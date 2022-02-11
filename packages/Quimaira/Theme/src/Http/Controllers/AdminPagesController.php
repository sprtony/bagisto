<?php

namespace Quimaira\Theme\Http\Controllers;

use Quimaira\Theme\Models\CmsValue;
use Illuminate\Support\Facades\Storage;

class AdminPagesController extends Controller
{
    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }


    public function indexHome()
    {
        $p = 'home';
        $page = CmsValue::all();
        return view($this->_config['view'], compact('page', 'p'));
    }


    public function update()
    {
        $page = CmsValue::all();

        foreach ($page as $value) {
            if (in_array($value->tipo, ['img', 'file'])) {
                $valor = CmsValue::find($value->id);
                $this->uploadImages(request()->all(), $valor, request()->input('page'), 'valor', $valor->clave);
            } else {
                CmsValue::where([['clave', $value->clave]])
                    ->update(['valor' => request()->input($value->clave)]);
            }
        }

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Banner']));
        return redirect()->back();
    }

    public function uploadImages($data, $entity, $dirname, $column, $input = "image")
    {
        if (isset($data[$input])) {
            $request = request();

            foreach ($data[$input] as $imageId => $image) {
                $file = $input . '.' . $imageId;
                $dir = $dirname . '/' . $entity->id;

                if ($request->hasFile($file)) {
                    if ($entity->{$column}) {
                        Storage::delete($entity->{$column});
                    }

                    $entity->{$column} = $request->file($file)->store($dir);
                    $entity->save();
                }
            }
        } else {
            if ($entity->{$column}) {
                Storage::delete($entity->{$column});
            }

            $entity->{$column} = null;
            $entity->save();
        }
    }
}

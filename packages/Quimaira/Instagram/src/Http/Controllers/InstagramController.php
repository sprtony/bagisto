<?php

namespace Quimaira\Instagram\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Quimaira\Instagram\Models\Instagram;
use function request;

class InstagramController extends Controller
{
    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }


    public function index()
    {
        return view($this->_config['view']);
    }


    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'name'        => 'required',
            'usuario'        => 'required',
            'image.*'     => 'mimes:jpeg,jpg,bmp,png',
        ]);

        $instagram = new Instagram;
        $instagram->name = request()->input('name');
        $instagram->usuario = request()->input('usuario');
        $instagram->orden = request()->input('position');
        $instagram->url = request()->input('url');

        $instagram->save();

        $this->uploadImages(request()->all(), $instagram);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Imagen Instagram']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $instagram = Instagram::findOrFail($id);

        return view($this->_config['view'], compact('instagram'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'name' => 'required',
            'usuario' => 'required',
            'image.*'         => 'mimes:jpeg,jpg,bmp,png',
        ]);

        $instagram = Instagram::findOrFail($id);
        $instagram->name = request()->input('name');
        $instagram->usuario = request()->input('name');
        $instagram->orden = request()->input('position');
        $instagram->url = request()->input('url');
        $instagram->save();

        $this->uploadImages(request()->all(), $instagram);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Imagen Instagram']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instagram = Instagram::findOrFail($id);
        try {
            Event::dispatch('catalog.instagram.delete.before', $id);

            $instagram->delete($id);

            Event::dispatch('catalog.instagram.delete.after', $id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Imagen Instagram']));

            return response()->json(['message' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Imagen Instagram']));
        }

        return response()->json(['message' => false], 400);
    }

    /**
     * Remove the specified resources from database
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        $suppressFlash = false;

        if (request()->isMethod('delete') || request()->isMethod('post')) {
            $indexes = explode(',', request()->input('indexes'));

            foreach ($indexes as $key => $value) {
                $instagram = Instagram::findOrFail($value);
                try {
                    Event::dispatch('catalog.instagram.delete.before', $value);

                    $instagram->delete($value);

                    Event::dispatch('catalog.instagram.delete.after', $value);
                } catch (\Exception $e) {
                    $suppressFlash = true;

                    continue;
                }
            }

            if (!$suppressFlash) {
                session()->flash('success', trans('admin::app.datagrid.mass-ops.delete-success'));
            } else {
                session()->flash('info', trans('admin::app.datagrid.mass-ops.partial-action', ['resource' => 'Attribute Family']));
            }

            return redirect()->back();
        } else {
            session()->flash('error', trans('admin::app.datagrid.mass-ops.method-error'));

            return redirect()->back();
        }
    }

    public function uploadImages($data, $instagram, $type = "image")
    {
        if (isset($data[$type])) {
            $request = request();

            foreach ($data[$type] as $imageId => $image) {
                $file = $type . '.' . $imageId;
                $dir = 'brand/' . $instagram->id;

                if ($request->hasFile($file)) {
                    if ($instagram->{$type}) {
                        Storage::delete($instagram->{$type});
                    }

                    $instagram->{$type} = $request->file($file)->store($dir);
                    $instagram->save();
                }
            }
        } else {
            if ($instagram->{$type}) {
                Storage::delete($instagram->{$type});
            }

            $instagram->{$type} = null;
            $instagram->save();
        }
    }

    public function all()
    {
        $instagrams = Instagram::all();
        return $instagrams;
    }
}

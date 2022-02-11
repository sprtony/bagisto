<?php

namespace Quimaira\Blog\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Quimaira\Blog\Models\BlogCategory;
use Quimaira\Blog\Models\BlogPost;

class BlogPostController extends Controller
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
    $categories = BlogCategory::all();
    return view($this->_config['view'], compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return \Illuminate\Http\Response
   */
  public function store()
  {
    $this->validate(request(), [
      'titulo'        => 'required',
      'slug'        => 'required|unique:blog_posts',
      'fecha'        => 'required',
      'liberacion'        => 'required',
      'image.*'     => 'mimes:jpeg,jpg,bmp,png',
      'image_mobile.*'     => 'mimes:jpeg,jpg,bmp,png',
      'category_id'     => 'required',
      'descripcion'     => 'required',
      'contenido'     => 'required',
    ]);

    $post = new BlogPost;
    $post->titulo = request()->input('titulo');
    $post->slug = request()->input('slug');
    $post->fecha = request()->input('fecha');
    $post->liberacion = request()->input('liberacion');
    $post->status = request()->input('status');
    $post->category_id = request()->input('category_id');
    $post->descripcion = request()->input('descripcion');
    $post->contenido = request()->input('contenido');
    $post->tags = request()->input('tags');
    $post->save();

    $this->uploadImages(request()->all(), $post, 'blog_posts');
    $this->uploadImages(request()->all(), $post, 'blog_posts', "image_mobile");

    session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Post']));

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
    $post = BlogPost::findOrFail($id);
    $categories = BlogCategory::all();
    return view($this->_config['view'], compact('post', 'categories'));
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
      'titulo'        => 'required',
      /* 'slug'        => 'required|unique:blog_posts', */
      'fecha'        => 'required',
      'liberacion'        => 'required',
      'image.*'     => 'mimes:jpeg,jpg,bmp,png',
      'image_mobile.*'     => 'mimes:jpeg,jpg,bmp,png',
      'category_id'     => 'required',
      'descripcion'     => 'required',
      'contenido'     => 'required',
    ]);

    $post = BlogPost::findOrFail($id);
    $post->titulo = request()->input('titulo');
    $post->slug = request()->input('slug');
    $post->fecha = request()->input('fecha');
    $post->liberacion = request()->input('liberacion');
    $post->status = request()->input('status');
    $post->category_id = request()->input('category_id');
    $post->descripcion = request()->input('descripcion');
    $post->contenido = request()->input('contenido');
    $post->tags = request()->input('tags');
    $post->save();

    $this->uploadImages(request()->all(), $post, 'blog_posts');
    $this->uploadImages(request()->all(), $post, 'blog_posts', "image_mobile");
    session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Post']));

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
    $post = BlogPost::findOrFail($id);
    try {
      Event::dispatch('blog.post.delete.before', $id);

      $post->delete($id);

      Event::dispatch('blog.post.delete.after', $id);

      session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Post']));

      return response()->json(['message' => true], 200);
    } catch (\Exception $e) {
      session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Post']));
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
        $post = BlogPost::findOrFail($value);
        try {
          Event::dispatch('blog.post.delete.before', $value);

          $post->delete($value);

          Event::dispatch('blog.post.delete.after', $value);
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

  public function uploadImages($data, $entity, $dirname, $type = "image")
  {
    if (isset($data[$type])) {
      $request = request();

      foreach ($data[$type] as $imageId => $image) {
        $file = $type . '.' . $imageId;
        $dir = $dirname . '/' . $entity->id;

        if ($request->hasFile($file)) {
          if ($entity->{$type}) {
            Storage::delete($entity->{$type});
          }

          $entity->{$type} = $request->file($file)->store($dir);
          $entity->save();
        }
      }
    } else {
      if ($entity->{$type}) {
        Storage::delete($entity->{$type});
      }

      $entity->{$type} = null;
      $entity->save();
    }
  }
}

<?php

namespace Quimaira\Blog\Http\Controllers;

use Quimaira\Blog\Models\BlogCategory;
use Quimaira\Blog\Models\BlogPost;

class BlogController extends Controller
{
  protected $_config;

  public function __construct()
  {
    $this->_config = request('_config');
  }


  public function index()
  {
    $categoria = BlogCategory::first();
    $categories = BlogCategory::all();
    $posts = BlogPost::where([
      ['category_id', $categoria->id],
      ['status', 1],
      ['liberacion', '<=', now()]
    ])
      ->orderBy('fecha', 'ASC')
      ->get();
    return view('shop::pages.blog.index', compact('categories', 'posts', 'categoria'));
  }

  public function search($slug)
  {
    //buscar categoria
    $categoria = BlogCategory::where('slug', $slug)->first();
    if (!empty($categoria)) {
      $categories = BlogCategory::all();
      $posts = BlogPost::where('category_id', $categoria->id)
        ->orderBy('fecha', 'ASC')
        ->get();
      return view('shop::pages.blog.index', compact('categories', 'posts', 'categoria'));
    }
    $post = BlogPost::where('slug', $slug)->firstOrFail();
    if (!empty($post)) {
      $recientes = BlogPost::orderBy('fecha', 'ASC')
        ->take(3)
        ->get();
      return view('shop::pages.blog.detalle', compact('post', 'recientes'));
    }
  }
}

@extends('admin::layouts.content')

@section('page_title')
    Blog Categorias
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Blog Categorias</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.blog.categories.create') }}" class="btn btn-lg btn-primary">
                    Agregar Categoria
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.blog.categories.list.before') !!}

        <div class="page-content">
            {!! app('Quimaira\Blog\DataGrids\BlogCategoriesDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.blog.categories.list.after') !!}
    </div>
@stop

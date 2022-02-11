@extends('admin::layouts.content')

@section('page_title')
    Posts
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Post</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-lg btn-primary">
                    Agregar Post
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.blog.post.list.before') !!}

        <div class="page-content">
            {!! app('Quimaira\Blog\DataGrids\BlogPostsDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.blog.post.list.after') !!}
    </div>
@stop

@extends('admin::layouts.content')

@section('page_title')
    Imagenes de Instagram
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Imagenes de Instagram</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.diseno.instagram.create') }}" class="btn btn-lg btn-primary">
                    Agregar Imagen de Instagram
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.diseno.instagram.list.before') !!}

        <div class="page-content">
            {!! app('Quimaira\Instagram\DataGrids\InstagramDataGrid')->render() !!}
        </div>

        {!! view_render_event('bagisto.admin.diseno.instagram.list.after') !!}
    </div>
@stop

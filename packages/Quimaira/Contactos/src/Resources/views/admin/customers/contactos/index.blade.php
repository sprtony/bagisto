@extends('admin::layouts.content')

@section('page_title')
    Mensajes de Contacto
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>Mensajes de Contacto</h1>
            </div>

            <div class="page-action">
                <a class="export-import" href="{{ route('admin.customers.contactos.download') }}">
                    <i class="export-icon"></i>
                    <span>
                        {{ __('admin::app.export.export') }}
                    </span>
                </a>
            </div>
        </div>


        <div class="page-content">
            {!! app('Quimaira\Contactos\DataGrids\ContactosDataGrid')->render() !!}
        </div>

    </div>
@stop

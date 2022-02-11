@extends('admin::layouts.content')

@section('page_title')
    Mensajes de Contacto
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <i class="icon angle-left-icon back-link"
                        onclick="history.length > 1 ? history.go(-1) : window.location = '{{ route('admin.dashboard.index') }}';"></i>
                    Ver Menaje de Contacto
                </h1>
            </div>

        </div>

        <div class="page-content">
            <div class="form-container">

                <accordian :title="'General'" :active="true">
                    <div slot="body">

                        <div class="control-group">
                            <label>Nombre</label>
                            <span class="control">{{ $pedido->nombre }}</span>
                        </div>

                        <div class="control-group">
                            <label>Empresa</label>
                            <span class="control">{{ $pedido->empresa }}</span>
                        </div>

                        <div class="control-group">
                            <label>Telefono</label>
                            <span class="control">{{ $pedido->telefono }}</span>
                        </div>

                        <div class="control-group">
                            <label>Email</label>
                            <span class="control">{{ $pedido->email }}</span>
                        </div>

                        <div class="control-group">
                            <label>Estado</label>
                            <span class="control">{{ $pedido->estado }}</span>
                        </div>

                        <div class="control-group">
                            <label>Ciudad</label>
                            <span class="control">{{ $pedido->ciudad }}</span>
                        </div>

                        <div class="control-group">
                            <label>Mensaje</label>
                            <span class="control">{{ $pedido->mensaje }}</span>
                        </div>


                        {!! view_render_event('bagisto.admin.catalog.marcas.edit_form_accordian.general.controls.after', ['marca' => $pedido]) !!}

                    </div>
                </accordian>
            </div>
        </div>

    </div>
@stop

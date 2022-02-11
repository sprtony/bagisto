@extends('admin::layouts.content')

@section('page_title')
    Agregar Blog Categoria
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.blog.categories.store') }}" @submit.prevent="onSubmit"
            enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link"
                            onclick="history.length > 1 ? history.go(-1) : window.location = '{{ route('admin.dashboard.index') }}';"></i>
                        Agregar Blog Categoria
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Guardar Categoria
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input type="hidden" name="locale" value="all" />

                    {!! view_render_event('bagisto.admin.blog.categories.create_form_accordian.general.before') !!}

                    <accordian :title="'General'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.blog.categories.create_form_accordian.general.controls.before') !!}

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">Nombre</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name"
                                    value="{{ old('name') }}" data-vv-as="&quot;Nombre&quot;" v-slugify-target="'slug'" />
                                <span class="control-error" v-if="errors.has('name')">@{{ errors . first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('slug') ? 'has-error' : '']">
                                <label for="slug" class="required">Slug</label>
                                <input type="text" v-validate="'required'" class="control" id="slug" name="slug"
                                    value="{{ old('Slug') }}" data-vv-as="&quot;Slug&quot;" />
                                <span class="control-error" v-if="errors.has('slug')">@{{ errors . first('slug') }}</span>
                            </div>


                            <div class="control-group" :class="[errors.has('order') ? 'has-error' : '']">
                                <label for="position">Orden</label>
                                <input type="text" v-validate="'numeric'" class="control" id="order" name="order"
                                    value="{{ old('order') }}" data-vv-as="&quot;Orden&quot;" />
                                <span class="control-error"
                                    v-if="errors.has('order')">@{{ errors . first('order') }}</span>
                            </div>

                            {!! view_render_event('bagisto.admin.blog.categories.create_form_accordian.general.controls.after') !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.blog.categories.create_form_accordian.general.after') !!}

                </div>
            </div>

        </form>
    </div>
@stop

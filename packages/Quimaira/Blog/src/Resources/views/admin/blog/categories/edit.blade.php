@extends('admin::layouts.content')

@section('page_title')
    Editar Blog Categorias
@stop

@section('content')
    <div class="content">
        @php
            $locale = request()->get('locale') ?: app()->getLocale();
        @endphp

        <form method="POST" action="" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link"
                            onclick="history.length > 1 ? history.go(-1) : window.location = '{{ route('admin.dashboard.index') }}';"></i>
                        Editar Blog Categorias
                    </h1>

                                   </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Guardar Blog Categorias
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input name="_method" type="hidden" value="PUT">

                    {!! view_render_event('bagisto.admin.blog.categories.edit_form_accordian.general.before', ['Categoria' => $category]) !!}

                    <accordian :title="'General'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.blog.categories.edit_form_accordian.general.controls.before', ['Categoria' => $category]) !!}

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">Nombre</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name"
                                    value="{{ old('name') ?: $category->name }}" data-vv-as="&quot;Nombre&quot;"
                                    v-slugify-target="'slug'" />
                                <span class="control-error" v-if="errors.has('name')">@{{ errors . first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('slug') ? 'has-error' : '']">
                                <label for="slug" class="required">Slug</label>
                                <input type="text" v-validate="'required'" class="control" id="slug" name="slug"
                                    value="{{ old('slug') ?: $category->slug }}" data-vv-as="&quot;Slug&quot;" />
                                <span class="control-error" v-if="errors.has('slug')">@{{ errors . first('slug') }}</span>
                            </div>


                            <div class="control-group" :class="[errors.has('position') ? 'has-error' : '']">
                                <label for="order">Orden</label>
                                <input type="text" v-validate="'numeric'" class="control" id="order" name="order"
                                    value="{{ old('order') ?: $category->order }}" data-vv-as="&quot;Orden&quot;" />
                                <span class="control-error"
                                    v-if="errors.has('order')">@{{ errors . first('order') }}</span>
                            </div>

                            {!! view_render_event('bagisto.admin.blog.categories.edit_form_accordian.general.controls.after', ['Categoria' => $category]) !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.blog.categories.edit_form_accordian.general.after', ['Categoria' => $category]) !!}


                </div>
            </div>

        </form>
    </div>
@stop

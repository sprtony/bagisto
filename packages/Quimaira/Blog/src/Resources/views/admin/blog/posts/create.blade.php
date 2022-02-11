@extends('admin::layouts.content')

@section('page_title')
    Agregar Post
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.blog.posts.store') }}" @submit.prevent="onSubmit"
            enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link"
                            onclick="history.length > 1 ? history.go(-1) : window.location = '{{ route('admin.dashboard.index') }}';"></i>
                        Agregar Post
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Guardar Post
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input type="hidden" name="locale" value="all" />

                    {!! view_render_event('bagisto.admin.blog.post.create_form_accordian.general.before') !!}

                    <accordian :title="'General'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.blog.post.create_form_accordian.general.controls.before') !!}

                            <div class="control-group" :class="[errors.has('titulo') ? 'has-error' : '']">
                                <label for="titulo" class="required">Titulo</label>
                                <input type="text" v-validate="'required'" class="control" id="titulo" name="titulo"
                                    value="{{ old('titulo') }}" data-vv-as="&quot;Titulo&quot;"
                                    v-slugify-target="'slug'" />
                                <span class="control-error"
                                    v-if="errors.has('titulo')">@{{ errors . first('titulo') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('slug') ? 'has-error' : '']">
                                <label for="slug" class="required">Slug</label>
                                <input type="text" v-validate="'required'" class="control" id="slug" name="slug"
                                    value="{{ old('Slug') }}" data-vv-as="&quot;Slug&quot;" />
                                <span class="control-error" v-if="errors.has('slug')">@{{ errors . first('slug') }}</span>
                            </div>


                            <div class="control-group" :class="[errors.has('fecha') ? 'has-error' : '']">
                                <label for="fecha">Fecha Publicacion (Fecha en el Post)</label>
                                <input type="date" class="control" id="fecha" name="fecha" value="{{ old('fecha') }}"
                                    data-vv-as="&quot;Fecha&quot;" />
                                <span class="control-error"
                                    v-if="errors.has('fecha')">@{{ errors . first('fecha') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('liberacion') ? 'has-error' : '']">
                                <label for="liberacion">Fecha de Liberacion</label>
                                <input type="date" class="control" id="liberacion" name="liberacion"
                                    value="{{ old('liberacion') }}" data-vv-as="&quot;Fecha de Liberacion&quot;" />
                                <span class="control-error"
                                    v-if="errors.has('liberacion')">@{{ errors . first('liberacion') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="video">Status</label>
                                <label class="switch">
                                    <input type="checkbox" class="control" id="status" name="status"
                                        data-vv-as="&quot;Status&quot;" value="1">
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <div class="control-group" :class="[errors.has('category_id') ? 'has-error' : '']">
                                <label for="category_id" class="required">Categoria</label>

                                <select type="text" class="control" name="category_id" v-validate="'required'"
                                    value="{{ old('category_id') }}" data-vv-as="&quot;Categoria&quot;">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <span class="control-error"
                                    v-if="errors.has('category_id')">@{{ errors . first('category_id') }}</span>
                            </div>

                            <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                                <label>Imagen</label>

                                <image-wrapper
                                    :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'"
                                    input-name="image" :multiple="false"></image-wrapper>

                                <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                    @foreach ($errors->get('image.*') as $key => $message)
                                        @php echo str_replace($key, 'Image', $message[0]); @endphp
                                    @endforeach
                                </span>

                            </div>

                            <div class="control-group {!! $errors->has('image_mobile.*') ? 'has-error' : '' !!}">
                                <label>Imagen Movil 740 * 740</label>

                                <image-wrapper
                                    :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'"
                                    input-name="image_mobile" :multiple="false"></image-wrapper>

                                <span class="control-error" v-if="{!! $errors->has('image_mobile.*') !!}">
                                    @foreach ($errors->get('image_mobile.*') as $key => $message)
                                        @php echo str_replace($key, 'Image', $message[0]); @endphp
                                    @endforeach
                                </span>
                            </div>

                            <div class="control-group" :class="[errors.has('descripcion') ? 'has-error' : '']">
                                <label for="descripcion" class="required">Descripcion</label>

                                <textarea type="text" class="control" id="descripcion" name="descripcion"
                                    v-validate="'required'"
                                    data-vv-as="&quot;Descripcion&quot;">{{ old('descripcion') }}</textarea>

                                <span class="control-error"
                                    v-if="errors.has('descripcion')">@{{ errors . first('description') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('contenido') ? 'has-error' : '']">
                                <label for="contenido" class="required">Contenido</label>

                                <textarea type="text" class="control" id="contenido" name="contenido"
                                    v-validate="'required'"
                                    data-vv-as="&quot;Contenido&quot;">{{ old('contenido') }}</textarea>

                                <span class="control-error"
                                    v-if="errors.has('contenido')">@{{ errors . first('contenido') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('tags') ? 'has-error' : '']">
                                <label for="tags">Tags (separadas por coma)</label>

                                <textarea type="text" class="control" id="tags" name="tags"
                                    data-vv-as="&quot;Tags&quot;">{{ old('tags') }}</textarea>

                                <span class="control-error"
                                    v-if="errors.has('tags')">@{{ errors . first('tags') }}</span>
                            </div>




                            {!! view_render_event('bagisto.admin.blog.posts.create_form_accordian.general.controls.after') !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.blog.posts.create_form_accordian.general.after') !!}

                </div>
            </div>

        </form>
    </div>
@stop

@push('scripts')
    <script src="{{ asset('vendor/webkul/admin/assets/js/tinyMCE/tinymce.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            tinymce.init({
                selector: 'textarea#contenido',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor link hr | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent  | removeformat | code | table',
                image_advtab: true
            });
        });

        Vue.component('description', {

            template: '#description-template',

            inject: ['$validator'],

            data: function() {
                return {
                    isRequired: true,
                }
            },

            created: function() {
                var this_this = this;

                $(document).ready(function() {
                    $('#display_mode').on('change', function(e) {
                        if ($('#display_mode').val() != 'products_only') {
                            this_this.isRequired = true;
                        } else {
                            this_this.isRequired = false;
                        }
                    })
                });
            }
        })
    </script>
@endpush

@extends('admin::layouts.content')

@section('page_title')
    Imagenes de Intragram
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.diseno.instagram.store') }}" @submit.prevent="onSubmit"
            enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link"
                            onclick="history.length > 1 ? history.go(-1) : window.location = '{{ route('admin.dashboard.index') }}';"></i>
                        Imagenes de Instagram
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Guardar Imagen
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input type="hidden" name="locale" value="all" />

                    {!! view_render_event('bagisto.admin.catalog.marcas.create_form_accordian.general.before') !!}

                    <accordian :title="'General'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.marcas.create_form_accordian.general.controls.before') !!}

                            <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                                <label for="name" class="required">Nombre</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name"
                                    value="{{ old('name') }}"
                                    data-vv-as="&quot;{{ __('admin::app.catalog.categories.name') }}&quot;" />
                                <span class="control-error" v-if="errors.has('name')">@{{ errors . first('name') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('usuario') ? 'has-error' : '']">
                                <label for="usuario" class="required">Usuario</label>
                                <input type="text" v-validate="'required'" class="control" id="usuario" name="usuario"
                                    value="{{ old('usuario') }}" data-vv-as="&quot;Usuario&quot;" />
                                <span class="control-error"
                                    v-if="errors.has('usuario')">@{{ errors . first('usuario') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('position') ? 'has-error' : '']">
                                <label for="position">{{ __('admin::app.catalog.categories.position') }}</label>
                                <input type="text" v-validate="'numeric'" class="control" id="position" name="position"
                                    value="{{ old('position') }}"
                                    data-vv-as="&quot;{{ __('admin::app.catalog.categories.position') }}&quot;" />
                                <span class="control-error"
                                    v-if="errors.has('position')">@{{ errors . first('position') }}</span>
                            </div>

                            <div class="control-group" :class="[errors.has('url') ? 'has-error' : '']">
                                <label for="position">URL</label>
                                <input type="text" class="control" id="url" name="url" value="{{ old('url') }}"
                                    data-vv-as="&quot;URL&quot;" />
                                <span class="control-error"
                                    v-if="errors.has('position')">@{{ errors . first('position') }}</span>
                            </div>


                            <div class="control-group {!! $errors->has('image.*') ? 'has-error' : '' !!}">
                                <label>{{ __('admin::app.catalog.categories.image') }} 310 x 310</label>

                                <image-wrapper
                                    :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'"
                                    input-name="image" :multiple="false"></image-wrapper>

                                <span class="control-error" v-if="{!! $errors->has('image.*') !!}">
                                    @foreach ($errors->get('image.*') as $key => $message)
                                        @php echo str_replace($key, 'Image', $message[0]); @endphp
                                    @endforeach
                                </span>

                            </div>

                            {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.controls.after') !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.category.create_form_accordian.general.after') !!}



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
                selector: 'textarea#description',
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

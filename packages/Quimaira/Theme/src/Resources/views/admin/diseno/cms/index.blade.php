@extends('admin::layouts.content')

@section('page_title')
    Configuraciones de {{ $p }}
@stop

@section('content')
    <div class="content">

        <form method="POST" action="{{ route('admin.diseno.cms.update') }}" @submit.prevent="onSubmit"
            enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link"
                            onclick="history.length > 1 ? history.go(-1) : window.location = '{{ route('admin.dashboard.index') }}';"></i>
                        Configuraciones de {{ $p }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        Guardar
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()
                    <input type="hidden" name="page" value="{{ $p }}" />

                    <accordian :title="'Home'" :active="true">
                        <div slot="body">
                            @foreach ($page as $value)
                                <div class="control-group">
                                    <label for="{{ $value->clave }}">{{ $value->titulo }}</label>
                                    @switch($value->tipo)

                                        @case('img')
                                            <image-wrapper
                                                :button-label="'{{ __('admin::app.catalog.products.add-image-btn-title') }}'"
                                                input-name="{{ $value->clave }}" :multiple="false" @if ($value->valor) :images='"{{ asset('storage/' . $value->valor) }}"' @endif> </image-wrapper>
                                        @break

                                        @case('textarea')

                                            <textarea type="text" class="control" id="{{ $value->clave }}"
                                                name="{{ $value->clave }}" v-validate="'required'"
                                                data-vv-as="&quot;{{ $value->clave }}&quot;">{{ old($value->clave) ?? ($value->valor ?? '') }}</textarea>

                                        @break

                                        @case('color')
                                            <input type="color" name="{{ $value->clave }}" value="{{ old($value->clave) ?? ($value->valor ?? '') }}">
                                        @break

                                    @endswitch
                                </div>
                            @endforeach
                        </div>
                    </accordian>

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
                selector: 'textarea',
                height: 200,
                width: "100%",
                plugins: 'image imagetools media wordcount save fullscreen code table lists link hr',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor alignleft aligncenter alignright alignjustify | link hr | numlist bullist outdent indent  | removeformat | code | table',
                image_advtab: true,
                valid_elements: '*[*]'
            });
        });
    </script>
@endpush

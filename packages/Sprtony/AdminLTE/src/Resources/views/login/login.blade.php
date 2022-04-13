@extends('admin::login.master')

@section('page_title')
    {{ __('admin::app.users.sessions.title') }}
@stop

@section('content')

    <div class="login-box">
        <div class="card card-outline card-primary">

            @include('admin::login.sections.header')

            <div class="card-body">
                <form method="POST" action="{{ route('admin.session.store') }}" @submit.prevent="onSubmit">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" v-validate="'required|email'" class="form-control"
                            :class="[errors.has('email') ? 'is-invalid' : '']" id="email" name="email"
                            placeholder="{{ __('admin::app.users.sessions.email') }}"
                            data-vv-as="&quot;{{ __('admin::app.users.sessions.email') }}&quot;">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <span class="error invalid-feedback" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                    </div>


                    <div class="input-group mb-3">
                        <input type="password" v-validate="'required|min:6'" class="form-control"
                            :class="[errors.has('password') ? 'is-invalid' : '']" id="password" name="password"
                            placeholder="{{ __('admin::app.users.sessions.password') }}"
                            data-vv-as="&quot;{{ __('admin::app.users.sessions.password') }}&quot;">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="error invalid-feedback" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <a
                                href="{{ route('admin.forget-password.create') }}">{{ __('admin::app.users.sessions.forget-password-link-title') }}</a>

                        </div>
                        <div class="col-4">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ __('admin::app.users.sessions.submit-btn-title') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


@stop

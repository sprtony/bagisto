@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.dashboard.title') }}
@stop

@section('header')
    {{ __('admin::app.dashboard.title') }}
@stop

@section('actions')
    <date-filter start="{{ $startDate->format('Y-m-d') }}" end="{{ $endDate->format('Y-m-d') }}"></date-filter>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-3 col-6">
            @include('admin::dashboard.widgets.total-customers')
        </div>
        <div class="col-lg-3 col-6">
            @include('admin::dashboard.widgets.total-orders')
        </div>
        <div class="col-lg-3 col-6">
            @include('admin::dashboard.widgets.total-sales')
        </div>
        <div class="col-lg-3 col-6">
            @include('admin::dashboard.widgets.avg-sales')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @include('admin::dashboard.widgets.sales-graph')
        </div>

        <div class="col-6">
            @include('admin::dashboard.widgets.top-selling-category')
        </div>

        <div class="col-6">
            @include('admin::dashboard.widgets.top-selling-product')
        </div>

        <div class="col-6">
            @include('admin::dashboard.widgets.top-selling-customer')
        </div>

        <div class="col-6">
            @include('admin::dashboard.widgets.stock-threshold')
        </div>
    </div>

@stop

@push('scripts')
    @include('admin::dashboard.date-filter')
    <script>
        Vue.component('date-filter', {

            template: '#date-filter-template',

            data: function() {
                return {
                    start: "{{ $startDate->format('Y-m-d') }}",
                    end: "{{ $endDate->format('Y-m-d') }}",
                }
            },


            methods: {
                applyFilter: function(field, date) {
                    this[field] = date;

                    window.location.href = "?start=" + this.start + '&end=' + this.end;
                }
            }
        });
    </script>

@endpush

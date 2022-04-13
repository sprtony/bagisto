@extends('admin::layouts.master')

@section('page_title')
    {{ __('admin::app.sales.orders.title') }}
@stop

@section('header')
    {{ __('admin::app.sales.orders.title') }}
@stop

@section('actions')
    <div class="export-import" @click="showModal('downloadDataGrid')">
        <i class="export-icon"></i>
        <span>
            {{ __('admin::app.export.export') }}
        </span>
    </div>
@stop

@section('content')
    <div class="page-content">
        @inject('orderGrid', 'Webkul\Admin\DataGrids\OrderDataGrid')
        {!! $orderGrid->render() !!}
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header">{{ __('admin::app.export.download') }}</h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>
@stop

@push('scripts')
    @include('admin::export.export', ['gridName' => $orderGrid])
@endpush


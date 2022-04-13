<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {{ __('admin::app.dashboard.customer-with-most-sales') }}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach ($statistics['customer_with_most_sales'] as $item)
                <li class="item">
                    <div class="product-info">
                        @if ($item->customer_id)
                            <a href="{{ route('admin.customer.edit', $item->customer_id) }}">
                        @endif
                        {{ $item->customer_full_name }}
                        @if ($item->customer_id)
                            </a>
                        @endif
                        <span class="product-description">
                            {{ __('admin::app.dashboard.order-count', ['count' => $item->total_orders]) }}
                            &nbsp;.&nbsp;
                            {{ __('admin::app.dashboard.revenue', [
                                'total' => core()->formatBasePrice($item->total_base_grand_total),
                            ]) }}
                        </span>
                    </div>
                </li>

            @endforeach
        </ul>
        @if (!count($statistics['customer_with_most_sales']))

            <div class="d-flex justify-content-center align-items-center py-4 flex-column">
                <i class="fas fa-exclamation" style="font-size: 30px;"></i>
                <p>{{ __('admin::app.common.no-result-found') }}</p>
            </div>

        @endif
    </div>

</div>

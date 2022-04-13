<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {{ __('admin::app.dashboard.top-performing-categories') }}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach ($statistics['top_selling_categories'] as $item)
                <li class="item">
                    <div class="product-info">
                        <a href="{{ route('admin.catalog.categories.edit', $item->category_id) }}"
                            class="product-title">{{ $item->name }}</a>
                        <span class="product-description">
                            {{ __('admin::app.dashboard.product-count', ['count' => $item->total_products]) }}
                            &nbsp;.&nbsp;
                            {{ __('admin::app.dashboard.sale-count', ['count' => $item->total_qty_invoiced]) }}
                        </span>
                    </div>
                </li>

            @endforeach
        </ul>
        @if (!count($statistics['top_selling_categories']))

            <div class="d-flex justify-content-center align-items-center py-4 flex-column">
                <i class="fas fa-exclamation" style="font-size: 30px;"></i>
                <p>{{ __('admin::app.common.no-result-found') }}</p>
            </div>

        @endif
    </div>

</div>

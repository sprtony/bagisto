<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {{ __('admin::app.dashboard.stock-threshold') }}
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>

    <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach ($statistics['stock_threshold'] as $item)
                <li class="item">
                    <div class="product-img">
                        <?php $productBaseImage = productimage()->getProductBaseImage($item->product); ?>
                        <img src="{{ $productBaseImage['small_image_url'] }}" alt="Product Image"
                            class="img-size-50">
                    </div>

                    <div class="product-info">
                        <a href="{{ route('admin.catalog.products.edit', $item->product_id) }}"
                            class="product-title">
                            @if (isset($item->product->name))
                                {{ $item->product->name }}
                            @endif
                        </a>
                        <span class="product-description">
                            {{ __('admin::app.dashboard.qty-left', ['qty' => $item->total_qty]) }}
                        </span>
                    </div>
                </li>

            @endforeach
        </ul>
        @if (!count($statistics['stock_threshold']))

            <div class="d-flex justify-content-center align-items-center py-4 flex-column">
                <i class="fas fa-exclamation" style="font-size: 30px;"></i>
                <p>{{ __('admin::app.common.no-result-found') }}</p>
            </div>

        @endif
    </div>

</div>

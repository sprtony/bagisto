@if (request()->route()->getName() != 'admin.configuration.index')
    @php $keys = explode('.', $menu->currentKey);  @endphp
    @if ($items = \Illuminate\Support\Arr::get($menu->items, implode('.children.', array_slice($keys, 0, 2)) . '.children'))
            @foreach (\Illuminate\Support\Arr::get($menu->items, implode('.children.', array_slice($keys, 0, 2)) . '.children') as $item)
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ $item['url'] }}" class="nav-link">{{ trans($item['name']) }}</a>
                </li>
            @endforeach
    @endif
@else

    @if ($items = \Illuminate\Support\Arr::get($config->items, request()->route('slug') . '.children'))
            @foreach ($items as $key => $item)
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.configuration.index', (request()->route('slug') . '/' . $key)) }}" class="nav-link">{{ trans($item['name']) }}</a>
                </li>
            @endforeach
    @endif
@endif
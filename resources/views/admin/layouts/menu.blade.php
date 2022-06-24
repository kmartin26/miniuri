

<nav class="flex w-full">
    <ul class="w-full m-0 p-0 h-12 text-white">
        @foreach (App\Models\Admin\Menu::$menu as $item)
            <li>
                <a class="{{ (request()->routeIs($item['route'])) ? 'active ' : '' }}{{isset($item['class']) ? $item['class'] : ''}}" href="{{ route($item['route']) }}"><i class="{{ $item['icon'] }}"></i>{{ $item['name']}}</a>
            </li>
        @endforeach
    </ul>
</nav>
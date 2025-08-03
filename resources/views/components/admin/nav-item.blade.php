<li class="menu-item {{ count($subMenu) ? 'has-children' : '' }}">

    <a
        href="{{ $route ?? 'javascript:void(0);' }}"
        class="menu-item-button"
    >
        <div class="icon"><i class="{{ $icon }}"></i></div>
        <div class="text">{{ is_array($text) ? implode(' ', $text) : __($text) }}</div>

    </a>

    @if (count($subMenu))
        <ul class="sub-menu">
            @foreach ($subMenu as $item)
                <x-nav-sub-item
                    :text="$item['text']"
                    :route="$item['route']"
                />
            @endforeach
        </ul>
    @endif
</li>

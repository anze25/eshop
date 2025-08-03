<ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
    @foreach ($items as $index => $item)
        <li>
            @if (isset($item['route']))
                <a href="{{ $item['route'] }}">
                    <div class="text-tiny">@lang($item['text'])</div>
                </a>
            @else
                <div class="text-tiny">@lang($item['text'])</div>
            @endif
        </li>

        @if (!$loop->last)
            <li>
                <i class="icon-chevron-right"></i>
            </li>
        @endif
    @endforeach
</ul>

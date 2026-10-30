@if ($paginator->hasPages())
    <nav class="flex flex-wrap items-center justify-center gap-2" role="navigation">
        @if ($paginator->onFirstPage())
            <span class="btn btn-ghost pointer-events-none opacity-50">{{ __('ui.pagination.prev') }}</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-ghost">{{ __('ui.pagination.prev') }}</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-2 text-muted">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="btn btn-primary">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="btn btn-ghost">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-ghost">{{ __('ui.pagination.next') }}</a>
        @else
            <span class="btn btn-ghost pointer-events-none opacity-50">{{ __('ui.pagination.next') }}</span>
        @endif
    </nav>
@endif

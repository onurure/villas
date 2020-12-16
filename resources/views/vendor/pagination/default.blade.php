@if ($paginator->hasPages())
    <nav class="pagination">
        <ul>
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a href="#" class="current-page">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>

    <nav class="pagination-next-prev">
        <ul>
            @if ($paginator->onFirstPage())
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" class="prev">Previous</a></li>
            @endif
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" class="next">Next</a></li>
            @else
            @endif
        </ul>
    </nav>

@endif

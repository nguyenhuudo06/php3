@if ($paginator->hasPages())
<div class="pagination d-flex justify-content-center mt-5">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a href="#" class="rounded no-pointer-events">&lsaquo;</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="rounded">&lsaquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a href="#" class="rounded disabled">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <p class="active">{{ $page }}</p>
                        @else
                            <a href="{{ $url }}" >{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="rounded">&rsaquo;</a>
            @else
                <p class="rounded no-pointer-events">&rsaquo;</p>
            @endif
    </div>
@endif

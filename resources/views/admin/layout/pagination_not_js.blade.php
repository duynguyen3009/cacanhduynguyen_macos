@if ($paginator->hasPages())
<nav class="app-pagination mt-5">
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" >Previous</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled page-item">{{ $element }}</li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)" data-page="{{ $page }}">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}" >{{ $page }}</a></li>
                        {{-- <li class="page-item"><a class="page-link" href="javascript:void(0)"  data-href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a></li> --}}
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                {{-- <a class="page-link" name="next-page" href="javascript:void(0)" data-href="2" data-page="2" rel="next">Next</a> --}}
                {{-- <a class="page-link" name="next-page" href="javascript:void(0)" data-href="{{ $paginator->nextPageUrl() }}" data-page="{{ $paginator->currentPage() + 1 }}" rel="next">Next</a> --}}
                <a class="page-link" name="next-page" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
            </li>
        @else
            <li class="disabled page-item">
                <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-disabled="true">Next</a>
            </li>
        @endif
    </ul>
</nav>
@endif

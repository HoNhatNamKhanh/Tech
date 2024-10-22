<div class="d-flex flex-column flex-sm-fill d-sm-flex align-items-center justify-content-between p-3">
    <div>
        <p class="small text-muted mb-0">
            {!! __('Showing') !!}
            <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span class="fw-semibold">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </p>
    </div>

    <nav>
        <ul class="pagination justify-content-center mb-0">
            {{-- Previous Page Link --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                @if ($paginator->onFirstPage())
                    <span class="page-link text-muted" aria-hidden="true">Previous</span>
                @else
                    <a class="page-link text-dark" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        aria-label="@lang('pagination.previous')">Previous</a>
                @endif
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link text-muted">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}"
                            aria-current="{{ $page == $paginator->currentPage() ? 'page' : '' }}">
                            @if ($page == $paginator->currentPage())
                                <span class="page-link bg-light text-dark">{{ $page }}</span>
                            @else
                                <a class="page-link bg-light text-dark" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                @if ($paginator->hasMorePages())
                    <a class="page-link text-dark" href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">Next</a>
                @else
                    <span class="page-link text-muted" aria-hidden="true">Next</span>
                @endif
            </li>
        </ul>
    </nav>
</div>

<style>
    .page-link {
        background-color: #f8f9fa;
        /* Light gray background */
        color: #6c757d;
        /* Gray text for non-active items */
        border: 1px solid #dee2e6;
        /* Border color */
        transition: background-color 0.3s, color 0.3s;
        /* Smooth transition for hover */
    }

    .page-item.active .page-link {
        background-color: #e9ecef;
        /* Darker gray for active item */
        color: #343a40;
        /* Dark text for active item */
        font-weight: bold;
        /* Bold for active item */
    }

    .page-item.disabled .page-link {
        color: #adb5bd;
        /* Muted gray for disabled items */
    }

    .page-link:hover {
        background-color: #e2e6ea;
        /* Darker gray on hover */
        color: #343a40;
        /* Dark text on hover */
    }
</style>
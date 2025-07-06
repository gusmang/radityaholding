@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link" aria-hidden="true">&lsaquo;</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @php
        $start = max($paginator->currentPage() - 2, 1);
        $end = min($start + 4, $paginator->lastPage());
        $start = max($end - 4, 1); // Recalculate start if end is too close to last page
        @endphp

        @php
        $role_name = isset($_GET['role_name']) ? $_GET['role_name'] : "";
        @endphp

        @foreach ($element as $page => $url)
        @if ($page >= $start && $page <= $end) @if ($page==$paginator->currentPage())
            
            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $url."&tab=users&role_name=".$role_name }}">{{ $page }}</a>
            </li>
            @endif
            @endif
            @endforeach
            @endif
            @endforeach
            {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link" aria-hidden="true">&rsaquo;</span>
        </li>
        @endif
    </ul>
</nav>
@endif

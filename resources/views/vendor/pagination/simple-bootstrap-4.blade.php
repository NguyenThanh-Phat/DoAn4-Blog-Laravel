@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">Trước</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Trước</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Sau</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">Sau</span>
                </li>
            @endif
        </ul>
    </nav>
@endif


{{-- @if ($paginator->hasPages())

<nav>
    <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
        <li class="page-item"><a class="page-link" href="#">Trước</a></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Trước</a></li>
        @endif

        @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Kế tiếp</a></li>
        @else
        <li class="page-item"><a class="page-link" href="#">Kế tiếp</a></li>
        @endif
    </ul>
</nav>

@endif --}}


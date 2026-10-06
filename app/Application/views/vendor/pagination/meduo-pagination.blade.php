{{-- DGA Platforms Code — Pagination component --}}
@if ($paginator->hasPages())
    @php $isAr = config('app.locale') == 'ar'; @endphp
    <nav class="dga-pagination-nav" role="navigation" aria-label="{{ $isAr ? 'ترقيم الصفحات' : 'Pagination' }}">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item prev disabled" aria-disabled="true">
                    <span class="page-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="{{ $isAr ? '9 18 15 12 9 6' : '15 18 9 12 15 6' }}"/></svg>
                        <span class="dga-page-label">{{ $isAr ? 'السابق' : 'Previous' }}</span>
                    </span>
                </li>
            @else
                <li class="page-item prev">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ $isAr ? 'الصفحة السابقة' : 'Previous page' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="{{ $isAr ? '9 18 15 12 9 6' : '15 18 9 12 15 6' }}"/></svg>
                        <span class="dga-page-label">{{ $isAr ? 'السابق' : 'Previous' }}</span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link" aria-hidden="true">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}" aria-label="{{ $isAr ? 'الصفحة' : 'Page' }} {{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item next">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ $isAr ? 'الصفحة التالية' : 'Next page' }}">
                        <span class="dga-page-label">{{ $isAr ? 'التالي' : 'Next' }}</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="{{ $isAr ? '15 18 9 12 15 6' : '9 18 15 12 9 6' }}"/></svg>
                    </a>
                </li>
            @else
                <li class="page-item next disabled" aria-disabled="true">
                    <span class="page-link">
                        <span class="dga-page-label">{{ $isAr ? 'التالي' : 'Next' }}</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="{{ $isAr ? '15 18 9 12 15 6' : '9 18 15 12 9 6' }}"/></svg>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

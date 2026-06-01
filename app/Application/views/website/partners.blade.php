@extends(layoutExtend('website'))

@section('title'){{ trans('home.HomeTitle') }} - {{ trans('home.accreditations') }}@endsection
@section('description'){{ trans('website.Footer IGTS') }}@endsection
@section('keywords')@endsection

@push('js')
<script>
function animateValue(obj, start, end, duration) {
    let s = null;
    const step = (t) => {
        if (!s) s = t;
        const p = Math.min((t - s) / duration, 1);
        obj.innerHTML = Math.floor(p * (end - start) + start).toLocaleString('ar-EG');
        if (p < 1) window.requestAnimationFrame(step);
    };
    window.requestAnimationFrame(step);
}
window.addEventListener('DOMContentLoaded', function() {
    var n1 = document.getElementById('dgaPartnersStat1'); if (n1) animateValue(n1, 0, 300000, 1200);
    var n2 = document.getElementById('dgaPartnersStat2'); if (n2) animateValue(n2, 0, 24, 1200);
    var n3 = document.getElementById('dgaPartnersStat3'); if (n3) animateValue(n3, 0, 300, 1200);
    var n4 = document.getElementById('dgaPartnersStat4'); if (n4) animateValue(n4, 0, 3, 1200);
});
</script>
@endpush

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    <section class="dga-page-hero">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span>شركاؤنا</span>
            </nav>
            <h1 class="dga-page-title">شركاؤنا في النجاح</h1>
            <p class="dga-page-sub">نفتخر بشراكاتنا الاستراتيجية مع نخبة من المؤسسات والجهات المعتمدة</p>
        </div>
    </section>

    <section class="dga-sec">
        <div class="dga-wrap">
            <div class="dga-partners-list">
                @foreach($Partners as $key => $data)
                <div class="dga-partner-row">
                    <div class="dga-partner-row-logo">
                        @if($data->logo)
                            <img src="{{ large($data->logo) }}" alt="{{ $data->title_lang }}" loading="lazy">
                        @else
                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/></svg>
                        @endif
                    </div>
                    <div class="dga-partner-row-body">
                        <h3>{{ $data->title_lang }}</h3>
                        @if($data->description_lang)
                        <p>{{ $data->description_lang }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="dga-pagination">
                {{ $Partners->links('pagination::meduo-pagination') }}
            </div>
        </div>
    </section>

    {{-- Stats banner --}}
    <section class="dga-sec">
        <div class="dga-wrap">
            <div class="dga-cta">
                <div class="dga-cta-orb dga-cta-orb1"></div>
                <div class="dga-cta-orb dga-cta-orb2"></div>
                <div class="dga-stats-banner">
                    <div class="dga-stats-banner-item">
                        <strong><span id="dgaPartnersStat1">0</span>+</strong>
                        <span>{{ trans('website.Trainees count') }}</span>
                    </div>
                    <div class="dga-stats-banner-sep"></div>
                    <div class="dga-stats-banner-item">
                        <strong><span id="dgaPartnersStat2">0</span></strong>
                        <span>{{ trans('website.Countries count') }}</span>
                    </div>
                    <div class="dga-stats-banner-sep"></div>
                    <div class="dga-stats-banner-item">
                        <strong><span id="dgaPartnersStat3">0</span>+</strong>
                        <span>{{ trans('website.Experts count') }}</span>
                    </div>
                    <div class="dga-stats-banner-sep"></div>
                    <div class="dga-stats-banner-item">
                        <strong><span id="dgaPartnersStat4">0</span></strong>
                        <span>{{ trans('website.Regional headquarters') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection

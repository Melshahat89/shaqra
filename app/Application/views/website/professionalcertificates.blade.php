@extends(layoutExtend('website'))

@section('title'){{ trans('home.HomeTitle') }}@endsection
@section('description'){{ trans('home.HomeDescription') }}@endsection
@section('keywords'){{ trans('home.HomeKeywords') }}@endsection

@push('css')
<link href="{{ asset('website') }}/css/front/dga-design-system.css?v=5.0" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>body > br, body > b { display: none !important; }</style>
@endpush

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

{{-- ══════════════════════════════════════
     HERO — full-width photo + overlay
══════════════════════════════════════ --}}
<section class="dga-hero">
    {{-- overlay gradient on top of CSS background --}}
    <div class="dga-hero-overlay"></div>

    <div class="dga-hero-center">
        <span class="dga-hero-eyebrow">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
            منصة الشهادات الاحترافية · جامعة شقراء
        </span>

        <h1>من أجل مستقبل <span class="dga-hero-gold">أكثر احترافاً</span></h1>

        <p>شهادات مهنية معتمدة تُعزز مسارك الوظيفي — تعلّم في أي وقت ومن أي مكان مع نخبة من أفضل المدربين والخبراء.</p>

        {{-- search bar --}}
        <form action="{{ url('/allcourses/category') }}" method="GET" class="dga-hero-searchbar">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" name="key" placeholder="ابحث عن دورة أو شهادة..." autocomplete="off">
            <button type="submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                بحث
            </button>
        </form>

        <div class="dga-hero-actions">
            <a href="{{ url('professional-certificates/category') }}" class="dga-btn dga-btn-gold">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                استعرض الشهادات
            </a>
            <a href="{{ url('/subscriptions') }}" class="dga-btn dga-btn-outline-white">
                خطط الاشتراك
            </a>
        </div>
    </div>

    {{-- stats strip inside hero at bottom --}}
    <div class="dga-hero-stats">
        <div class="dga-hero-stat">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            <div><strong>+1,000</strong><span>دورة معتمدة</span></div>
        </div>
        <div class="dga-hero-stat-sep"></div>
        <div class="dga-hero-stat">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            <div><strong>+50,000</strong><span>متعلم مسجل</span></div>
        </div>
        <div class="dga-hero-stat-sep"></div>
        <div class="dga-hero-stat">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
            <div><strong>+200</strong><span>مدرب معتمد</span></div>
        </div>
        <div class="dga-hero-stat-sep"></div>
        <div class="dga-hero-stat">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            <div><strong>98%</strong><span>رضا المتعلمين</span></div>
        </div>
    </div>
</section>

<main id="main-content">

{{-- ══════════════════════════════════════
     CATEGORIES
══════════════════════════════════════ --}}
@if(isset($categories) && $categories->count())
<section class="dga-sec dga-sec-gray">
    <div class="dga-wrap">
        <div class="dga-sec-head center">
            <div class="dga-line"></div>
            <h2>تصفح حسب <span class="dga-green">التخصص</span></h2>
            <p>اختر المجال الذي يناسب تطلعاتك المهنية</p>
        </div>
        <div class="dga-cats-grid" id="dgaCatsGrid">
            @foreach($categories as $i => $cat)
            <a href="{{ url('/allcourses/category/'.$cat->slug) }}"
               class="dga-cat-card{{ $i >= 12 ? ' dga-cat-hidden' : '' }}">
                <span class="dga-cat-icon">
                    <i class="hero-icons {{ $cat->color_code }}"></i>
                </span>
                <span class="dga-cat-name">{{ $cat->name_lang }}</span>
            </a>
            @endforeach
        </div>
        @if($categories->count() > 12)
        <div style="text-align:center;margin-top:28px;">
            <button class="dga-show-more" id="dgaCatBtn" onclick="dgaToggleCats()">
                عرض كل التخصصات ({{ $categories->count() }})
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
        </div>
        @endif
    </div>
</section>
@endif

{{-- ══════════════════════════════════════
     COURSES
══════════════════════════════════════ --}}
@if(isset($featuredCourses) && $featuredCourses->count())
<section class="dga-sec">
    <div class="dga-wrap">
        <div class="dga-sec-head between">
            <div>
                <div class="dga-line"></div>
                <h2>{{ trans('professionalcertificates.professionalcertificates') }}</h2>
                <p>شهادات مهنية معتمدة تُعزز مسارك الوظيفي</p>
            </div>
            <a href="{{ url('professional-certificates/category') }}" class="dga-btn dga-btn-outline">
                عرض الكل
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
        </div>
        <div class="dga-grid-4">
            @foreach($featuredCourses as $course)
            @php
                $disc = (userCountry()['code'] === 'EG') ? $course->discount_egp : $course->discount_usd;
                $imgSrc = medium($course->image);
                $isPlaceholder = (strpos($imgSrc, 'placeholder') !== false);
            @endphp
            <article class="dga-card">
                <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-card-img{{ $isPlaceholder ? ' dga-card-img-placeholder' : '' }}">
                    @if($isPlaceholder)
                    <div class="dga-card-placeholder">
                        <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        <span>{{ isset($course->categories) && $course->categories ? $course->categories->name_lang : 'دورة تدريبية' }}</span>
                    </div>
                    @else
                    <img src="{{ $imgSrc }}" alt="{{ $course->title_lang }}" loading="lazy">
                    @endif
                    @if($disc > 0)
                        <span class="dga-tag dga-tag-red">خصم {{ round($disc) }}%</span>
                    @else
                        <span class="dga-tag dga-tag-gold">شهادة معتمدة</span>
                    @endif
                </a>
                <div class="dga-card-body">
                    @if(isset($course->categories) && $course->categories)
                        <span class="dga-card-cat">{{ $course->categories->name_lang }}</span>
                    @endif
                    <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-card-title">{{ $course->title_lang }}</a>
                    <div class="dga-card-meta">
                        @if($course->courselectures->count())
                        <span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                            {{ $course->courselectures->count() }} {{ trans('courses.lectures') }}
                        </span>
                        @endif
                        @if($course->visits > 0)
                        <span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            {{ $course->visits >= 1000 ? number_format($course->visits/1000,1).'ألف' : $course->visits }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="dga-card-foot">
                    <div class="dga-card-price">{!! $course->PriceText !!}</div>
                    <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-btn dga-btn-sm dga-btn-green">التفاصيل</a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════
     WHY US
══════════════════════════════════════ --}}
<section class="dga-sec dga-sec-gray">
    <div class="dga-wrap">
        <div class="dga-sec-head center">
            <div class="dga-line"></div>
            <h2>لماذا تختار <span class="dga-green">منصتنا</span>؟</h2>
            <p>مزايا تجعل تجربتك التعليمية استثنائية</p>
        </div>
        <div class="dga-why-grid">
            <div class="dga-why-card">
                <div class="dga-why-icon">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                </div>
                <h3>شهادات معتمدة</h3>
                <p>شهادات إتمام معتمدة تُعزز سيرتك الذاتية وتفتح آفاقاً مهنية أوسع.</p>
            </div>
            <div class="dga-why-card">
                <div class="dga-why-icon">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <h3>تعلّم في أي وقت</h3>
                <p>وصول غير محدود من أي جهاز في أي وقت يناسبك، بدون انقطاع.</p>
            </div>
            <div class="dga-why-card">
                <div class="dga-why-icon">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h3>مدربون خبراء</h3>
                <p>نخبة من المدربين المعتمدين ذوي الخبرة العملية والأكاديمية.</p>
            </div>
            <div class="dga-why-card">
                <div class="dga-why-icon">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <h3>تعلّم تفاعلي</h3>
                <p>محتوى تفاعلي واختبارات ومشاريع عملية لتعزيز الفهم والتطبيق.</p>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════
     CTA
══════════════════════════════════════ --}}
<section class="dga-sec">
    <div class="dga-wrap">
        <div class="dga-cta">
            <div class="dga-cta-orb dga-cta-orb1"></div>
            <div class="dga-cta-orb dga-cta-orb2"></div>
            <div class="dga-cta-badge">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                ابدأ رحلتك اليوم
            </div>
            <h2>طوّر مسارك المهني مع شهادات معتمدة</h2>
            <p>احصل على وصول غير محدود لأكثر من ألف دورة تدريبية في مختلف المجالات</p>
            <div class="dga-cta-btns">
                <a href="{{ url('/subscriptions') }}" class="dga-btn dga-btn-gold">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    اشترك الآن
                </a>
                <a href="{{ url('professional-certificates/category') }}" class="dga-btn dga-btn-ghost">
                    تصفح مجاناً
                </a>
            </div>
        </div>
    </div>
</section>

</main>
</div>

<button class="dga-scroll-top" id="dgaScrollTop" aria-label="العودة للأعلى" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
</button>

@endsection

@push('js')
<script>
(function () {
    var btn = document.getElementById('dgaScrollTop');
    window.addEventListener('scroll', function () {
        btn.classList.toggle('visible', window.scrollY > 400);
    });
    function dgaToggleCats() {
        var hidden = document.querySelectorAll('.dga-cat-hidden');
        var catBtn = document.getElementById('dgaCatBtn');
        var open = catBtn.getAttribute('data-open') === '1';
        hidden.forEach(function (el) { el.style.display = open ? 'none' : 'flex'; });
        catBtn.setAttribute('data-open', open ? '0' : '1');
        catBtn.innerHTML = open
            ? 'عرض كل التخصصات <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>'
            : 'عرض أقل <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>';
    }
    window.dgaToggleCats = dgaToggleCats;
    document.querySelectorAll('.dga-cat-hidden').forEach(function (el) { el.style.display = 'none'; });
}());
</script>
@endpush

@extends(layoutExtend('website'))

@section('title'){{ trans('professionalcertificates.professionalcertificates') }} | {{ trans('home.HomeTitle') }}@endsection
@section('description'){{ trans('home.HomeDescription') }}@endsection
@section('keywords'){{ trans('home.HomeKeywords') }}@endsection

@push('css')
{{-- DGA design system is now loaded site-wide in app.blade.php; only page-specific overrides here --}}
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
        <form action="{{ url('/allcourses/category') }}" method="GET" class="dga-hero-searchbar" role="search" aria-label="البحث في الشهادات">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <label for="pc-search-key" class="sr-only">ابحث عن دورة أو شهادة</label>
            <input id="pc-search-key" type="search" name="key" placeholder="ابحث عن دورة أو شهادة..." autocomplete="off" aria-label="ابحث عن دورة أو شهادة">
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
     من نحن (ABOUT)
══════════════════════════════════════ --}}
<section class="dga-sec dga-about">
    <div class="dga-wrap">
        <div class="dga-about-grid">
            <div class="dga-about-text">
                <div class="dga-line"></div>
                <h2>من <span class="dga-green">نحن</span></h2>
                <p class="dga-about-lead">منصة الشهادات الاحترافية التابعة لمعهد الدراسات والخدمات الاستشارية بجامعة شقراء، تقدّم برامج تدريبية مهنية معتمدة بهدف تأهيل الكوادر الوطنية ودعم رؤية المملكة 2030.</p>
                <p>نسعى لبناء مستقبل أكثر احترافاً عبر شراكات استراتيجية مع نخبة من المدربين والخبراء، ومحتوى تدريبي متطور يواكب احتياجات سوق العمل المحلي والإقليمي.</p>
                <div class="dga-about-features">
                    <div class="dga-about-feature">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>برامج معتمدة من جامعة شقراء</span>
                    </div>
                    <div class="dga-about-feature">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>متوافقة مع رؤية المملكة 2030</span>
                    </div>
                    <div class="dga-about-feature">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>محتوى تفاعلي بأعلى المعايير</span>
                    </div>
                </div>
                <a href="{{ url('page/about') }}" class="dga-btn dga-btn-outline">
                    اقرأ المزيد
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                </a>
            </div>
            <div class="dga-about-visual">
                <div class="dga-about-stat-card">
                    <div class="dga-about-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    </div>
                    <strong>15+</strong>
                    <span>سنة من التميز</span>
                </div>
                <div class="dga-about-stat-card dga-about-stat-card--gold">
                    <div class="dga-about-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                    </div>
                    <strong>+200</strong>
                    <span>برنامج معتمد</span>
                </div>
                <div class="dga-about-stat-card">
                    <div class="dga-about-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                    </div>
                    <strong>+50K</strong>
                    <span>متعلم</span>
                </div>
                <div class="dga-about-stat-card dga-about-stat-card--gold">
                    <div class="dga-about-stat-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <strong>98%</strong>
                    <span>رضا المتعلمين</span>
                </div>
            </div>
        </div>
    </div>
</section>

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
     RECENT COURSES (أحدث الدورات)
══════════════════════════════════════ --}}
@if(isset($recentCourses) && $recentCourses->count())
<section class="dga-sec dga-sec-gray">
    <div class="dga-wrap">
        <div class="dga-sec-head between">
            <div>
                <div class="dga-line"></div>
                <h2>أحدث <span class="dga-green">الدورات</span></h2>
                <p>أضيفت مؤخراً إلى المنصة — اكتشف أحدث محتوى تعليمي معتمد</p>
            </div>
            <a href="{{ url('/allcourses/category') }}" class="dga-btn dga-btn-outline">
                عرض الكل
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
        </div>
        <div class="dga-grid-4">
            @foreach($recentCourses as $course)
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
                    <span class="dga-tag dga-tag-new">جديد</span>
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
                        @if($course->created_at)
                        <span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/></svg>
                            {{ $course->created_at->diffForHumans() }}
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
     الاشتراكات (SUBSCRIPTIONS — like reference)
══════════════════════════════════════ --}}
<section class="dga-sec dga-sec-gray dga-subs">
    <div class="dga-wrap">
        <div class="dga-sec-head between">
            <div>
                <div class="dga-line"></div>
                <h2>الاشتراكات</h2>
                <p>يمكنك الاستفادة بأكثر من 600 دورة تدريبية في كافة التخصصات والتمتع بمزايا الاشتراك لك ولجميع أفراد فريقك</p>
            </div>
            <a href="{{ url('/subscriptions') }}" class="dga-btn dga-btn-outline">
                عرض الكل
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
        </div>

        @php
            $monthly      = $subscription_monthly        ?? 99;
            $yearlyAfter  = $subscription_yearly_after   ?? 999;
            $yearlyBefore = $subscription_yearly_before  ?? 1188;
            $currency     = function_exists('getCurrency') ? getCurrency() : 'SAR';
        @endphp

        <div class="dga-subs-grid">
            {{-- شهري --}}
            <div class="dga-sub-card">
                <div class="dga-sub-check">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="9 12 11 14 15 10"/>
                    </svg>
                </div>

                <h3 class="dga-sub-title">شهري</h3>

                <div class="dga-sub-price">
                    <span class="dga-sub-num">{{ $monthly }}</span>
                    <span class="dga-sub-cur">{{ $currency }}</span>
                    <span class="dga-sub-period">/ شهر</span>
                </div>

                <a href="{{ url('/subscriptions#pricing') }}" class="dga-sub-cta">
                    اشترك الآن
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                </a>
            </div>

            {{-- سنوي --}}
            <div class="dga-sub-card">
                <div class="dga-sub-check">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="9 12 11 14 15 10"/>
                    </svg>
                </div>

                <h3 class="dga-sub-title">سنوي</h3>

                <div class="dga-sub-price">
                    <span class="dga-sub-num">{{ $yearlyAfter }}</span>
                    <span class="dga-sub-cur">{{ $currency }}</span>
                    <span class="dga-sub-period">/ سنة</span>
                </div>

                @if($yearlyBefore > $yearlyAfter)
                <span class="dga-sub-was">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    بدلاً من <span class="dga-sub-was-strike">{{ $yearlyBefore }} {{ $currency }}</span>
                </span>
                @endif

                <a href="{{ url('/subscriptions#pricing') }}" class="dga-sub-cta">
                    اشترك الآن
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                </a>
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

{{-- ══════════════════════════════════════
     PARTNERS (شركاؤنا — like reference cards)
══════════════════════════════════════ --}}
@if(isset($partners) && $partners->count())
<section class="dga-sec">
    <div class="dga-wrap">
        <div class="dga-sec-head between">
            <div>
                <div class="dga-line"></div>
                <h2>شركاؤنا</h2>
                <p>نفتخر بشراكاتنا مع نخبة من المؤسسات والجهات المعتمدة</p>
            </div>
            <a href="{{ url('partners') }}" class="dga-btn dga-btn-outline">
                عرض الكل
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
        </div>
        @if($partners->count() > 4)
        <div class="dga-scroll-btns">
            <button type="button" class="dga-scroll-btn" id="dgaPartnersPrev" aria-label="السابق">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
            <button type="button" class="dga-scroll-btn" id="dgaPartnersNext" aria-label="التالي">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
        </div>
        @endif

        <div class="dga-partners-scroll">
            <div class="dga-partners-track" id="dgaPartnersTrack">
                @foreach($partners as $partner)
                <div class="dga-partner-card">
                    <div class="dga-sub-check">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="9 12 11 14 15 10"/>
                        </svg>
                    </div>
                    <div class="dga-partner-logo-wrap">
                        @if($partner->logo)
                            <img src="{{ medium($partner->logo) }}" alt="{{ $partner->title_lang }}" loading="lazy">
                        @else
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M3 21h18M5 21V7l8-4v18M19 21V11l-6-4"/></svg>
                        @endif
                    </div>
                    <div class="dga-partner-name">{{ $partner->title_lang }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════
     BLOG & NEWS (المدونة والأخبار)
══════════════════════════════════════ --}}
@if(isset($blogposts) && $blogposts->count())
<section class="dga-sec">
    <div class="dga-wrap">
        <div class="dga-sec-head between">
            <div>
                <div class="dga-line"></div>
                <h2>آخر <span class="dga-green">الأخبار</span></h2>
                <p>تابع آخر المستجدات والمقالات التعليمية</p>
            </div>
            <a href="{{ url('blog') }}" class="dga-btn dga-btn-outline">
                جميع المقالات
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
        </div>
        <div class="dga-blog-grid">
            @foreach($blogposts as $post)
            @php
                $postImg = $post->image ? medium($post->image) : null;
                $isPostPlaceholder = !$postImg || (strpos($postImg, 'placeholder') !== false);
            @endphp
            <article class="dga-blog-card">
                <a href="{{ url('blog/'.$post->slug) }}" class="dga-blog-img{{ $isPostPlaceholder ? ' dga-blog-img--placeholder' : '' }}">
                    @if($isPostPlaceholder)
                    <div class="dga-blog-placeholder">
                        <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    @else
                    <img src="{{ $postImg }}" alt="{{ $post->title_lang }}" loading="lazy">
                    @endif
                </a>
                <div class="dga-blog-body">
                    <div class="dga-blog-meta">
                        <span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ $post->created_at ? $post->created_at->format('Y/m/d') : '' }}
                        </span>
                        @if($post->visits)
                        <span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            {{ $post->visits }}
                        </span>
                        @endif
                    </div>
                    <a href="{{ url('blog/'.$post->slug) }}" class="dga-blog-title">{{ $post->title_lang }}</a>
                    @if($post->description_lang)
                    <p class="dga-blog-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($post->description_lang), 110) }}</p>
                    @endif
                    <a href="{{ url('blog/'.$post->slug) }}" class="dga-blog-link">
                        اقرأ المزيد
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

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

    // ── Partners scroll buttons ────────────────────────
    var track = document.getElementById('dgaPartnersTrack');
    var prevB = document.getElementById('dgaPartnersPrev');
    var nextB = document.getElementById('dgaPartnersNext');
    if (track && prevB && nextB) {
        var step = function () {
            var card = track.querySelector('.dga-partner-card');
            return card ? card.offsetWidth + 16 : 240;
        };
        // RTL: next moves content to the LEFT (negative scrollLeft direction)
        // In RTL pages scrollLeft is negative or inverted depending on browser; use a safe delta.
        var scrollBy = function (dir) {
            // dir: 1 = next (right→left visually), -1 = prev
            track.scrollBy({ left: dir * step(), behavior: 'smooth' });
        };
        nextB.addEventListener('click', function () { scrollBy(-1); });
        prevB.addEventListener('click', function () { scrollBy(1); });
    }
}());
</script>
@endpush

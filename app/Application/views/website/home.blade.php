@extends(layoutExtend('website'))

@section('title'){{ trans('home.HomeTitle') }}@endsection
@section('description'){{ trans('home.HomeDescription') }}@endsection
@section('keywords'){{ trans('home.HomeKeywords') }}@endsection

@push('css')
{{-- home-dga.css: Shaqra palette (green + gold, no blue), DGA-compliant sizes --}}
<link href="{{ asset('website') }}/css/front/home-dga.css?v=1.2" rel="stylesheet">
<style>
    .dga-hero {
        background:
            linear-gradient(135deg, rgba(9,42,30,0.70) 0%, rgba(16,70,49,0.58) 50%, rgba(9,42,30,0.72) 100%),
            url('{{ asset('website/images/front/heroBanner.jpeg') }}') center center / cover no-repeat !important;
    }
</style>
@endpush

@section('content')
<div class="dga-home" id="dga-home-page">

    {{-- ================================================
         HERO SECTION
    ================================================ --}}
    @if(isset($sliders) && $sliders->count())
    <section class="dga-hero" aria-label="الصفحة الرئيسية">
        <div class="dga-hero-content">

            {{-- Hero Text --}}
            <div class="dga-hero-text">
                <div style="margin-bottom:var(--dga-space-4);">
                    <span class="dga-badge dga-badge-new" style="font-size:0.82rem;padding:6px 14px;">
                        ✦ {{ getSetting('siteTitle') }}
                    </span>
                </div>

                @php $firstSlider = $sliders->first(); @endphp
                <h1>{{ $firstSlider->title_lang }}</h1>
                @if($firstSlider->description_lang)
                    <p>{{ $firstSlider->description_lang }}</p>
                @endif

                <div class="dga-hero-actions">
                    @if($firstSlider->ctatext_lang)
                        <a href="{{ $firstSlider->cta_link ?: url('/allcourses') }}" class="dga-btn dga-btn-gold dga-btn-lg">
                            <i class="fas fa-graduation-cap"></i>
                            @if($firstSlider->id == 9 && getCurrency() == 'SAR')
                                {{ trans('website.Subscribe Now Saudi') }}
                            @else
                                {{ $firstSlider->ctatext_lang }}
                            @endif
                        </a>
                    @else
                        <a href="{{ url('/allcourses') }}" class="dga-btn dga-btn-gold dga-btn-lg">
                            <i class="fas fa-graduation-cap"></i>
                            استعرض الدورات
                        </a>
                    @endif
                    <a href="{{ url('/subscriptions') }}" class="dga-btn dga-btn-secondary dga-btn-lg">
                        <i class="fas fa-crown"></i>
                        {{ trans('b2b.Subscribe Now') }}
                    </a>
                </div>

                <div class="dga-hero-stats">
                    <div class="dga-hero-stat">
                        <span class="dga-stat-number">+1,000</span>
                        <span class="dga-stat-label">{{ trans('website.courses') }}</span>
                    </div>
                    <div class="dga-hero-stat">
                        <span class="dga-stat-number">+50K</span>
                        <span class="dga-stat-label">متعلم</span>
                    </div>
                    <div class="dga-hero-stat">
                        <span class="dga-stat-number">+200</span>
                        <span class="dga-stat-label">مدرب</span>
                    </div>
                </div>
            </div>

            {{-- Hero Visual: search card --}}
            <div class="dga-hero-visual">
                <div class="dga-hero-card-preview">
                    <form action="{{ url('/allcourses/category') }}" method="GET">
                        <div class="dga-hero-search-bar">
                            <i class="fas fa-search" style="color:#9E9E9E;margin:0 8px;"></i>
                            <input type="text" name="key" placeholder="{{ trans('home.search placeholder') }}" autocomplete="off">
                            <button type="submit">بحث</button>
                        </div>
                    </form>
                    @if(isset($categories) && $categories->count())
                        <p style="color:rgba(255,255,255,0.7);font-size:0.78rem;margin-bottom:8px;">الأكثر بحثاً:</p>
                        <div class="dga-hero-popular-tags">
                            @foreach($categories->take(7) as $cat)
                                <a href="{{ url('/allcourses/category/'.$cat->slug) }}" class="dga-popular-tag">{{ $cat->name_lang }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
    @else
    {{-- Fallback hero if no sliders --}}
    <section class="dga-hero" aria-label="الصفحة الرئيسية">
        <div class="dga-hero-content">
            <div class="dga-hero-text">
                <h1>{{ getSetting('siteTitle') }}</h1>
                <p>{{ getSetting('siteDescription') }}</p>
                <div class="dga-hero-actions">
                    <a href="{{ url('/allcourses') }}" class="dga-btn dga-btn-gold dga-btn-lg">
                        <i class="fas fa-graduation-cap"></i>
                        استعرض الدورات
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ================================================
         SERVICES — first section after the hero (Platforms Code
         homepage template for service platforms, criterion 7)
    ================================================ --}}
    <section class="dga-section" aria-labelledby="services-title" id="services">
        <div class="dga-container">
            <div class="dga-section-header text-center">
                <div class="dga-section-divider" style="margin:0 auto var(--dga-space-xl);"></div>
                <h2 id="services-title">خدمات المنصة</h2>
                <p>ابدأ من هنا — أهم الخدمات التي تقدمها منصة الشهادات الاحترافية</p>
            </div>
            <div class="dga-services-grid">
                <a href="{{ url('/professional-certificates/category') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg></span>
                    <h3>الشهادات الاحترافية</h3>
                    <p>برامج تدريبية معتمدة تمنحك شهادة احترافية من جامعة شقراء في تخصصك.</p>
                    <span class="dga-service-cta">ابدأ الخدمة <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg></span>
                </a>
                <a href="{{ url('/allcourses/category') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></span>
                    <h3>تصفح الدورات التدريبية</h3>
                    <p>أكثر من 1,000 دورة في مختلف المجالات، تعلّم في أي وقت ومن أي جهاز.</p>
                    <span class="dga-service-cta">ابدأ الخدمة <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg></span>
                </a>
                <a href="{{ url('/subscriptions') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg></span>
                    <h3>الاشتراك في المنصة</h3>
                    <p>اشتراك شهري أو سنوي يتيح لك الوصول غير المحدود لجميع الدورات.</p>
                    <span class="dga-service-cta">ابدأ الخدمة <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg></span>
                </a>
                <a href="{{ url('/verifycertificate') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg></span>
                    <h3>التحقق من الشهادة</h3>
                    <p>تحقق من صحة أي شهادة صادرة عن المنصة عبر رقم الشهادة.</p>
                    <span class="dga-service-cta">ابدأ الخدمة <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg></span>
                </a>
                <a href="{{ url('/instructors/All') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                    <h3>المدربون والخبراء</h3>
                    <p>تعرّف على نخبة المدربين المعتمدين واستعرض برامجهم التدريبية.</p>
                    <span class="dga-service-cta">ابدأ الخدمة <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg></span>
                </a>
                <a href="{{ url('/contact') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></span>
                    <h3>الدعم والتواصل</h3>
                    <p>فريق الدعم متاح للإجابة على استفساراتك وتلقّي ملاحظاتك ومقترحاتك.</p>
                    <span class="dga-service-cta">ابدأ الخدمة <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg></span>
                </a>
            </div>
        </div>
    </section>

    {{-- ================================================
         STATS STRIP
    ================================================ --}}
    <div class="dga-stats-strip" role="region" aria-label="إحصائيات المنصة">
        <div class="dga-stats-grid">
            <div class="dga-stat-item">
                <span class="dga-stat-number">+1,000</span>
                <span class="dga-stat-label">دورة تدريبية</span>
            </div>
            <div class="dga-stat-item">
                <span class="dga-stat-number">+50,000</span>
                <span class="dga-stat-label">متعلم مسجل</span>
            </div>
            <div class="dga-stat-item">
                <span class="dga-stat-number">+200</span>
                <span class="dga-stat-label">مدرب معتمد</span>
            </div>
            <div class="dga-stat-item">
                <span class="dga-stat-number">98%</span>
                <span class="dga-stat-label">نسبة رضا المتعلمين</span>
            </div>
        </div>
    </div>

    {{-- ================================================
         MAIN CONTENT
    ================================================ --}}
    <div class="dga-home-main">

        {{-- ===== CATEGORIES ===== --}}
        @if(isset($categories) && $categories->count())
        <section class="dga-section dga-section-alt" aria-labelledby="cats-title">
            <div class="dga-container">
                <div class="dga-section-header text-center">
                    <div class="dga-section-divider" style="margin:0 auto var(--dga-space-4);"></div>
                    <h2 id="cats-title">تصفح حسب <span class="dga-accent">التخصص</span></h2>
                    <p>اختر المجال الذي يناسب تطلعاتك المهنية</p>
                </div>
                <div class="dga-categories">
                    @foreach($categories as $cat)
                        <a href="{{ url('/allcourses/category/'.$cat->slug) }}" class="dga-category-pill">
                            <i class="hero-icons {{ $cat->color_code }}"></i>
                            {{ $cat->name_lang }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ===== FEATURED / BEST LEARNING ===== --}}
        @if(isset($featuredAll) && $featuredAll->count())
        <section class="dga-section" aria-labelledby="featured-title">
            <div class="dga-container">
                <div class="dga-section-header dga-section-header-row">
                    <div>
                        <div class="dga-section-divider"></div>
                        <h2 id="featured-title">{{ trans('home.best learning') }}</h2>
                        <p>الدورات الأعلى تقييماً من قِبل المتعلمين</p>
                    </div>
                    <a href="{{ url('/allcourses') }}" class="dga-btn dga-btn-secondary">
                        {{ trans('home.view all') }}
                        <i class="fas fa-arrow-{{ getDir()=='rtl' ? 'left' : 'right' }} ms-1"></i>
                    </a>
                </div>
                <div class="dga-courses-grid">
                    @foreach($featuredAll as $course)
                    @php
                        $disc = 0;
                        if(userCountry()['code'] == "EG") { $disc = $course->discount_egp; }
                        else { $disc = $course->discount_usd; }
                    @endphp
                    <article class="dga-course-card">
                        <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-course-card-img" style="display:block;">
                            <img src="{{ medium($course->image) }}" alt="{{ $course->title_lang }}" loading="lazy">
                            @if($disc > 0)
                                <span class="dga-course-card-badge dga-course-card-discount">خصم {{ round($disc) }}%</span>
                            @endif
                        </a>
                        <div class="dga-course-card-body">
                            @if(isset($course->categories) && $course->categories)
                                <div class="dga-course-card-category">{{ $course->categories->name_lang }}</div>
                            @endif
                            <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-course-card-title" style="display:block;">
                                {{ $course->title_lang }}
                            </a>
                            <div class="dga-course-card-meta">
                                @if($course->courselectures->count())
                                    <span><i class="fas fa-play-circle"></i> {{ $course->courselectures->count() }} {{ trans('courses.lectures') }}</span>
                                @endif
                                @if($course->visits > 0)
                                    <span><i class="fas fa-eye"></i>
                                        {{ ($course->visits >= 1000) ? number_format($course->visits/1000,0).'K' : $course->visits }}
                                    </span>
                                @endif
                            </div>
                            <div class="dga-course-card-footer">
                                <div class="dga-course-price">{!! $course->PriceText !!}</div>
                                <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-btn dga-btn-primary dga-btn-sm">
                                    {{ trans('website.More Details') }}
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ===== LATEST RELEASES ===== --}}
        @if(isset($latestReleased) && $latestReleased->count())
        <section class="dga-section dga-section-alt" aria-labelledby="latest-title">
            <div class="dga-container">
                <div class="dga-section-header dga-section-header-row">
                    <div>
                        <div class="dga-section-divider"></div>
                        <h2 id="latest-title">{{ trans('home.latest courses') }}</h2>
                        <p>أضفنا دورات جديدة لمواكبة احتياجات سوق العمل</p>
                    </div>
                    <a href="{{ url('/allcourses/category/') }}" class="dga-btn dga-btn-secondary">
                        {{ trans('home.view all') }}
                        <i class="fas fa-arrow-{{ getDir()=='rtl' ? 'left' : 'right' }} ms-1"></i>
                    </a>
                </div>
                <div class="dga-courses-grid">
                    @foreach($latestReleased as $course)
                    @php
                        $disc = (userCountry()['code'] == "EG") ? $course->discount_egp : $course->discount_usd;
                    @endphp
                    <article class="dga-course-card">
                        <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-course-card-img" style="display:block;">
                            <img src="{{ medium($course->image) }}" alt="{{ $course->title_lang }}" loading="lazy">
                            @if($disc > 0)
                                <span class="dga-course-card-badge dga-course-card-discount">خصم {{ round($disc) }}%</span>
                            @elseif($course->created_at->diffInDays(now()) <= 14)
                                <span class="dga-course-card-badge">جديد</span>
                            @endif
                        </a>
                        <div class="dga-course-card-body">
                            @if(isset($course->categories) && $course->categories)
                                <div class="dga-course-card-category">{{ $course->categories->name_lang }}</div>
                            @endif
                            <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-course-card-title" style="display:block;">
                                {{ $course->title_lang }}
                            </a>
                            <div class="dga-course-card-meta">
                                @if($course->courselectures->count())
                                    <span><i class="fas fa-play-circle"></i> {{ $course->courselectures->count() }} {{ trans('courses.lectures') }}</span>
                                @endif
                                @if($course->visits > 0)
                                    <span><i class="fas fa-eye"></i>
                                        {{ ($course->visits >= 1000) ? number_format($course->visits/1000,0).'K' : $course->visits }}
                                    </span>
                                @endif
                            </div>
                            <div class="dga-course-card-footer">
                                <div class="dga-course-price">{!! $course->PriceText !!}</div>
                                <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-btn dga-btn-primary dga-btn-sm">
                                    {{ trans('website.More Details') }}
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ===== WHY US ===== --}}
        <section class="dga-section" aria-labelledby="why-title">
            <div class="dga-container">
                <div class="dga-section-header text-center">
                    <div class="dga-section-divider" style="margin:0 auto var(--dga-space-4);"></div>
                    <h2 id="why-title">لماذا تختار <span class="dga-accent">{{ getSetting('siteTitle') }}</span>؟</h2>
                    <p>مزايا تجعل تجربتك التعليمية استثنائية</p>
                </div>
                <div class="dga-features-grid">
                    <div class="dga-feature-card">
                        <div class="dga-feature-icon"><i class="fas fa-certificate"></i></div>
                        <h3>شهادات معتمدة</h3>
                        <p>احصل على شهادات إتمام معتمدة تُعزز سيرتك الذاتية وتفتح أمامك آفاقاً مهنية أوسع.</p>
                    </div>
                    <div class="dga-feature-card">
                        <div class="dga-feature-icon"><i class="fas fa-laptop"></i></div>
                        <h3>تعلم في أي وقت</h3>
                        <p>وصول غير محدود للمحتوى من أي جهاز في أي وقت يناسبك، بدون انقطاع.</p>
                    </div>
                    <div class="dga-feature-card">
                        <div class="dga-feature-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h3>مدربون خبراء</h3>
                        <p>نخبة من المدربين المعتمدين ذوي الخبرة العملية والأكاديمية في تخصصاتهم.</p>
                    </div>
                    <div class="dga-feature-card">
                        <div class="dga-feature-icon"><i class="fas fa-users"></i></div>
                        <h3>مجتمع تعليمي</h3>
                        <p>انضم لمجتمع نشط من المتعلمين والمهنيين لتبادل الخبرات والنمو المشترك.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== SUBSCRIPTION PLANS ===== --}}
        <section class="dga-section dga-section-alt" aria-labelledby="plans-title">
            <div class="dga-container">
                <div class="dga-section-header text-center">
                    <div class="dga-section-divider" style="margin:0 auto var(--dga-space-4);"></div>
                    <h2 id="plans-title">{{ trans('b2b.OUR PLANS') }}</h2>
                    <p>
                        @if(getCurrency() == 'SAR')
                            {!! trans('b2b.With one subscription, you can view all of our courses Saudi') !!}
                        @else
                            {{ trans('b2b.With one subscription, you can view all of our courses') }}
                        @endif
                    </p>
                </div>

                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:var(--dga-space-6);max-width:700px;margin:0 auto;">
                    {{-- Monthly --}}
                    <div style="background:var(--dga-white);border-radius:var(--dga-radius-xl);overflow:hidden;box-shadow:var(--dga-shadow);border:1px solid var(--dga-gray-100);text-align:center;">
                        <div style="background:var(--dga-primary-dark);color:#fff;padding:var(--dga-space-6);font-size:var(--dga-font-size-xl);font-weight:700;">
                            {{ trans('b2b.MONTHLY') }}
                        </div>
                        <div style="padding:var(--dga-space-8);">
                            <img src="{{ asset('website/subscriptions') }}/image/monthly-icon.svg" alt="{{ trans('b2b.MONTHLY') }}" style="height:60px;margin-bottom:var(--dga-space-5);">
                            <div style="font-size:var(--dga-font-size-4xl);font-weight:700;color:var(--dga-primary);">
                                {{ $subscription_monthly }}
                                <span style="font-size:var(--dga-font-size-sm);color:var(--dga-gray-500);font-weight:400;">{{ getCurrency() }}/{{ trans('website.Mo') }}</span>
                            </div>
                            <p style="color:var(--dga-gray-500);font-size:var(--dga-font-size-sm);margin:var(--dga-space-3) 0 var(--dga-space-6);">{{ trans('website.Billed Monthly') }}</p>
                            <a href="{{ url('/subscriptions#pricing') }}" class="dga-btn dga-btn-secondary" style="width:100%;justify-content:center;">
                                اشترك الآن
                            </a>
                        </div>
                    </div>

                    {{-- Annual --}}
                    <div style="background:var(--dga-white);border-radius:var(--dga-radius-xl);overflow:hidden;box-shadow:var(--dga-shadow-lg);border:2px solid var(--dga-primary);text-align:center;position:relative;">
                        <div style="position:absolute;top:12px;right:12px;background:var(--dga-secondary);color:#fff;font-size:var(--dga-font-size-xs);font-weight:700;padding:4px 10px;border-radius:var(--dga-radius-full);">الأوفر</div>
                        <div style="background:var(--dga-primary);color:#fff;padding:var(--dga-space-6);font-size:var(--dga-font-size-xl);font-weight:700;">
                            {{ trans('b2b.ANNUAL') }}
                        </div>
                        <div style="padding:var(--dga-space-8);">
                            <img src="{{ asset('website/subscriptions') }}/image/annual-icon.svg" alt="{{ trans('b2b.ANNUAL') }}" style="height:60px;margin-bottom:var(--dga-space-5);">
                            <div>
                                <del style="font-size:var(--dga-font-size-base);color:var(--dga-gray-300);">{{ $subscription_yearly_before }} {{ getCurrency() }}</del>
                            </div>
                            <div style="font-size:var(--dga-font-size-4xl);font-weight:700;color:var(--dga-primary);">
                                {{ $subscription_yearly_after }}
                                <span style="font-size:var(--dga-font-size-sm);color:var(--dga-gray-500);font-weight:400;">{{ getCurrency() }}/{{ trans('website.Year') }}</span>
                            </div>
                            <p style="color:var(--dga-success);font-size:var(--dga-font-size-sm);font-weight:600;margin:var(--dga-space-3) 0 var(--dga-space-6);">
                                <i class="fas fa-check-circle"></i>
                                وفر {{ round((($subscription_yearly_before - $subscription_yearly_after) / $subscription_yearly_before) * 100) }}% مقارنةً بالشهري
                            </p>
                            <a href="{{ url('/subscriptions#pricing') }}" class="dga-btn dga-btn-primary" style="width:100%;justify-content:center;">
                                @if(getCurrency() == 'SAR')
                                    {{ trans('website.Subscribe Now Saudi') }}
                                @else
                                    {{ trans('b2b.Subscribe Now') }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== COURSES PER CATEGORY ===== --}}
        @if(isset($coursesPerCategory))
            @foreach($coursesPerCategory as $category)
                @if(count($category) > 0)
                <section class="dga-section" aria-labelledby="cat-{{ Str::slug($category[0]->categories->name_en ?? 'cat') }}">
                    <div class="dga-container">
                        <div class="dga-section-header dga-section-header-row">
                            <div>
                                <div class="dga-section-divider"></div>
                                <h2 id="cat-{{ Str::slug($category[0]->categories->name_en ?? 'cat') }}">
                                    {{ $category[0]->categories->name_lang }}
                                </h2>
                            </div>
                            <a href="{{ url('/allcourses/category/'.$category[0]->categories->slug) }}" class="dga-btn dga-btn-secondary">
                                {{ trans('home.view all') }}
                                <i class="fas fa-arrow-{{ getDir()=='rtl' ? 'left' : 'right' }} ms-1"></i>
                            </a>
                        </div>
                        <div class="dga-courses-grid">
                            @foreach($category as $course)
                            @php $disc2 = (userCountry()['code']=="EG") ? $course->discount_egp : $course->discount_usd; @endphp
                            <article class="dga-course-card">
                                <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-course-card-img" style="display:block;">
                                    <img src="{{ medium($course->image) }}" alt="{{ $course->title_lang }}" loading="lazy">
                                    @if($disc2 > 0)
                                        <span class="dga-course-card-badge dga-course-card-discount">خصم {{ round($disc2) }}%</span>
                                    @endif
                                </a>
                                <div class="dga-course-card-body">
                                    <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-course-card-title" style="display:block;">
                                        {{ $course->title_lang }}
                                    </a>
                                    <div class="dga-course-card-meta">
                                        @if($course->courselectures->count())
                                            <span><i class="fas fa-play-circle"></i> {{ $course->courselectures->count() }} {{ trans('courses.lectures') }}</span>
                                        @endif
                                    </div>
                                    <div class="dga-course-card-footer">
                                        <div class="dga-course-price">{!! $course->PriceText !!}</div>
                                        <a href="{{ url('/courses/view/'.$course->slug) }}" class="dga-btn dga-btn-primary dga-btn-sm">
                                            {{ trans('website.More Details') }}
                                        </a>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>
                </section>
                @endif
            @endforeach
        @endif

        {{-- ===== CTA BANNER ===== --}}
        <section class="dga-section dga-section-alt" aria-labelledby="cta-title">
            <div class="dga-container">
                <div class="dga-cta-banner">
                    <h2 id="cta-title">ابدأ رحلتك التعليمية اليوم</h2>
                    <p>اشترك الآن واحصل على وصول غير محدود لأكثر من 1,000 دورة تدريبية معتمدة</p>
                    <div class="dga-cta-actions">
                        <a href="{{ url('/subscriptions') }}" class="dga-btn dga-btn-gold dga-btn-lg">
                            <i class="fas fa-crown"></i>
                            @if(getCurrency() == 'SAR')
                                {{ trans('website.Subscribe Now Saudi') }}
                            @else
                                {{ trans('b2b.Subscribe Now') }}
                            @endif
                        </a>
                        <a href="{{ url('/allcourses') }}" class="dga-btn" style="background:rgba(255,255,255,0.15);color:#fff;border-color:rgba(255,255,255,0.4);">
                            تصفح الدورات مجاناً
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    @include('website.partials-maintenance-notice')

</div>

{{-- Scroll to top --}}
<a href="#" class="dga-scroll-top" id="dgaScrollTop" aria-label="العودة للأعلى">
    <i class="fas fa-chevron-up"></i>
</a>
@endsection

@push('js')
<script>
(function () {
    // Scroll to top
    var btn = document.getElementById('dgaScrollTop');
    if (btn) {
        window.addEventListener('scroll', function () {
            btn.classList.toggle('visible', window.scrollY > 400);
        });
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
})();
</script>
@endpush

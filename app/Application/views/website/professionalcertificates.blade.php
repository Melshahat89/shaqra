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
            {!! dgaIcon('certificate-01', '', ['height' => 13]) !!}
            منصة الشهادات الاحترافية · جامعة شقراء
        </span>

        <h1>من أجل مستقبل <span class="dga-hero-gold">أكثر احترافاً</span></h1>

        <p>شهادات مهنية معتمدة تُعزز مسارك الوظيفي — تعلّم في أي وقت ومن أي مكان مع نخبة من أفضل المدربين والخبراء.</p>

        {{-- search bar --}}
        <form action="{{ url('/allcourses/category') }}" method="GET" class="dga-hero-searchbar" role="search" aria-label="البحث في الشهادات">
            {!! dgaIcon('search-01', '', ['width' => 18, 'height' => 18]) !!}
            <label for="pc-search-key" class="sr-only">ابحث عن دورة أو شهادة</label>
            <input id="pc-search-key" type="search" name="key" placeholder="ابحث عن دورة أو شهادة..." autocomplete="off" aria-label="ابحث عن دورة أو شهادة">
            <button type="submit">
                {!! dgaIcon('search-01', '', ['height' => 16]) !!}
                بحث
            </button>
        </form>

        <div class="dga-hero-actions">
            <a href="{{ url('professional-certificates/category') }}" class="dga-btn dga-btn-primary dga-btn-lg">
                {!! dgaIcon('mortarboard-02', '', ['width' => 15, 'height' => 15]) !!}
                استعرض الشهادات
            </a>
            <a href="{{ url('/subscriptions') }}" class="dga-btn dga-btn-on-color dga-btn-lg">
                خطط الاشتراك
            </a>
        </div>
    </div>

    {{-- stats strip inside hero at bottom --}}
    <div class="dga-hero-stats">
        <div class="dga-hero-stat">
            {!! dgaIcon('mortarboard-02', '', ['height' => 28]) !!}
            <div><strong>+1,000</strong><span>دورة معتمدة</span></div>
        </div>
        <div class="dga-hero-stat-sep"></div>
        <div class="dga-hero-stat">
            {!! dgaIcon('user-multiple', '', ['height' => 28]) !!}
            <div><strong>+50,000</strong><span>متعلم مسجل</span></div>
        </div>
        <div class="dga-hero-stat-sep"></div>
        <div class="dga-hero-stat">
            {!! dgaIcon('certificate-01', '', ['height' => 28]) !!}
            <div><strong>+200</strong><span>مدرب معتمد</span></div>
        </div>
        <div class="dga-hero-stat-sep"></div>
        <div class="dga-hero-stat">
            {!! dgaIcon('star', '', ['height' => 28]) !!}
            <div><strong>98%</strong><span>رضا المتعلمين</span></div>
        </div>
    </div>
</section>

<div class="dga-home-main">

    {{-- ================================================
         SERVICES — first section after the hero (Platforms Code
         homepage template for service platforms, criterion 7)
    ================================================ --}}
    <section class="dga-sec" aria-labelledby="services-title" id="services">
        <div class="dga-wrap">
            <div class="dga-sec-head center">
                <div class="dga-line"></div>
                <h2 id="services-title">خدمات المنصة</h2>
                <p>ابدأ من هنا — أهم الخدمات التي تقدمها منصة الشهادات الاحترافية</p>
            </div>
            <div class="dga-services-grid">
                <a href="{{ url('/professional-certificates/category') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true">{!! dgaIcon('certificate-01', '') !!}</span>
                    <h3>الشهادات الاحترافية</h3>
                    <p>برامج تدريبية معتمدة تمنحك شهادة احترافية من جامعة شقراء في تخصصك.</p>
                    <span class="dga-service-cta">ابدأ الخدمة {!! dgaIcon('arrow-left-02', '') !!}</span>
                </a>
                <a href="{{ url('/allcourses/category') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true">{!! dgaIcon('book-02', '') !!}</span>
                    <h3>تصفح الدورات التدريبية</h3>
                    <p>أكثر من 1,000 دورة في مختلف المجالات، تعلّم في أي وقت ومن أي جهاز.</p>
                    <span class="dga-service-cta">ابدأ الخدمة {!! dgaIcon('arrow-left-02', '') !!}</span>
                </a>
                <a href="{{ url('/subscriptions') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true">{!! dgaIcon('credit-card', '') !!}</span>
                    <h3>الاشتراك في المنصة</h3>
                    <p>اشتراك شهري أو سنوي يتيح لك الوصول غير المحدود لجميع الدورات.</p>
                    <span class="dga-service-cta">ابدأ الخدمة {!! dgaIcon('arrow-left-02', '') !!}</span>
                </a>
                <a href="{{ url('/verifycertificate') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true">{!! dgaIcon('security-check', '') !!}</span>
                    <h3>التحقق من الشهادة</h3>
                    <p>تحقق من صحة أي شهادة صادرة عن المنصة عبر رقم الشهادة.</p>
                    <span class="dga-service-cta">ابدأ الخدمة {!! dgaIcon('arrow-left-02', '') !!}</span>
                </a>
                <a href="{{ url('/instructors/All') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true">{!! dgaIcon('user-multiple', '') !!}</span>
                    <h3>المدربون والخبراء</h3>
                    <p>تعرّف على نخبة المدربين المعتمدين واستعرض برامجهم التدريبية.</p>
                    <span class="dga-service-cta">ابدأ الخدمة {!! dgaIcon('arrow-left-02', '') !!}</span>
                </a>
                <a href="{{ url('/contact') }}" class="dga-service-card">
                    <span class="dga-service-icon" aria-hidden="true">{!! dgaIcon('comment-01', '') !!}</span>
                    <h3>الدعم والتواصل</h3>
                    <p>فريق الدعم متاح للإجابة على استفساراتك وتلقّي ملاحظاتك ومقترحاتك.</p>
                    <span class="dga-service-cta">ابدأ الخدمة {!! dgaIcon('arrow-left-02', '') !!}</span>
                </a>
            </div>
        </div>
    </section>



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
                        {!! dgaIcon('tick-02', '', ['width' => 22, 'height' => 22]) !!}
                        <span>برامج معتمدة من جامعة شقراء</span>
                    </div>
                    <div class="dga-about-feature">
                        {!! dgaIcon('tick-02', '', ['width' => 22, 'height' => 22]) !!}
                        <span>متوافقة مع رؤية المملكة 2030</span>
                    </div>
                    <div class="dga-about-feature">
                        {!! dgaIcon('tick-02', '', ['width' => 22, 'height' => 22]) !!}
                        <span>محتوى تفاعلي بأعلى المعايير</span>
                    </div>
                </div>
                <a href="{{ url('page/about') }}" class="dga-btn dga-btn-outline">
                    اقرأ المزيد
                    {!! dgaIcon('arrow-left-01', '', ['height' => 14]) !!}
                </a>
            </div>
            <div class="dga-about-visual">
                <div class="dga-about-stat-card">
                    <div class="dga-about-stat-icon">
                        {!! dgaIcon('mortarboard-02', '', ['height' => 28]) !!}
                    </div>
                    <strong>15+</strong>
                    <span>سنة من التميز</span>
                </div>
                <div class="dga-about-stat-card dga-about-stat-card--gold">
                    <div class="dga-about-stat-icon">
                        {!! dgaIcon('certificate-01', '', ['height' => 28]) !!}
                    </div>
                    <strong>+200</strong>
                    <span>برنامج معتمد</span>
                </div>
                <div class="dga-about-stat-card">
                    <div class="dga-about-stat-icon">
                        {!! dgaIcon('user-multiple', '', ['height' => 28]) !!}
                    </div>
                    <strong>+50K</strong>
                    <span>متعلم</span>
                </div>
                <div class="dga-about-stat-card dga-about-stat-card--gold">
                    <div class="dga-about-stat-icon">
                        {!! dgaIcon('shield-01', '', ['height' => 28]) !!}
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
                {!! dgaIcon('arrow-down-01', '', ['height' => 14]) !!}
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
                {!! dgaIcon('arrow-left-01', '', ['height' => 14]) !!}
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
                        {!! dgaIcon('mortarboard-02', '', ['height' => 44]) !!}
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
                            {!! dgaIcon('play-circle', '', ['width' => 12, 'height' => 12]) !!}
                            {{ $course->courselectures->count() }} {{ trans('courses.lectures') }}
                        </span>
                        @endif
                        @if($course->visits > 0)
                        <span>
                            {!! dgaIcon('view', '', ['width' => 12, 'height' => 12]) !!}
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
                {!! dgaIcon('arrow-left-01', '', ['height' => 14]) !!}
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
                        {!! dgaIcon('mortarboard-02', '', ['height' => 44]) !!}
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
                            {!! dgaIcon('play-circle', '', ['width' => 12, 'height' => 12]) !!}
                            {{ $course->courselectures->count() }} {{ trans('courses.lectures') }}
                        </span>
                        @endif
                        @if($course->created_at)
                        <span>
                            {!! dgaIcon('calendar-04', '', ['width' => 12, 'height' => 12]) !!}
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
                    {!! dgaIcon('certificate-01', '', ['height' => 30]) !!}
                </div>
                <h3>شهادات معتمدة</h3>
                <p>شهادات إتمام معتمدة تُعزز سيرتك الذاتية وتفتح آفاقاً مهنية أوسع.</p>
            </div>
            <div class="dga-why-card">
                <div class="dga-why-icon">
                    {!! dgaIcon('laptop', '', ['height' => 30]) !!}
                </div>
                <h3>تعلّم في أي وقت</h3>
                <p>وصول غير محدود من أي جهاز في أي وقت يناسبك، بدون انقطاع.</p>
            </div>
            <div class="dga-why-card">
                <div class="dga-why-icon">
                    {!! dgaIcon('user-multiple', '', ['height' => 30]) !!}
                </div>
                <h3>مدربون خبراء</h3>
                <p>نخبة من المدربين المعتمدين ذوي الخبرة العملية والأكاديمية.</p>
            </div>
            <div class="dga-why-card">
                <div class="dga-why-icon">
                    {!! dgaIcon('activity-01', '', ['height' => 30]) !!}
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
                {!! dgaIcon('arrow-left-01', '', ['height' => 14]) !!}
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
                    {!! dgaIcon('checkmark-circle-02', '', ['height' => 20]) !!}
                </div>

                <img src="{{ asset('website/subscriptions') }}/image/monthly-icon.svg" alt="شهري" loading="lazy" style="height:72px;width:auto;object-fit:contain;margin-bottom:16px;">

                <h3 class="dga-sub-title">شهري</h3>

                <div class="dga-sub-price">
                    <span class="dga-sub-num">{{ $monthly }}</span>
                    <span class="dga-sub-cur">{{ $currency }}</span>
                    <span class="dga-sub-period">/ شهر</span>
                </div>

                <a href="{{ url('/subscriptions#pricing') }}" class="dga-sub-cta">
                    اشترك الآن
                    {!! dgaIcon('arrow-left-01', '', ['height' => 14]) !!}
                </a>
            </div>

            {{-- سنوي --}}
            <div class="dga-sub-card">
                <div class="dga-sub-check">
                    {!! dgaIcon('checkmark-circle-02', '', ['height' => 20]) !!}
                </div>

                <img src="{{ asset('website/subscriptions') }}/image/annual-icon.svg" alt="سنوي" loading="lazy" style="height:72px;width:auto;object-fit:contain;margin-bottom:16px;">

                <h3 class="dga-sub-title">سنوي</h3>

                <div class="dga-sub-price">
                    <span class="dga-sub-num">{{ $yearlyAfter }}</span>
                    <span class="dga-sub-cur">{{ $currency }}</span>
                    <span class="dga-sub-period">/ سنة</span>
                </div>

                @if($yearlyBefore > $yearlyAfter)
                <span class="dga-sub-was">
                    {!! dgaIcon('tick-02', '', ['height' => 11]) !!}
                    بدلاً من <span class="dga-sub-was-strike">{{ $yearlyBefore }} {{ $currency }}</span>
                </span>
                @endif

                <a href="{{ url('/subscriptions#pricing') }}" class="dga-sub-cta">
                    اشترك الآن
                    {!! dgaIcon('arrow-left-01', '', ['height' => 14]) !!}
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
                {!! dgaIcon('star', '', ['width' => 13, 'height' => 13]) !!}
                ابدأ رحلتك اليوم
            </div>
            <h2>طوّر مسارك المهني مع شهادات معتمدة</h2>
            <p>احصل على وصول غير محدود لأكثر من ألف دورة تدريبية في مختلف المجالات</p>
            <div class="dga-cta-btns">
                <a href="{{ url('/subscriptions') }}" class="dga-btn dga-btn-primary dga-btn-lg">
                    {!! dgaIcon('star', '', ['width' => 15, 'height' => 15]) !!}
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
                {!! dgaIcon('arrow-left-01', '', ['height' => 14]) !!}
            </a>
        </div>
        @if($partners->count() > 4)
        <div class="dga-scroll-btns">
            <button type="button" class="dga-scroll-btn" id="dgaPartnersPrev" aria-label="السابق">
                {!! dgaIcon('arrow-right-01', '', ['height' => 16]) !!}
            </button>
            <button type="button" class="dga-scroll-btn" id="dgaPartnersNext" aria-label="التالي">
                {!! dgaIcon('arrow-left-01', '', ['height' => 16]) !!}
            </button>
        </div>
        @endif

        <div class="dga-partners-scroll">
            <div class="dga-partners-track" id="dgaPartnersTrack">
                @foreach($partners as $partner)
                <div class="dga-partner-card">
                    <div class="dga-sub-check">
                        {!! dgaIcon('checkmark-circle-02', '', ['height' => 16]) !!}
                    </div>
                    <div class="dga-partner-logo-wrap">
                        @if($partner->logo)
                            <img src="{{ medium($partner->logo) }}" alt="{{ $partner->title_lang }}" loading="lazy">
                        @else
                            {!! dgaIcon('building-03', '', ['height' => 48]) !!}
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
                {!! dgaIcon('arrow-left-01', '', ['height' => 14]) !!}
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
                        {!! dgaIcon('file-02', '', ['height' => 42]) !!}
                    </div>
                    @else
                    <img src="{{ $postImg }}" alt="{{ $post->title_lang }}" loading="lazy">
                    @endif
                </a>
                <div class="dga-blog-body">
                    <div class="dga-blog-meta">
                        <span>
                            {!! dgaIcon('calendar-04', '', ['width' => 12, 'height' => 12]) !!}
                            {{ $post->created_at ? $post->created_at->format('Y/m/d') : '' }}
                        </span>
                        @if($post->visits)
                        <span>
                            {!! dgaIcon('view', '', ['width' => 12, 'height' => 12]) !!}
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
                        {!! dgaIcon('arrow-left-01', '', ['width' => 14, 'height' => 14]) !!}
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

</div>
</div>

<button class="dga-scroll-top" id="dgaScrollTop" aria-label="العودة للأعلى" onclick="window.scrollTo({top:0,behavior:'smooth'})">
    {!! dgaIcon('arrow-up-01', '', ['height' => 18]) !!}
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
            ? 'عرض كل التخصصات {!! dgaIcon('arrow-down-01', '', ['height' => 14]) !!}'
            : 'عرض أقل {!! dgaIcon('arrow-up-01', '', ['height' => 14]) !!}';
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

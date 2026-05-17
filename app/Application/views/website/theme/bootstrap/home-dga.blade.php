@extends(layoutExtend('website'))

@push('css')
<link href="{{ asset('website') }}/css/front/dga-design-system.css?v={{ time() }}" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="dga-home" id="dga-home-page">

    {{-- ===== SKIP LINK (ACCESSIBILITY) ===== --}}
    <a href="#main-content" class="dga-skip-link">{{ trans('website.skip to content') ?: 'تخطى إلى المحتوى الرئيسي' }}</a>

    {{-- ===== HERO SECTION ===== --}}
    <section class="dga-hero" aria-label="القسم الرئيسي">
        <div class="dga-hero-content">
            <div class="dga-hero-text">
                <div class="dga-badge dga-badge-new mb-3" style="font-size:0.85rem;">
                    ✦ {{ getSetting('siteTitle') ?: 'منصة التعليم الإلكتروني' }}
                </div>
                <h1>
                    ارتقِ بمهاراتك مع<br>
                    <span>{{ getSetting('siteTitle') ?: trans('website.site name') }}</span>
                </h1>
                <p>{{ getSetting('siteDescription') ?: 'أكثر من ألف دورة تدريبية معتمدة تقدمها نخبة من أفضل المدربين والخبراء. تعلّم في أي وقت ومن أي مكان.' }}</p>

                <div class="dga-hero-actions">
                    <a href="{{ url('/allcourses') }}" class="dga-btn dga-btn-gold dga-btn-lg">
                        <i class="fas fa-graduation-cap"></i>
                        استعرض الدورات
                    </a>
                    <a href="{{ url('/subscriptions') }}" class="dga-btn dga-btn-secondary dga-btn-lg">
                        <i class="fas fa-crown"></i>
                        باقات الاشتراك
                    </a>
                </div>

                <div class="dga-hero-stats">
                    <div class="dga-hero-stat">
                        <span class="dga-stat-number">+1,000</span>
                        <span class="dga-stat-label">دورة تدريبية</span>
                    </div>
                    <div class="dga-hero-stat">
                        <span class="dga-stat-number">+50,000</span>
                        <span class="dga-stat-label">متعلم</span>
                    </div>
                    <div class="dga-hero-stat">
                        <span class="dga-stat-number">+200</span>
                        <span class="dga-stat-label">مدرب معتمد</span>
                    </div>
                </div>
            </div>

            <div class="dga-hero-visual">
                <div class="dga-hero-card-preview">
                    <div class="dga-hero-search-bar">
                        <i class="fas fa-search" style="color:#6E6E6E;margin:0 8px;"></i>
                        <input type="text" placeholder="{{ trans('home.search placeholder') ?: 'ابحث عن دورة...' }}" readonly>
                        <button type="button">بحث</button>
                    </div>
                    <p style="color:rgba(255,255,255,0.7);font-size:0.8rem;margin-bottom:8px;">الأكثر بحثاً:</p>
                    <div class="dga-hero-popular-tags">
                        @foreach(menuCategories()->take(6) as $cat)
                            <a href="{{ url('/allcourses/category/'.$cat->slug) }}" class="dga-popular-tag">
                                {{ $cat->name_lang }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== STATS STRIP ===== --}}
    <div class="dga-stats-strip">
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

    {{-- ===== MAIN CONTENT ===== --}}
    <main id="main-content">

        {{-- ===== CATEGORIES ===== --}}
        <section class="dga-section dga-section-alt" aria-labelledby="cats-heading">
            <div class="dga-container">
                <div class="dga-section-header text-center">
                    <div class="dga-section-divider" style="margin:0 auto var(--dga-space-4);"></div>
                    <h2 id="cats-heading">تصفح حسب <span class="dga-accent">التخصص</span></h2>
                    <p>اختر المجال الذي يناسب تطلعاتك المهنية</p>
                </div>
                <div class="dga-categories">
                    @foreach(menuCategories() as $cat)
                        <a href="{{ url('/allcourses/category/'.$cat->slug) }}" class="dga-category-pill">
                            <i class="hero-icons {{ $cat->color_code }}"></i>
                            {{ $cat->name_lang }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ===== LATEST COURSES ===== --}}
        @if(isset($latestCourses) && $latestCourses->count())
        <section class="dga-section" aria-labelledby="latest-heading">
            <div class="dga-container">
                <div class="dga-section-header dga-section-header-row">
                    <div>
                        <div class="dga-section-divider"></div>
                        <h2 id="latest-heading">أحدث <span class="dga-accent">الدورات</span></h2>
                        <p>أضفنا دورات جديدة لمواكبة احتياجات سوق العمل</p>
                    </div>
                    <a href="{{ url('/allcourses') }}" class="dga-btn dga-btn-secondary">
                        عرض الكل <i class="fas fa-arrow-left ms-1"></i>
                    </a>
                </div>
                <div class="dga-courses-grid">
                    @foreach($latestCourses->take(8) as $course)
                        @include('website.theme.bootstrap.layout.blocks.home-course-cards', ['data' => $course])
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ===== WHY US / FEATURES ===== --}}
        <section class="dga-section dga-section-alt" aria-labelledby="why-heading">
            <div class="dga-container">
                <div class="dga-section-header text-center">
                    <div class="dga-section-divider" style="margin:0 auto var(--dga-space-4);"></div>
                    <h2 id="why-heading">لماذا تختار <span class="dga-accent">{{ getSetting('siteTitle') ?: 'منصتنا' }}</span>؟</h2>
                    <p>مزايا تجعل تجربتك التعليمية استثنائية</p>
                </div>
                <div class="dga-features-grid">
                    <div class="dga-feature-card">
                        <div class="dga-feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3>شهادات معتمدة</h3>
                        <p>احصل على شهادات إتمام معتمدة تُعزز سيرتك الذاتية وتفتح أمامك آفاقاً مهنية أوسع.</p>
                    </div>
                    <div class="dga-feature-card">
                        <div class="dga-feature-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h3>تعلم في أي وقت</h3>
                        <p>وصول غير محدود للمحتوى من أي جهاز وفي أي وقت يناسبك، بدون انقطاع.</p>
                    </div>
                    <div class="dga-feature-card">
                        <div class="dga-feature-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3>مدربون خبراء</h3>
                        <p>نخبة من المدربين المعتمدين ذوي الخبرة العملية والأكاديمية في تخصصاتهم.</p>
                    </div>
                    <div class="dga-feature-card">
                        <div class="dga-feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>مجتمع تعليمي</h3>
                        <p>انضم لمجتمع نشط من المتعلمين والمهنيين لتبادل الخبرات والنمو المشترك.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== BEST SELLERS ===== --}}
        @if(isset($bestSellers) && $bestSellers->count())
        <section class="dga-section" aria-labelledby="best-heading">
            <div class="dga-container">
                <div class="dga-section-header dga-section-header-row">
                    <div>
                        <div class="dga-section-divider"></div>
                        <h2 id="best-heading">الأكثر <span class="dga-accent">مشاهدة</span></h2>
                        <p>الدورات التي يختارها المتعلمون باستمرار</p>
                    </div>
                    <a href="{{ url('/allcourses') }}" class="dga-btn dga-btn-secondary">
                        عرض الكل <i class="fas fa-arrow-left ms-1"></i>
                    </a>
                </div>
                <div class="dga-courses-grid">
                    @foreach($bestSellers->take(8) as $course)
                        @include('website.theme.bootstrap.layout.blocks.home-course-cards', ['data' => $course])
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ===== CTA BANNER ===== --}}
        <section class="dga-section" aria-labelledby="cta-heading">
            <div class="dga-container">
                <div class="dga-cta-banner">
                    <h2 id="cta-heading">ابدأ رحلتك التعليمية اليوم</h2>
                    <p>اشترك الآن واحصل على وصول غير محدود لأكثر من 1,000 دورة تدريبية</p>
                    <div class="dga-cta-actions">
                        <a href="{{ url('/subscriptions') }}" class="dga-btn dga-btn-gold dga-btn-lg">
                            <i class="fas fa-crown"></i>
                            اشترك الآن
                        </a>
                        <a href="{{ url('/allcourses') }}" class="dga-btn" style="background:rgba(255,255,255,0.15);color:#fff;border-color:rgba(255,255,255,0.4);">
                            تصفح الدورات مجاناً
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== TESTIMONIALS ===== --}}
        @if(isset($testimonials) && $testimonials->count())
        <section class="dga-section dga-testimonials-section" aria-labelledby="test-heading">
            <div class="dga-container">
                <div class="dga-section-header text-center">
                    <div class="dga-section-divider" style="margin:0 auto var(--dga-space-4);"></div>
                    <h2 id="test-heading">ماذا قال <span class="dga-accent">متعلمونا</span>؟</h2>
                    <p>آراء حقيقية من متعلمين حققوا أهدافهم</p>
                </div>
                <div class="dga-courses-grid">
                    @foreach($testimonials->take(3) as $item)
                    <div class="dga-testimonial-card">
                        <div class="dga-stars">★★★★★</div>
                        <p class="dga-testimonial-text">{{ $item->message_lang }}</p>
                        <div class="dga-testimonial-author">
                            <div style="width:48px;height:48px;background:var(--dga-primary-50);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:var(--dga-primary);">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="dga-testimonial-author-info">
                                <strong>{{ $item->name_lang }}</strong>
                                <span>{{ $item->title_lang }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ===== PARTNERS ===== --}}
        @if(isset($partners) && $partners->count())
        <div class="dga-partners-strip">
            <div class="dga-container">
                <p class="dga-partners-label">شركاؤنا وجهات الاعتماد</p>
                <div class="dga-partners-row">
                    @foreach($partners as $partner)
                    <div class="dga-partner-item">
                        <img src="{{ medium($partner->logo) }}" alt="{{ $partner->title_lang }}" loading="lazy">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    </main>

</div>

{{-- ===== SCROLL TO TOP ===== --}}
<a href="#" class="dga-scroll-top" id="dgaScrollTop" aria-label="العودة للأعلى">
    <i class="fas fa-chevron-up"></i>
</a>

@endsection

@push('js')
<script>
// Scroll to top button
(function() {
    var btn = document.getElementById('dgaScrollTop');
    if (!btn) return;
    window.addEventListener('scroll', function() {
        btn.classList.toggle('visible', window.scrollY > 400);
    });
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
})();
</script>
@endpush

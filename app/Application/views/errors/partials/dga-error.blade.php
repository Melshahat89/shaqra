{{-- DGA Platforms Code — error page body (shared by 403 / 404 / 500), rendered inside the main layout --}}
@php $isAr = getDir() == 'rtl'; @endphp
<div class="dga-home" dir="{{ getDir() }}">
    <section class="dga-page-hero">
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="{{ $isAr ? 'مسار التنقل' : 'Breadcrumb' }}">
                <a href="{{ url('/') }}">{{ $isAr ? 'الرئيسية' : 'Home' }}</a>
                {!! dgaIcon('arrow-left-01', '', ['width' => 16, 'height' => 16]) !!}
                <span aria-current="page">{{ $title }}</span>
            </nav>
            <h1 class="dga-page-title">{{ $title }}</h1>
            <p class="dga-page-sub">{{ $desc }}</p>
        </div>
    </section>

    <div class="dga-sec">
        <div class="dga-wrap">
            <div class="dga-card dga-error-card" role="alert" aria-live="polite">
                <div class="dga-error-code" aria-hidden="true">{{ $code }}</div>
                <h2 class="dga-error-title">{{ $title }}</h2>
                <p class="dga-error-desc">{{ $desc }}</p>
                <div class="dga-error-actions">
                    <a href="{{ url('/') }}" class="dga-btn dga-btn-primary dga-btn-lg">{{ $isAr ? 'العودة للرئيسية' : 'Back to Home' }}</a>
                    <a href="{{ url('contact') }}" class="dga-btn dga-btn-secondary dga-btn-lg">{{ $isAr ? 'تواصل مع الدعم' : 'Contact Support' }}</a>
                    <a href="{{ url('sitemap') }}" class="dga-btn dga-btn-transparent dga-btn-lg">{{ $isAr ? 'خريطة الموقع' : 'Sitemap' }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .dga-error-card { max-width: 640px; margin: 0 auto; text-align: center; padding: var(--dga-space-5xl) var(--dga-space-3xl) !important; }
    .dga-error-card:hover { background: #fff !important; }
    .dga-error-code { font-size: 4.5rem; line-height: 1; font-weight: 600; color: var(--dga-color-primary-600); margin-bottom: var(--dga-space-xl); }
    .dga-error-title { margin: 0 0 var(--dga-space-md); }
    .dga-error-desc { margin: 0 0 var(--dga-space-3xl); }
    .dga-error-actions { display: flex; gap: var(--dga-space-md); justify-content: center; flex-wrap: wrap; }
</style>

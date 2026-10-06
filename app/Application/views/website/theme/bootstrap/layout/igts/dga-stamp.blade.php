{{--
    DGA Platforms Code — الختم الرقمي (Digital Stamp)
    · Placed at the very top of every page (criterion 11).
    · Main element: emblem + "موقع رسمي…" + "كيف تتحقق؟" expander.
    · Secondary elements (max 2, on the opposite side): language switcher + accessibility tools.
--}}
@php
    $isAr        = config('app.locale') == 'ar';
    $otherLocale = $isAr ? 'en' : 'ar';
    $switchUrl   = LaravelLocalization::getLocalizedURL($otherLocale, null, [], true);
@endphp
<div class="dga-stamp" role="region" aria-label="{{ $isAr ? 'الختم الرقمي للموقع الحكومي' : 'Official government website stamp' }}">
    <div class="dga-stamp-inner">
        <div class="dga-stamp-main">
            <img src="{{ asset('website') }}/images/saudi-emblem.svg" alt="" class="dga-stamp-emblem" width="28" height="28" aria-hidden="true">
            <div class="dga-stamp-text">
                <strong>{{ $isAr ? 'موقع رسمي تابع لحكومة المملكة العربية السعودية' : 'An official website of the Government of Saudi Arabia' }}</strong>
                <button type="button" class="dga-stamp-toggle" id="dga-stamp-toggle" aria-expanded="false" aria-controls="dga-stamp-details">
                    {{ $isAr ? 'كيف تتحقق؟' : 'How to verify?' }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
            </div>
        </div>
        <div class="dga-stamp-secondary">
            <a href="{{ $switchUrl }}" class="dga-btn dga-btn-ghost dga-no-ext" hreflang="{{ $otherLocale }}" lang="{{ $otherLocale }}"
               aria-label="{{ $isAr ? 'Switch to English' : 'التبديل إلى العربية' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                <span class="dga-btn-label">{{ $isAr ? 'English' : 'العربية' }}</span>
            </a>
            <button type="button" class="dga-btn dga-btn-ghost" id="dga-a11y-toggle" aria-expanded="false" aria-controls="dga-a11y-panel">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="4.5" r="2"/><path d="M12 8v6M8 10l4 1 4-1M9 21l3-7 3 7"/></svg>
                <span class="dga-btn-label">{{ $isAr ? 'أدوات الوصول' : 'Accessibility' }}</span>
            </button>
        </div>
    </div>

    {{-- Expanded verification details --}}
    <div class="dga-stamp-details" id="dga-stamp-details">
        <div class="dga-stamp-details-inner">
            <div class="dga-stamp-detail">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                <div>
                    <strong>{{ $isAr ? 'النطاقات الرسمية' : 'Official domains' }}</strong>
                    {{ $isAr ? 'المواقع الرسمية لحكومة المملكة العربية السعودية تنتهي بـ gov.sa أو edu.sa. هذه المنصة تابعة لجامعة شقراء (su.edu.sa).' : 'Official Saudi government websites end with gov.sa or edu.sa. This platform belongs to Shaqra University (su.edu.sa).' }}
                </div>
            </div>
            <div class="dga-stamp-detail">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <div>
                    <strong>{{ $isAr ? 'اتصال آمن (HTTPS)' : 'Secure connection (HTTPS)' }}</strong>
                    {{ $isAr ? 'تأكد من وجود رمز القفل في شريط العنوان؛ فهو يعني أن بياناتك تُنقل مشفّرة.' : 'Look for the lock icon in the address bar; it means your data is transmitted encrypted.' }}
                </div>
            </div>
            <div class="dga-stamp-detail">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
                <div>
                    <strong>{{ $isAr ? 'التحقق من التسجيل' : 'Registration check' }}</strong>
                    <a href="https://raqmi.dga.gov.sa/platforms/platformslist" target="_blank" rel="noopener" class="dga-link">{{ $isAr ? 'سجل المنصات الحكومية — هيئة الحكومة الرقمية' : 'Government platforms registry — Digital Government Authority' }}</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Accessibility tools panel --}}
    <div class="dga-a11y-panel" id="dga-a11y-panel" role="region" aria-label="{{ $isAr ? 'أدوات إمكانية الوصول' : 'Accessibility tools' }}">
        <div class="dga-a11y-panel-inner">
            <span class="dga-a11y-label">{{ $isAr ? 'حجم الخط' : 'Text size' }}</span>
            <button type="button" class="dga-a11y-btn" data-font="1"  aria-label="{{ $isAr ? 'تكبير الخط' : 'Increase text size' }}">A+</button>
            <button type="button" class="dga-a11y-btn" data-font="-1" aria-label="{{ $isAr ? 'تصغير الخط' : 'Decrease text size' }}">A−</button>
            <span class="dga-a11y-sep" aria-hidden="true"></span>
            <span class="dga-a11y-label">{{ $isAr ? 'التباين' : 'Contrast' }}</span>
            <button type="button" class="dga-a11y-btn" data-contrast="high"  aria-pressed="false">{{ $isAr ? 'تباين عالٍ' : 'High contrast' }}</button>
            <button type="button" class="dga-a11y-btn" data-contrast="mono"  aria-pressed="false">{{ $isAr ? 'تدرج رمادي' : 'Grayscale' }}</button>
            <button type="button" class="dga-a11y-btn" data-contrast="smart" aria-pressed="false">{{ $isAr ? 'تباين ذكي' : 'Smart contrast' }}</button>
            <span class="dga-a11y-sep" aria-hidden="true"></span>
            <button type="button" class="dga-a11y-btn" id="dga-a11y-reset">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.56"/></svg>
                {{ $isAr ? 'إعادة الضبط' : 'Reset' }}
            </button>
        </div>
    </div>
</div>
<style>
    body.dga-mono    { filter: grayscale(100%); }
    body.dga-high-c  { filter: contrast(150%) brightness(.95); }
    body.dga-smart-c { filter: contrast(120%); }
    body.dga-high-sat{ filter: saturate(200%); }
</style>

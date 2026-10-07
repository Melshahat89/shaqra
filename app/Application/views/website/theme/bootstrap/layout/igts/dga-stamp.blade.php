{{--
    DGA Platforms Code — الختم الرقمي (Digital Stamp) + utility bar
    Structure mirrors the DGA-approved su.edu.sa theme:
      1. Stamp bar: Saudi flag mark + "موقع حكومي مسجل لدى هيئة الحكومة الرقمية" + "كيف تتحقق؟" (collapsible)
      2. Utility bar: date · time · city  |  accessibility tools (zoom in / zoom out / contrast)
--}}
@php
    $isAr = config('app.locale') == 'ar';
    $now  = \Carbon\Carbon::now('Asia/Riyadh');
    if ($isAr) {
        $days   = ['Sunday' => 'الأحد', 'Monday' => 'الاثنين', 'Tuesday' => 'الثلاثاء', 'Wednesday' => 'الأربعاء', 'Thursday' => 'الخميس', 'Friday' => 'الجمعة', 'Saturday' => 'السبت'];
        $months = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
        $dateText = $days[$now->format('l')] . '، ' . $now->day . ' ' . $months[$now->month - 1] . ' ' . $now->year;
        $timeText = $now->format('h:i') . ($now->format('A') == 'AM' ? ' صباحًا' : ' مساءً');
        $cityText = 'شقراء';
    } else {
        $dateText = $now->format('l, j F Y');
        $timeText = $now->format('h:i A');
        $cityText = 'Shaqra';
    }
@endphp
<div class="dga-stamp" role="region" aria-label="{{ $isAr ? 'الختم الرقمي للموقع الحكومي' : 'Official government website stamp' }}">
    <div class="dga-stamp-inner">
        <div class="dga-stamp-main">
            <img src="{{ asset('website') }}/images/saudi-stamp-logo.svg" alt="" class="dga-stamp-emblem" width="25" height="18" aria-hidden="true">
            <div class="dga-stamp-text">
                <strong>{{ $isAr ? 'موقع حكومي مسجل لدى هيئة الحكومة الرقمية' : 'Government website registered with the Digital Government Authority' }}</strong>
                <button type="button" class="dga-stamp-toggle" id="dga-stamp-toggle" aria-expanded="false" aria-controls="dga-stamp-details">
                    {{ $isAr ? 'كيف تتحقق؟' : 'How to verify?' }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Expanded verification details --}}
    <div class="dga-stamp-details" id="dga-stamp-details">
        <div class="dga-stamp-details-inner">
            <div class="dga-stamp-detail">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                <div>
                    <strong>{{ $isAr ? 'الروابط الرسمية' : 'Official links' }}</strong>
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                <div>
                    <strong>{{ $isAr ? 'التحقق من التسجيل' : 'Registration check' }}</strong>
                    <a href="https://raqmi.dga.gov.sa/platforms/platformslist" target="_blank" rel="noopener" class="dga-link">{{ $isAr ? 'سجل المنصات الحكومية — هيئة الحكومة الرقمية' : 'Government platforms registry — Digital Government Authority' }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Utility bar: date · time · city | accessibility tools --}}
<div class="dga-utility" role="region" aria-label="{{ $isAr ? 'شريط الأدوات' : 'Utility bar' }}">
    <div class="dga-utility-inner">
        <div class="dga-utility-meta">
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg><time datetime="{{ $now->toDateString() }}">{{ $dateText }}</time></span>
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg><time datetime="{{ $now->format('H:i') }}">{{ $timeText }}</time></span>
            <span class="dga-utility-city"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>{{ $cityText }}</span>
        </div>
        <div class="dga-utility-tools" id="dga-a11y-panel" role="group" aria-label="{{ $isAr ? 'أدوات إمكانية الوصول' : 'Accessibility tools' }}">
            <button type="button" class="dga-a11y-btn" data-contrast="high" aria-pressed="false" aria-label="{{ $isAr ? 'تباين عالٍ' : 'High contrast' }}" title="{{ $isAr ? 'تباين عالٍ' : 'High contrast' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
            <button type="button" class="dga-a11y-btn" data-font="1" aria-label="{{ $isAr ? 'تكبير' : 'Zoom in' }}" title="{{ $isAr ? 'تكبير' : 'Zoom in' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
            </button>
            <button type="button" class="dga-a11y-btn" data-font="-1" aria-label="{{ $isAr ? 'تصغير' : 'Zoom out' }}" title="{{ $isAr ? 'تصغير' : 'Zoom out' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
            </button>
            <button type="button" class="dga-a11y-btn" id="dga-a11y-reset" aria-label="{{ $isAr ? 'إعادة ضبط الأدوات' : 'Reset tools' }}" title="{{ $isAr ? 'إعادة ضبط الأدوات' : 'Reset tools' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.56"/></svg>
            </button>
        </div>
    </div>
</div>
<style>
    body.dga-mono    { filter: grayscale(100%); }
    body.dga-high-c  { filter: contrast(150%) brightness(.95); }
    body.dga-smart-c { filter: contrast(120%); }
</style>

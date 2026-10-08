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
                    {!! dgaIcon('arrow-down-01', '') !!}
                </button>
            </div>
        </div>
    </div>

    {{-- Expanded verification details --}}
    <div class="dga-stamp-details" id="dga-stamp-details">
        <div class="dga-stamp-details-inner">
            <div class="dga-stamp-detail">
                {!! dgaIcon('link-01', '') !!}
                <div>
                    <strong>{{ $isAr ? 'الروابط الرسمية' : 'Official links' }}</strong>
                    {{ $isAr ? 'المواقع الرسمية لحكومة المملكة العربية السعودية تنتهي بـ gov.sa أو edu.sa. هذه المنصة تابعة لجامعة شقراء (su.edu.sa).' : 'Official Saudi government websites end with gov.sa or edu.sa. This platform belongs to Shaqra University (su.edu.sa).' }}
                </div>
            </div>
            <div class="dga-stamp-detail">
                {!! dgaIcon('lock', '') !!}
                <div>
                    <strong>{{ $isAr ? 'اتصال آمن (HTTPS)' : 'Secure connection (HTTPS)' }}</strong>
                    {{ $isAr ? 'تأكد من وجود رمز القفل في شريط العنوان؛ فهو يعني أن بياناتك تُنقل مشفّرة.' : 'Look for the lock icon in the address bar; it means your data is transmitted encrypted.' }}
                </div>
            </div>
            <div class="dga-stamp-detail">
                {!! dgaIcon('security-check', '') !!}
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
            <span>{!! dgaIcon('calendar-04', '') !!}<time datetime="{{ $now->toDateString() }}">{{ $dateText }}</time></span>
            <span>{!! dgaIcon('clock-01', '') !!}<time datetime="{{ $now->format('H:i') }}">{{ $timeText }}</time></span>
            <span class="dga-utility-city">{!! dgaIcon('location-06', '') !!}{{ $cityText }}</span>
        </div>
        <div class="dga-utility-tools" id="dga-a11y-panel" role="group" aria-label="{{ $isAr ? 'أدوات إمكانية الوصول' : 'Accessibility tools' }}">
            <button type="button" class="dga-a11y-btn" data-contrast="high" aria-pressed="false" aria-label="{{ $isAr ? 'تباين عالٍ' : 'High contrast' }}" title="{{ $isAr ? 'تباين عالٍ' : 'High contrast' }}">
                {!! dgaIcon('view', '') !!}
            </button>
            <button type="button" class="dga-a11y-btn" data-font="1" aria-label="{{ $isAr ? 'تكبير' : 'Zoom in' }}" title="{{ $isAr ? 'تكبير' : 'Zoom in' }}">
                {!! dgaIcon('zoom-in-area', '') !!}
            </button>
            <button type="button" class="dga-a11y-btn" data-font="-1" aria-label="{{ $isAr ? 'تصغير' : 'Zoom out' }}" title="{{ $isAr ? 'تصغير' : 'Zoom out' }}">
                {!! dgaIcon('zoom-out-area', '') !!}
            </button>
            <button type="button" class="dga-a11y-btn" id="dga-a11y-reset" aria-label="{{ $isAr ? 'إعادة ضبط الأدوات' : 'Reset tools' }}" title="{{ $isAr ? 'إعادة ضبط الأدوات' : 'Reset tools' }}">
                {!! dgaIcon('reload', '') !!}
            </button>
        </div>
    </div>
</div>
<style>
    body.dga-mono    { filter: grayscale(100%); }
    body.dga-high-c  { filter: contrast(150%) brightness(.95); }
    body.dga-smart-c { filter: contrast(120%); }
</style>

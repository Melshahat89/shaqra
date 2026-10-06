{{--
    DGA Platforms Code — Loading component (page preloader)
    Shown on first paint of every page, hidden by dga-platforms-code.js on window.load
    (hard fallback 4s). role="status" + aria-live so screen readers announce the state.
--}}
@if(config('dga.preloader', true))
<div id="dga-preloader" class="dga-preloader" role="status" aria-live="polite" aria-busy="true" dir="{{ getDir() }}">
    <img src="{{ asset('website') }}/images/shaqracs.svg" alt="" class="dga-preloader-logo" width="220" height="80" decoding="async">
    <div class="dga-preloader-track" aria-hidden="true"></div>
    <p class="dga-preloader-text">{{ getDir() == 'rtl' ? 'جارٍ تحميل الصفحة…' : 'Loading…' }}</p>
</div>
<noscript><style>.dga-preloader{display:none !important}</style></noscript>
@endif

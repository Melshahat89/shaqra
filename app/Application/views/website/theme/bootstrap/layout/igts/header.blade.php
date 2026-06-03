<style>
/* ══════════════════════════════════════════════════════
   1. OFFICIAL GOVERNMENT BAR  (top of page, like su.edu.sa)
══════════════════════════════════════════════════════ */
.dga-gov-bar {
    background: #1a3a2a;
    color: rgba(255,255,255,0.88);
    font-size: 12px;
    padding: 7px 0;
    direction: rtl;
    border-bottom: 1px solid rgba(255,255,255,0.08);
}
.dga-gov-bar-inner {
    max-width: 1400px; margin: 0 auto; padding: 0 24px;
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 10px;
}
.dga-gov-verify {
    display: inline-flex; align-items: center; gap: 8px; cursor: pointer;
}
.dga-gov-verify-icon {
    width: 22px; height: 22px; flex-shrink: 0;
}
.dga-gov-verify-text strong { display: block; font-size: 12.5px; font-weight: 600; color: #fff; }
.dga-gov-verify-text small  { font-size: 10.5px; color: rgba(255,255,255,0.60); line-height: 1.3; }
.dga-gov-expand {
    display: none; width: 100%; padding: 10px 14px; margin-top: 6px;
    background: rgba(255,255,255,0.06); border-radius: 6px;
    font-size: 11.5px; color: rgba(255,255,255,0.75); line-height: 1.7;
    border-right: 3px solid #C1996C;
}
.dga-gov-expand.open { display: block; }
.dga-gov-expand svg { display: inline; vertical-align: middle; margin-left: 4px; }
.dga-gov-right {
    display: inline-flex; align-items: center; gap: 14px;
}
/* DGA registration badge */
.dga-reg-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.10); border: 1px solid rgba(255,255,255,0.18);
    border-radius: 20px; padding: 3px 10px 3px 6px;
    font-size: 11px; color: rgba(255,255,255,0.85); text-decoration: none;
    transition: background 0.2s;
}
.dga-reg-badge:hover { background: rgba(255,255,255,0.17); color: #fff; text-decoration: none; }
.dga-reg-badge-dot { width: 7px; height: 7px; border-radius: 50%; background: #4ade80; flex-shrink: 0; }

/* ══════════════════════════════════════════════════════
   2. ACCESSIBILITY TOOLBAR  (A+ A- contrast zoom etc)
══════════════════════════════════════════════════════ */
.dga-a11y-bar {
    background: #f1f5f2;
    border-bottom: 1px solid #dde5df;
    padding: 5px 0;
    direction: rtl;
    font-size: 12px;
}
.dga-a11y-inner {
    max-width: 1400px; margin: 0 auto; padding: 0 24px;
    display: flex; align-items: center; gap: 6px; flex-wrap: wrap;
}
.dga-a11y-label {
    font-size: 11px; font-weight: 600; color: #4a5568; margin-left: 8px; white-space: nowrap;
}
.dga-a11y-btn {
    display: inline-flex; align-items: center; justify-content: center;
    gap: 4px; padding: 3px 9px; border-radius: 4px; border: 1px solid #c9d5ca;
    background: #fff; color: #2d3748; font-size: 11.5px; cursor: pointer;
    transition: all 0.15s; white-space: nowrap; font-family: inherit;
    line-height: 1.4;
}
.dga-a11y-btn:hover   { background: #00261E; color: #fff; border-color: #00261E; }
.dga-a11y-btn.active  { background: #00261E; color: #fff; border-color: #00261E; }
.dga-a11y-sep {
    width: 1px; height: 18px; background: #c9d5ca; margin: 0 4px; flex-shrink: 0;
}
.dga-a11y-size-btn { font-weight: 700; min-width: 28px; }

/* Accessibility mode overrides */
body.dga-mono       { filter: grayscale(100%); }
body.dga-high-c     { filter: contrast(150%) brightness(0.9); }
body.dga-smart-c    { filter: contrast(120%); }
body.dga-high-sat   { filter: saturate(200%); }
body.dga-zoom-in    { zoom: 1.15; }
body.dga-zoom-out   { zoom: 0.88; }

/* ══════════════════════════════════════════════════════
   3. EXISTING TOPBAR / NAV STYLES
══════════════════════════════════════════════════════ */
.dga-topbar {
    background: #00261E;
    color: rgba(255,255,255,0.85);
    font-size: 12.5px;
    padding: 6px 0;
    border-bottom: 1px solid rgba(193,153,108,0.20);
    direction: rtl;
}
.dga-topbar-inner {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.dga-topbar-trust {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: rgba(255,255,255,0.78);
    font-weight: 500;
}
.dga-topbar-trust svg { color: #D9B589; flex-shrink: 0; }
.dga-topbar-links {
    display: inline-flex;
    align-items: center;
    gap: 16px;
}
.dga-topbar-links a {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
    font-size: 12.5px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: color 0.2s;
}
.dga-topbar-links a:hover { color: #D9B589; }
.dga-topbar-sep {
    width: 1px; height: 14px; background: rgba(255,255,255,0.15);
}
@media (max-width: 640px) {
    .dga-topbar { font-size: 11.5px; }
    .dga-topbar-inner { padding: 0 12px; gap: 6px; }
    .dga-topbar-links { gap: 10px; }
    .dga-a11y-inner { padding: 0 12px; }
    .dga-gov-bar-inner { padding: 0 12px; }
    .dga-a11y-label { display: none; }
}

.nav-link, .logo-container p { white-space: nowrap; }
.navbar-nav { display: flex; align-items: center; }
.logo-container { display: flex; align-items: center; }

.navbar-nav .nav-link:hover,
.dropdown-menu .dropdown-item:hover {
    background-color: #E6F1EE;
    color: #005C4B;
}

.dropdown-submenu { position: relative; }
.dropdown-submenu > .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
.dropdown-submenu:hover > .dropdown-menu { display: block; }
</style>

{{-- ══════════════════════════════════════════════════════════════
     1. OFFICIAL SAUDI GOVERNMENT VERIFICATION BAR  (like su.edu.sa)
══════════════════════════════════════════════════════════════ --}}
<div class="dga-gov-bar" role="banner" aria-label="تحقق الموقع الحكومي الرسمي">
    <div class="dga-gov-bar-inner">

        {{-- Left: gov verification toggle --}}
        <div class="dga-gov-verify" id="dga-gov-toggle" onclick="document.getElementById('dga-gov-details').classList.toggle('open')" role="button" tabindex="0" aria-expanded="false" aria-controls="dga-gov-details">
            <svg class="dga-gov-verify-icon" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <rect width="40" height="40" rx="8" fill="#fff" fill-opacity="0.12"/>
                <path d="M20 8l10 4v8c0 6-4.5 10.5-10 12-5.5-1.5-10-6-10-12v-8l10-4z" fill="#4ade80" fill-opacity="0.8"/>
                <polyline points="15,20 18,23 25,16" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <div class="dga-gov-verify-text">
                <strong>موقع حكومي رسمي تابع لحكومة المملكة العربية السعودية</strong>
                <small>اضغط للتحقق من هوية الموقع ▾</small>
            </div>
        </div>

        {{-- Right: DGA registration badge --}}
        <div class="dga-gov-right">
            <a href="https://raqmi.dga.gov.sa/platforms/platformslist" target="_blank" rel="noopener" class="dga-reg-badge" aria-label="رقم التسجيل لدى هيئة الحكومة الرقمية — انقر للتحقق">
                <span class="dga-reg-badge-dot"></span>
                <span>مسجل لدى هيئة الحكومة الرقمية برقم: <strong>PLACEHOLDER</strong></span>
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
        </div>
    </div>

    {{-- Expanded verification details --}}
    <div class="dga-gov-bar-inner" style="padding-top:0">
        <div class="dga-gov-expand" id="dga-gov-details" role="region" aria-label="تفاصيل التحقق من الموقع">
            <p style="margin:0 0 6px;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <strong style="color:#fff;">كيف تتحقق من أن هذا موقع رسمي؟</strong>
            </p>
            <p style="margin:0 0 4px;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#C1996C" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                جميع الروابط المؤدية إلى المواقع الإلكترونية الرسمية لجامعة شقراء تنتهي بـ <strong style="color:#fff;">su.edu.sa</strong>
            </p>
            <p style="margin:0;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#C1996C" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                تأكد من وجود رمز القفل 🔒 في شريط العنوان مما يشير إلى اتصال آمن عبر بروتوكول HTTPS
            </p>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════
     2. ACCESSIBILITY TOOLBAR  (A+/A- contrast zoom — like su.edu.sa)
══════════════════════════════════════════════════════════════ --}}
<div class="dga-a11y-bar" role="toolbar" aria-label="أدوات إمكانية الوصول">
    <div class="dga-a11y-inner">
        <span class="dga-a11y-label">إمكانية الوصول:</span>

        {{-- Font size --}}
        <button class="dga-a11y-btn dga-a11y-size-btn" id="a11y-font-plus"  onclick="dgaFontSize(1)"  aria-label="تكبير حجم الخط"  title="تكبير الخط">A+</button>
        <button class="dga-a11y-btn dga-a11y-size-btn" id="a11y-font-minus" onclick="dgaFontSize(-1)" aria-label="تصغير حجم الخط" title="تصغير الخط">A-</button>

        <span class="dga-a11y-sep" aria-hidden="true"></span>

        {{-- Contrast modes --}}
        <button class="dga-a11y-btn" id="a11y-smart-c"  onclick="dgaContrast('smart')"  aria-label="تباين ذكي"    title="تباين ذكي">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 2a10 10 0 0 1 0 20"/></svg>
            تباين ذكي
        </button>
        <button class="dga-a11y-btn" id="a11y-mono"     onclick="dgaContrast('mono')"   aria-label="أحادي اللون"  title="أحادي اللون">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 12h18"/></svg>
            أحادي اللون
        </button>
        <button class="dga-a11y-btn" id="a11y-high-c"   onclick="dgaContrast('high')"   aria-label="تباين عالي"   title="تباين عالي">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 2v20M2 12h20"/></svg>
            تباين عالي
        </button>
        <button class="dga-a11y-btn" id="a11y-high-sat" onclick="dgaContrast('sat')"    aria-label="تشبع عالي"    title="تشبع عالي">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="5"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>
            تشبع عالي
        </button>

        <span class="dga-a11y-sep" aria-hidden="true"></span>

        {{-- Zoom --}}
        <button class="dga-a11y-btn" onclick="dgaZoom(1)"  aria-label="تكبير الصفحة"  title="تكبير">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
            تكبير
        </button>
        <button class="dga-a11y-btn" onclick="dgaZoom(-1)" aria-label="تصغير الصفحة" title="تصغير">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
            تصغير
        </button>

        <span class="dga-a11y-sep" aria-hidden="true"></span>

        {{-- Reset --}}
        <button class="dga-a11y-btn" onclick="dgaReset()" aria-label="إعادة ضبط الإعدادات الافتراضية" title="إعادة الضبط">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.56"/></svg>
            إعادة الضبط
        </button>
    </div>
</div>

<script>
(function() {
    var MODES    = ['dga-mono','dga-high-c','dga-smart-c','dga-high-sat'];
    var ZOOM     = ['dga-zoom-in','dga-zoom-out'];
    var BTN_MAP  = { mono:'a11y-mono', high:'a11y-high-c', smart:'a11y-smart-c', sat:'a11y-high-sat' };
    var baseFontSize = parseFloat(getComputedStyle(document.documentElement).fontSize) || 16;
    var currentSize  = parseInt(localStorage.getItem('dga_font_size') || '0');

    function applyStored() {
        var c = localStorage.getItem('dga_contrast');
        if (c) dgaContrast(c, true);
        if (currentSize !== 0) {
            document.documentElement.style.fontSize = (baseFontSize + currentSize * 2) + 'px';
        }
    }

    window.dgaContrast = function(mode, silent) {
        MODES.forEach(function(m) { document.body.classList.remove(m); });
        Object.values(BTN_MAP).forEach(function(id) {
            var el = document.getElementById(id);
            if (el) el.classList.remove('active');
        });
        var cls = { mono:'dga-mono', high:'dga-high-c', smart:'dga-smart-c', sat:'dga-high-sat' }[mode];
        if (cls) {
            document.body.classList.add(cls);
            var btn = document.getElementById(BTN_MAP[mode]);
            if (btn) btn.classList.add('active');
            if (!silent) localStorage.setItem('dga_contrast', mode);
        } else {
            if (!silent) localStorage.removeItem('dga_contrast');
        }
    };

    window.dgaFontSize = function(dir) {
        currentSize = Math.max(-3, Math.min(5, currentSize + dir));
        document.documentElement.style.fontSize = (baseFontSize + currentSize * 2) + 'px';
        localStorage.setItem('dga_font_size', currentSize);
    };

    window.dgaZoom = function(dir) {
        ZOOM.forEach(function(z){ document.body.classList.remove(z); });
        document.body.classList.add(dir > 0 ? 'dga-zoom-in' : 'dga-zoom-out');
    };

    window.dgaReset = function() {
        MODES.concat(ZOOM).forEach(function(m){ document.body.classList.remove(m); });
        Object.values(BTN_MAP).forEach(function(id){
            var el = document.getElementById(id);
            if (el) el.classList.remove('active');
        });
        currentSize = 0;
        document.documentElement.style.fontSize = '';
        localStorage.removeItem('dga_contrast');
        localStorage.removeItem('dga_font_size');
    };

    /* gov bar toggle keyboard support */
    var govToggle = document.getElementById('dga-gov-toggle');
    if (govToggle) {
        govToggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                var details = document.getElementById('dga-gov-details');
                if (details) {
                    details.classList.toggle('open');
                    govToggle.setAttribute('aria-expanded', details.classList.contains('open'));
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', applyStored);
})();
</script>


{{-- ── Shaqra University platform trust bar ── --}}
<div class="dga-topbar">
    <div class="dga-topbar-inner">
        <span class="dga-topbar-trust">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
            منصة معتمدة من جامعة شقراء — معهد الدراسات والخدمات الاستشارية
        </span>
        <span class="dga-topbar-links">
            <a href="https://www.su.edu.sa" target="_blank" rel="noopener">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                الموقع الرسمي
            </a>
            <span class="dga-topbar-sep" aria-hidden="true"></span>
            <a href="{{ url('contact') }}">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                الدعم
            </a>
        </span>
    </div>
</div>


<header class="p-3" role="navigation" aria-label="التنقل الرئيسي">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0 d-flex justify-content-between align-items-center">

            <!-- اللوجو يمين -->
            <a class="navbar-brand m-0" href="/" aria-label="منصة الشهادات الاحترافية — الصفحة الرئيسية">
                <img src="{{ asset('website') }}/images/shaqracs.svg" loading="lazy" alt="منصة الشهادات الاحترافية — جامعة شقراء" width="250">
            </a>

            <!-- زر الهامبرغر للجوال -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="فتح/إغلاق القائمة">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- المنيو + البحث في الوسط -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <!-- Dropdown Courses -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">
                                {{ trans('professionalcertificates.professionalcertificates') }}
                            </a>
                        </li>

                        <!-- Dropdown Courses -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="coursesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{trans('website.courses')}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="coursesDropdown">
                                @foreach(menuCategories() as $cat)
                                    @if(!$cat->childs->isEmpty())
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#">{{$cat->name_lang}}</a>
                                            <ul class="dropdown-menu">
                                                @foreach($cat->childs as $child)
                                                    @if($child->show_menu)
                                                        <li><a class="dropdown-item" href="/allcourses/category/{{$child->slug}}">{{$child->name_lang}}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        @if(!$cat->parent_id)
                                            <li><a class="dropdown-item" href="/allcourses/category/{{$cat->slug}}">{{$cat->name_lang}}</a></li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/subscriptions')}}">{{trans('b2b.subscriptions')}}</a>
                        </li>
                    </ul>

                    <!-- البحث -->
                <form class="search-bar desktop-search ml-3" style="width: 40%" action="/allcourses/category" method="GET" role="search" aria-label="البحث في المنصة">
                    <div class="search-input">
                        <label for="desktop-search-key" class="sr-only">{{ trans('home.search placeholder') }}</label>
                        <input id="desktop-search-key" class="search-input-input" type="search" placeholder="{{trans('home.search placeholder')}}" name='key' autocomplete="off" aria-label="{{ trans('home.search placeholder') }}">
                        <div class="autocom-box" style="position: absolute;width: 100%;background: #fff;border-radius: 5px;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);margin-top: 8px; font-size: 15px; z-index: 3;"></div>
                    </div>
                </form>

            </div>

            <!-- الجزء الشمال (لغة + تسجيل دخول + لوجو ثاني) -->
            <div class="d-flex align-items-center">
                <!-- Language switcher -->
                <a href="{{ LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar' : 'en') }}"
                   class="button button_outline m-1"
                   aria-label="{{ config('app.locale') == 'ar' ? 'Switch to English' : 'التبديل إلى العربية' }}"
                   lang="{{ config('app.locale') == 'ar' ? 'en' : 'ar' }}">
                    {{ config('app.locale') == 'ar' ? 'EN' : 'عربى' }}
                </a>

                @if(Auth::check())
                    <!-- بيانات المستخدم -->
                    <div class="desktop-account-info-padding d-flex align-items-center">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userMenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="قائمة الحساب">
                            <img class="rounded-circle me-2" src="{{ large1(Auth::user()->image) }}" width="38" alt="{{ Auth::user()->name }}">
                            <span class="avatar_name">{{ charlimit(Auth::user()->name, 10) }}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userMenuDropdown">
                            @if(Auth::user()->group_id == 1 || Auth::user()->group_id == 9 || Auth::user()->group_id == 10 || Auth::user()->group_id == 11 || Auth::user()->group_id == 12 || Auth::user()->group_id == 13 || Auth::user()->group_id == 14 || Auth::user()->group_id == 15 || Auth::user()->group_id == 16)
                                <a href="/lazyadmin" class="dropdown-item"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{trans('home.UserType1')}}</a>
                            @endif
                            @if((Auth::user()->group_id == 6))
                                <a class="dropdown-item" href="{{url('business/home')}}">{{trans('businessdata.Dashboard')}}</a>
                            @endif
                            @if(isValidBusiness(Auth::user()->businessdata_id))
                                @php $businessdata = \App\Application\Model\Businessdata::findOrfail(Auth::user()->businessdata_id); @endphp
                                <a class="dropdown-item" href="{{url('business/businessCourses')}}">
                                    <i class="fas fa-home" aria-hidden="true"></i>
                                    {{trans('courses.businessCourses')}} ({{$businessdata->name_lang}})
                                </a>
                                @if((Auth::user()->group_id == App\Application\Model\User::TYPE_GROUP_ADMIN) AND Auth::user()->businessGroupAdmin)
                                    <a class="dropdown-item" href="{{url('business/mygroup')}}">
                                        <i class="fas fa-home" aria-hidden="true"></i>
                                        {{trans('courses.my group')}} ({{$businessdata->name_lang}})
                                    </a>
                                @endif
                            @endif
                            @if(Auth::user()->is_affiliate OR Auth::user()->group_id == 3)
                                <a href="/account/analysis" class="dropdown-item"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{trans('home.analysis')}}</a>
                            @endif
                            @if(Auth::user()->group_id == 17)
                                <a href="/account/consultantanalysis" class="dropdown-item"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{trans('home.analysis')}}</a>
                            @endif
                            <a href="/account/myCourses" class="dropdown-item"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{trans('home.my courses')}}</a>
                            <a href="/account/myProgress#weekly_goal" class="dropdown-item"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{trans('account.My Progress')}}</a>
                            <a href="/account/myProgress" class="dropdown-item"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{trans('account.my notes')}}</a>
                            <a href="/account/myFavourites" class="dropdown-item"><i class="fas fa-heart" aria-hidden="true"></i> {{trans('home.my favorites')}}</a>
                            <a href="/account/myCertificates" class="dropdown-item"><i class="fas fa-certificate" aria-hidden="true"></i> {{trans('home.my certificates')}}</a>
                            @isset(Auth::user()->subscription)
                                <a href="/account/mySubscriptions" class="dropdown-item"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{trans('courses.mySubscriptions')}}</a>
                            @endisset
                            <div class="divider"></div>
                            <a href="/account/edit" class="dropdown-item"><i class="fas fa-cog" aria-hidden="true"></i> {{trans('home.account info')}}</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i> {{trans('home.logout')}}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @else
                    <!-- أزرار تسجيل الدخول والتسجيل -->
                    <button type="button" data-toggle="modal" data-target="#loginModal" class="button button_primary m-1">{{trans('home.signin')}}</button>
                    <button type="button" data-toggle="modal" data-target="#registerModal" class="button button_primary m-1">{{trans('home.signup')}}</button>
                @endif

                <!-- اللوجو الثاني (Vision 2030) -->
                <a class="navbar-brand m-0" href="https://www.vision2030.gov.sa" target="_blank" rel="noopener" aria-label="رؤية المملكة 2030">
                    <img src="{{ asset('website') }}/images/mehany20302.png" loading="lazy" alt="رؤية المملكة 2030" width="200">
                </a>
            </div>

        </nav>
    </div>
</header>


<div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="searchModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background: transparent; border: 0;">
            <div class="modal-header flexRight">
                <h2 id="searchModalTitle" class="sr-only">البحث في المنصة</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق نافذة البحث">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="m-search-modal">
                    <form class="pr-2 pl-2 search-bar" action="/allcourses/category" method="GET" role="search" aria-label="البحث في المنصة">
                        <div class="mobile-search-input">
                            <a href="" target="_blank" hidden></a>
                            <label for="mobile-search-key" class="search-bar-label mr-3 ml-3" aria-hidden="true"><i class="fas fa-search"></i></label>
                            <input id="mobile-search-key" class="pr-5 pl-5 pt-4 pb-4 search-input-input" type="search" placeholder="{{trans('home.search placeholder')}}" name='key' value="{{ isset($_GET['key']) ? $_GET['key'] : '' }}" autocomplete="off" aria-label="{{ trans('home.search placeholder') }}">
                            <div class="autocom-box" style="position: absolute;width: 89%;background: #fff;border-radius: 5px;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);margin-top: 8px; font-size: 15px; z-index: 3;"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('website.theme.bootstrap.layout.igts.shared.search-box-scripts')

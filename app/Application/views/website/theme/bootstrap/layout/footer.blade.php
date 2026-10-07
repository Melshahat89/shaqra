{{--
    Footer — structure mirrors the DGA-approved su.edu.sa footer:
    4 link columns (titles with a thin rule) · "تابعنا على" + "أدوات الإتاحة والوصول" icon rows
    · bottom links · copyright block (3 lines) · official logos.
--}}
@php $isAr = config('app.locale') == 'ar'; @endphp
<footer class="dga-footer dga-ft" dir="{{ getDir() }}" lang="{{ config('app.locale') }}" role="contentinfo">
    <div class="dga-ft-inner">

        <div class="dga-ft-grid">

            {{-- 1. عن المنصة --}}
            <div class="dga-ft-col">
                <h3 class="dga-ft-title">{{ $isAr ? 'عن المنصة' : 'About the platform' }}</h3>
                <ul class="dga-ft-links">
                    <li><a href="{{ url('page/about') }}">{{ $isAr ? 'من نحن' : 'About us' }}</a></li>
                    <li><a href="{{ url('professional-certificates/category') }}">{{ $isAr ? 'الشهادات الاحترافية' : 'Professional certificates' }}</a></li>
                    <li><a href="{{ url('allcourses/category') }}">{{ $isAr ? 'الدورات التدريبية' : 'Courses' }}</a></li>
                    <li><a href="{{ url('instructors/All') }}">{{ $isAr ? 'المدربون' : 'Instructors' }}</a></li>
                    <li><a href="{{ url('partners') }}">{{ $isAr ? 'الشركاء' : 'Partners' }}</a></li>
                    <li><a href="{{ url('faq') }}">{{ $isAr ? 'الأسئلة الشائعة' : 'FAQ' }}</a></li>
                </ul>
            </div>

            {{-- 2. الخدمات --}}
            <div class="dga-ft-col">
                <h3 class="dga-ft-title">{{ $isAr ? 'الخدمات' : 'Services' }}</h3>
                <ul class="dga-ft-links">
                    <li><a href="{{ url('subscriptions') }}">{{ $isAr ? 'خطط الاشتراك' : 'Subscription plans' }}</a></li>
                    <li><a href="{{ url('verifycertificate') }}">{{ $isAr ? 'التحقق من الشهادة' : 'Verify a certificate' }}</a></li>
                    <li><a href="{{ url('joinAsInstructor') }}">{{ $isAr ? 'انضم كمدرب' : 'Join as instructor' }}</a></li>
                    <li><a href="{{ url('contact') }}">{{ $isAr ? 'الدعم الفني' : 'Support' }}</a></li>
                    <li><a href="{{ url('contact') }}">{{ $isAr ? 'تواصل معنا' : 'Contact us' }}</a></li>
                </ul>
            </div>

            {{-- 3. روابط مفيدة --}}
            <div class="dga-ft-col">
                <h3 class="dga-ft-title">{{ $isAr ? 'روابط مفيدة' : 'Useful links' }}</h3>
                <ul class="dga-ft-links">
                    <li><a href="https://www.su.edu.sa" target="_blank" rel="noopener">{{ $isAr ? 'جامعة شقراء' : 'Shaqra University' }}</a></li>
                    <li><a href="https://www.vision2030.gov.sa" target="_blank" rel="noopener">{{ $isAr ? 'رؤية السعودية 2030' : 'Saudi Vision 2030' }}</a></li>
                    <li><a href="https://moe.gov.sa" target="_blank" rel="noopener">{{ $isAr ? 'وزارة التعليم' : 'Ministry of Education' }}</a></li>
                    <li><a href="https://www.my.gov.sa" target="_blank" rel="noopener">{{ $isAr ? 'المنصة الوطنية' : 'National platform' }}</a></li>
                    <li><a href="https://dga.gov.sa" target="_blank" rel="noopener">{{ $isAr ? 'هيئة الحكومة الرقمية' : 'Digital Government Authority' }}</a></li>
                    <li><a href="https://sdaia.gov.sa" target="_blank" rel="noopener">{{ $isAr ? 'الهيئة السعودية للبيانات والذكاء الاصطناعي' : 'SDAIA' }}</a></li>
                </ul>
            </div>

            {{-- 4. تابعنا على + أدوات الإتاحة والوصول --}}
            <div class="dga-ft-col">
                <h3 class="dga-ft-title">{{ $isAr ? 'تابعنا على' : 'Follow us' }}</h3>
                <div class="dga-ft-icons">
                    @if(getSetting('linkedin'))
                    <a href="{{ getSetting('linkedin') }}" target="_blank" rel="noopener" class="dga-ft-icon dga-no-ext" aria-label="{{ $isAr ? 'لينكد إن (رابط خارجي)' : 'LinkedIn (external link)' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                    </a>
                    @endif
                    @if(getSetting('twitter'))
                    <a href="{{ getSetting('twitter') }}" target="_blank" rel="noopener" class="dga-ft-icon dga-no-ext" aria-label="{{ $isAr ? 'إكس (رابط خارجي)' : 'X (external link)' }}">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    @endif
                    @if(getSetting('youtube'))
                    <a href="{{ getSetting('youtube') }}" target="_blank" rel="noopener" class="dga-ft-icon dga-no-ext" aria-label="{{ $isAr ? 'يوتيوب (رابط خارجي)' : 'YouTube (external link)' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-2C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 2A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                    </a>
                    @endif
                    @if(getSetting('instagram'))
                    <a href="{{ getSetting('instagram') }}" target="_blank" rel="noopener" class="dga-ft-icon dga-no-ext" aria-label="{{ $isAr ? 'إنستغرام (رابط خارجي)' : 'Instagram (external link)' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    @endif
                    @if(getSetting('facebook'))
                    <a href="{{ getSetting('facebook') }}" target="_blank" rel="noopener" class="dga-ft-icon dga-no-ext" aria-label="{{ $isAr ? 'فيسبوك (رابط خارجي)' : 'Facebook (external link)' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    @endif
                </div>

                <h3 class="dga-ft-title dga-ft-title--tools">{{ $isAr ? 'أدوات الإتاحة والوصول' : 'Accessibility tools' }}</h3>
                <div class="dga-ft-icons" role="group" aria-label="{{ $isAr ? 'أدوات إمكانية الوصول' : 'Accessibility tools' }}">
                    <button type="button" class="dga-ft-icon" data-contrast="high" aria-pressed="false" aria-label="{{ $isAr ? 'تباين عالٍ' : 'High contrast' }}" title="{{ $isAr ? 'تباين عالٍ' : 'High contrast' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                    <button type="button" class="dga-ft-icon" data-font="1" aria-label="{{ $isAr ? 'تكبير' : 'Zoom in' }}" title="{{ $isAr ? 'تكبير' : 'Zoom in' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </button>
                    <button type="button" class="dga-ft-icon" data-font="-1" aria-label="{{ $isAr ? 'تصغير' : 'Zoom out' }}" title="{{ $isAr ? 'تصغير' : 'Zoom out' }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    </button>
                </div>
            </div>

        </div>

        {{-- Bottom: links + copyright + logos --}}
        <div class="dga-ft-bottom">
            <div class="dga-ft-bottom-text">
                <ul class="dga-ft-bottom-links">
                    <li><a href="{{ url('sitemap') }}">{{ $isAr ? 'خريطة الموقع' : 'Sitemap' }}</a></li>
                    <li><a href="{{ url('page/termsOfUse') }}">{{ $isAr ? 'الشروط والأحكام' : 'Terms and conditions' }}</a></li>
                    <li><a href="{{ url('page/privacyPolicy') }}">{{ $isAr ? 'سياسة الخصوصية' : 'Privacy policy' }}</a></li>
                    <li><a href="{{ url('page/accessibility') }}">{{ $isAr ? 'إمكانية الوصول' : 'Accessibility' }}</a></li>
                </ul>
                <div class="dga-ft-copy">
                    <p>{{ $isAr ? 'جميع الحقوق محفوظة © جامعة شقراء' : 'All rights reserved © Shaqra University' }} {{ date('Y') }}</p>
                    <p>{{ $isAr ? 'تم تطويره وصيانته بواسطة معهد الدراسات والخدمات الاستشارية — جامعة شقراء، وتشغيل المحتوى بواسطة iGTS' : 'Developed and maintained by the Studies and Consulting Services Institute — Shaqra University; content operated by iGTS' }}</p>
                    <p>{{ $isAr ? 'مسجل لدى هيئة الحكومة الرقمية برقم:' : 'Registered with the Digital Government Authority, No.:' }} <a href="https://raqmi.dga.gov.sa/platforms/platformslist" target="_blank" rel="noopener" class="dga-no-ext">PLACEHOLDER</a></p>
                    <p class="dga-ft-updated">{{ $isAr ? 'تاريخ آخر تحديث :' : 'Last updated:' }} {{ date('Y/m/d') }}</p>
                </div>
            </div>
            <div class="dga-ft-logos">
                <a href="{{ url('/') }}" aria-label="{{ $isAr ? 'منصة الشهادات الاحترافية — الرئيسية' : 'Professional Certificates Platform — Home' }}">
                    <img src="{{ asset('website') }}/images/shaqracs.svg" alt="{{ $isAr ? 'منصة الشهادات الاحترافية — جامعة شقراء' : 'Professional Certificates Platform — Shaqra University' }}" class="dga-ft-logo dga-ft-logo--brand">
                </a>
                <a href="https://www.vision2030.gov.sa" target="_blank" rel="noopener" class="dga-no-ext" aria-label="{{ $isAr ? 'رؤية المملكة 2030 (رابط خارجي)' : 'Saudi Vision 2030 (external link)' }}">
                    <img src="{{ asset('website') }}/images/2030.svg" alt="{{ $isAr ? 'رؤية المملكة 2030' : 'Saudi Vision 2030' }}" class="dga-ft-logo">
                </a>
            </div>
        </div>

    </div>
</footer>

{{-- ══ Cookie Consent Banner — su.edu.sa (DGA-approved) pattern ══ --}}
<div id="dga-cookie-banner" class="dga-cookie-banner" role="dialog" aria-labelledby="dga-cookie-title" aria-describedby="dga-cookie-desc" dir="{{ getDir() }}" style="display:none;">
    <div class="dga-cookie-inner">
        <button type="button" class="dga-cookie-close" id="dga-cookie-close" aria-label="{{ $isAr ? 'إغلاق' : 'Close' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        <div class="dga-cookie-head">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/><circle cx="8.5" cy="8.5" r="1"/><circle cx="15.5" cy="15.5" r="1"/><circle cx="9" cy="15" r="1"/></svg>
            <div class="dga-cookie-text">
                <h5 id="dga-cookie-title">{{ $isAr ? 'ملفات تعريف الارتباط' : 'Cookies' }}</h5>
                <p id="dga-cookie-desc">{{ $isAr ? 'يستخدم هذا الموقع ملفات تعريف الارتباط (Cookies) لجعل تجربة استخدامك للموقع أفضل. يُرجى قبول استخدامنا لملفات تعريف الارتباط أو الاطلاع على سياسة الخصوصية لمزيد من المعلومات.' : 'This website uses cookies to improve your experience. Please accept our use of cookies or read the privacy policy for more information.' }}</p>
            </div>
        </div>
        <div class="dga-cookie-actions">
            <a href="{{ url('page/privacyPolicy') }}">{{ $isAr ? 'سياسة الخصوصية' : 'Privacy policy' }}</a>
            <button type="button" id="dga-cookie-accept" class="dga-btn dga-btn-primary dga-btn-lg" aria-label="{{ $isAr ? 'قبول' : 'Accept' }}">{{ $isAr ? 'قبول' : 'Accept' }}</button>
            <button type="button" id="dga-cookie-reject" class="dga-btn dga-btn-danger dga-btn-lg" aria-label="{{ $isAr ? 'رفض' : 'Reject' }}">{{ $isAr ? 'رفض' : 'Reject' }}</button>
        </div>
    </div>
</div>
<script>
(function() {
    var banner = document.getElementById('dga-cookie-banner');
    if (!banner) return;
    if (!localStorage.getItem('dga_cookie_consent')) banner.style.display = 'block';
    function close(v) { if (v) localStorage.setItem('dga_cookie_consent', v); banner.style.display = 'none'; }
    document.getElementById('dga-cookie-accept').addEventListener('click', function() { close('accepted'); });
    document.getElementById('dga-cookie-reject').addEventListener('click', function() { close('rejected'); });
    document.getElementById('dga-cookie-close').addEventListener('click', function() { close(null); });
})();
</script>

@if(!Auth::check() && Illuminate\Support\Facades\Route::currentRouteName() != 'post')
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.login');
</div>
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.register');
</div>
@endif

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
                        {!! dgaIcon('linkedin-02', '') !!}
                    </a>
                    @endif
                    @if(getSetting('twitter'))
                    <a href="{{ getSetting('twitter') }}" target="_blank" rel="noopener" class="dga-ft-icon dga-no-ext" aria-label="{{ $isAr ? 'إكس (رابط خارجي)' : 'X (external link)' }}">
                        {!! dgaIcon('new-twitter') !!}
                    </a>
                    @endif
                    @if(getSetting('youtube'))
                    <a href="{{ getSetting('youtube') }}" target="_blank" rel="noopener" class="dga-ft-icon dga-no-ext" aria-label="{{ $isAr ? 'يوتيوب (رابط خارجي)' : 'YouTube (external link)' }}">
                        {!! dgaIcon('youtube', '') !!}
                    </a>
                    @endif
                    @if(getSetting('instagram'))
                    <a href="{{ getSetting('instagram') }}" target="_blank" rel="noopener" class="dga-ft-icon dga-no-ext" aria-label="{{ $isAr ? 'إنستغرام (رابط خارجي)' : 'Instagram (external link)' }}">
                        {!! dgaIcon('instagram', '') !!}
                    </a>
                    @endif
                    @if(getSetting('facebook'))
                    <a href="{{ getSetting('facebook') }}" target="_blank" rel="noopener" class="dga-ft-icon dga-no-ext" aria-label="{{ $isAr ? 'فيسبوك (رابط خارجي)' : 'Facebook (external link)' }}">
                        {!! dgaIcon('facebook-02', '') !!}
                    </a>
                    @endif
                </div>

                <h3 class="dga-ft-title dga-ft-title--tools">{{ $isAr ? 'أدوات الإتاحة والوصول' : 'Accessibility tools' }}</h3>
                <div class="dga-ft-icons" role="group" aria-label="{{ $isAr ? 'أدوات إمكانية الوصول' : 'Accessibility tools' }}">
                    <button type="button" class="dga-ft-icon" data-contrast="high" aria-pressed="false" aria-label="{{ $isAr ? 'تباين عالٍ' : 'High contrast' }}" title="{{ $isAr ? 'تباين عالٍ' : 'High contrast' }}">
                        {!! dgaIcon('view', '') !!}
                    </button>
                    <button type="button" class="dga-ft-icon" data-font="1" aria-label="{{ $isAr ? 'تكبير' : 'Zoom in' }}" title="{{ $isAr ? 'تكبير' : 'Zoom in' }}">
                        {!! dgaIcon('zoom-in-area', '') !!}
                    </button>
                    <button type="button" class="dga-ft-icon" data-font="-1" aria-label="{{ $isAr ? 'تصغير' : 'Zoom out' }}" title="{{ $isAr ? 'تصغير' : 'Zoom out' }}">
                        {!! dgaIcon('zoom-out-area', '') !!}
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
                <a href="https://www.su.edu.sa" target="_blank" rel="noopener" class="dga-no-ext" aria-label="{{ $isAr ? 'جامعة شقراء (رابط خارجي)' : 'Shaqra University (external link)' }}">
                    <img src="{{ asset('website') }}/images/shaqra2.svg" alt="{{ $isAr ? 'جامعة شقراء' : 'Shaqra University' }}" class="dga-ft-logo">
                </a>
                <a href="https://www.vision2030.gov.sa" target="_blank" rel="noopener" class="dga-no-ext" aria-label="{{ $isAr ? 'رؤية المملكة 2030 (رابط خارجي)' : 'Saudi Vision 2030 (external link)' }}">
                    <img src="{{ asset('website') }}/images/2030.svg" alt="{{ $isAr ? 'رؤية المملكة 2030' : 'Saudi Vision 2030' }}" class="dga-ft-logo">
                </a>
                <a href="{{ url('/') }}" aria-label="{{ $isAr ? 'منصة مهني — الرئيسية' : 'Mehani platform — Home' }}">
                    <img src="{{ asset('website') }}/images/logonew2.webp" alt="{{ $isAr ? 'منصة مهني للشهادات الاحترافية' : 'Mehani Professional Certificates Platform' }}" class="dga-ft-logo">
                </a>
            </div>
        </div>

    </div>
</footer>

{{-- ══ Cookie Consent Banner — su.edu.sa (DGA-approved) pattern ══ --}}
<div id="dga-cookie-banner" class="dga-cookie-banner" role="dialog" aria-labelledby="dga-cookie-title" aria-describedby="dga-cookie-desc" dir="{{ getDir() }}" style="display:none;">
    <div class="dga-cookie-inner">
        <button type="button" class="dga-cookie-close" id="dga-cookie-close" aria-label="{{ $isAr ? 'إغلاق' : 'Close' }}">
            {!! dgaIcon('cancel-01', '') !!}
        </button>
        <div class="dga-cookie-head">
            {!! dgaIcon('cookie', '') !!}
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

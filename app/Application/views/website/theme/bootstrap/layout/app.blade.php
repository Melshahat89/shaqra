@php
    use Illuminate\Support\Facades\Session as Session;

        $VERSION_NUMBER = 15.5;
@endphp
        <!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ getDir() }}">
<head>


    @if(Auth::check())
        <script defer>
            let event_id = "{{ Auth::user()->id }}";
        </script>
    @endif

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="mehany">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- Open Graph (DGA digital standards — social sharing + search enrichment) --}}
    <meta property="og:type"        content="website">
    <meta property="og:locale"      content="{{ config('app.locale') == 'ar' ? 'ar_SA' : 'en_US' }}">
    <meta property="og:site_name"   content="{{ trans('home.HomeTitle') }}">
    <meta property="og:title"       content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:image"       content="{{ asset('website') }}/images/shaqracs.svg">
    <meta name="twitter:card"       content="summary_large_image">
    <meta name="twitter:title"      content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">

    <title> @yield('title') </title>

    @if(View::hasSection('canonical'))
        @yield('canonical')
    @else
        <link rel="canonical" href="{{ url()->current() }}">
    @endif

    <!-- Bootstrap core CSS ARABIC -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('website') }}/images/icon.svg">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('website') }}/css/bootstrap.min.css?v={{$VERSION_NUMBER}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('website') }}/css/front/style.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ asset('website') }}/css/front/owl.theme.default.min.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ asset('website') }}/css/front/owl.carousel.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ asset('website') }}/css/front/responsive.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ asset('website') }}/css/front/flaticon.css?v={{$VERSION_NUMBER}}" rel="stylesheet">

    @if(getDir() == "rtl")
        <link href="{{ asset('website') }}/css/front/custom-rtl.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    @else
        <link href="{{ asset('website') }}/css/front/custom.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    @endif

    <link href="{{ url('website') }}/css/selectize.bootstrap4.css?v={{$VERSION_NUMBER}}" rel="stylesheet">
    <link href="{{ url('website') }}/css/selectize.css?v={{$VERSION_NUMBER}}" rel="stylesheet">

    {{-- ══ DGA / Shaqra Unified Design System (site-wide) ══ --}}
    <link href="{{ asset('website') }}/css/front/mobile.css?v=1.0" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('website') }}/css/front/dga-design-system.css?v=8.3" rel="stylesheet">
    <link href="{{ asset('website') }}/css/front/dga-overrides.css?v=8.3" rel="stylesheet">

    @stack('css')
    {{ Html::style('website/css/sweetalert.css') }}
    @livewireStyles



    @stack('schema')


</head>

@if(getDir() == 'rtl')
    <body class="text-right" id="p_wrapper">
    <a href="#main-content" class="dga-skip-link">تجاوز إلى المحتوى الرئيسي</a>
    <div class="smart_bar">
{{--        <div class=" fade show" >--}}
{{--            <div class="text_center ptsm pbsm">--}}
{{--                <a class="navbar-brand m-0" href="/">--}}
{{--                    <img src="{{ asset('website') }}/images/logonew2.webp" loading="lazy" alt="" width="150" height="75">--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="alert alert-info alert-dismissible fade show" style="background-color: #212529;border-color: #031138">--}}
{{--            <div class="text_center ptsm pbsm">--}}
{{--                <h5>--}}
{{--                    <div style="color: #ffffff"  >--}}
{{--                        بمناسبة عيد الفطر المبارك، خصم 60% علي كل الاشتراكات بكود--}}
{{--                    <a href="{{url('/subscriptions/?promotion=Free60')}}" class="button home-slider-button button_small text_capitalize slider-cta">--}}
{{--                        Free60--}}
{{--                    </a>--}}
{{--                    </div>--}}
{{--                </h5>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

    <div id="smartbar-ar" class="smart_bar">
    </div>
    @else
        <body class="text-left" id="p_wrapper">
        <a href="#main-content" class="dga-skip-link">Skip to main content</a>
        <div class="smart_bar">
{{--            <div class="alert alert-info alert-dismissible fade show" style="background-color: #20a0e1;border-color: #031138">--}}
{{--                <div class="text_center ptsm pbsm">--}}
{{--                    <h5>--}}
{{--                        <a style="color: #ffffff" target="_blank" href="https://t.me/InternationalGroupForTrainingSer"> Join the IGTS community on Telegram </a>--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="alert alert-info alert-dismissible fade show" style="background-color: #212529;border-color: #031138">--}}
{{--                <div class="text_center ptsm pbsm">--}}
{{--                    <h5>--}}
{{--                        <a style="color: #ffffff"  >--}}
{{--                            On the occasion of Eid Al-Fitr, get a 60% discount on all subscriptions with the code.--}}
{{--                            <a href="{{url('/subscriptions/?promotion=Free60')}}" class="button home-slider-button button_small text_capitalize slider-cta">--}}
{{--                                Free60--}}
{{--                            </a>--}}
{{--                        </a>--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div id="smartbar-en" class="smart_bar">
        </div>
        @endif




        @php
            $isWebView = false;
        if((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) :
            $isWebView = true;
        elseif(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) :
            $isWebView = true;
        endif;

        @endphp

        @if(!$isWebView)

            @if(! ( class_basename(Route::current()->controller) == 'PageController'))
                <!-- <div class="se-pre-con"></div> -->
                 <div class="loading flexCenter">
                    <div class="loader-logo">
                        <div class="loader">Loading...</div>
                         <img src="{{ asset('website') }}/images/logonew2.webp" alt="{{ config('app.name', 'منصة الشهادات الاحترافية') }}">
                    </div>
                 </div>
            @endif
        @endif




        @include(layoutIgtsHeader('website'))


        @include(layoutContent('website'))


        @if(getSetting('whatsapp'))
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', getSetting('whatsapp')) }}" target="_blank" rel="noopener" class="float" aria-label="{{ getDir() == 'rtl' ? 'تواصل عبر واتساب' : 'Chat on WhatsApp' }}">
            <i class="whatsapp-homepage-icon fab fa-whatsapp my-float" aria-hidden="true"></i>
        </a>
        @endif

        <input type='hidden' id='user_id' value='{{(auth()->check())?Auth::user()->id:''}}'>
        <input type='hidden' id='path' value='{{ url('/') }}'>

        @include(layoutFooter('website'))

        {{-- ══ Mobile Bottom Navigation Bar (app feel) ══ --}}
        <nav class="dga-mobile-nav" aria-label="التنقل السريع" dir="rtl">
            <a href="{{ url('/') }}" class="{{ request()->is('/') || request()->is('ar') ? 'active' : '' }}" aria-label="الرئيسية">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                الرئيسية
            </a>
            <a href="{{ url('/allcourses/category') }}" class="{{ request()->is('allcourses*') ? 'active' : '' }}" aria-label="الدورات">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                الدورات
            </a>
            <a href="{{ url('/subscriptions') }}" class="dga-nav-cta {{ request()->is('subscriptions*') ? 'active' : '' }}" aria-label="اشترك الآن">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                اشترك
            </a>
            <a href="{{ url('/faq') }}" class="{{ request()->is('faq*') ? 'active' : '' }}" aria-label="الأسئلة الشائعة">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                مساعدة
            </a>
            @if(Auth::check())
            <a href="{{ url('/account/myCourses') }}" class="{{ request()->is('account*') ? 'active' : '' }}" aria-label="حسابي">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                حسابي
            </a>
            @else
            <a href="javascript:void(0)" data-toggle="modal" data-target="#loginModal" aria-label="تسجيل الدخول">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                دخول
            </a>
            @endif
        </nav>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" id="lectureModal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalBody">
                        ...
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal -->

        {{--        @if(getCurrency() == 'SAR')--}}
        {{--        <div class="modal fade"  id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
        {{--            <div class="modal-dialog modal-dialog-centered small-modal" role="document">--}}
        {{--                <div class="modal-content" style="width: 60%;height: 55%">--}}
        {{--                    <div class="modal-body text-center">--}}
        {{--                        <img src="{{ asset('website') }}/popup2.jpg" alt="Welcome Image" class="img-fluid">--}}
        {{--                        <a href="/spin" type="button" class="btn btn-success mt-3">احصل عليها الان</a>--}}
        {{--                        <button type="button" class="btn btn-primary mt-3" id="dontShowAgain">لا تظهر مرة أخرى</button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        @endif--}}



        {{--    <div id="yourElementID" class="modal fade" role="dialog">--}}
        {{--        <div class="modal-dialog">--}}
        {{--            <div class="modal-content" style="    background-color: antiquewhite;">--}}
        {{--                <div class="modal-header btn-blue">--}}
        {{--                    <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
        {{--                </div>--}}
        {{--                <div class="modal-body">--}}
        {{--                    @include('website.spin')--}}
        {{--                </div>--}}
        {{--                <div class="modal-footer">--}}
        {{--                    <div class="col-sm-12">--}}
        {{--                        <a href="">--}}
        {{--                            <button type="button" class="btn btn-danger col-xs-12" data-dismiss="modal">Cancel</button>--}}
        {{--                        </a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}


        @livewireScripts
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js?v={{$VERSION_NUMBER}}"></script>

{{--@if(Auth::check())--}}

{{--    @if(!\App\Application\Model\Spin::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->first())--}}
{{--        <!-- START JAVASCRIPT FILES LOADING -->--}}
{{--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>--}}
{{--        <script type="text/javascript">--}}
{{--            $(window).load(function() {--}}
{{--                $('#yourElementID').modal('show');--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endif--}}
{{--@endif--}}

<!--


<script>
    jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.wheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("wheel", handle, { passive: true });
    }
};
jQuery.event.special.mousewheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("mousewheel", handle, { passive: true });
    }
};

</script> -->
<script src="{{ asset('website') }}/js/bootstrap.min.js?v={{$VERSION_NUMBER}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js?v={{$VERSION_NUMBER}}" async defer></script>
<script type="text/javascript" src="{{ asset('website') }}/js/app.min.js?v={{$VERSION_NUMBER}}"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/owl.carousel.min.js?v={{$VERSION_NUMBER}}"></script>
@if(getDir() == "rtl")
    <script type="text/javascript" src="{{ asset('website') }}/js/custom.owl-rtl.js?v={{$VERSION_NUMBER}}"></script>
@else
    <script type="text/javascript" src="{{ asset('website') }}/js/custom.owl.js?v={{$VERSION_NUMBER}}"></script>
@endif

<script src="{{ asset('website') }}/js/custom.js?v={{$VERSION_NUMBER}}"></script>
{{ Html::script('website/js/sweetalert.min.js') }}


{{--@if(getCurrency() == 'SAR')--}}
{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        if (!localStorage.getItem('dontShowPopup')) {--}}
{{--            $('#welcomeModal').modal('show');--}}
{{--        }--}}

{{--        document.getElementById('dontShowAgain').addEventListener('click', function () {--}}
{{--            localStorage.setItem('dontShowPopup', 'true');--}}
{{--            $('#welcomeModal').modal('hide');--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
{{--@endif--}}

@include('sweet::alert')

<script>
/* ── Mobile drawer navigation ── */
(function () {
    var toggler  = document.querySelector('header .navbar-toggler');
    var collapse = document.querySelector('header .navbar-collapse');
    var body     = document.body;

    if (!toggler || !collapse) return;

    function openDrawer() {
        collapse.classList.add('show');
        body.classList.add('dga-drawer-open');
        toggler.setAttribute('aria-expanded', 'true');
    }
    function closeDrawer() {
        collapse.classList.remove('show');
        body.classList.remove('dga-drawer-open');
        toggler.setAttribute('aria-expanded', 'false');
    }

    /* Toggle on hamburger click (override Bootstrap) */
    toggler.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        collapse.classList.contains('show') ? closeDrawer() : openDrawer();
    });

    /* Close on overlay click */
    body.addEventListener('click', function (e) {
        if (body.classList.contains('dga-drawer-open') && !collapse.contains(e.target) && e.target !== toggler) {
            closeDrawer();
        }
    });

    /* Close on Escape */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && body.classList.contains('dga-drawer-open')) {
            closeDrawer();
            toggler.focus();
        }
    });

    /* Close drawer when a nav link is tapped */
    collapse.querySelectorAll('.nav-link, .dropdown-item').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 960) closeDrawer();
        });
    });

    /* Highlight active bottom nav item */
    var currentPath = window.location.pathname;
    document.querySelectorAll('.dga-mobile-nav a').forEach(function (a) {
        var href = a.getAttribute('href');
        if (href && href !== 'javascript:void(0)' && currentPath === href) {
            a.classList.add('active');
        }
    });
})();
</script>

<!-- <script type="text/javascript">
$(document).ready(function () {
    //Disable cut copy paste
    $(document).bind('cut copy paste', function (e) {
        e.preventDefault();
    });

    //Disable mouse right click
    $(document).on("contextmenu",function(e){
        return false;
    });
});
</script> -->

<script>
    (function (e, t, n) {
        var r = e.querySelectorAll("html")[0];
        r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
    })(document, window, 0);
</script>

@if(Session::get('socialUserRegister'))
    <script>$('#registerModal').modal('show');</script>
    @php Session::pull('socialUserRegister') @endphp
@endif

@if(Illuminate\Support\Facades\Route::currentRouteName() != "register" && Illuminate\Support\Facades\Route::currentRouteName() != "login")
    @if(Session::get('signupError') )
        <script>$('#registerModal').modal('show');</script>
        @php Session::pull('signupError'); @endphp
    @endif

    @if(Session::get('loginError'))
        <script>$('#loginModal').modal('show');</script>
        @php Session::pull('loginError'); @endphp
    @endif
@endif




<script src="{{ url('website') }}/js/selectize.min.js?v={{$VERSION_NUMBER}}"></script>

@if(request()->route()->getActionName() <> "App\Application\Controllers\Website\HomeController@index")
    <script>
        (function (e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);
    </script>

    <script type="text/javascript" src="{{ asset('website') }}/js/consultations.js?v={{$VERSION_NUMBER}}"></script>
@endif
@stack('js')

{{--Hide Hubspot Messages--}}
{{--<style>--}}
{{--    .hs-chat-widget {--}}
{{--        display: none !important;--}}
{{--    }--}}
{{--    #hubspot-messages-iframe-container {--}}
{{--        display: none !important;--}}
{{--    }--}}
{{--</style>--}}
        </body>
</html>
@php
    use Illuminate\Support\Facades\Session as Session;

        $VERSION_NUMBER = 15.2;
@endphp
        <!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ getDir() }}">
<head>
    <!-- Google Tag Manager -->
    <script async>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KGKDP6C');
    </script>
    <!-- End Google Tag Manager -->

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
    <meta name="author" content="IGTS">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="facebook-domain-verification" content="z3li963csbvtfybzbb6kf3unwwj4v9" />

    <title> @yield('title') </title>

    @if(View::hasSection('canonical'))
        @yield('canonical')
    @else
        <link rel="canonical" href="{{ url()->current() }}">
    @endif

    <!-- Bootstrap core CSS ARABIC -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('website') }}/images/favicon-16x16.png">

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
    @stack('css')
    {{ Html::style('website/css/sweetalert.css') }}
    @livewireStyles



    @if(request()->route()->getActionName() <> "App\Application\Controllers\Website\HomeController@index")


    <!-- TikTok Pixel Code Start -->
        <script async>
        !function (w, d, t) {
            w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
                var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
            ;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};


            ttq.load('CRGKRVBC77UD2MA17590');
            ttq.page();
        }(window, document, 'ttq');
    </script>
    <!-- TikTok Pixel Code End -->

    <!-- Snap Pixel Code -->
        <script async type='text/javascript'>
        (function(e,t,n){if(e.snaptr)return;var a=e.snaptr=function()
        {a.handleRequest?a.handleRequest.apply(a,arguments):a.queue.push(arguments)};
            a.queue=[];var s='script';r=t.createElement(s);r.async=!0;
            r.src=n;var u=t.getElementsByTagName(s)[0];
            u.parentNode.insertBefore(r,u);})(window,document,
            'https://sc-static.net/scevent.min.js');

        snaptr('init', 'befc9e4c-5986-4ab6-8d33-6b723026a277', {});

        snaptr('track', 'PAGE_VIEW');
    </script>
    <!-- End Snap Pixel Code -->
    @endif


    @stack('schema')


</head>

@if(getDir() == 'rtl')
    <body class="text-right" id="p_wrapper">
    <div class="smart_bar">
        <div class="alert alert-info alert-dismissible fade show" style="background-color: #20a0e1;border-color: #031138">
            <div class="text_center ptsm pbsm">
                <h5>
                    <a style="color: #ffffff" target="_blank" href="https://t.me/InternationalGroupForTrainingSer">انضم الى مجتمع IGTS على التليجرام</a>
                </h5>
            </div>
        </div>
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
        <div class="smart_bar">
            <div class="alert alert-info alert-dismissible fade show" style="background-color: #20a0e1;border-color: #031138">
                <div class="text_center ptsm pbsm">
                    <h5>
                        <a style="color: #ffffff" target="_blank" href="https://t.me/InternationalGroupForTrainingSer"> Join the IGTS community on Telegram </a>
                    </h5>
                </div>
            </div>
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

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KGKDP6C"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->




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
                {{-- <div class="loading flexCenter">
                    <div class="loader-logo">
                        <div class="loader">Loading...</div>
                         <img src="{{ asset('website') }}/images/logonew.webp" alt="..." >
                    </div>
                 </div>--}}
            @endif
        @endif




        @include(layoutIgtsHeader('website'))


        @include(layoutContent('website'))


        <a href="https://contactus.igtsservice.com/?prevUrl={{ urlencode(url()->full()) }}" target="_blank" class="float">
            <i class="whatsapp-homepage-icon fab fa-whatsapp my-float" aria-hidden="true"></i>
        </a>

        <input type='hidden' id='user_id' value='{{(auth()->check())?Auth::user()->id:''}}'>
        <input type='hidden' id='path' value='{{ url('/') }}'>

        @include(layoutFooter('website'))

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
        </body>
</html>
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
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js?v={{$VERSION_NUMBER}}" async defer></script>
<script type="text/javascript" src="{{ asset('website') }}/js/app.min.js?v={{$VERSION_NUMBER}}"></script>
<script type="text/javascript" src="{{ asset('website') }}/js/owl.carousel.min.js?v={{$VERSION_NUMBER}}"></script>
@if(getDir() == "rtl")
    <script type="text/javascript" src="{{ asset('website') }}/js/custom.owl-rtl.js?v={{$VERSION_NUMBER}}"></script>
@else
    <script type="text/javascript" src="{{ asset('website') }}/js/custom.owl.js?v={{$VERSION_NUMBER}}"></script>
@endif
<!--Start of HubSpot Embed Code -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/4880007.js"></script>
<!--End of HubSpot Embed Code -->
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
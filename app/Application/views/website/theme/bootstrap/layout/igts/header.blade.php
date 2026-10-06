<style>
/* Nav header — Platforms Code component styles live in dga-platforms-code.css.
   Only structural helpers for the nested dropdown remain here. */
.nav-link, .logo-container p { white-space: nowrap; }
.navbar-nav { display: flex; align-items: center; }
.logo-container { display: flex; align-items: center; }
.dropdown-submenu { position: relative; }
.dropdown-submenu > .dropdown-menu { top: 0; left: 100%; margin-top: -1px; }
.dropdown-submenu:hover > .dropdown-menu { display: block; }
</style>
{{-- ══ 1. DIGITAL STAMP (الختم الرقمي) — top of page, with language + accessibility as its two secondary elements ══ --}}
@include('website.theme.bootstrap.layout.igts.dga-stamp')

{{-- ══ 2. NAV HEADER ══ --}}
<header class="dga-nav-header" role="navigation" aria-label="التنقل الرئيسي">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0 d-flex justify-content-between align-items-center">

            <!-- اللوجو يمين -->
            <a class="navbar-brand m-0" href="/" aria-label="منصة الشهادات الاحترافية — الصفحة الرئيسية">
                <img src="{{ asset('website') }}/images/shaqracs.svg" loading="lazy" alt="منصة الشهادات الاحترافية — جامعة شقراء" width="250">
            </a>

            <!-- زر الهامبرغر للجوال -->
            {{-- NOTE: no data-toggle="collapse" — the drawer is driven entirely by the
                 custom script in app.blade.php. Letting Bootstrap's collapse plugin also
                 bind here caused a race that left the drawer frozen mid-transition. --}}
            <button class="navbar-toggler" type="button"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="فتح/إغلاق القائمة">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- المنيو + البحث في الوسط -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <!-- Dropdown Courses -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
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

            <!-- الجزء الشمال (تسجيل دخول + لوجو ثاني) -->
            <div class="d-flex align-items-center dga-header-actions">
                {{-- Language switcher — commented out until bilingual content is ready
                <a href="{{ LaravelLocalization::getLocalizedURL((config('app.locale') == 'en') ? 'ar' : 'en') }}"
                   class="button button_outline m-1"
                   aria-label="{{ config('app.locale') == 'ar' ? 'Switch to English' : 'التبديل إلى العربية' }}"
                   lang="{{ config('app.locale') == 'ar' ? 'en' : 'ar' }}">
                    {{ config('app.locale') == 'ar' ? 'EN' : 'عربى' }}
                </a>
                --}}

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
                    <button type="button" data-toggle="modal" data-target="#loginModal" class="dga-btn dga-btn-outline">{{trans('home.signin')}}</button>
                    <button type="button" data-toggle="modal" data-target="#registerModal" class="dga-btn dga-btn-primary">{{trans('home.signup')}}</button>
                @endif

                <!-- اللوجو الثاني (Vision 2030) -->
                <a class="navbar-brand m-0 dga-vision-logo dga-no-ext" href="https://www.vision2030.gov.sa" target="_blank" rel="noopener" aria-label="رؤية المملكة 2030 (رابط خارجي)">
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

{{-- ══════════════════════════════════════════════════════════════
     MOBILE DRAWER MENU — sub-menu accordions + close-affordance.

     The drawer open/close/overlay/ESC/link-close wiring lives in ONE
     place: the script at the bottom of app.blade.php. This block only
     adds the pieces that script doesn't: scroll-lock on open, the top
     "✕ إغلاق" tap area, and accordion behaviour for the dropdowns.
     We do NOT touch Bootstrap's collapse plugin here — doing so is what
     left the drawer frozen mid-transition.
══════════════════════════════════════════════════════════════ --}}
<script>
(function () {
    var navEl = document.getElementById('navbarSupportedContent');
    if (!navEl) return;

    // Lock background scroll while the drawer is open (app.blade.php toggles
    // `dga-drawer-open` on <body>; mirror that to the scroll lock).
    var mo = new MutationObserver(function () {
        var isOpen = document.body.classList.contains('dga-drawer-open');
        document.documentElement.style.overflow = isOpen ? 'hidden' : '';
    });
    mo.observe(document.body, { attributes: true, attributeFilter: ['class'] });

    // Tap the top "✕ إغلاق" affordance (the ::before pseudo-element) to close.
    navEl.addEventListener('click', function (e) {
        if (window.innerWidth > 960) return;
        if (e.target !== navEl) return;            // only the bare drawer surface, i.e. the ::before strip
        var rect = navEl.getBoundingClientRect();
        if (e.clientY - rect.top < 50) {
            navEl.classList.remove('show');
            document.body.classList.remove('dga-drawer-open');
        }
    });

    // Mobile: dropdown toggles act as accordions inside the drawer.
    navEl.addEventListener('click', function (e) {
        var dt = e.target.closest('.dropdown-toggle');
        if (!dt) return;
        if (window.innerWidth > 960) return;       // desktop keeps Bootstrap hover dropdowns
        e.preventDefault();
        var parent = dt.parentElement;
        var menu   = parent ? parent.querySelector('.dropdown-menu') : null;
        if (!menu) return;
        // Close sibling sub-menus first
        parent.parentElement.querySelectorAll(':scope > .nav-item.dropdown .dropdown-menu.show').forEach(function (m) {
            if (m !== menu) m.classList.remove('show');
        });
        menu.classList.toggle('show');
    });
}());
</script>

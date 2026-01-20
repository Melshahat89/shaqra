<style>
    .top-bar {
        background: linear-gradient(90deg, #ff4d4d, #ff1a75); /* تدرج لوني جذاب */
        color: #fff;
        font-weight: bold;
        font-size: 16px;
        height: 35px;
        letter-spacing: 1px;
    }

    .top-bar-text {
        white-space: nowrap; /* يمنع الكسر على سطرين */
    }
    .nav-link, .logo-container p {
        white-space: nowrap;   /* يمنع الكسر */
    }
    .nav-link {
        /*font-size: 14px; !* أو أي حجم أصغر *!*/
    }
    .logo-container p {
        /*font-size: 16px;*/
        /*padding: 10px 20px;*/
    }
    .navbar-nav {
        display: flex;
        align-items: center;
    }
    .logo-container {
        display: flex;
        align-items: center;
    }

    /* تغيير اللون عند الوقوف */
    .navbar-nav .nav-link:hover,
    .dropdown-menu .dropdown-item:hover {
        background-color: #f8f9fa; /* لون فاتح */
        color: #007bff; /* أزرق */
    }

    /* دعم الـ submenu */
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }

    /* فتح القائمة الفرعية تلقائيًا عند الوقوف */
    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }


</style>


<div class="top-bar d-flex justify-content-center align-items-center"> <span class="top-bar-text"> ⚡ نسخة تجريبية </span> </div>
<header class="p-3">
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0 d-flex justify-content-between align-items-center">

            <!-- اللوجو يمين -->
            <a class="navbar-brand m-0" href="/">
                <img src="{{ asset('website') }}/images/shaqra.svg" loading="lazy" alt="Logo" width="250">
            </a>

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
                <form class="search-bar desktop-search ml-3" style="width: 40%" action="/allcourses/category" method="GET">
                    <div class="search-input">
{{--                        <label for="key" class="search-bar-label mr-3 ml-3"><i class="fas fa-search"></i></label>--}}
                        <input class="search-input-input" type="text" placeholder="{{trans('home.search placeholder')}}" name='key' autocomplete="off">
                        <div class="autocom-box" style="position: absolute;width: 100%;background: #fff;border-radius: 5px;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);margin-top: 8px; font-size: 15px; z-index: 3;"></div>

                    </div>
                </form>

            </div>

            <!-- الجزء الشمال (تسجيل دخول/خروج أو بيانات المستخدم + اللوجو الثاني) -->
            <div class="d-flex align-items-center">
                @if(Auth::check())
                    <!-- بيانات المستخدم -->
                    <div class="desktop-account-info-padding d-flex align-items-center">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userMenuDropdown" role="button" data-toggle="dropdown">
                            <img class="rounded-circle me-2" src="{{ large1(Auth::user()->image) }}" width="38">
                            <span class="avatar_name">{{ charlimit(Auth::user()->name, 10) }}</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userMenuDropdown">
                            @if(Auth::user()->group_id == 1 || Auth::user()->group_id == 9 || Auth::user()->group_id == 10 || Auth::user()->group_id == 11 || Auth::user()->group_id == 12 || Auth::user()->group_id == 13 || Auth::user()->group_id == 14 || Auth::user()->group_id == 15 || Auth::user()->group_id == 16)
                                <a href="/lazyadmin" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.UserType1')}}</a>
                            @endif
                            @if((Auth::user()->group_id == 6))
                                <a class="dropdown-item" href="{{url('business/home')}}">{{trans('businessdata.Dashboard')}}</a>
                            @endif

                            @if(isValidBusiness(Auth::user()->businessdata_id))
                                @php
                                    $businessdata = \App\Application\Model\Businessdata::findOrfail(Auth::user()->businessdata_id);
                                @endphp


                                <a class="dropdown-item" href="{{url('business/businessCourses')}}">
                                    <i class="fas fa-home"></i>
                                    {{trans('courses.businessCourses')}} ({{$businessdata->name_lang}})
                                </a>

                                @if((Auth::user()->group_id == App\Application\Model\User::TYPE_GROUP_ADMIN) AND Auth::user()->businessGroupAdmin)
                                    <a class="dropdown-item" href="{{url('business/mygroup')}}">
                                        <i class="fas fa-home"></i>
                                        {{trans('courses.my group')}} ({{$businessdata->name_lang}})
                                    </a>
                                @endif


                            @endif


                            @if(Auth::user()->is_affiliate OR Auth::user()->group_id == 3)
                                <a href="/account/analysis" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.analysis')}}</a>
                            @endif
                            @if(Auth::user()->group_id == 17)
                                <a href="/account/consultantanalysis" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.analysis')}}</a>
                            @endif
                            <a href="/account/myCourses" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('home.my courses')}}</a>
                            <a href="/account/myProgress#weekly_goal" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('account.My Progress')}}</a>
                            <a href="/account/myProgress" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('account.my notes')}}</a>
                            <a href="/account/myFavourites" class="dropdown-item"><i class="fas fa-heart"></i> {{trans('home.my favorites')}}</a>
                            <a href="/account/myCertificates" class="dropdown-item"><i class="fas fa-certificate"></i> {{trans('home.my certificates')}}</a>

                            @isset(Auth::user()->subscription)
                                <a href="/account/mySubscriptions" class="dropdown-item"><i class="fas fa-graduation-cap"></i> {{trans('courses.mySubscriptions')}}</a>
                            @endisset


                            <div class="divider"></div>
                            <a href="/account/edit" class="dropdown-item"><i class="fas fa-cog"></i> {{trans('home.account info')}}</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> {{trans('home.logout')}}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </div>
                    </div>
                @else
                    <!-- أزرار تسجيل الدخول والخروج -->
                    <button type="button" data-toggle="modal" data-target="#loginModal" class="button button_primary m-1">{{trans('home.signin')}}</button>
                    <button type="button" data-toggle="modal" data-target="#registerModal" class="button button_primary m-1">{{trans('home.signup')}}</button>
                @endif

                <!-- اللوجو الثاني -->
                <a class="navbar-brand m-0" href="/">
                    <img src="{{ asset('website') }}/images/mehany20302.png" loading="lazy" alt="Logo Left" width="200">
                </a>
            </div>

        </nav>
    </div>
</header>





{{--<header class="p-3">--}}
{{--    <div class="wrapper">--}}
{{--        <nav class="navbar navbar-expand-lg navbar-light bg-light p-0">--}}
{{--            <a class="navbar-brand m-0" href="/">--}}
{{--                <img src="{{ asset('website') }}/images/shaqra.svg" loading="lazy" alt="" width="250" height="">--}}
{{--                <img src="{{ asset('website') }}/images/Scsi.webp" loading="lazy" alt="" width="200" height="">--}}
{{--            </a>--}}
{{--            <a href="#" data-toggle="modal" data-target="#searchmodal"><i class="fas fa-search d-none" id="header-search-icon"></i></a>--}}

{{--            <div class="dropdown">--}}

{{--                <button class="dropbtn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                    <span class="navbar-toggler-icon" ></span>--}}
{{--                </button>--}}

{{--                <div class="dropdown-content">--}}
{{--                    <div class="navigation-primary">--}}
{{--                        <ul class="collapse navbar-collapse pr-2 pl-2 navbar-nav " id="navbarSupportedContent" style="margin: revert;">--}}
{{--                            <li class="nav-item active">--}}
{{--                                <a class="nav-link" href="/"> {{ trans('professionalcertificates.professionalcertificates') }}  <span class="sr-only">(current)</span></a>--}}
{{--                            </li>--}}
{{--                            <li><a class="nav-link dropdown-toggle" href="{{url('/home-courses')}}"> {{trans('website.courses')}}</a>--}}
{{--                                <ul class="sub-menu">--}}
{{--                                    @foreach(menuCategories() as $cat)--}}
{{--                                        @if(!$cat->childs->isEmpty())--}}
{{--                                            <li><a>  {{$cat->name_lang}}  <i class="fas fa-angle-down"></i> </a>--}}
{{--                                                <ul class="sub-menu">--}}
{{--                                                    @foreach($cat->childs as $child)--}}
{{--                                                        @if($child->show_menu)--}}
{{--                                                            <li><a href="/allcourses/category/{{$child->slug}}">{{$child->name_lang}}</a></li>--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            </li>--}}
{{--                                        @else--}}
{{--                                            @if(!$cat->parent_id)--}}
{{--                                                <li><a class="dropdown-item" href="/allcourses/category/{{$cat->slug}}">{{$cat->name_lang}}</a></li>--}}
{{--                                            @endif--}}

{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </li>--}}

{{--                            <li class="nav-item active">--}}
{{--                                <a class="nav-link button  button_small text_capitalize slider-cta" href="{{url('/subscriptions')}}">{{trans('b2b.subscriptions')}} <span class="sr-only"></span></a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}





{{--            <div class="collapse navbar-collapse pr-2 pl-2" id="navbarSupportedContent">--}}
{{--                <form class="pr-2 pl-2 search-bar desktop-search" style="width: 40%" action="/allcourses/category" method="GET">--}}
{{--                    <div class="search-input">--}}
{{--                        <a href="" target="_blank" hidden></a>--}}
{{--                        <label for="key" class="search-bar-label mr-3 ml-3"><i class="fas fa-search"></i></label>--}}
{{--                        <input class="pr-5 pl-5 pt-4 pb-4 search-input-input" type="text" placeholder="{{trans('home.search placeholder')}}" name='key' autocomplete="off">--}}
{{--                        <div class="autocom-box" style="position: absolute;width: 100%;background: #fff;border-radius: 5px;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);margin-top: 8px; font-size: 15px; z-index: 3;"></div>--}}

{{--                    </div>--}}
{{--                </form>--}}
{{--                <div class="logo-container" style="padding-right: 10%">--}}
{{--                    <p class="font-bold text-white text-[18px] md:text-[18px] pb-[3px] mt-[17px] transition ease-in-out bg-red--}}
{{--    hover:bg-blue w-[265px] h-[55px] flex items-center justify-center rounded-full" style="background-color: red;">--}}
{{--                        نسخة تجريبية--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}


{{--            @if(Auth::check())--}}
{{--                <div class="pt-2 d-flex align-items-center justify-content-between ">--}}
{{--                    --}}{{-- سلة المشتريات --}}
{{--                    <div class="head_cart d-flex align-items-center">--}}
{{--                        <a href="/cart" class="position-relative">--}}
{{--                            <span class="floated_count">{{ count(getShoppingCart()) }}</span>--}}
{{--                            <span class="head_cart_icon"></span>--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    --}}{{-- معلومات المستخدم --}}
{{--                    <div class="desktop-account-info-padding d-flex align-items-center">--}}
{{--                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userMenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            <img class="rounded-circle me-2" src="{{ large1(Auth::user()->image) }}" width="38">--}}
{{--                            <span class="avatar_name">{{ charlimit(Auth::user()->name, 10) }}</span>--}}
{{--                        </a>--}}
{{--                        --}}{{-- القائمة المنسدلة --}}
{{--                        <div class="nav-item dropdown">--}}

{{--                                <div class="dropdown-menu" aria-labelledby="userMenuDropdown">--}}
{{--                                  هنا القائمة المنسدلة //--}}
{{--                                </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                    --}}{{-- اللوجو --}}

{{--                </div>--}}
{{--            @else--}}
{{--                <div class="pt-2 {{ isMobile() ? 'w-100 d-flex justify-content-between' : ''}}">--}}
{{--   <button type="button"  data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary text_capitalize m-1">{{trans('home.signin')}}</button>--}}
{{--                    <button type="button"  data-dismiss="modal" data-remote="/register" data-toggle="modal" data-target="#registerModal" class="button button_primary text_capitalize regButton m-1">{{trans('home.signup')}}</button>--}}
{{--                    <a class="navbar-brand m-0" href="/">--}}
{{--                        <img src="{{ asset('website') }}/images/mehany2030.png" loading="lazy" alt="" width="200" >--}}
{{--                        <img src="{{ asset('website') }}/images/2030b.png" loading="lazy" alt="" width="150" height="75">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </nav>--}}


{{--    </div>--}}
{{--</header>--}}

<div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background: transparent; border: 0;">
            <div class="modal-header flexRight">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="m-search-modal">
                    <form class="pr-2 pl-2 search-bar" action="/allcourses/category" method="GET">
                        <div class="mobile-search-input">
                            <a href="" target="_blank" hidden></a>
                            <label for="key" class="search-bar-label mr-3 ml-3"><i class="fas fa-search"></i></label>
                            <input class="pr-5 pl-5 pt-4 pb-4 search-input-input" type="text" placeholder="{{trans('home.search placeholder')}}" name='key' value="{{ isset($_GET['key']) ? $_GET['key'] : '' }}" autocomplete="off">
                            <div class="autocom-box" style="position: absolute;width: 89%;background: #fff;border-radius: 5px;box-shadow: 0px 1px 5px rgba(0,0,0,0.1);margin-top: 8px; font-size: 15px; z-index: 3;"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('website.theme.bootstrap.layout.igts.shared.search-box-scripts')
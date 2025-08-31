@php
use Illuminate\Support\Facades\Auth;
@endphp
<section class="sec sec_pad_top  bg_gradient_home text_white">
        <div class="wrapper">
            <div class="profile_info">
                <header class="profile_info_header">
                    <figure class="profile_info_avatar">
                        <a href="#">
                            <img src="{{ large1(Auth::user()->image)}}" width="100" class="rounded m-4" alt="">
                        </a>
                        <figcaption>
                            <h5 class="mb_0">{{ Auth::user()->name }}</h5>
                            <small><a href="/account" class="text_white">{{trans('home.account info')}}</a></small>


                            @isset(Auth::user()->subscription)
                            <h6 class="mb_0">

                                {{trans('account.Subscription Expire in')}}:

                                <span class="btn btn-success">{{Auth::user()->subscription['end_date']}} </span>

                            </h6>
                            @endisset
                        </figcaption>
                    </figure>
                    <div class="profile_info_statics">
                        <div>
                            <?php //dd(Auth::user()->id); ?>
                            <div class="profile_info_statics_name_icon"><i class="fas fa-graduation-cap"></i></div>
                            <div class="profile_info_statics_number">{{count(hideIncludedCourses())}}</div>
                            <div class="profile_info_statics_name">{{trans('home.courses')}}</div>
                        </div>
                        <div>
                            <div class="profile_info_statics_name_icon"><i class="far fa-question-circle"></i></div>
                            <div class="profile_info_statics_number">{{count(Auth::user()->coursewishlist)}}</div>
                            <div class="profile_info_statics_name">{{trans('home.wishlist')}}</div>
                        </div>
                        <div>
                            <div class="profile_info_statics_name_icon"><i class="fas fa-certificate"></i></div>
                            <div class="profile_info_statics_number">{{count(Auth::user()->certificates)}}</div>
                            <div class="profile_info_statics_name">{{trans('home.my certificates')}}</div>
                        </div>
                    </div>
                </header>

                <nav class="profile_info_nav">
                    <ul>
                        <li <?php if(isset($page) && $page == 'myCourses'){?>class="selected"<?php }?>><a href="/account/myCourses"><i class="fas fa-graduation-cap"></i> {{trans('home.my courses')}}</a></li>
                        <li <?php if(isset($page) && $page == 'myFavourites'){?>class="selected"<?php }?>><a href="/account/myFavourites"><i class="fas fa-heart"></i> {{trans('home.my favorites')}}</a></li>
                        <li <?php if(isset($page) && $page == 'myCertificates'){?>class="selected"<?php }?>><a href="/account/myCertificates"><i class="fas fa-certificate"></i> {{trans('home.my certificates')}}</a></li>
                        <li <?php if(isset($page) && $page == 'myNotes'){?>class="selected"<?php }?>><a href="/account/myProgress"><i class="fas fa-sticky-note"></i> {{trans('account.my notes')}}</a></li>

{{--                        @isset(Auth::user()->subscription)--}}
{{--                        <li <?php if(isset($page) && $page == 'mySubscriptions'){?>class="selected"<?php }?>><a href="/account/mySubscriptions"><i class="fas fa-graduation-cap"></i> {{trans('courses.mySubscriptions')}}</a></li>--}}
{{--                        @endisset--}}
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    

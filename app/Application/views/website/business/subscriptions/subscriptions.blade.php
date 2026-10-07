@extends(layoutExtend('website'))
@php $VERSION_NUMBER = 15.6; @endphp

@section('title'){{ trans('website.Subscriptions') }} | {{ trans('home.HomeTitle') }}@endsection
@section('description'){{ trans('website.Subscriptions') }} — {{ trans('home.HomeDescription') }}@endsection

@push('css')
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <link rel="stylesheet" href="{{ asset('subscription-new/public') }}/style.css?v=15.6" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    {{-- Re-assert the Platforms Code system after the page's Tailwind sheet so header/footer/typography stay consistent --}}
    <link href="{{ asset('website') }}/css/front/dga-platforms-code.css?v=3.0" rel="stylesheet">
    <style>
        /* Scope the Tailwind landing to the content area only */
        .subs-page { background: #fff; }
        .subs-page .hero-section__title { color: var(--dga-color-text-default) !important; }
        .subs-page .hero-section { background: var(--dga-color-primary-50) !important; padding-top: 40px !important; padding-bottom: 40px; }
        .subs-page .btn.bg-green, .subs-page a.bg-green, .subs-page button.bg-green { background: var(--dga-color-primary-600) !important; color: #fff !important; }
        .subs-page .btn.bg-green:hover { background: var(--dga-color-primary-700) !important; }
        /* daisyUI dialogs must stay hidden until opened (Bootstrap .modal rules otherwise leak in) */
        dialog.modal:not([open]) { display: none !important; }
        /* The landing stylesheet decorates its own (removed) header with a 450px box — not for the shared header */
        header.dga-nav-header::after, header.dga-nav-header::before, .rtl header::after { content: none !important; display: none !important; }
        /* daisyUI's .modal rules leak onto the shared Bootstrap modals — keep Bootstrap behaviour */
        .modal.fade:not(.show) { display: none !important; }
        .modal.fade.show { display: block !important; opacity: 1 !important; visibility: visible !important; pointer-events: auto !important; }
        .modal.fade .modal-dialog { pointer-events: auto; }
        .subs-page .text-blue { color: var(--dga-color-text-default) !important; }
        .subs-page .btn, .subs-page button.btn { border-radius: 4px; }
        .subs-page img[src=""], .subs-page img:not([src]) { display: none; }
    </style>
@endpush

@section('content')
<div class="subs-page istok-web-regular" dir="{{ getDir() }}">
<div class="dga-home-main">

<!-- Hero Section -->
<section class="hero-section px-[30px] md:px-[90px] pt-[40px] md:pt-[80px]">
    <div class="flex flex-col items-start justify-between md:items-center md:flex-row">
        <div class="hero-section__content border-decoration ltr:pl-[22px] rtl:pr-[22px]">
            <h1 class="hero-section__title text-blue md:text-[40px] text-[30px]">
                {{trans('website.Chase It,')}}
                {{--                <br />--}}
                {{--                {{trans('website.Youre Almost There')}}--}}
            </h1>
        </div>
        <div class="hero-section__description w-full md:w-[546px]" style="z-index: 1;">
            <p class="text-babydark md:text-[16px] text-[16px] mt-[15px] md:mt-0">
                {{trans('website.Hero Section Desc')}}
                {{--<br>
                <br>--}}
                <a  href="#Plans"
                    class="font-bold text-white text-[24px] md:text-[24px] pb-[3px] mt-[17px] transition ease-in-out bg-green hover:bg-blue w-[265px] h-[55px] flex items-center justify-center rounded-full">
                    {{trans('website.Subscriptions')}}
                </a>
        </div>
    </div>
    <div class="hero-section__image mt-[60px]">
        <div class="swiper md:h-[650px] h-[400px]">
            <div class="swiper-wrapper">

                @foreach($sliders as $slider)
                    <div class="swiper-slide">
                        <img class="w-full h-[300px] md:h-[650px] object-cover" src="{{large1($slider->image)}}" alt="igts-image"/>
                    </div>
                @endforeach
            </div>

            <div class="swiper-pagination pb-[20px]"></div>
        </div>
    </div>
</section>



<!-- Our Plans Section -->
<section class="md:mt-[100px] mt-[50px] md:px-[90px] px-[30px] py-[80px] bg-coolgrey flex flex-col md:flex-row items-center" id="Plans">
    <div class="md:w-[30%] w-full md:items-start items-center flex flex-col text-center md:text-left">
        <h3 class="text-black text-[25px] lg:text-[40px] font-bold">
            {{trans('website.Our Plans')}}
        </h3>
        {{--        <p class="text-babydark text-[20px] lg:text-[32px] mt-[10px]">--}}
        {{--            {{trans('website.Our Plans P')}}--}}
        {{--        </p>--}}
        <p class="text-babydark text-[18px] mt-[30px]">
            {{trans('website.Our Plans Description')}}
        </p>
        <p class="text-babydark text-[18px] mt-[30px]">
            {{trans('website.Our Plans Description2')}}
        </p>

        <br/>
        <br/>

        @if(Auth::check())
            <form id="promoForm" class="flex flex-col w-full gap-4 md:text-right" action="javascript:void(0);" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @php
                    $promoCode = getCurrentPromoCode(null, \App\Application\Model\Promotionactive::TYPE_B2C);
                @endphp
                @if($promoCode)
                    @if($promoCode['promotions'])
                        <div class="text-right">
                            <label> {{ trans('website.Coupon Applied, Click to remove') }} </label>
                            <br>
                            <a href="javascript:void(0);" id="removePromoBtn" class="add-to-cart">
                                <b>{{ $promoCode['promotions']['code'] }}</b> {{ trans('website.Applied Now') }}
                            </a>
                        </div>
                    @else
                        <label class="flex items-center gap-2 input input-bordered">
                            <input required name="code" type="text" class="grow" placeholder="{{ trans('website.Add Coupon Code') }}" />
                        </label>
                        <button id="addPromoBtn" class="text-white hover:text-black btn bg-green mb-[25px] addPromoBtn-subscription">
                            {{ trans('website.Add Coupon') }}
                        </button>
                    @endif
                @else
                    <label class="flex items-center gap-2 input input-bordered">
                        <input required name="code" type="text" class="grow" placeholder="{{ trans('website.Add Coupon Code') }}" />
                    </label>
                    <button id="addPromoBtn" class="text-white hover:text-black btn bg-green mb-[25px] addPromoBtn-subscription">
                        {{ trans('website.Add Coupon') }}
                    </button>
                @endif
            </form>


        @else

{{--            <p class="text-babydark text-[18px] mt-[30px]">--}}
{{--                {{trans('website.Our Plans Description')}}--}}

{{--                سجل دخول أو أنشئ حساب واحصل على خصم 60% باستخدام بروموكود free60--}}
{{--            </p>--}}

            <span style="color: #2d4a9fde ; direction: {{ getDir() }}" class="md:text-right">
سجل دخول أو أنشئ حساب واحصل على خصم 60%
            </span>
            <a onclick="openLoginModal()" class="text-white hover:text-black btn bg-green mb-[25px]">
                {{ trans('website.login') }}
            </a>

        @endif



        {{--        <a href="#" onclick="annualModal.showModal()" class="text-white pb-[3px] mt-[50px] transition ease-in-out bg-green hover:bg-blue w-[265px] h-[55px] flex items-center justify-center rounded-full">--}}
        {{--            Signup To Subscribe--}}
        {{--        </a>--}}
    </div>
    <div class="flex flex-col md:flex-row items-center justify-center md:w-[70%] w-full md:mt-0 mt-[50px]">
        <div class="annualSubBtn text-center cursor-pointer flex flex-col justify-between h-[500px] lg:h-[650px] min-w-[350px] lg:min-w-[560px] p-[32px] gradient-blue rounded-[20px]"
             id="annualSubBtn" data-annualFees="{{$subscription_yearly_after}}"
             onclick="{{Auth::check() ?  ($subscription_yearly_after == 0 ? 'subscriptionEnrollFree('.\App\Application\Model\Subscriptionuser::SUBSCRIPTION_YEARLY.')' : 'subscriptionModal.showModal()') : 'openLoginModal()'}}">

            <h4 class="text-white pb-[32px] text-[40px] font-bold border-b border-white uppercase annualSubBtn">
                {{trans('b2b.ANNUAL')}}
            </h4>
            <div class="text-white annualSubBtn">
                <h2 class="annualSubBtn text-[80px] lg:text-[120px] font-bold leading-[1]">
                    {{$subscription_yearly_after}}
                </h2>
                <h3 class="annualSubBtn text-[24px] lg:text-[32px] uppercase">{{getCurrency()}}/{{trans('website.Year')}}</h3>
                <div class="annualSubBtn mt-[10px] flex justify-center gap-4" style="align-items:baseline;">
                    <p class="text-[32px] lg:text-[48px] font-bold line-through text-white/45">
                        {{$subscription_yearly_before}}
                    </p>
                    <span class="annualSubBtn text-[20px] lg:text-[24px] text-white/45 uppercase">{{getCurrency()}}/{{trans('website.Year')}}</span>
                </div>
            </div>
            <div class="annualSubBtn text-white flex items-center justify-center pt-[32px] text-[28px] font-light border-t border-white uppercase w-full">
                {{trans('website.Recommended')}}
            </div>

            <div class="annualSubBtn text-white flex items-center justify-center">
                <a class="annualSubBtn tems-center justify-center font-bold text-white text-[24px] md:text-[24px] pb-[3px] mt-[17px] transition ease-in-out bg-green hover:bg-blue w-[265px] h-[55px] flex items-center justify-center rounded-full">
                    {{($subscription_yearly_after == 0) ? trans('b2b.Subscribe Free') : trans('b2b.Subscribe Now') }}
                </a>
            </div>
        </div>
        <div id="monthlySubBtn" data-monthlyFees="{{$subscription_monthly}}"
             class="monthlySubBtn text-center cursor-pointer flex flex-col justify-between h-[420px] lg:h-[483px] min-w-[350px] lg:min-w-[560px] p-[32px] bg-white md:ltr:rounded-br-[20px] md:ltr:rounded-tr-[20px] md:ltr:rounded-bl-0 md:ltr:rounded-tl-0 md:rtl:rounded-bl-[20px] md:rtl:rounded-tl-[20px] md:rtl:rounded-br-0 md:rtl:rounded-tr-0 ltr:rounded-br-[20px] ltr:rounded-bl-[20px] ltr:rounded-tr-0 ltr:rounded-tl-0 rtl:rounded-br-[20px] rtl:rounded-bl-[20px] rtl:rounded-tr-0 rtl:rounded-tl-0"
             onclick="{{Auth::check() ? ($subscription_monthly == 0 ? 'subscriptionEnrollFree('.\App\Application\Model\Subscriptionuser::SUBSCRIPTION_MONTHLY.')' : 'subscriptionModal.showModal()') : 'openLoginModal()'}}">


            <h4 class="monthlySubBtn text-green pb-[32px] text-[40px] font-bold border-b border-green uppercase">
                {{trans('b2b.MONTHLY')}}
            </h4>
            <div class="text-green monthlySubBtn">
                <h2 class="monthlySubBtn text-[80px] lg:text-[120px] font-bold leading-[1]">
                    {{$subscription_monthly}}
                </h2>
                <h3 class="monthlySubBtn text-[24px] lg:text-[32px] monthlySubBtn uppercase">{{getCurrency()}}/{{trans('website.Mo')}}</h3>
            </div>
            <div class="monthlySubBtn text-babydark flex items-center justify-center pt-[32px] text-[28px] font-light border-t border-green uppercase w-full">
                {{trans('website.Billed Monthly')}}
            </div>
            <div class="monthlySubBtn text-white flex items-center justify-center">

                <a class="monthlySubBtn tems-center justify-center font-bold text-white text-[24px] md:text-[24px] pb-[3px] mt-[17px] transition ease-in-out bg-green hover:bg-blue w-[265px] h-[55px] flex items-center justify-center rounded-full">
                    {{($subscription_monthly == 0) ? trans('b2b.Subscribe Free') : trans('b2b.Subscribe Now') }}
                </a>
            </div>
        </div>
    </div>
</section>



<!-- Top Courses Section -->
<section
        class="top-courses-section bg-white mt-[50px] md:mt-[100px] px-[30px] md:px-[90px] pt-0 py-[60px]"
>
    <div class="border-decoration ltr:pl-[22px] rtl:pr-[22px] relative">
        <h2 class="text-black md:text-[40px] text-[30px] font-bold">
            {{trans('website.Top Courses')}}
        </h2>
        <p class="text-babydark md:text-[32px] text-[20px]">
            {{trans('website.Discover, the most requested courses')}}
        </p>
    </div>
    <div class="mt-[50px] top-courses-slider">
        <div class="swiper h-[550px] relative">
            <div class="swiper-wrapper">

                @if($featuredAll && count($featuredAll) > 0)
                    {{--    Best Learning Experience Section  --}}
                    @foreach($featuredAll as $feature)
                        <div class="swiper-slide">
                            <a href="{{url('/courses/view/'.$feature->slug)}}" class="block">
                                <img class="rounded-[10px] w-full h-[250px] object-cover" src="https://igtsservice.com/uploads/files/medium/{{$feature->image}}"
                                     alt="{{$feature->title_lang}}"
                                />
                                <h3 class="text-black mt-[15px] text-[24px]" style="min-height: 13%;">

                                    {{ strlen(strip_tags($feature['title_lang'])) > 50 ? mb_substr(strip_tags($feature['title_lang']), 0, 50) . '...' : strip_tags($feature['title_lang']) }}

                                </h3>
                                <p class="text-babydark mt-[15px] text-[14px] h-[63px] !overflow-hidden">
                                    {{mb_substr(strip_tags($feature['description_lang']), 0, 200)}}
                                </p>
                                <div class="inline-flex px-[15px] items-center mt-[20px] justify-center bg-coolgrey h-[35px] rounded-full gap-2">
                                    <span class="text-green text-[14px]">+{{ ($feature->visits >= 1000 && $feature->visits < 1000000) ? (number_format($feature->visits / 1000, 0) . 'K') : (($feature->visits >= 1000000) ? (number_format($feature->visits / 1000000, 0) . 'M'  ) : $feature->visits) }}</span>
                                    <span class="text-[14px] text-babydark">{{trans('website.Views')}}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="flex items-center bottom-0 justify-end gap-4 top-courses-slider__buttons pt-[48px]">
                <div class="button-prev">
                    <img src="{{ asset('subscription-new/src') }}/images/arrow-left.svg" alt="arrow-left" />
                </div>
                <div class="button-next">
                    <img src="{{ asset('subscription-new/src') }}/images/arrow-right.svg" alt="arrow-right" />
                </div>
            </div>
        </div>
    </div>
</section>
@isset($forYou)
    @if(count($forYou) > 0)
        <!-- Suggested Courses Section -->
        <section class="mt-[50px] md:mt-[100px] px-[30px] md:px-[90px] py-[60px] bg-coolgrey grid grid-cols-1 md:grid-cols-2 items-center">
            <div class="md:ltr:pr-[100px] ltr:pr-0 md:rtl:pl-[100px] rtl:pl-0">
                <h3 class="text-green text-[45px] lg:text-[80px] md:text-[60px] font-bold">
                    {{trans('website.Suggest Courses')}}
                </h3>
                <h4 class="text-babydark text-[18px] lg:text-[32px] md:text-[24px] mt-[15px]">
                    {{trans('website.With the power of AI. Discover, the powerful suggested courses')}}
                </h4>
                {{--        <p class="text-babydark md:text-[14px] text-[12px] mt-[15px]">--}}
                {{--            {{trans('website.Suggest Courses Description')}}--}}
                {{--        </p>--}}
            </div>
            <div class="suggest-courses-slider mt-[50px] md:mt-0 md:ltr:pl-[50px] md:rtl:pr-[50px] ltr:pl-0 rtl:pr-0" >
                <div class="swiper">
                    <div class="swiper-wrapper">


                        @foreach ($forYou as $you)

                            <div class="swiper-slide">
                                <a href="{{url('courses/view/'.$you->slug)}}" class="block">
                                    <div class="flex md:flex-row flex-col items-center gap-[20px] w-full">
                                        <img class="rounded-[10px] md:w-[200px] md:h-[200px] w-full h-full object-cover" src="https://igtsservice.com/uploads/files/medium/{{$you->image}}" alt="hero-image"/>
                                        <div class="w-full">
                                            <h3 class="text-black text-[24px] font-bold">
                                                {{mb_substr(strip_tags($you['title_lang']), 0, 50)}}
                                            </h3>
                                            <p class="text-babydark mt-[10px] text-[14px] h-[84px] !overflow-hidden">
                                                {{mb_substr(strip_tags($you['description_lang']), 0, 200)}}
                                            </p>
                                            <div class="inline-flex px-[15px] items-center mt-[10px] justify-center bg-green h-[35px] rounded-full gap-2">
                                                <span class="text-white text-[14px]">
                                                    +{{ ($you->visits >= 1000 && $you->visits < 1000000) ? (number_format($you->visits / 1000, 0) . 'K') : (($you->visits >= 1000000) ? (number_format($you->visits / 1000000, 0) . 'M'  ) : $you->visits) }}
                                                </span>
                                                <span class="text-[14px] text-white">{{trans('website.Views')}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                    <div class="block md:hidden swiper-pagination"></div>
                </div>
                <div
                        class="items-center justify-center hidden gap-4 rotate-90 md:flex top-courses-slider__buttons"
                >
                    <div class="button-prev">
                        <img src="{{ asset('subscription-new/src') }}/images/arrow-left.svg" alt="arrow-left" />
                    </div>
                    <div class="button-next">
                        <img src="{{ asset('subscription-new/src') }}/images/arrow-right.svg" alt="arrow-right" />
                    </div>
                </div>
            </div>
        </section>
    @endif
@endif

<!-- Featured Courses Section -->
<section class="md:mt-[100px] mt-[50px] md:px-[90px] px-[30px] bg-white">
    <div class="flex flex-col items-center justify-center text-center">
        <h3 class="text-black text-[25px] lg:text-[40px] font-bold">
            {{trans('website.Last Courses')}}
        </h3>
        <p class="text-babydark text-[18px] mt-[16px]">
            {{trans('website.Featured Courses H1')}}
        </p>
    </div>
    <div class="mt-[64px] featured-courses-list">


        @foreach($Last4 as $last)

            <a href="{{url('courses/view/'.$last->slug)}}" class="block group">
                <div class="feat-card flex transition ease-in-out group-hover:bg-green md:flex-row border-coolgrey border-solid border-b flex-col items-center justify-between gap-[20px] w-full group-hover:rounded-[10px] p-[14px]">
                    <img class="rounded-[10px] md:w-[200px] md:h-[200px] w-full h-full object-cover"
                         src="https://igtsservice.com/uploads/files/medium/{{$last->image}}"
                         alt="hero-image"/>
                    <div class="w-full mx-[20px]">
                        <h3 class="text-green group-hover:text-white text-[24px] font-bold">
                            {{mb_substr(strip_tags($last['title_lang']), 0, 200)}}
                        </h3>
                        <p class="text-babydark group-hover:text-white mt-[10px] h-[63px] !overflow-hidden text-[14px]">
                            {{mb_substr(strip_tags($last['description_lang']), 0, 400)}}
                        </p>
                        <div
                                class="inline-flex items-center  mt-[10px] justify-cente gap-2"
                        >
                            <span class="text-green group-hover:text-white text-[14px]">
                                +{{ ($last->visits >= 1000 && $last->visits < 1000000) ? (number_format($last->visits / 1000, 0) . 'K') : (($last->visits >= 1000000) ? (number_format($last->visits / 1000000, 0) . 'M'  ) : $last->visits) }}
                            </span>
                            <span class="text-[14px] group-hover:text-white text-green">{{trans('website.Views')}}</span>
                        </div>
                    </div>
                    <svg id="linkArrow"
                         class="hidden md:flex"
                         data-name="Layer 1"
                         xmlns="http://www.w3.org/2000/svg"
                         version="1.1"
                         viewBox="0 0 52 52">
                        <path d="M42,0H10C4.5,0,0,4.5,0,10v32c0,5.5,4.5,10,10,10h32c5.5,0,10-4.5,10-10V10c0-5.5-4.5-10-10-10ZM35.8,33.7c0,1.1-.9,2-2,2s-2-.9-2-2v-10.9l-12.3,12.3c-.8.8-2,.8-2.8,0s-.8-2,0-2.8l12.3-12.3h-10.9c-1.1,0-2-.9-2-2s.9-2,2-2h15.7s0,0,0,0c.2,0,.5,0,.7.1h0c.2,0,.5.2.7.4.2.2.3.4.4.6h0c0,.2.2.5.2.8v15.7Z"/>
                    </svg>
                </div>
            </a>


        @endforeach



{{--        <div class="flex justify-center">--}}
{{--            <a href="{{url('allcourses/category')}}"  class="text-white pb-[3px] mt-[50px] transition ease-in-out bg-blue hover:bg-green w-[265px] h-[55px] flex items-center justify-center rounded-full">--}}
{{--                {{trans('website.View All Courses')}}--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>
</section>



<!-- Our Partners Section -->
{{--<section class="our-partners-section bg-white md:mt-[100px] mt-[50px] md:px-[90px] px-[30px] pb-[50px]">--}}
{{--    <div class="flex flex-col items-center justify-center text-center">--}}
{{--        <h3 class="text-black text-[25px] lg:text-[40px] font-bold">--}}
{{--            {{trans('website.Partners')}}--}}
{{--        </h3>--}}
{{--        <p class="text-babydark text-[18px] mt-[14px]">--}}
{{--            {{trans('website.Partners p')}}--}}
{{--        </p>--}}
{{--    </div>--}}

{{--    <div class="partners-section__image relative mt-[60px]">--}}
{{--        <div class="swiper h-[250px]">--}}
{{--            <div class="swiper-wrapper pb-[50px]">--}}


{{--                @foreach ($Partners as $partner)--}}
{{--                    <div class="swiper-slide">--}}
{{--                        <div class="flex p-[50px] items-center justify-center bg-coolgrey md:rounded-full rounded-[10px] md:w-[150px] md:h-[150px] w-full h-full">--}}
{{--                            <img src="{{large1($partner->logo)}}"--}}
{{--                                 alt="{{$partner->title_lang}}"--}}
{{--                                 class="h-[145px] w-[265px]"/>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            <div class="-bottom-[20px] swiper-pagination"></div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

<!-- Specialities Section -->
<section class="specialities-section relative mt-[50px] md:px-[90px] px-[30px] md:py-[60px] py-[30px] bg-coolgrey reverse-cols-md grid md:grid-cols-2 grid-cols-1 items-center">
    <div class="Specialities-slider mt-[30px] ltr:pr-0 rtl:pl-0 md:ltr:pr-[50px] md:rtl:pl-[50px]">
        <div class="swiper md:h-[600px] h-[400px]">
            <div class="swiper-wrapper">



                @foreach($homeCategories as $cats)
                    {{--                    @if(!$cats->childs->isEmpty())--}}
                    <div class="swiper-slide">
                        <div class="relative">
                            <a href="/allcourses/category/{{$cats->slug}}">
                                <img src="https://igtsservice.com/uploads/files/medium/{{$cats->image}}"
                                     alt="{{$cats->name_lang}}"
                                     class="object-cover w-full h-full rounded-lg"/>
                                <div class="absolute inset-0 bg-black rounded-lg opacity-50"></div>
                                <h2 class="absolute w-full md:text-lg text-[12px] font-bold text-center text-white bottom-4 px-[10px]">
                                    {{$cats->name_lang}}
                                </h2>
                            </a>
                        </div>
                    </div>
                    {{--                    @endif--}}
                @endforeach

            </div>
            <div class="block swiper-pagination md:hidden"></div>
        </div>
        <div
                class="items-center justify-center hidden gap-4 rotate-90 md:flex Specialities-slider__buttons"
        >
            <div class="button-prev">
                <img src="{{ asset('subscription-new/src') }}/images/arrow-left.svg" alt="arrow-left" />
            </div>
            <div class="button-next">
                <img src="{{ asset('subscription-new/src') }}/images/arrow-right.svg" alt="arrow-right" />
            </div>
        </div>
    </div>
    <div
            class="md:ltr:pl-[100px] ltr:pl-0 md:rtl:pr-[100px] rtl:pr-0 order-first md:order-last"
    >
        <div class="border-decoration ltr:pl-[22px] rtl:pr-[22px] relative">
            <h2 class="text-black md:text-[40px] text-[25px]">{{trans('website.Specialities')}}</h2>
            {{--            <p class="text-babydark md:text-[32px] text-[18px]">--}}
            {{--                {{trans('website.Specialities p')}}--}}
            {{--            </p>--}}
        </div>
        <p class="text-babydark md:text-[18px] text-[18px] mt-[30px]">
            {{trans('website.Specialities description')}}
        </p>
    </div>
</section>

<!-- Instructors Section -->


{{--@if($instructors && count($instructors) > 0)--}}
{{--    <section  class="instructors-section bg-white md:mt-[100px] mt-[50px] md:px-[90px] px-[30px] pb-[50px]">--}}
{{--        <div class="flex flex-col items-center justify-center text-center">--}}
{{--            <h3 class="text-black text-[25px] lg:text-[40px] font-bold">--}}
{{--                {{trans('website.Instructors')}}--}}
{{--            </h3>--}}
{{--            <p class="text-babydark text-[18px] mt-[14px]">--}}
{{--                {{trans('website.Instructors p')}}--}}
{{--            </p>--}}
{{--        </div>--}}

{{--        <div class="partners-section__image relative mt-[60px]">--}}
{{--            <div class="swiper md:h-[450px] h-[400px]">--}}
{{--                <div class="swiper-wrapper md:pb-0 pb-[120px]">--}}

{{--                    @foreach ($instructors as $instructor)--}}
{{--                        <div class="swiper-slide">--}}
{{--                            <a href="/instructors/view/{{$instructor->slug}}" >--}}
{{--                                <div class="flex flex-col w-full h-[300px]">--}}
{{--                                    <img src="https://igtsservice.com/uploads/files/{{$instructor->image}}"--}}
{{--                                         alt="{{ $instructor->fullname_lang }}"--}}
{{--                                         style="max-height:300px"--}}
{{--                                         class="object-cover w-full h-full rounded-[10px]"/>--}}
{{--                                    <h3 class="text-black text-[20px] lg:text-[25px] font-bold mt-[15px]"--}}
{{--                                        style="min-height: 15%" >--}}
{{--                                        {{ $instructor->fullname_lang }}--}}
{{--                                    </h3>--}}
{{--                                    <p class="text-babydark lg:text-[18px] text-[20px]"--}}
{{--                                       style="min-height: 30%">--}}
{{--                                        {{ strlen(strip_tags($instructor['title_lang'])) > 70 ? mb_substr(strip_tags($instructor['title_lang']), 0, 70) . '...' : strip_tags($instructor['title_lang']) }}--}}

{{--                                    </p>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="swiper-pagination !bottom-0"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--@endif--}}
<!-- Newsletter Section -->
<section class="md:mt-[100px] mt-[50px] md:px-[90px] px-[30px] text-center h-[380px]" >
    <div class="bg-blue rounded-[28px] h-full w-full flex items-center justify-center" >
        <div class="md:w-[70%] w-[100%] px-[10px]">
            <h2 class="md:text-[40px] text-[28px] font-bold text-white">
                {{trans('website.Our Newsletter')}}
            </h2>
            <p class="mb-6 md:text-[32px] text-[20px] text-white">
                {{trans('website.Our Newsletter p')}}
            </p>
            <form class="flex justify-center">
                <input
                        type="email"
                        placeholder="{{trans('website.Enter Your Email')}}"
                        class="ltr:pl-[35px] rtl:pr-[35px] py-[20px] text-black placeholder-white bg-white/50 focus:outline-none w-[80%] md:w-[90%] ltr:rounded-l-full rtl:rounded-r-full"
                />
                <button
                        class="px-4 py-[20px] text-white bg-white/50 ltr:rounded-r-full rtl:rounded-l-full"
                >
                    <img src="{{ asset('subscription-new/src') }}/images/send.svg" alt="submit-button" />
                </button>
            </form>
        </div>
    </div>
</section>

</div>

<a href="{{ getSetting('whatsapp') ?: 'https://wa.me/966539680702' }}" aria-label="{{ trans('website.Contact') }} WhatsApp" style="    position: fixed;
    left: 0;
    margin-left: 24px;
    width: 60px;
    height: 60px;
    bottom: 0;
    margin-bottom: 16px;
    /*background-color: #E6E6E6;*/
    color: #FFF;
    border-radius: 50px;
    text-align: center;
    /*box-shadow: 2px 2px 3px #999;*/
    z-index: 2;" target="_blank" class="whatsapp_btn float">
    <i class="fab fa-whatsapp my-float" aria-hidden="true"></i>
    <svg aria-hidden="true" focusable="false" style="
         margin-top: 10px;
         font-size: 40px;
    " xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 256 258"><defs><linearGradient id="logosWhatsappIcon0" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#1faf38"/><stop offset="100%" stop-color="#60d669"/></linearGradient><linearGradient id="logosWhatsappIcon1" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#f9f9f9"/><stop offset="100%" stop-color="#fff"/></linearGradient></defs>
        <path  class="whatsapp_btn" fill="url(#logosWhatsappIcon0)" d="M5.463 127.456c-.006 21.677 5.658 42.843 16.428 61.499L4.433 252.697l65.232-17.104a123 123 0 0 0 58.8 14.97h.054c67.815 0 123.018-55.183 123.047-123.01c.013-32.867-12.775-63.773-36.009-87.025c-23.23-23.25-54.125-36.061-87.043-36.076c-67.823 0-123.022 55.18-123.05 123.004"/><path fill="url(#logosWhatsappIcon1)" d="M1.07 127.416c-.007 22.457 5.86 44.38 17.014 63.704L0 257.147l67.571-17.717c18.618 10.151 39.58 15.503 60.91 15.511h.055c70.248 0 127.434-57.168 127.464-127.423c.012-34.048-13.236-66.065-37.3-90.15C194.633 13.286 162.633.014 128.536 0C58.276 0 1.099 57.16 1.071 127.416m40.24 60.376l-2.523-4.005c-10.606-16.864-16.204-36.352-16.196-56.363C22.614 69.029 70.138 21.52 128.576 21.52c28.3.012 54.896 11.044 74.9 31.06c20.003 20.018 31.01 46.628 31.003 74.93c-.026 58.395-47.551 105.91-105.943 105.91h-.042c-19.013-.01-37.66-5.116-53.922-14.765l-3.87-2.295l-40.098 10.513z"/><path fill="#fff" d="M96.678 74.148c-2.386-5.303-4.897-5.41-7.166-5.503c-1.858-.08-3.982-.074-6.104-.074c-2.124 0-5.575.799-8.492 3.984c-2.92 3.188-11.148 10.892-11.148 26.561s11.413 30.813 13.004 32.94c1.593 2.123 22.033 35.307 54.405 48.073c26.904 10.609 32.379 8.499 38.218 7.967c5.84-.53 18.844-7.702 21.497-15.139c2.655-7.436 2.655-13.81 1.859-15.142c-.796-1.327-2.92-2.124-6.105-3.716s-18.844-9.298-21.763-10.361c-2.92-1.062-5.043-1.592-7.167 1.597c-2.124 3.184-8.223 10.356-10.082 12.48c-1.857 2.129-3.716 2.394-6.9.801c-3.187-1.598-13.444-4.957-25.613-15.806c-9.468-8.442-15.86-18.867-17.718-22.056c-1.858-3.184-.199-4.91 1.398-6.497c1.431-1.427 3.186-3.719 4.78-5.578c1.588-1.86 2.118-3.187 3.18-5.311c1.063-2.126.531-3.986-.264-5.579c-.798-1.593-6.987-17.343-9.819-23.64"/></svg>
</a>



<!-- Footer Section -->
</div>

@php
    $data['test'] = null;
@endphp



<dialog id="subscriptionModal" class="modal">
    <div class="modal-box">

        <div class="plan-card" id="annual-plan-card">
            <div class="border-decoration ltr:pl-[22px] rtl:pr-[22px] relative">
                <h2 class="text-black text-[25px] font-bold">{{trans('website.Checkout')}}</h2>
                <p class="text-babydark mt-[10px] text-[18px]">
                    {{trans('b2b.ANNUAL')}}
                </p>
            </div>
            <div class="modal-action flex flex-col items-center text-center w-full gap-4">
                <img alt="{{trans('b2b.ANNUAL')}}" style="height: 150px; width: auto; object-fit: contain; margin: 0 auto;" src="{{asset('website/subscriptions')}}/image/annual-icon.svg">
                <div class="spce"></div>
                <h3 class="fw-400 flex justify-center" style="align-items:baseline;gap:6px;">
                    <span class="rate">{{$subscription_yearly_after}}</span>
                    <span class="meta fw-300">{{getCurrency()}}/{{trans('website.Year')}}</span></h3>

                <div class="discount">
                    <div class="save-percent flex justify-center" style="align-items:baseline;gap:4px;">
                        <del>{{$subscription_yearly_before}}
                            <span>{{getCurrency()}}/{{trans('website.Year')}}</span>
                        </del>
                        {{-- {{trans('website.Billed Annually')}} --}}
                    </div>
                </div>

            </div>

        </div>

        <div class="plan-card" id="monthly-plan-card" >
            <div class="border-decoration ltr:pl-[22px] rtl:pr-[22px] relative">
                <h2 class="text-black text-[25px] font-bold">{{trans('website.Checkout')}}</h2>
                <p class="text-babydark mt-[10px] text-[18px]">
                    {{trans('b2b.MONTHLY')}}
                </p>
            </div>

            <div class="modal-action flex flex-col items-center text-center w-full gap-4">
                <img alt="{{trans('b2b.MONTHLY')}}" style="height: 150px; width: auto; object-fit: contain; margin: 0 auto;" src="{{asset('website/subscriptions')}}/image/monthly-icon.svg">
                <div class="spce"></div>
                <h3 class="fw-400 flex justify-center" style="align-items:baseline;gap:6px;">
                    <span class="rate">{{$subscription_monthly}}</span>
                    <span class="meta fw-300">{{getCurrency()}}/{{trans('website.Mo')}}</span></h3>

            </div>



        </div>

        <form id="promoForm2" class="flex flex-col w-full gap-4" action="javascript:void(0);" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @php
                $promoCode = getCurrentPromoCode(null, \App\Application\Model\Promotionactive::TYPE_B2C);
            @endphp


            @if($promoCode)
                @if($promoCode['promotions'])
                    <div class="text-right">
                        <label> {{ trans('website.Coupon Applied, Click to remove') }} </label>
                        <br>
                        <a href="javascript:void(0);" id="removePromoBtn2" class="add-to-cart">
                            <b>{{ $promoCode['promotions']['code'] }}</b> {{ trans('website.Applied Now') }}
                        </a>
                    </div>
                @else
                    <label class="flex items-center gap-2 input input-bordered">
                        <input required name="code" type="text" class="grow" placeholder="{{ trans('website.Add Coupon Code') }}" />
                    </label>
                    <button id="addPromoBtn" class="text-white hover:text-black btn bg-green mb-[25px] addPromoBtn-subscription">
                        {{ trans('website.Add Coupon') }}
                    </button>
                @endif
            @else
                <label class="flex items-center gap-2 input input-bordered">
                    <input required name="code" type="text" class="grow" placeholder="{{ trans('website.Add Coupon Code') }}" />
                </label>
                <button id="addPromoBtn" class="text-white hover:text-black btn bg-green mb-[25px] addPromoBtn-subscription">
                    {{ trans('website.Add Coupon') }}
                </button>
            @endif
        </form>


        <div id="promotionAlert"></div>
        <div id="PaymentsMethods"></div>
        <div  class="border-decoration ltr:pl-[22px] rtl:pr-[22px] relative">
            <h2 class="text-black text-[25px] font-bold">{{trans('website.Payment Method')}}</h2>
            <p class="text-babydark mt-[10px] text-[18px]">
                {{trans('website.Secure Checkout')}}
            </p>
        </div>

        <div class="flex flex-row items-center jeel">
            <a href="javascript: void(0)" onclick="jeel('{{json_encode($data)}}')" class="jeel bg-coolgrey hover:bg-[#f7f7f7] rounded-[10px] text-center w-full inline-block p-[10px]">
                <img class="block m-auto jeel" src="https://giraffy.com/storage/images/brands/1Hxs6SpPKbmnenWGpnHRHvr6VhibCG72Q3LWjgS4.png" width="200" height="200" />
            </a>
        </div>


        {{--        <div class="row ml-4 mt-4 mb-4" id="ChangePaymentsDiv" style="display: none;">--}}

        {{--            <div class="col-md-3">--}}
        {{--                <strong style="color: black;">{{ trans('website.payment method') }}</strong>--}}
        {{--            </div>--}}

        {{--            <div class="col-md-9">--}}
        {{--                <a href="javascript: void(0)" onclick="changeMethod()">{{ trans('website.choose another payment method') }}</a>--}}
        {{--            </div>--}}


        {{--        </div>--}}

        <div class="spinner-border" id="loading-spinner" style="margin-left: 50%;display:none;" role="status">
            <span class="sr-only">Loading...</span>
        </div>


        <div id="VisaDiv" style="display: none;">
            <iframe style="height: 585px; width:-webkit-fill-available;" name="iframe1" id="visaiframe" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay" oncontextmenu="return false"></iframe>
        </div>
        <br>
        <form method="dialog" class="flex flex-col w-full gap-4">
            <button href="javascript: void(0)" onclick="changeMethod()" id="ChangePaymentsDiv" class=" btn bg-green">{{trans('website.Cancel')}}</button>
        </form>
    </div>
</dialog>



{{ Html::script('website/js/sweetalert.min.js') }}
@endsection

@push('js')
<script>
    /* Subscriptions page used its own <dialog> login/register; the shared layout modals are used instead */
    function openLoginModal()    { if (window.jQuery) jQuery('#loginModal').modal('show'); }
    function openRegisterModal() { if (window.jQuery) jQuery('#registerModal').modal('show'); }
</script>
<script>
    (function (e, t, n) {
        var r = e.querySelectorAll("html")[0];
        r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
    })(document, window, 0);
</script>


<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('subscription-new/src') }}/js/script.js"></script>




<script src="{{ asset('website/subscriptions') }}/js/custom.js?v={{$VERSION_NUMBER}}"></script>

<script>
    function subscriptionEnrollFree(subscriptionType) {
        let data = {
            subType: subscriptionType
        };

        $.ajax({
            url: "/site/subscriptionEnrollFree",
            type: 'get',
            data: data,
            success: function(data) {
                swal({
                    title: "تم الاشتراك بنجاح!",
                    text: "شكراً لاشتراكك في الخدمة.",
                    icon: "success",
                    button: "ممتاز"
                });
            },
            error: function() {
                alert("حدث خطأ أثناء الاشتراك");
            }
        });
    }
</script>


<script>
    $(function() {
        // $('#country-register').selectize();
        $('#country-register').on('change', function() {
            if (this.value) {
                getCountryDataAjax(function(country) {
                    $('#mobile-container').show();
                    $('#mobile-code').text(country.country_phone_code + "+");
                }, this.value);
            }
        });


        function getCountryDataAjax(handleData, countryId) {
            $.ajax({
                url: "/site/country/" + countryId,
                type: 'get',
                success: function(data) {
                    handleData(data.country);
                },
                error: function() {
                    alert("error!!!!");
                }
            });
        }


    });
</script>


<script>
    $(document).ready(function() {
        $('#promoForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ concatenateLangToUrl('site/insertCouponAjax') }}",
                type: 'GET',
                data: $(this).serialize(),
                success: function(response) {
                    if(response.success) {
                        alert(response.text); // Replace with your desired success message display logic
                        location.reload(); // Optionally reload the page to reflect changes
                    } else {
                        alert(response.text); // Replace with your desired error message display logic
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.'); // Replace with your desired error handling
                }
            });
        });

        $('#promoForm2').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ concatenateLangToUrl('site/insertCouponAjax') }}",
                type: 'GET',
                data: $(this).serialize(),
                success: function(response) {
                    if(response.success) {
                        alert(response.text); // Replace with your desired success message display logic
                        location.reload(); // Optionally reload the page to reflect changes
                    } else {
                        alert(response.text); // Replace with your desired error message display logic
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.'); // Replace with your desired error handling
                }
            });
        });

        $('#removePromoBtn').on('click', function() {
            $.ajax({
                url: "{{ url('/removePromoAjax') }}",
                type: 'GET',
                success: function(response) {
                    if(response.success) {
                        alert(response.text); // Replace with your desired success message display logic
                        location.reload(); // Optionally reload the page to reflect changes
                    } else {
                        alert(response.text); // Replace with your desired error message display logic
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.'); // Replace with your desired error handling
                }
            });
        });

        $('#removePromoBtn2').on('click', function() {
            $.ajax({
                url: "{{ url('/removePromoAjax') }}",
                type: 'GET',
                success: function(response) {
                    if(response.success) {
                        alert(response.text); // Replace with your desired success message display logic
                        location.reload(); // Optionally reload the page to reflect changes
                    } else {
                        alert(response.text); // Replace with your desired error message display logic
                    }
                },
                error: function() {
                    alert('An error occurred. Please try again.'); // Replace with your desired error handling
                }
            });
        });
    });
</script>






{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('.close-button').on('click', function() {--}}
{{--            $('#createAccountModal').hide();--}}
{{--        });--}}

{{--        $('#openModalButton').on('click', function() { $('#createAccountModal').show(); });--}}

{{--    });--}}

{{--</script>--}}

@endpush

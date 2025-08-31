<html lang="{{ config('app.locale') }}" dir="{{getDir()}}" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>iGTS - Business</title>

    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="IGTS Business">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('business/newBusiness') }}/src/images/logo.png">


    <link rel="stylesheet" href="{{ asset('business/newBusiness') }}/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
          rel="stylesheet" />
    <link rel="preload"
          href="{{ asset('business/newBusiness') }}/fonts/URWGeometricArabic-ExtraBold.woff2"
          as="font"
          type="font/woff2"
          crossorigin />
    <link rel="preload"
          href="{{ asset('business/newBusiness') }}/fonts/URWGeometricArabic-Regular.woff2"
          as="font"
          type="font/woff2"
          crossorigin
    />

    <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    {{ Html::style('css/sweetalert.css') }}
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @stack('css')
</head>
<body class="h-full {{getDir()}} main-theme">
<!-- Header -->
<header class="flex relative border-b border-primary/25 items-center justify-between px-[30px] md:px-[80px] py-[40px] !bg-transparent">
    <a href="#" class="block relative z-[2]">
        <img src="{{ $logo ?? asset('business/newBusiness/src/images/logo.png') }}" alt="Business" class="md:w-[115px] md:h-[56px] w-[110px]"  />
    </a>

</header>



<!-- Contact Section -->
    <section class="contact-section relative py-[theme('spacing.90')]">
        <div class="container mx-auto">
            <div class="flex flex-col-reverse gap-8 hero-section md:flex-row">
                <!-- Contact Form -->
                <div class="w-full md:w-[40%] lg:w-[30%] ">
                    <h2 class="md:text-[30px] text-[20px] mb-[35px] text-secondary">

                        {!! trans('business.Contact us via the form below') !!}


                    </h2>
                    <div
                            class="w-full py-[35px] px-[25px] bg-[#f7f7f7] rounded-lg shadow-md"
                    >

                        <script src="https://js-eu1.hsforms.net/forms/embed/145180663.js" defer></script>
                        <div class="hs-form-frame space-y-4" data-region="eu1" data-form-id="61fdda78-380f-488a-8b2b-5f91508f2973" data-portal-id="145180663"></div>




                        {{--<form class="space-y-4" action="{{ concatenateLangToUrl('trainingdisclosure/item') }}" name="contactform"
                                  method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="source" value="business-offer-price">
                            <input
                                    type="text" required
                                    name="name"
                                    placeholder="{{ trans('website.Name') }}"
                                    class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"
                            />
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    </div>
                                @endif


                                <input type="text" required
                                       name="title"
                                       placeholder="{{ trans('website.title') }}"
                                       class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500" />

                                @if ($errors->has('title'))
                                    <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                    </div>
                                @endif

                                <input
                                    type="email" required
                                    name="email"
                                    placeholder="{{ trans('website.Email') }}"
                                    class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"
                            />
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                <span class='help-block'>
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    </div>
                                @endif
                            <input
                                    type="tel"
                                    name="phone" required
                                    placeholder="{{ trans('website.Phone') }}"
                                    class="w-full p-3 text-right border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"
                            />

                            <input
                                    type="text"
                                    name="country" required
                                    placeholder="{{trans('business.Country')}}"
                                    id="country"
                                    class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"
                            />

                            <input
                                    type="text"
                                    name="company" required
                                    placeholder="{{ trans('website.company_name') }}"
                                    class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"
                            />
                            <select
                                    name="numberoftrainees" required
                                    class="w-full p-3 bg-white border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-500"
                            >
                                <option value="">{{trans('website.Number_of_trainees')}}</option>
                                <option value="0-50">0 - 50</option>
                                <option value="51-100">51 - 100</option>
                                <option value="101-200">101 - 200</option>
                                <option value="+200">+200</option>
                            </select>
                            <select name="service"
                                    class="w-full p-3 bg-white border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                <option value="">{{trans('business.service')}}</option>
                                <option value="{{trans('business.Subscriptions')}}">{{trans('business.Subscriptions')}}</option>
                                <option value="{{trans('business.Offline training')}}">{{trans('business.Offline training')}}</option>
                                <option value="{{trans('business.Professional Certificates')}}">{{trans('business.Professional Certificates')}}</option>
                                <option value="{{trans('business.Digital transformation')}}"> {{trans('business.Digital transformation')}}</option>
                            </select>
                            <input type="text"
                                    name="websiteurl"
                                    placeholder="{{trans('website.website_url')}}"
                                    class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"
                            />
--}}{{--                            <select--}}{{--
--}}{{--                                    class="w-full p-3 bg-white border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-500"--}}{{--
--}}{{--                            >--}}{{--
--}}{{--                                <option>الخدمات</option>--}}{{--
--}}{{--                                <option>الاشتراكات</option>--}}{{--
--}}{{--                                <option>التحول الرقمي</option>--}}{{--
--}}{{--                                <option>التدريب اوفلاين</option>--}}{{--
--}}{{--                                <option>شهادات احترافية</option>--}}{{--
--}}{{--                            </select>--}}{{--
--}}{{--                            <div class="g-recaptcha" data-sitekey="your-site-key"></div>--}}{{--

                            <div>
                                <button
                                        type="submit"
                                        class="block w-[160px] m-auto mt-[40px] text-center pb-[10px] pt-[8px] text-white transition ease-in-out rounded-full bg-primary hover:bg-secondary"
                                >
                                    {{ trans('website.send now') }}
                                </button>
                            </div>
                        </form>--}}
                    </div>
                </div>

                <!-- Hero Content -->
                <div
                        class="flex flex-col justify-center items-center w-full md:w-[60%] lg:w-[70%] text-center"
                >
                    <h1 class="md:text-[42px] text-[24px] mb-[20px] text-secondary">
                        {!! trans('business.Discover How We Can Help Your Business Grow') !!}
                    </h1>
                    <p class="md:text-[20px] text-[12px] text-secondary mb-[40px]">
                        {!! trans('business.We offer training and consulting solutions') !!}

                    </p>
                    <img
                            src="{{ asset('business/newBusiness') }}/src/images/landingpage-image.png"
                            alt="Landing Page Image"
                            class="lg:w-[681px] lg:h-[406px] w-full"
                    />
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="relative services-section">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-secondary">
                <strong class="text-primary">{{trans('business.Discover')}}</strong> {!! trans('business.Our Service') !!}
            </h2>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div
                        class="flex flex-col gap-4 bg-softGrey shadow-md rounded-xl p-[50px]"
                >
                    <div class="flex items-center justify-start gap-4">
                        <img
                                src="{{ asset('business/newBusiness') }}/src/images/service-01-logo.png"
                                alt="Service 01"
                                class="w-[115px] h-[56px]"
                        />

                        <h3
                                class="text-subscriptionsTheme-primary md:text-[24px] text-[18px] font-bold group-hover:text-white"
                        >
                            {{trans('business.Subscriptions')}}
                        </h3>
                    </div>
                    <p class="text-black  text-[14px] group-hover:text-white">
                        {{trans('business.Home-Subscription-text1')}}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <ul class="flex flex-col gap-2 md:w-[48%] w-full">
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Diverse course library')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Customized training plans')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Flexible subscription options')}}
                            </li>

                        </ul>
                        <ul class="flex flex-col gap-2 md:w-[48%] w-full">
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Performance tracking system')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Comprehensive training reports')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Cost-effective solutions')}}
                            </li>
                        </ul>
                    </div>
                </div>

                <div
                        class="flex flex-col gap-4 bg-softGrey shadow-md rounded-xl p-[50px]"
                >
                    <div class="flex items-center justify-start gap-4">
                        <img
                                src="{{ asset('business/newBusiness') }}/src/images/service-02-logo.png"
                                alt="Service 01"
                                class="w-[113px] h-[52px]"
                        />

                        <h3
                                class="text-offlineTrainingTheme-primary md:text-[24px] text-[18px] font-bold group-hover:text-white"
                        >
                            {{trans('business.Offline training')}}
                        </h3>
                    </div>
                    <p class="text-black text-[14px] group-hover:text-white">
                        {!! trans('business.Home-Offline-training-text1') !!}
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <ul class="flex flex-col gap-2 md:w-[48%] w-full">
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Preparing Training Packages')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Presenting Training Programs')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Meet Business Goals')}}
                            </li>

                        </ul>
                        <ul class="flex flex-col gap-2 md:w-[48%] w-full">
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Experts in Different Industries')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Improve Leadership Skills')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Improve Engagement with Management')}}
                            </li>
                        </ul>
                    </div>


                </div>

                <div
                        class="flex flex-col gap-4 bg-softGrey shadow-md rounded-xl p-[50px]"
                >
                    <div class="flex items-center justify-start gap-4">
                        <img
                                src="{{ asset('business/newBusiness') }}/src/images/service-03-logo.png"
                                alt="Service 01"
                                class="w-[113px] h-[57px]"
                        />

                        <h3
                                class="text-digitalTransformationTheme-primary md:text-[24px] text-[18px] font-bold group-hover:text-white"
                        >
                            {{trans('business.Digital transformation')}}
                        </h3>
                    </div>
                    <p class="text-black text-[14px] group-hover:text-white">
                        {!!  trans('business.Home-Digital-transformation-text1')!!}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <ul class="flex flex-col gap-2 md:w-[48%] w-full">
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Digital consultancy')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Smart advanced solutions')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Skills enhancement')}}
                            </li>

                        </ul>
                        <ul class="flex flex-col gap-2 md:w-[48%] w-full">
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Performance monitoring')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Interactive tools')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Decision-making support')}}
                            </li>
                        </ul>
                    </div>

                </div>

                <div
                        class="flex flex-col gap-4 bg-softGrey shadow-md rounded-xl p-[50px]"
                >
                    <div class="flex items-center justify-start gap-4">
                        <img
                                src="{{ asset('business/newBusiness') }}/src/images/service-04-logo.png"
                                alt="Service 01"
                                class="w-[115px] h-[52px]"
                        />

                        <h3
                                class="text-certificationsTheme-primary md:text-[24px] text-[18px] font-bold group-hover:text-white"
                        >
                            {{trans('business.Professional Certificates')}}
                        </h3>
                    </div>

                    <p class="text-black text-[14px] group-hover:text-white">
                        {{trans('business.Home-Professional-Certificates-text1')}}
                    </p>


                    <div class="flex flex-wrap gap-4">
                        <ul class="flex flex-col gap-2 md:w-[48%] w-full">
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Local & international accreditation')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Recognized certifications')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Expert trainers')}}
                            </li>

                        </ul>
                        <ul class="flex flex-col gap-2 md:w-[48%] w-full">
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Advanced professional programs')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Exam preparation support')}}
                            </li>
                            <li class="list-icon leading-[20px] py-[5px]">
                                {{trans('business.Skills development')}}
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section relative py-[theme('spacing.90')] mt-[theme('spacing.90')] bg-secondary">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-white">
                <strong class="text-primary">{{trans('business.Discover')}}</strong> {{trans('business.the features')}}
            </h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="flex feat-card cursor-pointer flex-col gap-4 bg-white rounded-xl p-[30px] group hover:bg-primary hover:text-white">
                    <div class="flex items-center justify-start gap-4">
                        <div class="flex items-center justify-center w-[73px] h-[73px] bg-primary group-hover:border-2 group-hover:border-white rounded-xl group-hover:bg-primary group-hover:text-white">
                            <img src="{{ asset('business/newBusiness') }}/src/images/check-solid.svg" alt="check" class="w-[38px] h-[38px]">
                        </div>
                        <h3 class="text-secondary md:text-[24px] text-[18px] font-bold group-hover:text-white">{{trans('business.For Leaders')}}</h3>
                    </div>
                    <ul class="flex flex-col gap-2 mt-[30px]">
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Improve Leadership Skills')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Focusing on Efficient Training Time')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Improve Team Performance and Productivity')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Making effective strategic decisions')}}
                        </li>
                    </ul>
                </div>

                <div class="flex feat-card cursor-pointer flex-col gap-4 bg-white rounded-xl p-[30px] group hover:bg-primary hover:text-white">
                    <div class="flex items-center justify-start gap-4">
                        <div class="flex items-center justify-center w-[73px] h-[73px] bg-primary group-hover:border-2 group-hover:border-white rounded-xl group-hover:bg-primary group-hover:text-white">
                            <img src="{{ asset('business/newBusiness') }}/src/images/check-solid.svg" alt="check" class="w-[38px] h-[38px]">
                        </div>
                        <h3 class="text-secondary md:text-[24px] text-[18px] font-bold group-hover:text-white">{{trans('business.For Employees')}}</h3>
                    </div>
                    <ul class="flex flex-col gap-2 mt-[30px]">
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Improve Engagement with Management')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Improve Tasks Completion')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Improve Production Quality')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Increasing Satisfaction')}}
                        </li>
                    </ul>
                </div>

                <div class="flex feat-card cursor-pointer flex-col gap-4 bg-white rounded-xl p-[30px] group hover:bg-primary hover:text-white">
                    <div class="flex items-center justify-start gap-4">
                        <div class="flex items-center justify-center w-[73px] h-[73px] bg-primary group-hover:border-2 group-hover:border-white rounded-xl group-hover:bg-primary group-hover:text-white">
                            <img src="{{ asset('business/newBusiness') }}/src/images/check-solid.svg" alt="check" class="w-[38px] h-[38px]">
                        </div>
                        <h3 class="text-secondary md:text-[24px] text-[18px] font-bold group-hover:text-white">{{trans('business.For Businesses')}}</h3>
                    </div>
                    <ul class="flex flex-col gap-2 mt-[30px]">
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Meet Business Goals')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Reduce Onboarding Cost')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Improve Company Positioning')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Smart Analyzing for Company Needs')}}
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>



<!-- Call to Action Section -->
<section class="relative py-[theme('spacing.90')]">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row items-center justify-between md:p-[27px] p-[30px] bg-primary rounded-xl">
            <p class="text-[24px] text-white md:w-[70%] w-[90%] md:text-right text-center mb-[25px] md:mb-0">
                {{trans('business.Discover our latest price offers Text')}}
            </p>
            <a  href="{{url('business/offer-price')}}" class="h-[42px] inline-block text-center w-[280px] leading-[19px] px-4 py-2 text-bodyColor rounded-full bg-white transition ease-in-out hover:bg-secondary hover:text-white">
                {{trans('business.Discover our latest price offers')}}
            </a>
        </div>

    </div>
</section>



<!-- Footer -->
<footer class="bg-secondary pt-[60px]">
    <div class="border-t footer-bottom border-grey/25 py-[20px]">
        <div
                class="px-[80px] flex flex-col md:flex-row justify-center items-center"
        >
            <div
                    class="flex flex-col items-center justify-center gap-4 md:flex-row md:justify-center"
            >
                <p class="md:text-[18px] text-[14px] text-white">
                    {{trans('business.Certified Global Content Provider')}}
                </p>
                <img
                        src="{{ asset('business/newBusiness') }}/src/images/providedby.png"
                        alt="providedby"
                        class="md:w-[354px] md:h-[87px] w-[254px]"
                />
            </div>
        </div>
    </div>
    <div class="border-t footer-bottom border-grey/25 py-[20px]">
        <div
                class="md:px-[80px] px-[30px] flex flex-col justify-between md:flex-row align-center"
        >
            <!-- Copyright Notice -->
            <p
                    class="md:text-[16px] text-[12px] text-white md:text-right text-center md:mb-0 mb-[20px]"
            >
                {{trans('business.All rights reserved to IGTS © 2025.')}}
            </p>

            <!-- Social Media Icons -->
            <div class="flex justify-center gap-6 md:mb-0 mb-[20px]">
                <a href="{{ getSetting('facebook') }}"
                ><img
                            src="{{ asset('business/newBusiness') }}/src/images/facebook-brands-solid.svg"
                            alt="Facebook"
                            class="w-6 h-6 hover:opacity-50"
                    /></a>
                <a href="{{ getSetting('instagram') }}"
                ><img
                            src="{{ asset('business/newBusiness') }}/src/images/square-instagram-brands-solid.svg"
                            alt="Instagram"
                            class="w-6 h-6 hover:opacity-50"
                    /></a>
                <a href="{{ getSetting('youtube') }}">
                    <img  src="{{ asset('business/newBusiness') }}/src/images/square-youtube-brands-solid.svg"
                          alt="YouTube"
                          class="w-6 h-6 hover:opacity-50" /></a>
                <a href="{{ getSetting('twitter') }}">
                    <img src="{{ asset('business/newBusiness') }}/src/images/square-x-twitter-brands-solid.svg"
                         alt="Twitter"
                         class="w-6 h-6 hover:opacity-50" />
                </a>
            </div>

            <!-- Footer Bottom Links -->
            <div class="flex justify-center gap-1 text-sm text-white md:gap-3">




{{--                <a href="https://igtsservice.com/page/privacyPolicy" class="hover:underline md:text-[16px] text-[12px]" >{{trans('business.Privacy policy')}}</a  >--}}
{{--                <span>-</span>--}}
{{--                <a href="https://igtsservice.com/page/termsOfUse" class="hover:underline md:text-[16px] text-[12px]"--}}
{{--                >{{trans('business.Terms')}}</a--}}
{{--                >--}}
{{--                <span>-</span>--}}
{{--                <a href="https://igtsservice.com/faq" class="hover:underline md:text-[16px] text-[12px]"--}}
{{--                >{{trans('business.Q&A')}}</a--}}
{{--                >--}}
                {{--                <span>-</span>--}}
                {{--                <a href="#" class="hover:underline md:text-[16px] text-[12px]"--}}
                {{--                >انضم كشريك</a--}}
                {{--                >--}}
            </div>
        </div>
    </div>
</footer>

{{ Html::script('js/sweetalert.min.js') }}
<!-- Script -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{ asset('business/newBusiness') }}/src/js/script.js"></script>

@include('sweet::alert')
@stack('js')

</body>
</html>
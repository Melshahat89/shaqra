@extends(layoutNewBusiness())
@section('title')
    {{trans('business.Business Services')}}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection

@section('content')

    <!-- Hero Section -->
    <div class="hero-section__image mt-[60px] mx-[30px] md:mx-[80px]" style="direction: ltr">
        <div class="swiper md:h-[650px] h-[720px] relative">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="w-full h-[350px] md:h-[650px] object-cover rounded-xl"
                         src="{{ asset('business/newBusiness') }}/src/images/hero-slider.jpg"
                         alt="hero-image" />
                    <div  class="md:absolute md:mt-0 mt-[35px] relative md:w-[418px] md:items-start items-center w-full flex flex-col gap-4 md:bottom-[80px] md:right-[60px] bottom-0 right-0 z-[2]">
                        <h2 class="md:text-[24px] text-[18px] font-bold md:text-white text-secondary md:text-right text-center" >
                            {{trans('business.Home-Slider-Title')}}
                        </h2>
                        <p class="md:text-[14px] text-[12px] md:text-white text-secondary md:text-right text-center" >
                            {{trans('business.Home-Slider-Desc')}}
                        </p>
                        <a  href="{{url('business/contact-us')}}" class="contact-us-cta h-[42px] text-center w-[180px] mt-[20px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-primary transition ease-in-out hover:bg-secondary">
                            {{trans('business.Offer price')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="swiper-pagination md:pb-[35px] pb-[0px]"></div>
        </div>
    </div>
    <!-- Services Section -->
    <section class="services-section relative pt-[theme('spacing.90')]">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-secondary">
{{--                <strong>{{trans('business.Discover')}}</strong>--}}
                {{trans('business.Our Services')}}
            </h2>

            <div class="flex flex-col gap-10 md:gap-20 md:flex-row">
                <img style="max-height: 400px;"
                        src="{{ asset('business/newBusiness') }}/src/images/grid.webp"
                        alt="Service 1"
                        class="object-cover md:w-[50%] w-full rounded-xl"
                />

                <div class="flex justify-center items-center md:w-[50%]">
                    <div>
                        <div class="flex items-center justify-start gap-4 mb-[32px]">
                            <img style="max-height: 60px;"
                                    src="{{ asset('business/newBusiness') }}/src/images/service-01-logo.png"
                                    alt="Service 1 Logo"
                                    class=""
                            />
                            <h3 class="text-lg font-bold text-subscriptionsTheme-primary">{{trans('business.Subscriptions')}}</h3>
                        </div>
                        <div class="text-bodyColor">
                            <p class="mb-[10px] md:text-[18px]">
                                {{trans('business.Home-Subscription-text1')}}
                            </p>

                        </div>
                        <a
                                href="{{url('business/subscriptions-service')}}"
                                class="h-[42px] inline-block text-center w-[160px] mt-[22px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-subscriptionsTheme-primary transition ease-in-out hover:bg-secondary"
                        >{{trans('business.Discover Now')}}</a
                        >
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse gap-10 md:gap-20 md:flex-row pt-[theme('spacing.90')]">
                <div class="flex justify-center items-center md:w-[50%]">
                    <div>
                        <div class="flex items-center justify-start gap-4 mb-[32px]">
                            <img
                                    src="{{ asset('business/newBusiness') }}/src/images/service-02-logo.png"
                                    alt="Service 2 Logo"
                                    class=""
                            />
                            <h3 class="text-lg font-bold text-offlineTrainingTheme-primary"> {{trans('business.Offline training')}}</h3>
                        </div>
                        <div class="text-bodyColor">
                            <p class="mb-[10px] md:text-[18px]">
                                {!! trans('business.Home-Offline-training-text1') !!}
                            </p>

                        </div>
                        <a
                                href="{{url('business/offline-training')}}"
                                class="h-[42px] inline-block text-center w-[160px] mt-[22px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-offlineTrainingTheme-primary transition ease-in-out hover:bg-secondary"
                        >{{trans('business.Discover Now')}}</a
                        >
                    </div>
                </div>

                <img style="max-height: 400px;"
                        src="{{ asset('business/newBusiness') }}/src/images/grid2.webp"
                        alt="Online Training"
                        class="object-cover md:w-[50%] w-full rounded-xl"
                />
            </div>

            <div class="flex flex-col gap-10 md:gap-20 md:flex-row pt-[theme('spacing.90')]">
                <img style="max-height: 400px;"
                        src="{{ asset('business/newBusiness') }}/src/images/grid3.webp"
                        alt="Digital Transformation"
                        class="object-cover md:w-[50%] w-full rounded-xl"
                />
                <div class="flex justify-center items-center md:w-[50%]">
                    <div>
                        <div class="flex items-center justify-start gap-4 mb-[32px]">
                            <img
                                    src="{{ asset('business/newBusiness') }}/src/images/service-03-logo.png"
                                    alt="Service 3 Logo"
                                    class=""
                            />
                            <h3 class="text-lg font-bold text-digitalTransformationTheme-primary">{{trans('business.Digital transformation')}}</h3>
                        </div>
                        <div class="text-bodyColor">
                            <p class="mb-[10px] md:text-[18px]">
                                {!!  trans('business.Home-Digital-transformation-text1')!!}
                            </p>

                        </div>
                        <a
                                href="{{url('business/digital-transformation')}}"
                                class="h-[42px] inline-block text-center w-[160px] mt-[22px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-digitalTransformationTheme-primary transition ease-in-out hover:bg-secondary">
                            {{trans('business.Discover Now')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse gap-10 md:gap-20 md:flex-row pt-[theme('spacing.90')]">
                <div class="flex justify-center items-center md:w-[50%]">
                    <div>
                        <div class="flex items-center justify-start gap-4 mb-[32px]">
                            <img
                                    src="{{ asset('business/newBusiness') }}/src/images/service-04-logo.png"
                                    alt="Certifications"
                                    class=""
                            />
                            <h3 class="text-lg font-bold text-certificationsTheme-primary">{{trans('business.Professional Certificates')}}</h3>
                        </div>
                        <div class="text-bodyColor">
                            <p class="mb-[10px] md:text-[18px]">
                                {{trans('business.Home-Professional-Certificates-text1')}}
                            </p>

                        </div>
                        <a
                                href="{{url('business/professional-certificates')}}"
                                class="h-[42px] inline-block text-center w-[160px] mt-[22px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-certificationsTheme-primary transition ease-in-out hover:bg-secondary"
                        >{{trans('business.Discover Now')}}</a
                        >
                    </div>
                </div>

                <img style="max-height: 400px;"
                        src="{{ asset('business/newBusiness') }}/src/images/grid4.webp"
                        alt="Certifications"
                        class="object-cover md:w-[50%] w-full rounded-xl"
                />
            </div>

        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section relative py-[theme('spacing.90')] mt-[theme('spacing.90')] bg-secondary">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-white">
                <strong>{{trans('business.Discover')}}</strong> {{trans('business.the features')}}
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



    <!-- Testimonials Section -->
    <section class="testimonials-section relative py-[theme('spacing.90')] bg-softGrey">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-secondary">
                <strong>{{trans('business.Testimonials')}}</strong>
            </h2>

            <div class="swiper">
                <div class="swiper-wrapper pb-[50px]">

                        <div class="swiper-slide">
                            <div class="flex flex-col gap-2 p-[40px] bg-white rounded-xl w-full shadow-md"  >
                                <h3 class="text-bodyColor font-bold md:text-[24px] text-[18px]">طالبكم موسى رابع عبدالله</h3>
{{--                                <h6 class="text-bodyColor md:text-[16px] text-[14px]">طالبكم موسى رابع عبدالله</h6>--}}
                                <p class="text-bodyColor text-[14px]">
                                    موقع حقيقي ولا يوجد فيه اي غش
                                    <br>
                                    وكل الشكر لكم على المصداقيه

                                </p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="flex flex-col gap-2 p-[40px] bg-white rounded-xl w-full shadow-md"  >
                                <h3 class="text-bodyColor font-bold md:text-[24px] text-[18px]">أروى حامد</h3>
{{--                                <h6 class="text-bodyColor md:text-[16px] text-[14px]">طالبكم موسى رابع عبدالله</h6>--}}
                                <p class="text-bodyColor text-[14px]">
                                    السلام عليكم اشكر جامعه iGTS المحترمين على اهتماهم وحرصهم على تسليم الشهادة في الوقت المناسب وخصوصا الأستاذة منةالله لها .

                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="flex flex-col gap-2 p-[40px] bg-white rounded-xl w-full shadow-md"  >
                                <h3 class="text-bodyColor font-bold md:text-[24px] text-[18px]">سالى ابو حسن</h3>
{{--                                <h6 class="text-bodyColor md:text-[16px] text-[14px]">طالبكم موسى رابع عبدالله</h6>--}}
                                <p class="text-bodyColor text-[14px]">
                                    تجربة ممتازة وتعاون ومعاملة ولا أروع، أكيد راح أفكر بنفس المنصه مستقبلاً للماستر 👍🏻
                                </p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="flex flex-col gap-2 p-[40px] bg-white rounded-xl w-full shadow-md"  >
                                <h3 class="text-bodyColor font-bold md:text-[24px] text-[18px]">Nada El-bati</h3>
{{--                                <h6 class="text-bodyColor md:text-[16px] text-[14px]">طالبكم موسى رابع عبدالله</h6>--}}
                                <p class="text-bodyColor text-[14px]">
                                    Well-structured course materials, the faculty members are highly qualified educators utilizing the most up-to-date professional educational methods                                </p>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="flex flex-col gap-2 p-[40px] bg-white rounded-xl w-full shadow-md"  >
                                <h3 class="text-bodyColor font-bold md:text-[24px] text-[18px]">Non Life</h3>
{{--                                <h6 class="text-bodyColor md:text-[16px] text-[14px]">طالبكم موسى رابع عبدالله</h6>--}}
                                <p class="text-bodyColor text-[14px]">
                                    للامانه كنت متشككه بالبدايه لكن المنهج وسهوله الدخول للموقع وكذلك ارسال الشهادات وتعاون التيم معنا كل شي كان رائع اشكر لهم مجهودهم الرائع للامانه                            </div>
                        </div>




                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>




@endsection
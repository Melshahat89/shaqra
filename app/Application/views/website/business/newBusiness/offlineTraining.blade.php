@extends(layoutNewBusiness())
@section('title')
    {{trans('business.Offline training')}}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection
@push('css')
    <style>
        .bg-subscriptionsTheme-primary {

            background-color: rgb(38 172 226 / var(--tw-bg-opacity, 1)) !important;
        }

        .bg-primary {

            background-color: rgb(38 172 226 / var(--tw-bg-opacity, 1))  !important;
        }
    </style>

@endpush

@section('content')

    <!-- Hero Section -->
    <div class="hero-section__image mt-[60px] mx-[30px] md:mx-[80px]" style="direction: {{getDir()}}">
        <div class="swiper md:h-[650px] h-[720px] relative">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="w-full h-[350px] md:h-[650px] object-cover rounded-xl"
                         src="{{ asset('business/newBusiness') }}/src/images/hero-slider.jpg"
                         alt="hero-image" />
                    <div  class="md:absolute md:mt-0 mt-[35px] relative md:w-[418px] md:items-start items-center w-full flex flex-col gap-4 md:bottom-[80px] md:right-[60px] bottom-0 right-0 z-[2]">
                        <h2 class="md:text-[24px] text-[18px] font-bold md:text-white text-secondary md:text-right text-center" >
                            {{trans('business.Design a Customized Programs Tailored to Your Organizations Needs')}}
                        </h2>
                        <p class="md:text-[14px] text-[12px] md:text-white text-secondary md:text-right text-center" >
                            {{trans('business.We design the training packages according the Saudi standards, and present')}}
                        </p>
                        <a  href="{{url('business/contact-us')}}" class="contact-us-cta h-[42px] text-center w-[160px] mt-[20px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-primary transition ease-in-out hover:bg-secondary">
                            {{trans('business.Request a Quote')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="swiper-pagination md:pb-[35px] pb-[0px]"></div>
        </div>
    </div>

    <!-- Inner Features Section -->
    <section class="inner-features-section relative mt-[theme('spacing.90')] py-[theme('spacing.90')] bg-softGrey">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-secondary">
              {!! trans('business.Our customized services') !!}
            </h2>

            <div class="swiper">
                <div class="swiper-wrapper pb-[50px]">
                    <div class="swiper-slide">
                        <div class="flex transition ease-in-out feat-card cursor-pointer flex-col gap-4 bg-white rounded-xl p-[30px] group hover:bg-offlineTrainingTheme-primary hover:text-white">
                            <div class="flex items-center justify-start gap-4">
                                <div class="flex items-center border-2 border-transparent justify-center w-[73px] h-[73px] bg-offlineTrainingTheme-primary group-hover:border-2 group-hover:border-white rounded-xl group-hover:bg-offlineTrainingTheme-primary group-hover:text-white">
                                    <img src="{{ asset('business/newBusiness') }}/src/images/inner-feat-01.svg" alt="check"  class="w-[38px] h-[38px]"/>
                                </div>
                                <h3 class="text-secondary md:text-[24px] text-[18px] font-bold group-hover:text-white" >
                                    {{trans('business.Analyzing Training Needs2')}}
                                </h3>
                            </div>
                            <p class="text-bodyColor text-[14px] group-hover:text-white">
                                {{trans('business.analyzing the training needs')}}
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex transition ease-in-out feat-card cursor-pointer flex-col gap-4 bg-white rounded-xl p-[30px] group hover:bg-offlineTrainingTheme-primary hover:text-white">
                            <div class="flex items-center justify-start gap-4">
                                <div class="flex items-center border-2 border-transparent justify-center w-[73px] h-[73px] bg-offlineTrainingTheme-primary group-hover:border-2 group-hover:border-white rounded-xl group-hover:bg-offlineTrainingTheme-primary group-hover:text-white">
                                    <img src="{{ asset('business/newBusiness') }}/src/images/inner-feat-01.svg" alt="check"  class="w-[38px] h-[38px]"/>
                                </div>
                                <h3 class="text-secondary md:text-[24px] text-[18px] font-bold group-hover:text-white" >
                                    {{trans('business.Identifying Training Needs2')}}
                                </h3>
                            </div>
                            <p class="text-bodyColor text-[14px] group-hover:text-white">
                                {{trans('business.We provide a full report which')}}
                            </p>
                        </div>
                    </div>


                    <div class="swiper-slide">
                        <div class="flex transition ease-in-out feat-card cursor-pointer flex-col gap-4 bg-white rounded-xl p-[30px] group hover:bg-offlineTrainingTheme-primary hover:text-white">
                            <div class="flex items-center justify-start gap-4">
                                <div class="flex items-center border-2 border-transparent justify-center w-[73px] h-[73px] bg-offlineTrainingTheme-primary group-hover:border-2 group-hover:border-white rounded-xl group-hover:bg-offlineTrainingTheme-primary group-hover:text-white">
                                    <img src="{{ asset('business/newBusiness') }}/src/images/inner-feat-01.svg" alt="check"  class="w-[38px] h-[38px]"/>
                                </div>
                                <h3 class="text-secondary md:text-[24px] text-[18px] font-bold group-hover:text-white" >
                                    {{trans('business.Preparing Training Packages')}}
                                </h3>
                            </div>
                            <p class="text-bodyColor text-[14px] group-hover:text-white">
                                {{trans('business.We prepare the training content according the national standards')}}
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div
                                class="flex transition ease-in-out feat-card cursor-pointer flex-col gap-4 bg-white rounded-xl p-[30px] group hover:bg-offlineTrainingTheme-primary hover:text-white"
                        >
                            <div class="flex items-center justify-start gap-4">
                                <div
                                        class="flex items-center border-2 border-transparent justify-center w-[73px] h-[73px] bg-offlineTrainingTheme-primary group-hover:border-2 group-hover:border-white rounded-xl group-hover:bg-offlineTrainingTheme-primary group-hover:text-white"
                                >
                                    <img
                                            src="{{ asset('business/newBusiness') }}/src/images/inner-feat-02.svg"
                                            alt="check"
                                            class="w-[38px] h-[38px]"
                                    />
                                </div>
                                <h3
                                        class="text-secondary md:text-[24px] text-[18px] font-bold group-hover:text-white"
                                >
                                    {{trans('business.Presenting Training Programs')}}
                                </h3>
                            </div>
                            <p class="text-bodyColor text-[14px] group-hover:text-white">
                                {{trans('business.We organize, manage, and present the training programs in all capitals in the world, by cooperation with our experts')}}
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div
                                class="flex transition ease-in-out feat-card cursor-pointer flex-col gap-4 bg-white rounded-xl p-[30px] group hover:bg-offlineTrainingTheme-primary hover:text-white"
                        >
                            <div class="flex items-center justify-start gap-4">
                                <div
                                        class="flex items-center justify-center w-[73px] h-[73px] bg-offlineTrainingTheme-primary border-2 border-transparent group-hover:border-2 group-hover:border-white rounded-xl group-hover:bg-offlineTrainingTheme-primary group-hover:text-white"
                                >
                                    <img
                                            src="{{ asset('business/newBusiness') }}/src/images/inner-feat-03.svg"
                                            alt="check"
                                            class="w-[38px] h-[38px]"
                                    />
                                </div>
                                <h3
                                        class="text-secondary md:text-[24px] text-[18px] font-bold group-hover:text-white"
                                >
                                    {{trans('business.Experts in Different Industries')}}
                                </h3>
                            </div>
                            <p class="text-bodyColor text-[14px] group-hover:text-white">
                                {{trans('business.We trusted our expertise experiences in all industries to present the best training solutions')}}
                            </p>
                        </div>
                    </div>

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Why Us Section -->
    <section class="why-us-section relative pt-[theme('spacing.90')]">
        <div class="container mx-auto">
            <div class="flex flex-col-reverse gap-10 md:flex-row">
                <div class="flex justify-center flex-col md:w-[60%]">
                    <h2 class="md:text-[42px] text-[24px] mb-[25px] text-secondary">
                        <strong>{{trans('business.Discover')}}</strong> {{trans('business.the features')}}
                    </h2>
                    <ul class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.10+ years of experience in Training and Development')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.Cooperate with the most education and training prominent in KSA')}}
                        </li>
                        <li class="list-icon leading-[20px] py-[5px]">
                            {{trans('business.We have local and international accreditations')}}
                        </li>
                    </ul>
                    <a href="{{url('business/contact-us')}}"
                            class="contact-us-cta h-[42px] inline-block text-center w-[160px] mt-[35px] leading-[19px] px-4 py-2 text-white rounded-full bg-secondary transition ease-in-out hover:bg-offlineTrainingTheme-primary"
                    > {{trans('business.Request a Quote')}}</a
                    >
                </div>

                <img
                        src="{{ asset('business/newBusiness') }}/src/images/why-us.jpg"
                        alt="why us"
                        class="object-cover md:w-[40%] w-full rounded-xl"
                />
            </div>
        </div>
    </section>


@endsection
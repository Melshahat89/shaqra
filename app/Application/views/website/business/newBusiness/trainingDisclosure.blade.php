@extends(layoutNewBusiness())
@section('title')
    {{ trans('business.trainingDisclosure') }}
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

            background-color: rgb(24 178 137 / var(--tw-bg-opacity, 1)) !important;
        }

        .bg-primary {

            background-color: rgb(24 178 137 / var(--tw-bg-opacity, 1))  !important;
        }
    </style>


    <style>

        .custom-style .container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin: 20px;
        }

        .custom-style .card {
            position: relative;
            width: 90%;
            max-width: 300px;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-style .card img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }

        .custom-style .card-text {
            position: absolute;
            top: 00px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 18px;
            color: #ffffff;
            font-weight: bold;
            /*text-shadow: 1px 1px 4px rgba(255, 255, 255, 0.8);*/
            /*background-color: rgba(255, 255, 255, 0.7);*/

            background-color: rgb(24 178 137);

            z-index: 2;
            padding: 5px 10px;
            border-radius: 5px;
            justify-content: center;
            text-align: center;
        }

        .custom-style .card:hover {
            transform: scale(1.05);
        }

        .custom-style .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgb(0 0 0), rgb(191 191 191 / 35%));

            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .custom-style .card:hover .card-overlay {
            opacity: 1;
        }

        .custom-style .button {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #f0ad4e;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .custom-style .button:hover {
            background-color: #ec971f;
        }


        .custom-style .card:hover .card-text {
            opacity: 0;
            visibility: hidden;
        }


        .video-container {
            position: relative;
            width: 100%;
            /*max-width: 800px; !* تحديد أقصى عرض للفيديو *!*/
            margin: auto;
            aspect-ratio: 16 / 9;
            overflow: hidden;
        }

        .video-container iframe {
            width: 100%;
            height: 100%;
            border-radius: 10px; /* لجعل الزوايا مستديرة */
        }


        @media (max-width: 768px) {
            .video-container {
                aspect-ratio: 16 / 13; /* زيادة الطول */
            }


            .custom-style .container {

                margin: 2px;
            }

            .faq-image{
                display: none;
            }

            .pt-\[60px\] {
                padding-top: 10px;
            }

            .py-\[20px\] {
                padding-top: 5px;
                padding-bottom: 5px;
            }
        }



        @media (max-width: 768px) {
            .custom-style .card {
                width: 100%;
                max-width: none;
            }
            .custom-style .card img {
                height: auto;
            }
        }



        .faq-section {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-direction: row-reverse; /* الصورة على اليسار */
            width: 90%;
            max-width: 1500px;
            margin: 20px auto;
            padding: 10px;
            background: #fff;
            /*border-radius: 10px;*/
            /*box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);*/
            gap: 20px; /* إضافة مساحة بين العناصر */
        }

        .faq-content {
            width: 65%; /* يشغل ثلثي المساحة */
        }

        .faq-title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .faq-item {
            margin-bottom: 15px;
        }

        .faq-question {
            width: 100%;
            background: rgb(24, 178, 137); /* اللون المطلوب */
            border: none;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            color: white; /* لون الخط أبيض */
            cursor: pointer;
            text-align: right;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .faq-question:hover {
            background: rgb(20, 150, 115); /* لون أغمق عند التمرير */
        }

        .faq-answer {
            display: none;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
            margin-top: 5px;
            color: #555;
            font-size: 16px;
        }

        .faq-image {
            width: 30%; /* يشغل ثلث المساحة */
        }

        .faq-image img {
            width: 100%;
            border-radius: 10px;
        }

        /* تصميم متجاوب */
        @media (max-width: 768px) {
            .faq-section {
                flex-direction: column-reverse; /* الأسئلة أسفل الصورة */
                gap: 10px;
            }

            .faq-content {
                width: 100%; /* العرض كامل للأسئلة */
            }

            .faq-image {
                width: 100%; /* العرض كامل للصورة */
            }
        }

    </style>

@endpush

@section('content')


    <section class="contact-section relative py-[theme('spacing.90')]">
        <div class="container mx-auto">

            <div class="flex flex-col gap-8 hero-section md:flex-row">
                <!-- Contact Form -->
                <div
                        class="w-full md:w-[40%] lg:w-[35%] py-[50px] px-[25px] bg-[#f7f7f7] rounded-lg shadow-md"
                >
                    {{--                    <h4 class="md:text-[20px] text-[16px] mb-[35px] text-blue">--}}
                    {{--                        {!! trans('business.Contact us via the form below') !!}--}}
                    {{--                    </h4>--}}

                    <script src="https://js-eu1.hsforms.net/forms/embed/145180663.js" defer></script>
                    <div class="hs-form-frame space-y-4" data-region="eu1" data-form-id="61fdda78-380f-488a-8b2b-5f91508f2973" data-portal-id="145180663"></div>


{{--                    <form class="space-y-4" action="{{ concatenateLangToUrl('trainingdisclosure/item') }}" name="contactform"--}}
{{--                          method="post">--}}
{{--                        {{ csrf_field() }}--}}
{{--                        <input type="hidden" name="source" value="business-offer-price">--}}
{{--                        <input--}}
{{--                                type="text" required--}}
{{--                                name="name"--}}
{{--                                placeholder="{{ trans('website.Name') }}"--}}
{{--                                class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"--}}
{{--                        />--}}

{{--                        @if ($errors->has('name'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <span class='help-block'>--}}
{{--                                    <strong>{{ $errors->first('name') }}</strong>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        <input type="text" required--}}
{{--                               name="title"--}}
{{--                               placeholder="{{ trans('website.title') }}"--}}
{{--                               class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500" />--}}

{{--                        @if ($errors->has('title'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <span class='help-block'>--}}
{{--                                    <strong>{{ $errors->first('title') }}</strong>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        @endif--}}


{{--                        <input--}}
{{--                                type="email" required--}}
{{--                                name="email"--}}
{{--                                placeholder="{{ trans('website.Email') }}"--}}
{{--                                class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"--}}
{{--                        />--}}
{{--                        @if ($errors->has('email'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <span class='help-block'>--}}
{{--                                    <strong>{{ $errors->first('email') }}</strong>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        <input--}}
{{--                                type="tel" required--}}
{{--                                name="phone"--}}
{{--                                placeholder="{{ trans('website.Phone') }}"--}}
{{--                                class="w-full p-3 text-right border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"--}}
{{--                        />--}}
{{--                        @if ($errors->has('phone'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <span class='help-block'>--}}
{{--                                    <strong>{{ $errors->first('phone') }}</strong>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        @endif--}}


{{--                        <input--}}
{{--                                type="text"--}}
{{--                                name="country" required--}}
{{--                                placeholder="{{trans('business.Country')}}"--}}
{{--                                id="country"--}}
{{--                                class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"--}}
{{--                        />--}}

{{--                        @if ($errors->has('country'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <span class='help-block'>--}}
{{--                                    <strong>{{ $errors->first('country') }}</strong>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        @endif--}}

{{--                        <input--}}
{{--                                type="text"--}}
{{--                                name="company" required--}}
{{--                                placeholder="{{ trans('website.company_name') }}"--}}
{{--                                class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"--}}
{{--                        />--}}
{{--                        <select required--}}
{{--                                name="numberoftrainees"--}}
{{--                                class="w-full p-3 bg-white border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-500"--}}
{{--                        >--}}
{{--                            <option value="">{{trans('website.Number_of_trainees')}}</option>--}}
{{--                            <option value="0-50">0 - 50</option>--}}
{{--                            <option value="51-100">51 - 100</option>--}}
{{--                            <option value="101-200">101 - 200</option>--}}
{{--                            <option value="+200">+200</option>--}}
{{--                        </select>--}}
{{--                        <input--}}
{{--                                type="text"--}}
{{--                                name="websiteurl"--}}
{{--                                placeholder="{{trans('website.website_url')}}"--}}
{{--                                class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500"--}}
{{--                        />--}}
{{--                        --}}{{--                            <select--}}
{{--                        --}}{{--                                    class="w-full p-3 bg-white border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-500"--}}
{{--                        --}}{{--                            >--}}
{{--                        --}}{{--                                <option>الخدمات</option>--}}
{{--                        --}}{{--                                <option>الاشتراكات</option>--}}
{{--                        --}}{{--                                <option>التحول الرقمي</option>--}}
{{--                        --}}{{--                                <option>التدريب اوفلاين</option>--}}
{{--                        --}}{{--                                <option>شهادات احترافية</option>--}}
{{--                        --}}{{--                            </select>--}}
{{--                        --}}{{--                            <div class="g-recaptcha" data-sitekey="your-site-key"></div>--}}

{{--                        <select name="service"--}}
{{--                                class="w-full p-3 bg-white border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-500">--}}
{{--                            <option value="">{{trans('business.service')}}</option>--}}
{{--                            <option value="{{trans('business.Subscriptions')}}">{{trans('business.Subscriptions')}}</option>--}}
{{--                            <option value="{{trans('business.Offline training')}}">{{trans('business.Offline training')}}</option>--}}
{{--                            <option value="{{trans('business.Professional Certificates')}}">{{trans('business.Professional Certificates')}}</option>--}}
{{--                            <option value="{{trans('business.Digital transformation')}}"> {{trans('business.Digital transformation')}}</option>--}}
{{--                        </select>--}}

{{--                        <div>--}}
{{--                            <button--}}
{{--                                    type="submit"--}}
{{--                                    class="block trainingDisclosure w-[160px] m-auto mt-[40px] text-center pb-[10px] pt-[8px] text-white transition ease-in-out rounded-full bg-primary hover:bg-secondary"--}}
{{--                            >--}}
{{--                                {{ trans('website.send now') }}--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                </div>

                <!-- Hero Content -->
                <div class="flex flex-col justify-center w-full md:w-[60%] lg:w-[70%]">

                    <center>
                    <div
                            class="flex flex-col justify-center items-center w-full md:w-[60%] lg:w-[70%] text-center"
                    >
                        <h1 class="md:text-[42px] text-[24px] mb-[20px] text-secondary">
                            {!! trans('business.Discover How We Can Help Your Business Grow2') !!}
                        </h1>
                        <p class="md:text-[20px] text-[12px] text-secondary mb-[40px]">
                            {{trans('business.Discover How We Can Help Your Business Grow3')}}

                        </p>
                        <img
                                src="{{ asset('business/newBusiness') }}/src/images/image77.webp"
                                alt="Landing Page Image"
                                class="lg:w-[681px] lg:h-[406px] w-full"
                        />
                    </div>
                    </center>
                </div>
            </div>
        </div>
    </section>

{{--    <!-- Hero Section -->--}}
{{--    <div class="hero-section__image mt-[60px] mx-[30px] md:mx-[80px]" style="direction: {{getDir()}}">--}}
{{--        <div class="swiper md:h-[650px] h-[720px] relative">--}}
{{--            <div class="swiper-wrapper">--}}
{{--                <div class="swiper-slide">--}}
{{--                    <img class="w-full h-[350px] md:h-[650px] object-cover rounded-xl"--}}
{{--                         src="{{ asset('business/newBusiness') }}/src/images/b-copy.webp"--}}
{{--                         alt="hero-image" />--}}
{{--                    <div  class="md:absolute md:mt-0 mt-[35px] relative md:w-[418px] md:items-start items-center w-full flex flex-col gap-4 md:bottom-[80px] md:right-[60px] bottom-0 right-0 z-[2]">--}}
{{--                        <h2 class="md:text-[24px] text-[18px] font-bold md:text-white text-secondary md:text-right text-center" >--}}
{{--                            {{trans('business.Train Efficiently with IGTS')}}--}}
{{--                        </h2>--}}
{{--                        <p class="md:text-[14px] text-[12px] md:text-white text-secondary md:text-right text-center" >--}}
{{--                            {{trans('business.At IGTS, we help empower your organization to fully comply with the requirements of the Training Data Disclosure regulation')}}--}}
{{--                        </p>--}}
{{--                        <a  href="{{url('business/contact-us')}}" class="h-[42px] text-center w-[160px] mt-[20px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-primary transition ease-in-out hover:bg-secondary">--}}
{{--                            {{trans('business.Request a Quote')}}--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="swiper-pagination md:pb-[35px] pb-[0px]"></div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Partners Section -->
    <section class="our-partners-section relative py-[theme('spacing.90')]">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-secondary">
                <strong> {{trans('business.Discover')}}</strong>  {{trans('business.Our success partners')}}
            </h2>

            <div class="relative partners-section__image">
                <div class="swiper">
                    <div class="swiper-wrapper pb-[50px]">

                        @foreach ($Partners as $partner)
                            <div class="swiper-slide">
                                <div class="flex p-[50px] items-center justify-center bg-white rounded-xl h-[200px] w-full border border-grey">
                                    <img src="{{large1($partner->logo)}}"
                                         alt="{{$partner->title_lang}}"
                                         class="h-[145px] w-[265px]"
                                            {{--                                     class="w-full h-full"--}}
                                    />
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Inner Features Section -->
    <section class="inner-features-section relative pt-[theme('spacing.90')] ">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-secondary">
                {!!  trans('business.IGTS Innovations')!!}
            </h2>
            <div class="custom-style">
                <div class="container">
                    <div class="card">
                        <img src="{{ asset('business/newBusiness') }}/src/images/support.webp" alt="{{trans('business.Seamless Compliance & Ongoing Support')}}">
                        <div class="card-text">{{trans('business.Seamless Compliance & Ongoing Support')}}</div>
                        <div class="card-overlay">
                            {{trans('business.Our expert team provides professional')}}
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('business/newBusiness') }}/src/images/report.webp" alt="{{trans('business.Accurate Reporting & Comprehensive Evaluations')}}">
                        <div class="card-text"> {{trans('business.Accurate Reporting & Comprehensive Evaluations')}}</div>
                        <div class="card-overlay">
                            {{trans('business.We deliver up-to-date data')}}
                        </div>
                    </div>
                    <div class="card">
                        <img src="{{ asset('business/newBusiness') }}/src/images/train.webp" alt=" {{trans('business.Advanced Training with Cutting-Edge Technologies')}}">
                        <div class="card-text">  {{trans('business.Advanced Training with Cutting-Edge Technologies')}}</div>
                        <div class="card-overlay">
                            {{trans('business.Utilizing AI and interactive')}}
                        </div>
                    </div>
                </div>

            </div>

            <br>
            <center>    <a  href="{{url('business/contact-us')}}" class="contact-us-cta h-[42px] text-center w-[160px] mt-[20px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-primary transition ease-in-out hover:bg-secondary">
                    {{trans('business.Request a Quote')}}
                </a>


            </center>

        </div>
    </section>

    <!-- Why Us Section -->
    <section class="why-us-section relative pt-[theme('spacing.90')] ">
        <div class="container mx-auto">
            <div class="flex flex-col-reverse gap-10 md:flex-row ">

                {{--                <div class="flex justify-center flex-col md:w-[60%]">--}}
                {{--                    <h2 class="md:text-[42px] text-[24px] mb-[25px] text-secondary">--}}
                {{--                        {!! trans('business.The Best Training Solutions') !!}--}}
                {{--                    </h2>--}}
                {{--                    <p class="grid grid-cols-1 gap-4 md:grid-cols-1 md:text-[18px] text-[12px]">--}}

                {{--                        {{trans('business.At IGTS for Business, we offer a comprehensive')}}--}}


                {{--                    </p>--}}


                {{--                </div>--}}
                {{--                <iframe class="object-cover md:w-[100%] w-full rounded-xl" width="100%" height="100%" src="https://www.youtube.com/embed/WzAbvJTaiQI?si=kQcnQaeEQU-0Okh9" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>--}}



                <div class="video-container">

                    <video class="rounded-xl" controls>
                        <source src="{{ asset('business') }}/TR.mp4" type="video/mp4">
                        متصفحك لا يدعم تشغيل الفيديو.
                    </video>

                </div>


            </div>

        </div>
        <br>
        <center>
            <a  href="{{url('business/contact-us')}}" class="contact-us-cta h-[42px] text-center w-[160px] mt-[20px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-primary transition ease-in-out hover:bg-secondary">
                {{trans('business.Request a Quote')}}
            </a>

        </center>

    </section>

    <!-- Business Features Section -->
    <section
            class="business-features-section relative mt-[theme('spacing.90')] py-[theme('spacing.90')] bg-subscriptionsTheme-primary">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-white">
                {!! trans('business.Our Service') !!}
            </h2>

            <div class="swiper">
                <div class="swiper-wrapper pb-[50px]">
                    <div class="swiper-slide">
                        <div
                                class="flex flex-col gap-2 p-[30px] bg-white rounded-xl w-full shadow-md"
                        >
                            <img
                                    src="{{ asset('business/newBusiness') }}/src/images/serv4.webp"
                                    alt=" {{trans('business.Training Needs Analysis (TNA)')}}"
                                    class="w-full h-[215px] object-cover shadow-md"
                            />
                            <h3
                                    class="text-bodyColor font-bold md:text-[24px] text-[18px] py-[20px]"
                            >
                                {{trans('business.Training Needs Analysis (TNA)')}}
                            </h3>
                            <p class="text-bodyColor text-[14px]">
                                {{trans('business.We help you accurately identify')}}
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div
                                class="flex flex-col gap-2 p-[30px] bg-white rounded-xl w-full shadow-md"
                        >
                            <img
                                    src="{{ asset('business/newBusiness') }}/src/images/serv6.webp"
                                    alt="{{trans('business.Training Policy Development')}}"
                                    class="w-full h-[215px] object-cover shadow-md"
                            />
                            <h3
                                    class="text-bodyColor font-bold md:text-[24px] text-[18px] py-[20px]"
                            >
                                {{trans('business.Training Policy Development')}}
                            </h3>
                            <p class="text-bodyColor text-[14px]">
                                {{trans('business.We develop customized training')}}
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div
                                class="flex flex-col gap-2 p-[30px] bg-white rounded-xl w-full shadow-md"
                        >
                            <img
                                    src="{{ asset('business/newBusiness') }}/src/images/serv1.webp"
                                    alt="    {{trans('business.Training Budget Management')}}"
                                    class="w-full h-[215px] object-cover shadow-md"
                            />
                            <h3
                                    class="text-bodyColor font-bold md:text-[24px] text-[18px] py-[20px]"
                            >
                                {{trans('business.Training Budget Management')}}
                            </h3>
                            <p class="text-bodyColor text-[14px]">
                                {{trans('business.We provide specialized tools to plan')}}
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div
                                class="flex flex-col gap-2 p-[30px] bg-white rounded-xl w-full shadow-md"
                        >
                            <img
                                    src="{{ asset('business/newBusiness') }}/src/images/serv5.webp"
                                    alt="L&D {{trans('business.Individual Development Plans (IDPs)')}}"
                                    class="w-full h-[215px] object-cover shadow-md"
                            />
                            <h3
                                    class="text-bodyColor font-bold md:text-[24px] text-[18px] py-[20px]"
                            >
                                {{trans('business.Individual Development Plans (IDPs)')}}
                            </h3>
                            <p class="text-bodyColor text-[14px]">
                                {{trans('business.We design tailored development plans for')}}
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="flex flex-col gap-2 p-[30px] bg-white rounded-xl w-full shadow-md" >
                            <img src="{{ asset('business/newBusiness') }}/src/images/serv3.webp"
                                 alt="{{trans('business.Integrated Training Programs')}}"
                                 class="w-full h-[215px] object-cover shadow-md" />
                            <h3  class="text-bodyColor font-bold md:text-[24px] text-[18px] py-[20px]">
                                {{trans('business.Integrated Training Programs')}}
                            </h3>
                            <p class="text-bodyColor text-[14px]">
                                {{trans('business.We offer training programs across')}}
                            </p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="flex flex-col gap-2 p-[30px] bg-white rounded-xl w-full shadow-md" >
                            <img src="{{ asset('business/newBusiness') }}/src/images/serv2.webp"
                                 alt="{{trans('business.Documentation & Performance Reporting')}}"
                                 class="w-full h-[215px] object-cover shadow-md" />
                            <h3  class="text-bodyColor font-bold md:text-[24px] text-[18px] py-[20px]">
                                {{trans('business.Documentation & Performance Reporting')}}
                            </h3>
                            <p class="text-bodyColor text-[14px]">
                                {{trans('business.We prepare accurate reports that')}}
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex flex-col gap-2 p-[30px] bg-white rounded-xl w-full shadow-md" >
                            <img src="{{ asset('business/newBusiness') }}/src/images/serv8.webp"
                                 alt="{{trans('business.Integrated Training Management System')}}"
                                 class="w-full h-[215px] object-cover shadow-md" />
                            <h3  class="text-bodyColor font-bold md:text-[24px] text-[18px] py-[20px]">
                                {{trans('business.Integrated Training Management System')}}
                            </h3>
                            <p class="text-bodyColor text-[14px]">
                                {{trans('business.Our comprehensive system manages')}}
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="flex flex-col gap-2 p-[30px] bg-white rounded-xl w-full shadow-md" >
                            <img src="{{ asset('business/newBusiness') }}/src/images/serv7.webp"
                                 alt="{{trans('business.Ongoing Support & Guidance')}}"
                                 class="w-full h-[215px] object-cover shadow-md" />
                            <h3  class="text-bodyColor font-bold md:text-[24px] text-[18px] py-[20px]">
                                {{trans('business.Ongoing Support & Guidance')}}
                            </h3>
                            <p class="text-bodyColor text-[14px]">
                                {{trans('business.Our dedicated team offers continuous consultations')}}
                            </p>
                        </div>
                    </div>




                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>


    {{--    F&Q--}}

    <section class="why-us-section relative pt-[theme('spacing.90')] ">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-secondary">
                {!!  trans('business.F&Q')!!}
            </h2>
        </div>
        <section class="faq-section">
            <!-- جزء الصورة -->
            <div class="faq-image">
                <img src="{{ asset('business/newBusiness') }}/src/images/faq.webp" alt="{!!  trans('business.F&Q')!!}">
            </div>

            <!-- جزء الأسئلة -->
            <div class="faq-content">

                <div class="faq-item">
                    <button class="faq-question">{{trans('home.Q1')}}</button>
                    <div class="faq-answer">
                        {{trans('home.A1')}}
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">{{trans('home.Q2')}}</button>
                    <div class="faq-answer">
                        {{trans('home.A2')}}
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">{{trans('home.Q3')}}</button>
                    <div class="faq-answer">
                        {{trans('home.A3')}}
                    </div>
                </div>
                <div class="faq-item">
                    <button class="faq-question">{{trans('home.Q4')}}</button>
                    <div class="faq-answer">
                        {{trans('home.A4')}}
                    </div>
                </div>
            </div>
        </section>
        <center>
            <a  href="{{url('business/contact-us')}}" class="contact-us-cta h-[42px] text-center w-[160px] mt-[20px] md:mt-[15px] leading-[19px] px-4 py-2 text-white rounded-full bg-primary transition ease-in-out hover:bg-secondary">
                {{trans('business.Request a Quote')}}
            </a>

        </center>

    </section>


    <script>
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                const isVisible = answer.style.display === 'block';

                document.querySelectorAll('.faq-answer').forEach(ans => ans.style.display = 'none');
                answer.style.display = isVisible ? 'none' : 'block';
            });
        });
    </script>



@endsection
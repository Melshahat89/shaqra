@extends(layoutNewBusiness())
@section('title')
    {!! trans('website.Contact Us') !!}
@endsection
@section('description')
    {{ trans('home.MeduoHomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.MeduoHomeKeywords') }}
@endsection

@section('content')

    <style>
        .Offer-price-section{
            display: none;
        }
    </style>


    <!-- Breadcrumb -->
    <div class="breadcrumb py-[20px] bg-softGrey">
        <div class="px-[30px] md:px-[80px]">
            <a class="font-bold" href="{{trans('website.home')}}">{{trans('website.home')}}</a>
            <span>-</span>
            <span class=""> {!! trans('website.Contact Us') !!}</span>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="contact-section relative py-[theme('spacing.90')]">
        <div class="container mx-auto">
            <h2 class="md:text-[42px] text-[24px] mb-[35px] text-secondary">
                {!! trans('business.Contact us via the form below') !!}
            </h2>
            <div class="flex flex-col gap-8 hero-section md:flex-row">
                <!-- Contact Form -->
                <div
                        class="w-full md:w-[40%] lg:w-[30%] py-[50px] px-[25px] bg-[#f7f7f7] rounded-lg shadow-md"
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
{{--                        <input type="text" required--}}
{{--                                name="name"--}}
{{--                                placeholder="{{ trans('website.Name') }}"--}}
{{--                                class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500" />--}}

{{--                        @if ($errors->has('name'))--}}
{{--                            <div class="alert alert-danger">--}}
{{--                                <span class='help-block'>--}}
{{--                                    <strong>{{ $errors->first('name') }}</strong>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        <input type="text" required--}}
{{--                                name="title"--}}
{{--                                placeholder="{{ trans('website.title') }}"--}}
{{--                                class="w-full p-3 border border-gray-300 rounded placeholder:text-black focus:outline-none focus:ring-2 focus:ring-cyan-500" />--}}

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
{{--                                    class="contactUsSubmit block w-[160px] m-auto mt-[40px] text-center pb-[10px] pt-[8px] text-white transition ease-in-out rounded-full bg-primary hover:bg-secondary"--}}
{{--                            >--}}
{{--                                {{ trans('website.send now') }}--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                </div>

                <!-- Hero Content -->
                <div class="flex flex-col justify-center w-full md:w-[60%] lg:w-[70%]">
                    <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1811.831305952976!2d46.76090699999999!3d24.768018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f01150b515909%3A0xa43e377813d7377e!2zSUdUUyDYtNix2YPZhyDYp9mK2KzYqtizINmE2YTYqtiv2LHZitio!5e0!3m2!1sar!2seg!4v1744198515379!5m2!1sar!2seg"
                            width="100%"
                            height="100%"
                            style="border: 0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>

                </div>
            </div>
        </div>
    </section>
    <section class="pb-[theme('spacing.90')]">
        <div class="container mx-auto">
            <h2 class="md:text-[42px]  text-[24px] mb-[35px] text-secondary">
                {!! trans('website.Keep Connected') !!}

            </h2>
            <div class="grid grid-cols-1 gap-8 hero-section md:grid-cols-3">
                <div class="w-full">
                    <h4 class="border-decoration font-bold relative rtl:pr-[20px] ltr:pl-[20px] md:text-[24px] text-[16px] mb-[20px] text-black pb-[5px] -pt-[5px]">
                        {{trans('business.Saudi Arabia')}}
                    </h4>
                    <div class="flex flex-col gap-2">
                        <p class="md:text-[16px] text-[12px] text-black">
                            <strong>{{ trans('website.Address') }}:</strong>
                            {{ trans('website.Saudi Address') }}
                        </p>
                        <p class="md:text-[16px] text-[12px] text-black">
                            <strong>{{trans('business.E-mail')}} :</strong>
                            <a href="mailto:info@igtsservice.com" class="hover:underline"
                            >info@igtsservice.com</a
                            >
                        </p>
                    </div>
                </div>
                <div class="w-full">
                    <h4 class="border-decoration font-bold relative rtl:pr-[20px] ltr:pl-[20px] md:text-[24px] text-[16px] mb-[20px] text-black pb-[5px] -pt-[5px]">
                        {{trans('business.Egypt')}}
                    </h4>
                    <div class="flex flex-col gap-2">
                        <p class="md:text-[16px] text-[12px] text-black">
                            <strong>{{ trans('website.Address') }}:</strong>
                            {{ trans('website.EgyptAddress Text') }}
                        </p>
                        <p class="md:text-[16px] text-[12px] text-black">
                            <strong>{{trans('business.E-mail')}} :</strong>
                            <a href="mailto:info@igtsservice.com" class="hover:underline"
                            >info@igtsservice.com</a
                            >
                        </p>
                    </div>
                </div>
                <div class="w-full">
                    <h4 class="border-decoration font-bold relative rtl:pr-[20px] ltr:pl-[20px] md:text-[24px] text-[16px] mb-[20px] text-black pb-[5px] -pt-[5px]">
                        {{trans('business.Emirates')}}
                    </h4>
                    <div class="flex flex-col gap-2">
                        <p class="md:text-[16px] text-[12px] text-black">
                            <strong>{{trans('business.Emirates')}}:</strong>
                            {{ trans('website.Address Text') }}
                        </p>
                        <p class="md:text-[16px] text-[12px] text-black">
                            <strong>{{trans('business.E-mail')}} :</strong>
                            <a href="mailto:info@igtsservice.com" class="hover:underline"
                            >info@igtsservice.com</a
                            >
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </section>


@endsection
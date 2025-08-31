@extends(layoutExtend('website'))
@section('title')
    {{ trans('home.HomeTitle') }}
@endsection
@section('description')
    {{ trans('home.HomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.HomeKeywords') }}
@endsection
@section('content')
    <style>
        .plan-card {
            background: #fff;
            border-radius: 15px;
            text-align: center;
            position: relative;
            width: 295px;
            margin: 0 auto;
        }
        .plan-card h3 {
            color: #fff;
            background: #000;
            padding: 20px 0;
            border-radius: 15px 15px 0 0;
            font-size: 25px;
            font-weight: 200;
            text-transform: uppercase;
        }
        .card-footer:last-child {
            border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
        }
        .card-footer {
            border-top: 1px solid #ddd;
            padding: 10px 15px
        }
        .price p {
            color: #000;
            font-size: 24px;
            font-weight: 800;
            display: inline;
        }
        .plans {
            background: url(../../business/subscriptions/images/plan-bg.svg) no-repeat center center;
            background-size: cover;
            margin-top: 40px;
            padding-top: 40px;
            padding-bottom: 20px;
            border-radius: 15px;
        }
    </style>

    <div id="carouselExampleIndicators" class="carousel slide hero-slider" data-ride="carousel">
        <div class="carousel-inner" style="height: 100%;">
            <ol class="carousel-indicators">
                @php $j = 0; @endphp
                @foreach($sliders as $slider)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$j}}" class="{{$j == 0 ? 'active' : ''}}"></li>
                    @php $j++; @endphp
                @endforeach
            </ol>
            @php $i = 0; @endphp
            @foreach($sliders as $slider)
                <div class="carousel-item {{ ($i == 0) ? 'active' : '' }}" style="height: 100%;background: url({{large1($slider->image)}}) no-repeat center center;background-size: cover;">
                    <div class="d-flex align-items-center text-center h-100" style="place-content: center;">
                        <div>
                            <h2 class="mbmd" style="color: #FFF;font-weight: bold;">{{$slider->title_lang}}</h2>
                            <h3 class="mbmd" style="color: #FFF; font-size: 18px;">{{$slider->description_lang}}</h3>
                            @if($slider->ctatext_lang && !empty($slider->ctatext_lang))
                                <a href="{{$slider->cta_link}}" class="button home-slider-button button_small text_capitalize mt-4 slider-cta" type="button" role="button">

                                    @if($slider->id == 9  && getCurrency() == 'SAR')
                                        {{trans('website.Subscribe Now Saudi')}}
                                    @else
                                        {{$slider->ctatext_lang}}
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @php $i++; @endphp
            @endforeach
        </div>
    </div>
    <main class="main_content">
        <section class="sec">
            <div class="wrapper">
                <section class="title mblg">
                    <h2 class="text_primary text_capitalize d-none">{{trans('home.specialities')}}</h2>
                    <!-- <div class="actions">
                        <a href="/courses/category/masters" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                    </div> -->
                </section>

                <div id="specialities">
                    <div class="owl-carousel owl-theme specialities">

                        @foreach ($categories as $category)
                            @include(sectionSpecialities('website'), ['data' => $category])
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
        @if($featuredAll && count($featuredAll) > 0)

            {{--    Best Learning Experience Section  --}}

            <section class="sec sec_pad_top bg_gradient_home mtxs">
                {{--    <div class="section_image_overlay"></div>--}}
                <div class="wrapper">
                    <div class="row">
                        <div class="col-md-4 text-center align-self-center">
                            <div class="">
                                <h3 class="mbmd" style="color: #FFF;font-weight: bold;">{{trans('home.best learning')}}</h3>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div id="bestLearning">
                                <div class="owl-carousel owl-theme bestLearning">
                                    @foreach($featuredAll as $featuredAll1)
                                        @include(sectionBestLearning('website'), ['data' => $featuredAll1])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        @endif
        @if($latestReleased)
            <section class="sec sec_pad_top sec_pad_bottom bg_lightgray ">
                <div class="wrapper">
                    <section class="title mblg">
                        <h2 class="text_primary text_capitalize">{{trans('home.latest courses')}}</h2>
                        <div class="actions">
                            <a href="/allcourses/category/" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                        </div>
                    </section>

                    <div id="latestCourses">
                        <div class="owl-carousel owl-theme latestCourses">

                            @foreach ($latestReleased as $latestRelease)
                                @include(sectionMasterCourses('website'), ['data' => $latestRelease])
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
        @endif
        {{--    Best Learning Experience Section  --}}
        <section class="sec sec_pad_top  mtxs">
            <div class="wrapper">
                <div class="row plans"  style="background: linear-gradient(90deg, #244092 0%, #244092 50%, #18b289 90%)">
                    <div class="col-md-6 text-center align-self-center">
                        <div style="color: #FFF;font-weight: bold;">
                            <h2 >{{trans('b2b.OUR PLANS')}}</h2>
                            <p>

                                @if(getCurrency() == 'SAR')
                                    {!! trans('b2b.With one subscription, you can view all of our courses Saudi') !!}
                                @else
                                    {{trans('b2b.With one subscription, you can view all of our courses')}}
                                @endif


                            </p>
                            <div class="m-4">
                                <a id="annualSubBtn" data-annualfees="250" href="/subscriptions#pricing"
                                   class="button home-slider-button button_small text_capitalize mt-4 slider-cta">

                                    @if(getCurrency() == 'SAR')
                                        {{trans('website.Subscribe Now Saudi')}}
                                    @else
                                        {{trans('b2b.Subscribe Now')}}
                                    @endif



                                </a>
                            </div>
                            <!--Input Form1-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="bestLearning">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-5">



                                    <div class="plan-card" style="width: auto">

                                        <h3>{{trans('b2b.MONTHLY')}}</h3>

                                        <img class="mt-2" src="{{asset('website/subscriptions')}}/image/monthly-icon.svg" alt="{{trans('b2b.MONTHLY')}}">


                                        <div class="flexBetween card-footer">
                                            <div class="price final-price">
                                                <p class="monthlyPrice">{{$subscription_monthly}} </p>
                                                <span>{{getCurrency()}}/{{trans('website.Mo')}}</span>
                                            </div>
                                            <div class="discount">
                                                <div class="save-percent">
                                                    {{trans('website.Billed Monthly')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="plan-card" style="width: auto">
                                        <h3>{{trans('b2b.ANNUAL')}}</h3>
                                        <img class="mt-2" src="{{asset('website/subscriptions')}}/image/annual-icon.svg" alt="{{trans('b2b.ANNUAL')}}">


                                        <div class="flexBetween card-footer">
                                            <div class="price final-price">
                                                <p class="annualPriceOutter">{{$subscription_yearly_after}}</p>
                                                <span>{{getCurrency()}}/{{trans('website.Year')}}</span>
                                            </div>
                                            <div class="discount">
                                                <div class="save-percent">
                                                    <del>{{$subscription_yearly_before}}
                                                        <span>{{getCurrency()}}/{{trans('website.Year')}}</span>
                                                    </del>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @foreach($coursesPerCategory as $category)

            @if(count($category) > 0)
                <section class="sec sec_pad_top sec_pad_bottom bg_white ">
                    <div class="wrapper">
                        <section class="title mblg">
                            <h2 class="text_primary text_capitalize">{{$category[0]->categories->name_lang}}</h2>
                            <div class="actions">
                                <a href="/allcourses/category/{{$category[0]->categories->slug}}" class="button button_primary button_small text_capitalize" type="button" role="button">{{trans('home.view all')}}</a>
                            </div>
                        </section>

                        <div id="latestCourses">
                            <div class="owl-carousel owl-theme latestCourses">

                                @foreach($category as $course)
                                    @include(sectionMasterCourses('website'), ['data' => $course])
                                @endforeach

                            </div>
                        </div>
                    </div>
                </section>
            @endif

        @endforeach

{{--        @if($PartnerCards && count($PartnerCards) > 0)--}}
{{--            <section class="sec sec_pad_top sec_pad_bottom" style="height: 357px;">--}}
{{--                <div class="wrapper">--}}
{{--                    <section class="title mblg">--}}
{{--                        <h2 class="text_primary text_capitalize">{{trans('home.accreditations')}}</h2>--}}

{{--                    </section>--}}

{{--                    <div id="instructors">--}}
{{--                        <div class="owl-carousel owl-theme instructors">--}}

{{--                            @foreach ($PartnerCards as $partner)--}}
{{--                                @include(sectionHomePartners('website'), ['data' => $partner])--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </section>--}}
{{--        @endif--}}


    </main>
@endsection
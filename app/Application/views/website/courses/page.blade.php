@php
    use App\Application\Model\Courses;
    use App\Application\Model\User;

@endphp

@extends(layoutExtend('website'))
@section('title')
    {{ $course->metatitle_lang ?? $course->title_lang .'-'.   trans('home.IGTS') }}
@endsection
@section('canonical')<link rel="canonical" href="{{$course->canonical ? $course->canonical : url()->current() }}">@endsection
@section('description')
    {{  $course->metadescription_lang ?? (($course->seo_desc) ? $course->seo_desc_lang : $course->description_lang)  }}
@endsection
@section('keywords')
    {{ ($course->seo_keys) ? extractSeoKeys($course->seo_keys) : defaultSeoKeys($course->title_lang) }}
@endsection

@push('css')
    <meta property="og:title" content="{{$course->metatitle_lang ?? $course->title_lang}}">
    <meta property="og:description" content="{{ $course->metadescription_lang ?? $course->description_lang }}">
    <meta property="og:image" content="{{ large1($course->image) }}">
    <meta property="og:url" content="{{url('courses/view/'.$course->slug)}}">
    <meta property="og:type" content="website">
    {!!  $course->published ? '' : '<meta name="robots" content="noindex, nofollow" />'  !!}

    <style>
        .description ul li {
            list-style: circle;
        }


        @media only screen and (min-width: 300px) and (max-width: 1024px) {
            .fixed-buttons {
                position: fixed;
                bottom: 0;
                right: 0;
                left: 0;
                /*z-index: 9999;*/
                background: #fff;
                padding: 15px;
                border-top: 1px solid #ddd;
            }
        }

    </style>
@endpush

@push('schema')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Course",
          "headline": "{{ $course->metatitle_lang }}",
          "description": "{{ $course->metadescription_lang }}",
          "image": "{{ large1($course->image) }}",
          "author": {
            "@type": "Person",
            "name": "{{ $course->author_lang }}"
          },
          "datePublished": "{{ $course->created_at->toIso8601String() }}",
          "dateModified": "{{ $course->updated_at->toIso8601String() }}"
        }
    </script>


@endpush

@push('js')
    <script src="{{asset('website')}}/js/courses.js?v=2"></script>
    <script src="{{asset('website')}}/js/social.js?v=2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endpush
@section('content')


    <div class="bread-crumb">
        <div class="wrapper">
            <a href="/{{getCourseTypeText($course)}}/category/<?= $course->categories->slug ?>"><?=  $course->categories->name_lang ?> </a> > <span><?= $course->title_lang ?></span>
        </div>
    </div>

    <main class="main_content">
        <div class="course_detail" id="course_detail">
            <section class="bb course_detail_header">
                <div class="video_wrapper">
                    <div>
                        @if($course->type != Courses::TYPE_BUNDLES && $course->type != Courses::TYPE_MASTERS)
                            {{-- <div class="user_name">

                                @if($course->instructor->image)
                                    <img src="{{ large1($course->instructor->image) }}" style="height: 40px;">
                                @endif
                                &nbsp;  {{$course->instructor->Fullname_lang}}
                            </div> --}}
                        @endif
                        <div class="course_detail_title mbsm"><h1>{{ $course->title_lang }}</h1>

                            <p class="d-none">{{ $course->title_ar }}</p>

                        </div>
                        <div class="course_detail_sub_info mbmd">
                            <strong>

                            </strong>
                        </div>

                        <div class="course_detail_rating mbsm {{isMobile() ? 'd-flex justify-content-between' : ''}}">
                            {{--<div class="jq_rating jq-stars" data-options='{"initialRating":{{$course->CourseRating}}, "readOnly":true, "starSize":19}'></div>
                            <span class="mr-2 ml-2">{{ round($course->CourseRating, 1) }} ( {{ $course->CourseCountRating}} {{trans('courses.ratings')}} )</span>--}}
                            <div class="show-mobile d-none">
                                @if(Auth::check())
                                    <a href="/courses/toggleFavourite/id/{{$course->id}}" class=" button button_primary2 button_large add_wishlist <?= ($wishListed) ? 'active' :  '' ?>"  data-course-id="{{$course->id}}">
                                        @else
                                            <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary2 button_large">
                                                @endif
                                                <i class="far fa-heart"></i>
                                            </a>

                                            @if(!$shoppingCart && !$enrolled)
                                                @if(Auth::check())
                                                    @if($course->type == Courses::TYPE_WEBINAR)
                                                        @if(getEventStatus($course) == "passed")
                                                            <a href="javascript:void(0)" class="more_button button_primary w-50 text-center mb-10 p-3" style="background-color: #cf2626;">
                                                                {{ trans('courses.This Webinar Has Ended') }}
                                                            </a>
                                                        @else
                                                            <a href="/site/enrollWebinar/{{$course->id}}" class="more_button button_primary w-50 text-center mb-10 p-3" style="background-color: #cf2626;">
                                                                {{ trans('courses.Watch This Webinar') }}
                                                            </a>
                                                        @endif
                                                    @else
                                                        @if($course->OriginalPrice > 0)
                                                            @if(count($course->certificatesContainer) > 0)
                                                                <a href="javascript:void(0)" onclick="loadModal('/courses/certificatesContainer/id/', {{$course->id}})" class="more_button button_primary w-50 text-center mb-10 p-3" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal" class="button button_primary button_large add_cart track" data-course-id="{{$course->id}}">
                                                                    <i class="fas fa-cart-plus track"></i>
                                                                </a>
                                                            @else
                                                                <a href="/courses/addToCart/id/{{$course->id}}" class="more_button button_primary w-50 text-center mb-10 p-3">
                                                                    <i class="fas fa-cart-plus track"></i>
                                                                </a>
                                                            @endif
                                                        @else
                                                            <a class="button button_primary button_large add_cart track" href="{{ url('/courses/enrollNow/id/' . $course->id) }}">
                                                                {{ trans('courses.Get It For Free') }}
                                                            </a>
                                                        @endif
                                                    @endif
                                                @else
                                                    @if($course->type == Courses::TYPE_WEBINAR)
                                                        @if(getEventStatus($course) == "passed")
                                                            <a href="javascript:void(0)" class="more_button button_primary w-50 text-center mb-10 p-3" style="background-color: #cf2626;">
                                                                {{ trans('courses.This Webinar Has Ended') }}
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="more_button button_primary w-50 text-center mb-10 p-3">
                                                                {{ trans('courses.Sign in to join this webinar') }}
                                                            </a>
                                                        @endif
                                                    @else
                                                        <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="more_button button_primary w-50 text-center mb-10 p-3">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </a>
                                @endif
                                @endif
                                @endif

                            </div>
                        </div>


                        @if($course->type == Courses::TYPE_WEBINAR)
                            <h3>{{ localizeDate($course->start_date) }}</h3>
                            <br>
                            <p>({{trans('courses.egypt')}}) @php $datetime = new DateTime($course->start_date); @endphp {{ $datetime->format('h:i A') }}</p>
                            <p>({{trans('courses.ksa')}}) @php $datetime = new DateTime($course->start_date); $datetime->add(new DateInterval('PT1H')); @endphp {{ $datetime->format('h:i A') }}</p>

                        @else

                            <h3>{!! $course->PriceText !!}</h3>

                        @endif

                        @if($course->course_hubspot_form)
                            <br>
                            <h2 class="text_primary text_capitalize">معتمدة بـ 10 CME</h2>
                        @endif

                        <div class="course_price_actions mtmd">
                            <div class="course_ad_to_cart hide-mobile">




                                @if(!$shoppingCart && !$enrolled)
                                    @if(Auth::check())

                                        @if($course->type == Courses::TYPE_WEBINAR)
                                            @if(getEventStatus($course) == "passed")
                                                <a href="javascript:void(0)" class="button button_primary button_large add_cart" style="background-color: #cf2626;">
                                                    {{ trans('courses.This Webinar Has Ended') }}
                                                </a>
                                            @else
                                                <a href="/site/enrollWebinar/{{$course->id}}" class="button button_primary button_large add_cart">
                                                    {{ trans('courses.Watch This Webinar') }}
                                                </a>
                                            @endif
                                        @else



                                            @if($course->OriginalPrice > 0)
                                                @if(count($course->certificatesContainer) > 0)
                                                    <a href="javascript:void(0)"  onclick="loadModal('/courses/certificatesContainer/id/', {{$course->id}})" data-toggle="modal" data-target="#exampleModal" class="button button_primary button_large add_cart track" data-course-id="{{$course->id}}">
                                                        <i class="fas fa-cart-plus track"></i>
                                                    </a>
                                                @else
                                                    <a href="/courses/addToCart/id/{{$course->id}}" class="button button_primary button_large add_cart track" data-course-id="{{$course->id}}">
                                                        <i class="fas fa-cart-plus track"></i>
                                                    </a>
                                                @endif

                                            @else
                                                <a class="button button_primary button_large add_cart track" href="{{ url('/courses/enrollNow/id/' . $course->id) }}">
                                                    {{ trans('courses.Get It For Free') }}
                                                </a>
                                            @endif



                                        @endif

                                    @else

                                        @if($course->type == Courses::TYPE_WEBINAR)
                                            @if(getEventStatus($course) == "passed")
                                                <a href="javascript:void(0)" class="button button_primary button_large add_cart" style="background-color: #cf2626;">
                                                    {{ trans('courses.This Webinar Has Ended') }}
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary button_large">
                                                    {{ trans('courses.Sign in to join this webinar') }}
                                                </a>
                                            @endif

                                        @else
                                            <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary button_large">
                                                <i class="fas fa-cart-plus"></i>
                                            </a>
                                        @endif

                                    @endif
                                @endif

                                @if($enrolled && $course->type == Courses::TYPE_WEBINAR)

                                    @if(getEventStatus($course) == "passed")
                                        <a href="javascript:void(0)" class="button button_primary button_large add_cart" style="background-color: #cf2626;">
                                            {{ trans('courses.This Webinar Has Ended') }}
                                        </a>
                                    @else
                                        <a href="{{($course->webinar_url) ? $course->webinar_url : 'javascript:void(0)'}}" target="_blank" class="button button_primary button_large add_cart">
                                            {{ trans('courses.Watch This Webinar') }}
                                        </a>
                                    @endif

                                @endif

                                    @if($course->OriginalPrice > 0)
                                        <a href="/cart" class="button button_primary button_large go_to_cart" style="<?= (!$shoppingCart) ? 'display:none' : '' ?>">
                                            ابدأ التعلم الآن
                                        </a>

                                    @else
                                        <a class="button button_primary button_large add_cart track" href="{{ url('/courses/enrollNow/id/' . $course->id) }}">
                                            {{ trans('courses.Get It For Free') }}
                                        </a>
                                    @endif



                                @if(Auth::check())
                                    <a href="/courses/toggleFavourite/id/{{$course->id}}" class=" button button_primary2 button_large add_wishlist <?= ($wishListed) ? 'active' :  '' ?>"  data-course-id="{{$course->id}}">
                                        @else
                                            <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="button button_primary2 button_large">
                                                @endif
                                                <i class="far fa-heart"></i>
                                            </a>

                            </div>
                        </div>

                        <!-- <div class="" style="background-color: #0e385e; color: white;margin-top: 20px;border-radius: 4px;">
                            <div>
                                <img alt="time" src="https://unihance.com/images/CoursePage/A3.png?v=1" class="CoursePage-MuiAvatar-img">
                            </div>
                            <div>
                                TEST Title
                            </div>
                        </div> -->

                        <div class="imagesBoxes CoursePage-MuiPaper-elevation3 hide-mobile">
                            <div>
                                <div class="imagesBox">
                                    <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                        <img alt="time" src="{{asset('website')}}/images/duration.png" class="CoursePage-MuiAvatar-img">
                                    </div>
                                    <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.duration') }} <br> {{$course->getHoursLectures()}} </p>
                                </div>
                                @if($course->CourseRating > 0)
                                    <div class="imagesBox">
                                        <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                            <img alt="time" src="{{asset('website')}}/images/rate.png" class="CoursePage-MuiAvatar-img">
                                        </div>
                                        <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.rate') }} <br>  ({{ round($course->CourseRating, 1) }}) </p>
                                    </div>
                                @endif
                                <div class="imagesBox">
                                    <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                        <img alt="time" src="{{asset('website')}}/images/lifetime.png" class="CoursePage-MuiAvatar-img">
                                    </div>
                                    <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.access') }} <br> {{ trans('courses.lifetime') }} <br>  </p>
                                </div>
                            </div>
                            <div class="course-insight-devider-mobile" style="display: none;"></div>
                            <div>
                                <div class="imagesBox">
                                    <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                        <img alt="time" src="{{asset('website')}}/images/language.png" class="CoursePage-MuiAvatar-img">
                                    </div>
                                    <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.language') }} <br> {{ trans('courses.arabic') }} </p>
                                </div>
                                <div class="imagesBox">
                                    <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                        <img alt="time" src="{{asset('website')}}/images/resources.png" class="CoursePage-MuiAvatar-img">
                                    </div>
                                    <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.resources') }}  <br> ({{ $course->getTotalResourcesCount() }}) </p>
                                </div>
                                @if($course->skill_level)
                                    @if(is_array(json_decode($course->skill_level)))

                                        <div class="imagesBox">
                                            <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                                <img style="height: 30px" alt="time" src="{{asset('website')}}/images/levels.png" class="CoursePage-MuiAvatar-img">
                                            </div>
                                            <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1">{{ trans('courses.skill_level') }}
                                                <br>
                                                (
                                                @foreach(json_decode($course->skill_level) as $key => $skill_level)
                                                    @if($key > 0)

                                                        -

                                                    @endif
                                                    {{ courseLevels()[$skill_level]}}
                                                @endforeach
                                                )
                                            </p>
                                        </div>

                                    @else
                                        <div class="imagesBox">
                                            <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                                <img style="height: 30px" alt="time" src="{{asset('website')}}/images/levels.png" class="CoursePage-MuiAvatar-img">
                                            </div>
                                            <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1">{{ trans('courses.skill_level') }}
                                                <br>
                                                ( {{courseLevels()[$course->skill_level]}} )
                                            </p>
                                        </div>
                                    @endif
                                @endif
                                @if($course->file)
                                    <div class="imagesBox">
                                        <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                            <a href="/uploads/files/{{$course->file}}" download> <img alt="time" src="{{asset('website')}}/images/Download -01.png" class="CoursePage-MuiAvatar-img"></a>
                                        </div>
                                        <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1">{{ trans('courses.Download file') }}  <br> <i class="fa fa-download"></i> </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($course->type == Courses::TYPE_WEBINAR)
                        <div>
                            <div class="flowplayer-embed-container">
                                <img src="{{ large1($course->image) }}" style="height: 600px; width: 100%; object-fit: contain;" class="webinar-poster">
                            </div>
                        </div>
                    @else

                        <div>
                            <div class="flowplayer-embed-container videoContainer" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width:100%;">

                                @if($course->promo_video)
                                    <!-- <iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://player.vimeo.com/video/{{ $course->promo_video }}" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay"></iframe> -->
                                    <!-- <a href="#"><img src="{{ large1($course->image) }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;"></a> -->
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#promoModal">
                                        <img src="{{ large1($course->image) }}" alt="{{$course->alt_image}}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                                        <img src="{{ asset('website') }}/play-button.png" alt="play" class="playBtn">
                                        <span class="badge badge-primary views-badge"><i class="fas fa-eye"></i> <span>{{$course->visits}}</span></span>
                                    </a>
                                @else
                                    <img src="{{ large1($course->image) }}"  alt="{{$course->alt_image}}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;">
                                @endif
                            </div>
                        </div>
                </div>

                <div class="imageBoxesContrainer">
                    <div class="imagesBoxes CoursePage-MuiPaper-elevation3 show-mobile" style="display: none;">
                        <div>
                            <div class="imagesBox">
                                <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                    <img alt="time" src="{{asset('website')}}/images/duration.png" class="CoursePage-MuiAvatar-img">
                                </div>
                                <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.duration') }} <br> {{$course->getHoursLectures()}} </p>
                            </div>
                            @if($course->CourseRating > 0)
                                <div class="imagesBox">
                                    <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                        <img alt="time" src="{{asset('website')}}/images/rate.png" class="CoursePage-MuiAvatar-img">
                                    </div>
                                    <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.rate') }} <br>  ({{ round($course->CourseRating, 1) }}) </p>
                                </div>
                            @endif
                            <div class="imagesBox">
                                <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                    <img alt="time" src="{{asset('website')}}/images/lifetime.png" class="CoursePage-MuiAvatar-img">
                                </div>
                                <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.access') }} <br> {{ trans('courses.lifetime') }} <br>  </p>
                            </div>
                        </div>
                        <div class="course-insight-devider-mobile" style="display: none;"></div>
                        <div>
                            <div class="imagesBox">
                                <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                    <img alt="time" src="{{asset('website')}}/images/language.png" class="CoursePage-MuiAvatar-img">
                                </div>
                                <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.language') }} <br> {{ trans('courses.arabic') }} </p>
                            </div>
                            <div class="imagesBox">
                                <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                    <img alt="time" src="{{asset('website')}}/images/resources.png" class="CoursePage-MuiAvatar-img">
                                </div>
                                <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.resources') }}  <br> ({{ $course->getTotalResourcesCount() }}) </p>
                            </div>
                            @if($course->skill_level)
                                @if(is_array(json_decode($course->skill_level)))

                                    <div class="imagesBox">
                                        <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                            <img style="height: 30px" alt="time" src="{{asset('website')}}/images/levels.png" class="CoursePage-MuiAvatar-img">
                                        </div>
                                        <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1">{{ trans('courses.skill_level') }}
                                            <br>

                                            (
                                            @foreach(json_decode($course->skill_level) as $key => $skill_level)
                                                @if($key > 0)
                                                    -
                                                @endif
                                                {{ courseLevels()[$skill_level]}}
                                            @endforeach
                                            )
                                        </p>
                                    </div>

                                @else
                                    <div class="imagesBox">
                                        <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                            <img style="height: 30px" alt="time" src="{{asset('website')}}/images/levels.png" class="CoursePage-MuiAvatar-img">
                                        </div>
                                        <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1">{{ trans('courses.skill_level') }}
                                            <br>
                                            ( {{courseLevels()[$course->skill_level]}} )
                                        </p>
                                    </div>
                                @endif
                            @endif
                            @if($course->file)
                                <div class="imagesBox">
                                    <div class="CoursePage-MuiAvatar-root CoursePage-MuiAvatar-square headerImages">
                                        <a href="/uploads/files/{{$course->file}}" download> <img alt="time" src="{{asset('website')}}/images/Download -01.png" class="CoursePage-MuiAvatar-img"> </a>
                                    </div>
                                    <p class="CoursePage-MuiTypography-root imageDesciption CoursePage-MuiTypography-body1"> {{ trans('courses.Download file') }}  <br> <i class="fa fa-download"></i> </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
        </section>

        <nav class="course_detail_nav" data-sticky="nav" data-plugin-option='{"offset_top":59, "parent": "#course_detail"}'>
            <div class="wrapper">
                <ul>

                    @if($course->description_lang)
                        <li><a data-secId="nav_course_gools" class="smooth_scroll" href="#nav_course_gools">{{trans('courses.course description head')}}</a></li>
                    @endif
                    {{--@if($course->willlearn_lang)
                        <li><a data-secId="will_learn_section" class="smooth_scroll" href="#will_learn_section">{{trans('courses.You Will Learn')}}</a></li>
                    @endif--}}
                    {{-- @if($course->dynamicfields)

                        @foreach($course->dynamicfields as $field)
                            <li><a class="smooth_scroll" href="#{{$field->name}}">{{$field->title_lang}}</a></li>
                        @endforeach

                    @endif --}}
                    @if($course->requirments_lang)
                        <li><a data-secId="requirements_section" class="smooth_scroll" href="#requirements_section">{{trans('courses.Requirments')}}</a></li>
                    @endif
                    @if(count($course->courseincludes) > 0)
                        <li><a data-secId="instructors_section" class="smooth_scroll" href="#instructors_section">{{trans('home.instructors')}}</a></li>
                    @endif
                    @if($course->targetstudents_lang)
                        <li><a data-secId="target_students_section" class="smooth_scroll" href="#target_students_section">{{trans('courses.target_students')}}</a></li>
                    @endif
                    @if($course->coursesections)
                        <li><a data-secId="nav_course_list" class="smooth_scroll" href="#nav_course_list">{{trans('courses.lectures')}}</a></li>
                    @endif
                    @if($enrolled  && !empty($course->resources) )
                        <li><a data-secId="nav_course_resource" class="smooth_scroll" href="#nav_course_resource">{{trans('courses.course resources head')}}</a></li>
                    @endif

                    @if($course->course_hubspot_form)
                        <li><a data-secId="cme_section" class="smooth_scroll" href="#cme_section">{{trans('courses.course cme form head')}}</a></li>
                    @endif
                    @if($course->CourseRating > 0)
                        <li><a data-secId="nav_course_reviews" class="smooth_scroll" href="#nav_course_reviews">{{trans('courses.course rating and reviews head')}}</a></li>
                    @endif
                    <li><a data-secId="learning-adv-section" class="smooth_scroll" href="#learning-adv-section">{{trans('courses.learning benefits')}}</a></li>
                </ul>
            </div>
        </nav>

        <div class="course_detail_nav_tabs bg_lightgray">
            <!-- course_streamer -->
            <!-- <section class="course_streamer streamer_fixed" id="course_detail_streamer">
                <div class="wrapper">
                    <div class="section_shrank">
                        <div class="title">{{ $course->title_lang }}</div>

                        <div class="course_streamer_rating">
                            @if($course->CourseRating > 0)
                <div class="jq_rating jq-stars" data-options='{"initialRating":{{$course->CourseRating}}, "readOnly":true, "starSize":19}'></div>
                            @endif
            <div class="course_detail_watched_number">{{trans('courses.price')}}
            <span>&nbsp;&nbsp;{!! $course->PriceText !!}</span>
                                <a href="/cart" class="button button_primary button_large go_to_cart" style="<?php //if(!$shoppingCart){ echo "display:none;";}?>" >
                                    {{trans('courses.start learning now')}}
            </a>
        </div>
    </div>
</div>
</div>
</section> -->
            <!-- end course_streamer -->

            <section class="sec sec_pad_top_sm sec_pad_bottom_sm">
                <div class="wrapper">
                    <div class="course_detail_content">
                        <!--DESKTOP course_column_info -->
                        <div class="course_column_info is_stuck col-md-4 hide-mobile" data-sticky="nav" data-plugin-option='{"offset_top":130}' style="position: unset;">
                            @if($course->type != Courses::TYPE_WEBINAR)
                                <div class="b_all">
                                    <h3>
                                        <div class="course_price">
                                            {!! $course->PriceText !!}
                                        </div>
                                    </h3>
                                    <div class="share_course text_center bt pbsm">
                                        <div class="socials" style="height: 50px;">
                                            <span><small>{{trans('courses.share on')}}</small></span>
                                            <!-- ShareThis BEGIN -->
                                            <div class="sharethis-inline-share-buttons" style="z-index: 0;"></div>
                                            <!-- ShareThis END -->
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="course_column_info_inner mtxs b_all">
                                <div class="about_auther">
                                    @if(count($course->courseincludes) > 0)
                                        <h3 class="text_primary mblg text_capitalize">{{trans('website.about igts')}}</h3>
                                        <figure class="mbsm">
                                            <a href="javascript:void(0)">
                                                <img src="{{ asset('website') }}/images/igts-instructor-logo.jpeg" style="width: 100px;">
                                            </a>
                                        </figure>
                                        <div class="auther_name mbmd">
                                            <h5 class="mbxs"><a href="javascript: void(0)">IGTS</a></h5>
                                        </div>
                                        <div>{{trans('website.About IGTS')}}</div>
                                    @else
                                        @if($course->type  ==  Courses::TYPE_PROFESSIONAL_CERTIFICATES)
                                            @isset($course->professionalcertificates[0])
                                                <h3 class="text_primary mblg text_capitalize">{{trans('courses.about certificate')}}</h3>
                                                <div class="container mt-4">
                                                    <div class="card shadow-lg border-0">
                                                        <div class="card-body">
                                                            <div class="d-flex flex-column gap-3">
                                                                <div class="d-flex justify-content-between border-bottom pb-2">
                                                                    <span class="fw-bold">📅  {{trans('professionalcertificates.startdate')}}:</span>
                                                                    <span>{{$course->professionalcertificates[0]['startdate']}}</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between border-bottom pb-2">
                                                                    <span class="fw-bold">⏰ {{trans('professionalcertificates.appointment')}}:</span>
                                                                    <span>{{trans('professionalcertificates.Yes')}}</span>
                                                                </div>

                                                                <div class="d-flex justify-content-between border-bottom pb-2">
                                                                    <span class="fw-bold">📆  {{trans('professionalcertificates.days')}}:</span>
                                                                    <span>{{$course->professionalcertificates[0]['days']}}</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between border-bottom pb-2">
                                                                    <span class="fw-bold">⏳  {{trans('professionalcertificates.hours')}}:</span>
                                                                    <span> {{$course->professionalcertificates[0]['hours']}}</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between border-bottom pb-2">
                                                                    <span class="fw-bold">🎟  {{trans('professionalcertificates.seats')}}:</span>
                                                                    <span class="text-success fw-bold">{{$course->professionalcertificates[0]['seats']}}</span>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="fw-bold">🔚   {{trans('professionalcertificates.registrationdeadline')}}:</span>
                                                                    <span> {{$course->professionalcertificates[0]['registrationdeadline']}} </span>
                                                                </div>
                                                            </div>


                                                            <div class="text-center mt-4">


                                                                @if(Auth::check())
                                                                    <button type="button" class="btn btn-primary btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#termsModal">
                                                                        {{trans('account.Enroll Now')}}
                                                                    </button>

                                                                @else
                                                                    <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-lg mt-3">
                                                                        {{trans('account.Enroll Now')}}
                                                                    </a>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endisset



                                        @else
                                            <h3 class="text_primary mblg text_capitalize">{{trans('courses.about instructor')}}</h3>

                                            <figure class="mbsm">
                                                <a href="/instructors/view/{{$course->instructor->slug}}">

                                                    @if($course->instructor->image)
                                                        <img src="{{large1($course->instructor->image)}}" style="width: 100px;">
                                                    @endif
                                                </a>
                                            </figure>
                                            <div class="auther_name mbmd">
                                                <h5 class="mbxs"><a href="/instructors/view/{{$course->instructor->slug}}">{{$course->instructor->Fullname_lang}}</a></h5>
                                                <span class="auther_title">{{$course->instructor->title_lang}}</span>
                                            </div>
                                            <div>{!!$course->instructor->about_lang!!}</div>
                                        @endif

                                    @endif
                                </div>
                            </div>

                            @if($course->tags)
                                <div class="course_column_info_inner mtxs b_all">
                                    <div class="about_auther">
                                        <h3 class="text_primary mblg text_capitalize">{{trans('courses.tags')}}</h3>

                                        <div>
                                            @foreach(json_decode($course->tags) as $tag)
                                                <a href="/allcourses/category?key={{$tag}}"><span class="badge badge-primary m-1" style="font-size: 1em;">{{$tag}}</span></a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($enrolled && $course->type != Courses::TYPE_WEBINAR && isset($course->quiz))
                                <div class="course_column_info_inner mtxs b_all">
                                    <div class="about_auther">

                                        @if($coursePercent > 90  OR  (count($course->courseincludes) > 0))

                                            <a href="/courses/startExam/{{$course->slug}}" class="button button_primary button_shadow">{{trans('courses.start exam')}}</a>

                                        @endif

                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- end course_column_info -->

                        <!-- course_detail_content -->
                        <div class="col-md-8 description">
                            @if($course->type == Courses::TYPE_WEBINAR && $enrolled)
                                @if(getEventStatus($course) == "passed")
                                    <section class="title mbmd" id="target_students_section">
                                        <h2 class="text_primary text_capitalize">{{trans('courses.Event Certificate')}}</h2>
                                    </section>
                                    @if(isset($enrollment->certificate))
                                        <div class="certificate_list">
                                            <div class="item">
                                                <div>
                                                    <span class="item_icon text_primary"><i class="fas fa-certificate"></i></span>
                                                    <h5 class="item_name">{{ $course->title_lang }}</h5>
                                                </div>
                                                <div>
                                                    <a href="{{ url(env("CERTIFICATE_PATH_1")."/".$enrollment->certificate) }}" class="button button_link" target="_blank"><i class="far fa-eye"></i></a>
                                                    <a href="{{ url(env("CERTIFICATE_PATH_1")."/".$enrollment->certificate) }}" class="button button_link" target="_blank"><i class="fas fa-cloud-download-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <img src="{{ asset('website') }}/images/igts certificate placeholder.jpg" id="webinar-certificate-placeholder">
                                        <form action="{{concatenateLangToUrl('savewebinarcertificate')}}/{{$course->id}}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="name">{{ trans('courses.Name') }}</label>
                                                <input type="text" name="name" required class="form-control" id="name" aria-describedby="nameHelp" placeholder="{{ trans('courses.Your Full Name In English') }}">
                                                <small id="nameHelp" class="form-text text-muted">{{ trans('courses.Type in the name') }} <strong>({{trans('courses.In English')}})</strong> {{ trans('courses.that you want to be shown on the certificate') }}</small>
                                            </div>
                                            <button type="submit" class="btn btn-primary">{{ trans('courses.Save') }}</button>
                                        </form>
                                    @endif
                                @endif
                            @endif

                            @if($course->paragraph_lang)
                                <div class="text mbmd pr-3 pl-3">{!! $course->paragraph_lang !!}</div>
                            @endif


                            @if($course->description_lang)
                                <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="nav_course_gools">
                                    <div class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('courses.course description content')}} {{$course->title_lang}}</h2>
                                    </div>
                                    <div class="text mbmd pr-3 pl-3">{!! $course->description_lang !!}</div>
                                </section>
                            @endif

                            @if($course->willlearn_lang)
                                <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="will_learn_section">
                                    <div class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('courses.You Will Learn')}}</h2>
                                    </div>
                                    <div class="text mbmd pr-3 pl-3"> {!! $course->willlearn_lang !!} </div>
                                </section>
                            @endif
                            @if($course->targetstudents_lang)
                                <section class="title mbmd" id="target_students_section">
                                    <h2 class="text_primary text_capitalize">{{trans('courses.target_students')}}</h2>
                                </section>
                                <div class="text mbmd pr-3 pl-3">{!! $course->targetstudents_lang !!}</div>


                            @endif


                            @if($course->dynamicfields)
                                @foreach($course->dynamicfields as $field)
                                    <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="{{$field->name}}">

                                        <div class="title mbmd">
                                            <h5 class="">{{$field->title_lang}}</h5>
                                        </div>
                                        <div class="text mbmd pr-3 pl-3">
                                            <h3>
                                                {!! $field->description_lang !!}
                                            </h3>
                                        </div>

                                    </section>
                                @endforeach
                            @endif

                            @if($course->requirments_lang)
                                <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="requirements_section">
                                    <div class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('courses.Requirments')}}</h2>
                                    </div>
                                    {!! $course->requirments_lang !!}
                                </section>
                            @endif


                            <section class="sec">
                                <div class="mtlg">
                                    @if($course->created_at)
                                        {{trans('courses.created at')}} {{ $course->created_at }}
                                    @endif
                                    <br>
                                    @if($course->updated_at)
                                        {{trans('courses.updated at')}} {{ $course->updated_at }}
                                    @endif
                                    <div class="socials contact_whatsapp">
                                        @if($course->type != Courses::TYPE_WEBINAR)
{{--                                                <span class="contact_whatsapp">--}}
{{--                                                <h6>--}}
{{--                                                    <a href="https://contactus.igtsservice.com/?prevUrl={{ urlencode(url()->full()) }}">--}}
{{--                                                        {{trans('home.contact us on whatsapp')}}--}}
{{--                                                    </a>--}}
{{--                                                </h6>--}}
{{--                                            </span>--}}
{{--                                                <a href="https://contactus.igtsservice.com/?prevUrl={{ urlencode(url()->full()) }}" class="social_link contact_whatsapp" style="background-color: #4AC959;">--}}
{{--                                                    <i class="fab fa-whatsapp"></i>--}}
{{--                                                </a>--}}

                                                <button class="whatsapp-coursepage" onclick="window.location.href='https://contactus.igtsservice.com/?prevUrl={{ urlencode(url()->full()) }}'"
                                                        style="background-color: #4AC959; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; display: flex; align-items: center;">

                                                    {{trans('home.contact us on whatsapp')}}

                                                    <i class="fab fa-whatsapp" style="margin-right: 8px;"></i>
                                                </button>



                                        @endif
                                    </div>
                                </div>
                            </section>

                            @if(count($course->courseincludes) > 0)
                                <section  class="sec sec_pad_top_sm sec_pad_bottom_sm" id="instructors_section">
                                    <div class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('home.instructors')}}</h2>
                                    </div>
                                    <div class="row text-center">
                                        @include('website.courses.assets.instructors', ['instructor' => $course->instructor])
                                        @foreach(getInstructors($course) as $instructor)
                                            @include('website.courses.assets.instructors', ['instructor' => $instructor])
                                        @endforeach
                                    </div>
                                </section>
                            @endif

                            <!-- Course Content -->
                            @if($course->coursesections)
                                @include('website.courses.assets.courseContent', ['course' => $course, 'enrolled' => $enrolled])
                            @endif

                            @if($course->coursesincluded)
                                @foreach ($course->courseincludes as $course1)
                                    @if($course1->includedCourse->coursesections)
                                        @include('website.courses.assets.courseContent', ['course' => $course1->includedCourse, 'includedTitle' => $course1->includedCourseTitle_lang, 'enrolled' => $enrolled])
                                        {{-- @include('website.courses.assets.includedCourseCard', ['data' => $course1->includedCourse, 'includedTitle' => $course1->includedCourseTitle_lang, 'enrolled' => $enrolled]) --}}
                                    @endif
                                @endforeach
                            @endif


                            @if($enrolled)
                                @if($course->course_hubspot_form)
                                    <section id="cme_section">
                                        <header class="course_list_header">
                                            <div class="title">{{trans('courses.course cme form content')}}</div>
                                        </header>
                                        <br>
                                        <p>{{trans('courses.course cme form email')}}</p>
                                        <br>
                                        <p class="text-center">{{Auth::user()->email}}</p>
                                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
                                        <script>
                                            hbspt.forms.create({
                                                portalId: "4880007",
                                                formId: '{{ $course->course_hubspot_form }}',
                                            });
                                        </script>
                                    </section>
                                @endif
                            @endif

                            <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="learning-adv-section">
                                <div class="accordion accordion_list">
                                    <div class="card">
                                        <div class="card_header">
                                            <button data-toggle="collapse" data-target="#learning-adv" aria-expanded="true" aria-controls="coll_1" class="d-flex justify-content-between" style="background-color: #244092; color: white;">
                                                <span class="card_header_title">{{trans('courses.learning benefits')}}</span>
                                                <i class="fa mr-10 fa-plus" aria-hidden="true" style="place-self: center;"></i>
                                            </button>
                                        </div>
                                        <div id="learning-adv" class="panel_collapse collapse">
                                            <div class="card_body">
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-1')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-2')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-3')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-4')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-5')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-6')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-7')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-8')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-9')}}
                                                </div>
                                                <div class="card p-3">
                                                    {{trans('courses.benefits-10')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            @if(isMobile())
                                <!--Mobile course_column_info -->
                                <div class="course_column_info">
                                    @if($course->type != Courses::TYPE_WEBINAR)
                                        <div class="b_all">
                                            <div class="share_course text_center bt pbsm">
                                                <div class="socials" style="height: 50px;">
                                                    <span><small>{{trans('courses.share on')}}</small></span>
                                                    <!-- ShareThis BEGIN -->
                                                    <div class="sharethis-inline-share-buttons" style="z-index: 0;"></div>
                                                    <!-- ShareThis END -->
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="course_column_info_inner mtxs b_all">
                                        <div class="about_auther">
                                            @if(count($course->courseincludes) > 0)
                                                <h3 class="text_primary mblg text_capitalize">{{trans('website.about igts')}}</h3>
                                                <figure class="mbsm">
                                                    <a href="javascript: void(0)">
                                                        <img src="{{ asset('website') }}/images/igts-instructor-logo.jpeg" style="width: 100px;">
                                                    </a>
                                                </figure>
                                                <div class="auther_name mbmd">
                                                    <h5 class="mbxs"><a href="javascript: void(0)">IGTS</a></h5>
                                                </div>
                                                <div>{{trans('website.Footer IGTS')}}</div>
                                            @else
                                                @if($course->type  ==  Courses::TYPE_PROFESSIONAL_CERTIFICATES)
                                                    @isset($course->professionalcertificates[0])
                                                        <h3 class="text_primary mblg text_capitalize">{{trans('courses.about certificate')}}</h3>
                                                        <div class="container mt-4">
                                                            <div class="card shadow-lg border-0">
                                                                <div class="card-body">
                                                                    <div class="d-flex flex-column gap-3">
                                                                        <div class="d-flex justify-content-between border-bottom pb-2">
                                                                            <span class="fw-bold">📅  {{trans('professionalcertificates.startdate')}}:</span>
                                                                            <span>{{$course->professionalcertificates[0]['startdate']}}</span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between border-bottom pb-2">
                                                                            <span class="fw-bold">⏰ {{trans('professionalcertificates.appointment')}}:</span>
                                                                            <span>{{trans('professionalcertificates.Yes')}}</span>
                                                                        </div>

                                                                        <div class="d-flex justify-content-between border-bottom pb-2">
                                                                            <span class="fw-bold">📆  {{trans('professionalcertificates.days')}}:</span>
                                                                            <span>{{$course->professionalcertificates[0]['days']}}</span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between border-bottom pb-2">
                                                                            <span class="fw-bold">⏳  {{trans('professionalcertificates.hours')}}:</span>
                                                                            <span> {{$course->professionalcertificates[0]['hours']}}</span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between border-bottom pb-2">
                                                                            <span class="fw-bold">🎟  {{trans('professionalcertificates.seats')}}:</span>
                                                                            <span class="text-success fw-bold">{{$course->professionalcertificates[0]['seats']}}</span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between">
                                                                            <span class="fw-bold">🔚   {{trans('professionalcertificates.registrationdeadline')}}:</span>
                                                                            <span> {{$course->professionalcertificates[0]['registrationdeadline']}} </span>
                                                                        </div>
                                                                    </div>

                                                                    @if(Auth::check())
                                                                        <button type="button" class="btn btn-primary btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#termsModal">
                                                                            {{trans('account.Enroll Now')}}
                                                                        </button>

                                                                    @else
                                                                        <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-lg mt-3">
                                                                            {{trans('account.Enroll Now')}}
                                                                        </a>
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endisset
                                                @else
                                                    <h3 class="text_primary mblg text_capitalize">{{trans('courses.about instructor')}}</h3>
                                                    <figure class="mbsm">
                                                        <a href="/instructors/view/{{$course->instructor->slug}}">
                                                            @if($course->instructor->image)
                                                                <img src="{{large1($course->instructor->image)}}" style="width: 100px;">
                                                            @endif
                                                        </a>
                                                    </figure>
                                                    <div class="auther_name mbmd">
                                                        <h5 class="mbxs"><a href="/instructors/view/{{$course->instructor->slug}}">{{$course->instructor->Fullname_lang}}</a></h5>
                                                        <span class="auther_title">{{$course->instructor->title_lang}}</span>
                                                    </div>
                                                    <div>{!!$course->instructor->about_lang!!}</div>
                                                @endif


                                            @endif
                                        </div>
                                    </div>

                                    @if($course->tags)
                                        <div class="course_column_info_inner mtxs b_all">
                                            <div class="about_auther">
                                                <h3 class="text_primary mblg text_capitalize">{{trans('courses.tags')}}</h3>

                                                <div>
                                                    @foreach(json_decode($course->tags) as $tag)
                                                        <span class="badge badge-primary m-1" style="font-size: 1em;">{{$tag}}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($enrolled && $course->type != Courses::TYPE_WEBINAR)
                                        @if($course->type == Courses::TYPE_BUNDLES)
                                            <div class="course_column_info_inner mtxs b_all">
                                                <div class="about_auther">
                                                    <button type="button" data-dismiss="modal" data-remote="/courses/bundleExams/{{$course->slug}}" data-toggle="ajaxModal" class="button button_primary2 text_capitalize">{{trans('courses.start exam')}}</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="course_column_info_inner mtxs b_all">
                                                <div class="about_auther">
                                                    @if($coursePercent > 90  OR  (count($course->courseincludes) > 0))

                                                        <a href="/courses/startExam/{{$course->slug}}" class="button button_primary button_shadow">{{trans('courses.start exam')}}</a>

                                                    @endif

                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <!-- end course_column_info -->
                            @endif
                            <section class="sec sec_pad_top_sm sec_pad_bottom_sm" id="nav_course_reviews">
                                @if($course->CourseRating)
                                    <section class="title mbmd">
                                        <h2 class="text_primary text_capitalize">{{trans('home.customer reviews')}}</h2>
                                    </section>
                                    <div class="course_review_summary">
                                        <div class="course_review_summary_total">
                                            <div class="course_review_summary_number">{{ round($course->CourseRating, 1) }}</div>
                                            <div class="course_review_summary_rating">
                                                <div class="jq_rating jq-stars" data-options='{"initialRating":{{$course->CourseRating}}, "readOnly":true, "starSize":22}'></div>
                                            </div>
                                            <small>{{trans('courses.total rating score')}}</small>
                                        </div>
                                        @php
                                            $ratingDetails = $course->CourseRatingDetails['ratingDetails'];
                                            $ratingCount = $course->CourseRatingDetails['count'];
                                        @endphp
                                        @if($ratingDetails)
                                            <div class="review_summary_chart">
                                                @foreach ($ratingDetails as $ratingItem)
                                                    @php
                                                        $ratingPercent = round( (( $ratingItem->ratingCount / $ratingCount ) * 100), 1 ) ;
                                                    @endphp
                                                    <div class="review_summary_chart_row">
                                                        <div class="review_summary_chart_prograss">
                                                            <div class="review_summary_chart_buffer" style="width:{{$ratingPercent}}%;"></div>
                                                        </div>
                                                        <div class="review_summary_chart_rating">
                                                            <div class="jq_rating jq-stars" data-options='{"initialRating":{{$ratingItem->rating}}, "readOnly":true, "starSize":16}'></div>
                                                            <div><span class="text_primary">{{round($ratingPercent)}}%</span></div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <!-- Reviews -->
                                @include('website.courses.assets.courseReviews', ['courseReviews' => $course->coursereviews, 'courseId' => $course->id])

                            </section>
                        </div>
                        <!-- end course_detail_content -->
                    </div>
                </div>
            </section>

            @if(count($course->courserelatedPublished) > 0)
                <section class="sec sec_pad_top sec_pad_bottom">
                    <div class="wrapper">
                        <section class="title mbmd">
                            <h2 class="text_primary text_capitalize">{{trans('courses.Recommended courses')}}</h2>
                        </section>
                        <div id="relatedCourses">
                            <div class="courses_cards owl-carousel owl-theme relatedCourses">
                                @foreach($course->courserelatedPublished as $data)
                                    @include('website.courses.assets.mostViewedItem', ['data' => $data->relatedCourse])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>

        <!-- START MOBILE FIXED BUTTONS -->
        <div class="show-mobile fixed-buttons text-center d-none">
            @if(!$shoppingCart && !$enrolled)
                @if(Auth::check())
                    @if($course->type == Courses::TYPE_WEBINAR)
                        @if(getEventStatus($course) == "passed")
                            <a href="javascript:void(0)" class="more_button button_primary w-50 text-center mb-10 p-3" style="background-color: #cf2626;">
                                {{ trans('courses.This Webinar Has Ended') }}
                            </a>
                        @else
                            <a href="/site/enrollWebinar/{{$course->id}}" class="more_button button_primary w-50 text-center mb-10 p-3" style="background-color: #cf2626;">
                                {{ trans('courses.Watch This Webinar') }}
                            </a>
                        @endif
                    @else
                        @if($course->OriginalPrice > 0)
                            @if(count($course->certificatesContainer) > 0)
                                <a href="javascript:void(0)" onclick="loadModal('/courses/certificatesContainer/id/', {{$course->id}})" class="more_button button_primary w-50 text-center mb-10 p-3" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal" class="button button_primary button_large add_cart track" data-course-id="{{$course->id}}">
                                    <i class="fas fa-cart-plus track"></i> {{ $course->OriginalPrice }} {{getCurrency()}}
                                </a>
                            @else
                                <a href="/courses/addToCart/id/{{$course->id}}" class="more_button button_primary w-50 text-center mb-10 p-3">
                                    <i class="fas fa-cart-plus track"></i> {{ $course->OriginalPrice }} {{getCurrency()}}
                                </a>
                            @endif
                        @else
                            <a class="button button_primary button_large add_cart track" href="{{ url('/courses/enrollNow/id/' . $course->id) }}">
                                {{ trans('courses.Get It For Free') }}
                            </a>
                        @endif
                    @endif
                @else
                    @if($course->type == Courses::TYPE_WEBINAR)
                        @if(getEventStatus($course) == "passed")
                            <a href="javascript:void(0)" class="more_button button_primary w-50 text-center mb-10 p-3" style="background-color: #cf2626;">
                                {{ trans('courses.This Webinar Has Ended') }}
                            </a>
                        @else
                            <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="more_button button_primary w-50 text-center mb-10 p-3">
                                {{ trans('courses.Sign in to join this webinar') }}
                            </a>
                        @endif
                    @else
                        <a href="javascript:void(0)" data-dismiss="modal" data-remote="/login" data-toggle="modal" data-target="#loginModal" class="more_button button_primary w-50 text-center mb-10 p-3">
                            <i class="fas fa-cart-plus"></i> {{ $course->OriginalPrice }} {{getCurrency()}}
                        </a>
                    @endif
                @endif
            @endif

            @if($enrolled && $course->type == Courses::TYPE_WEBINAR)
                @if(getEventStatus($course) == "passed")
                    <a href="javascript:void(0)" class="more_button button_primary w-50 text-center mb-10 p-3" style="background-color: #cf2626;">
                        {{ trans('courses.This Webinar Has Ended') }}
                    </a>
                @else
                    <a href="{{($course->webinar_url) ? $course->webinar_url : 'javascript:void(0)'}}" target="_blank" class="more_button button_primary w-50 text-center mb-10 p-3">
                        {{ trans('courses.Watch This Webinar') }}
                    </a>
                @endif
            @endif

            @if($enrolled && $course->type != Courses::TYPE_WEBINAR && isset($course->quiz))

                @if($coursePercent > 90  OR  (count($course->courseincludes) > 0))
                    <a href="/courses/startExam/{{$course->slug}}" class="more_button button_primary w-50 text-center mb-10 p-3">
                        {{trans('courses.start exam')}}
                    </a>
                @endif

            @endif
        </div>
        <!-- END MOBILE FIXED BUTTONS -->
        </div>
    </main>

    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=612247d00596560012d381ab&product=inline-share-buttons' async='async'></script>

    @if($course->promo_video)
        <!-- Modal -->
        <div class="modal fade" style="overflow: hidden;width: 100%;" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="Promo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered2" role="document" style="top: 20%;">
                <div class="modal-content" style="background: transparent;border: 0;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <iframe style="position: relative;width: 100%;" webkitAllowFullScreen mozallowfullscreen allowfullscreen src="https://player.vimeo.com/video/{{ $course->promo_video }}" title="0" byline="0" portrait="0" width="640" height="360" frameborder="0" allow="autoplay"></iframe>
                </div>
            </div>
        </div>
        </div>
    @endif


    @if($course->type  ==  Courses::TYPE_PROFESSIONAL_CERTIFICATES)

        {{--<div class="modal fade" id="termsModal" data-bs-backdrop="false" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">--}}
        <div class="modal fade" id="termsModal" data-bs-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        {{--                                                                            <h5 class="modal-title fw-bold" id="termsModalLabel">الشروط والأحكام</h5>--}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        {{--                                                                            <div class="container mt-4">--}}
                        {{--                                                                                <div class="card shadow-lg border-0">--}}
                        {{--                                                                                    <div class="card-body">--}}
                        <h3 class="text-center fw-bold mb-4">الشروط والأحكام</h3>

                        <h4 class="fw-bold">📌 التسجيل بالبرامج التدريبية</h4>
                        <ul>
                            <li>في حالة طلب المتدرب دعم هدف إذا توفرت الشروط لذلك، فلا يجوز لأي شخص الدفع عوضًا عنه، إذ يجب تسجيل بيانات المتدرب الطالب للدعم في الفاتورة.</li>
                            <li>يتم تقديم البرنامج التدريبي بنمط التدريب الافتراضي المتزامن (أونلاين).</li>
                            <li>في حال قام المتدرب بالتسجيل على دورة ما ولم يسدد الرسوم حتى تاريخ انتهاء التسجيل، فيقوم النظام بحذف اسمه تلقائيًا من قائمة الملتحقين بالدورة، ويستطيع التسجيل في موعد لاحق.</li>
                            <li>يتم إعلام المتدرب برسالة على الواتس آب إذا حدث أي تغيير على الموعد.</li>
                        </ul>

                        <h4 class="fw-bold">📅 الحضور والغياب</h4>
                        <ul>
                            <li>يعامل الحضور الإلكتروني معاملة الحضور في قاعات التدريب التقليدية ويطبق على الحضور الإلكتروني اللوائح المنظمة للحضور والحرمان.</li>
                            <li>يجب ألا تقل نسبة الحضور الإلكتروني في التعلم الإلكتروني عن 70% من مجموع ساعات الدورة التدريبية.</li>
                            <li>يحرم المتدرب من الحصول على شهادة الحضور إذا تجاوزت نسبة غيابه 30% من المحاضرات التزامنية.</li>
                        </ul>

                        <h4 class="fw-bold">💰 السداد والأسعار والتخفيضات</h4>
                        <ul>
                            <li>يمكن السداد بطرق ثلاثة: الدفع الإلكتروني ببطاقات الائتمان المختلفة، أو بطاقات مدى، أو التحويل البنكي المباشر.</li>
                            <li>سعر البرنامج هو سعره عند السداد وليس عند التسجيل.</li>
                            <li>يعرض الموقع دائمًا السعر الحالي للبرنامج، قد يتغير السعر لاحقًا وفقًا لسريان التخفيضات.</li>
                            <li>إذا كان السداد بإحدى الطرق الإلكترونية يتم تأكيد التسجيل مباشرة ويصبح التسجيل مؤكدًا.</li>
                            <li>في حال كان التسجيل بالحوالات البنكية، يتحول إلى "انتظار اعتماد الإدارة"، حيث يقوم أحد موظفي خدمة العملاء باعتماد التسجيل بعد التأكد من تلقي المبلغ.</li>
                        </ul>

                        <h4 class="fw-bold">🔄 الاسترجاع</h4>
                        <ul>
                            <li>يحق للمتدرب استرجاع المبلغ المدفوع قبل بدء البرنامج بـ 5 أيام عمل كحد أدنى.</li>
                            <li>في حال تعذر إقامة البرنامج لأسباب لا تتعلق بالمتدرب، يحق له المطالبة باسترجاع المبلغ.</li>
                            <li>يمكن للمتدرب تحويل مبلغ البرنامج إلى برنامج آخر إذا طلب التحويل قبل 3 أيام عمل من بدء البرنامج المدفوع.</li>
                            <li>لا يمكن استرجاع المبلغ أو تحويله إلى برنامج آخر إذا تغيب المتدرب عن الحضور.</li>
                        </ul>

                        <h4 class="fw-bold">📜 شروط وأحكام عقد البرامج التدريبية</h4>
                        <ul>
                            <li>يحق للإدارة تأجيل عقد برنامج تدريبي مدة لا تزيد عن أسبوع، مع إخطار جميع المتدربين بذلك.</li>
                            <li>يحق للإدارة تأجيل جلسة تدريبية مدة لا تزيد عن يومين، مع إخطار المتدربين.</li>
                            <li>يمكن للمتدرب معرفة روابط الغرف الافتراضية عبر صفحة البرنامج، والتي تعمل فقط أثناء فترة انعقاد البرامج.</li>
                            <li>جهة التدريب غير مسؤولة عن تهاون المتدرب في التدريب وعدم التزامه بالاختبارات التجريبية.</li>
                        </ul>
                        {{--                                                                                    </div>--}}
                        {{--                                                                                </div>--}}
                        {{--                                                                            </div>--}}


                        <!-- Checkbox للموافقة -->
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="agreeCheckbox">
                            <label class="form-check-label fw-bold" for="agreeCheckbox" style="
    margin-right: 20px;
    margin-left: 20px;
">
                                أوافق على جميع الشروط والأحكام
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- زر التسجيل يكون غير نشط حتى يتم تحديد الـ Checkbox -->
                        <button type="button" class="btn btn-success confirmRegister-button" id="confirmRegister" disabled>تأكيد التسجيل</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('termsModal');
                const agreeCheckbox = document.getElementById('agreeCheckbox');
                const confirmButton = document.getElementById('confirmRegister');
                const closeButtons = document.querySelectorAll('[data-bs-dismiss="modal"]');

                // تفعيل زر التسجيل فقط عند تحديد الـ Checkbox
                agreeCheckbox.addEventListener('change', function () {
                    confirmButton.disabled = !this.checked;
                });

                // ربط زر "تأكيد التسجيل" بتنفيذ إضافة الدورة إلى السلة
                confirmButton.addEventListener("click", function () {
                    const courseId = "{{ $course->id }}"; // جلب معرف الدورة من Laravel
                    const redirectUrl = `/courses/addToCart/id/${courseId}`;

                    window.location.href = redirectUrl; // توجيه المستخدم إلى رابط التسجيل
                });

                // وظيفة إغلاق المودال بشكل كامل وإزالة `modal-backdrop`
                function closeModal() {
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) backdrop.remove();
                    modal.classList.remove('show');
                    modal.style.display = "none";  // إخفاء المودال نهائيًا
                    document.body.classList.remove('modal-open');
                    modal.setAttribute('aria-hidden', 'true');
                }

                // ربط الحدث بزر "تأكيد التسجيل"
                confirmButton.addEventListener('click', function () {
                    closeModal();
                    alert("تم التسجيل بنجاح!");
                });

                // ربط الحدث بجميع أزرار الإغلاق
                closeButtons.forEach(button => {
                    button.addEventListener('click', closeModal);
                });

                // السماح بإغلاق المودال عند الضغط على أي منطقة خارجية
                window.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        closeModal();
                    }
                });
            });
        </script>



        <style>
            div#hubspot-messages-iframe-container {
                display: none !important;
            }

            .float {
                display: none !important;
            }

            .float-whatsapp {
                position: fixed;
                left: 0;
                margin-left: 24px;
                width: 60px;
                height: 60px;
                bottom: 0;
                margin-bottom: 16px;
                background-color: #18B289;
                color: #FFF;
                border-radius: 50px;
                text-align: center;
                box-shadow: 2px 2px 3px #999;
                z-index: 2;
            }
        </style>

        <a href="https://contactus.igtsservice.com/?prevUrl={{ urlencode(url()->full()) }}" target="_blank" class="float-whatsapp contact_whatsapp">
            <i class="fab fa-whatsapp my-float" aria-hidden="true"></i>
        </a>

    @endif



@endsection

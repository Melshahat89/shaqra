@extends(layoutExtend('website'))
@section('title'){{ trans('website.Payments') }} | {{ trans('home.HomeTitle') }}@endsection
@section('description'){{ trans('home.HomeDescription') }}@endsection
@section('keywords')
    
@endsection
@section('content')

    <div dir="rtl" lang="ar">

<nav class="bread-crumb" aria-label="مسار التنقل">
    <div class="wrapper">
        <a href="/">{{trans('website.home')}}</a>
        <span aria-hidden="true"> / </span>
        <span>{{trans('website.Payments')}}</span>
    </div>
</nav>

<div class="page-title general-gred">
    <div class="container">
        <h1>{{trans('website.A payment error has occurred')}}</h1>
    </div>
</div>

    <section class="mycart-container" id="steps">
        <div class="container">
            <div class="my-items mt-40">
                <div class="row">
                    <div class="col-md-12">
                        <div class="Summary">
                            <h2><strong style="color: red" class="successfully">
                            {{ trans('website.A payment error has occurred') }}
                            </strong></h2>
                            <div class="total">
                                <p><strong>{{ trans('website.Error Message') }} : {{$data_message}}</strong></p>
                            </div>
                            <div class="coupon">
                                <p>{!! trans('website.Do you need help?') !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-40 next-step">
                        <div class="flexLeft">
                            <a class="view-more-section" href="{{ url('/cart') }}">
                                <i class="flaticon-left-arrow" aria-hidden="true"></i>
                                <span>{{ trans('website.Back to cart') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>

@endsection

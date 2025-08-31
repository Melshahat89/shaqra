@extends(layoutExtend('website'))
@section('title')
    {{trans('home.Trainee Guide')}}
@endsection
@section('description')
    {{ trans('home.HomeDescription') }}
@endsection
@section('keywords')
    {{ trans('home.HomeKeywords') }}
@endsection
@section('content')


    @include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('home.Trainee Guide')])

    <section class="contact-content">
        <div class="container">

            <div class="row">
                <!--ARCADE EMBED START-->
                <div style="position: relative; padding-bottom: calc(100.53976311336717%); height: 0; width: 100%;">
                    <iframe src="https://demo.arcade.software/Pb7OJPVmorFtYsjE5VQn?embed&embed_mobile=inline&embed_desktop=inline&show_copy_link=true"
                            title="(دليل المتدرب)" frameborder="0" loading="lazy" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="clipboard-write"
                            style="position: absolute;
                    top: 0; left: 0;
                    width: 100%; height: 100%;
                    color-scheme: light;" ></iframe>
                </div>
                <!--ARCADE EMBED END-->

            </div>
        </div>







    </section>


@endsection

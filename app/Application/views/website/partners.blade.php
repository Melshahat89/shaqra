@extends(layoutExtend('website'))
@section('title')
    {{  trans('home.HomeTitle') }} - {{trans('home.accreditations')}}
@endsection
@section('description')
    {{ trans('website.Footer IGTS') }}
@endsection
@section('keywords')

@endsection
@push('css')
    <style>
        .loading {
            display: none !important;
        }


        .counter-card-section {
            background: linear-gradient(90deg, #005B8F 0%, #005B8F 50%, #00A9CE 90%);
            /*background-image: url("https://images.pexels.com/photos/7096/people-woman-coffee-meeting.jpg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"),*/
            radial-gradient(rgba(0, 0, 0, 1), rgba(255, 255, 0, 0.2));
            background-blend-mode: overlay;
            background-size: cover;
            background-repeat: no-repeat;
            margin: 5rem auto;
            border-radius: 5rem;
            box-shadow: 3px 3px 1px #ccc;
            -webkit-box-shadow: 3px 3px 1px #ccc;
            -moz-box-shadow: 3px 3px 1px #ccc;
        }




    </style>
@endpush
@push('js')
    <script>
        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        const obj = document.getElementById("value1");
        animateValue(obj, 0, 300000, 1000);

        const obj2 = document.getElementById("value2");
        animateValue(obj2, 0, 24, 1000);

        const obj3 = document.getElementById("value3");
        animateValue(obj3, 0, 300, 1000);

        const obj4 = document.getElementById("value4");
        animateValue(obj4, 0, 3, 1000);

    </script>
@endpush
@section('content')


    <main class="main_content">

        <section class="sec sec_pad_top sec_pad_bottom bg_gradient sticky-stopper">
            <div class="wrapper">
                <section class="title mblg">
                    <h2 class="text_white text_capitalize">{{trans('home.accreditations')}} & {{trans('home.achievements')}}</h2>
                    <p style="color: white;"></p>
                </section>
            </div>
        </section>

        <section class="sec sec_pad_top sec_pad_bottom">
            <div class="wrapper">

                <section class="title mblg">
                    <h2 class="text_primary text_capitalize">{{trans('home.accreditations')}} & {{trans('home.achievements')}}</h2>
                </section>


                <div class="wrapper row">

                    @foreach($Partners as $key => $data)
                        <div class="col-md-4 pt-4 pb-2">
                            <div class="card">
                                <a class="" href="#collapse{{$key}}" data-toggle="collapse">
                                    <img class="card-img-top" style="height: 300px; object-fit: scale-down;" src="{{large($data->logo)}}" alt="{{$data->title_lang}}" />
                                </a>
                                <div class="card-header text-center">{{$data->title_lang}}</div>
                                <div id="collapse{{$key}}" class="collapse multi-collapse">
                                    <div class="card-body">
                                        <p class="card-text">
                                            {{$data->description_lang}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>



            </div>

            <div class="global-pagenation flexBetween">
                {{ $Partners->links('pagination::meduo-pagination') }}
            </div>
        </section>


    </main>

@endsection

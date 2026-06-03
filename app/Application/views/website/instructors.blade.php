@extends(layoutExtend('website'))

@section('title'){{ trans('home.instructors') }} | {{ trans('home.HomeTitle') }}@endsection
@section('description'){{ trans('home.HomeDescription') }}@endsection
@section('keywords')@endsection

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    <section class="dga-page-hero">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span>{{ trans('home.instructors') }}</span>
            </nav>
            <h1 class="dga-page-title">{{ trans('home.instructors') }}</h1>
            <p class="dga-page-sub">نخبة من المدربين والخبراء المعتمدين بخبرات عملية وأكاديمية متميزة</p>
        </div>
    </section>

    <section class="dga-sec">
        <div class="dga-wrap">
            <div tag_id="instructorsList" class="list-view trainers_list trainers_list_small">
                @foreach($Instructors as $key => $data)
                    @include('website.instructorsListView')
                @endforeach
            </div>

            <div class="dga-pagination">
                {{ $Instructors->links('pagination::meduo-pagination') }}
            </div>
        </div>
    </section>

</div>
@endsection

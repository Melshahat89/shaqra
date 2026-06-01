@extends(layoutExtend('website'))

@section('title')
    {{ ($homesettings->seo_title_lang) ? $homesettings->seo_title_lang : trans('home.HomeTitle') }}
@endsection
@section('description')
    {{ ($homesettings->seo_desc_lang) ? $homesettings->seo_desc_lang : trans('website.Footer IGTS') }}
@endsection
@section('keywords')
    {{ ($homesettings->seo_keys) ? extractSeoKeys($homesettings->seo_keys) : '' }}
@endsection

@push('js')
<script src="{{ asset('old') }}/js/front/social.js"></script>
@endpush

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    <section class="dga-page-hero">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span>{{ $category ? $category->name_lang : trans('home.diplomas') }}</span>
            </nav>
            <h1 class="dga-page-title">{{ $category ? $category->name_lang : trans('home.diplomas') }}</h1>
            <p class="dga-page-sub">دبلومات مهنية معتمدة مصممة لتأهيلك للسوق الوظيفي</p>
        </div>
    </section>

    <div class="dga-tabs-bar">
        @include('website.categories.assets.tabs-container', ['active' => 'diplomas', 'tabsWidth' => $tabsWidth])
    </div>

    <main class="main_content dga-sec">
        <div class="dga-wrap">
            @if($mostViewedPerCategory && !($key))
            <section class="sec sec_pad_bottom d-none">
                <section class="title mblg">
                    <h2 class="text_primary text_capitalize">{{ trans('categories.most viewed') }}</h2>
                </section>
                <div id="mostViewed">
                    <div class="courses_cards owl-carousel owl-theme mostViewed">
                        @foreach($mostViewedPerCategory as $data)
                            @include('website.courses.assets.mostViewedItem', ['data' => $data])
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            @include('website.courses.assets.coursesPerCategory', [
                'headTitle' => trans('home.diplomas'),
                'type'      => $type,
                'key'       => $key,
                'slug'      => $slug
            ])
        </div>
    </main>

</div>
@endsection

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
<script>
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
@endpush

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    <section class="dga-page-hero">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span>{{ $category ? $category->name_lang : 'جميع الدورات' }}</span>
            </nav>
            <h1 class="dga-page-title">{{ $category ? $category->name_lang : 'جميع الدورات' }}</h1>
            <p class="dga-page-sub">
                @if($key)
                    نتائج البحث عن: <strong>«{{ $key }}»</strong>
                @else
                    استعرض جميع الدورات المتاحة في مختلف التخصصات
                @endif
            </p>
        </div>
    </section>

    <div class="dga-tabs-bar">
        @include('website.categories.assets.tabs-container', ['active' => 'all', 'tabsWidth' => $tabsWidth, 'key' => $key])
    </div>

    @isset($category->childs)
        @if(!$category->childs->isEmpty())
        <section class="dga-sec dga-sec-gray">
            <div class="dga-wrap">
                <div class="dga-sec-head center">
                    <div class="dga-line"></div>
                    <h2>{{ trans('home.Sub Category') }}</h2>
                </div>
                <div id="specialities">
                    <div class="owl-carousel owl-theme specialities">
                        @foreach($category->childs as $cat)
                            @include(sectionSpecialities('website'), ['data' => $cat])
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
    @endisset

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
                'headTitle' => trans('website.All'),
                'key'       => $key,
                'slug'      => $slug
            ])
        </div>
    </main>

</div>
@endsection

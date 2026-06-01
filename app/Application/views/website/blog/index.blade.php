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
                <span>{{ trans('blog.blog') }}</span>
            </nav>
            <h1 class="dga-page-title">{{ trans('blog.blog') }}</h1>
            <p class="dga-page-sub">آخر الأخبار والمقالات التعليمية من خبرائنا</p>
        </div>
    </section>

    <main class="dga-sec">
        <div class="dga-wrap">
            @include('website.blog.postsPerCategory', ['headTitle' => trans('home.courses')])
        </div>
    </main>

</div>
@endsection

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
<script src="{{ asset('website') }}/js/social.js"></script>
@endpush

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    <section class="dga-page-hero">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                <svg width="16" height="16" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span aria-current="page">{{ trans('blog.blog') }}</span>
            </nav>
            <h1 class="dga-page-title">{{ trans('blog.blog') }}</h1>
            <p class="dga-page-sub">آخر الأخبار والمقالات التعليمية من خبرائنا</p>
        </div>
    </section>

    <div class="dga-sec">
        <div class="dga-wrap">
            @include('website.blog.postsPerCategory', ['headTitle' => trans('home.courses')])
        </div>
    </div>

</div>
@endsection

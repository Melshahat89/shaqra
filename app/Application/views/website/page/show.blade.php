@extends(layoutExtend('website'))

@section('title'){{ getDefaultValueKey(nl2br($item->title)) }}@endsection
@section('description'){{ trans('home.HomeDescription') }}@endsection
@section('keywords'){{ trans('home.HomeKeywords') }}@endsection

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    <section class="dga-page-hero">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                {!! dgaIcon('arrow-left-01', '', ['height' => 16]) !!}
                <span aria-current="page">{{ getDefaultValueKey($item->title) }}</span>
            </nav>
            <h1 class="dga-page-title">{{ getDefaultValueKey($item->title) }}</h1>
        </div>
    </section>

    <div class="dga-sec">
        <div class="dga-wrap dga-wrap--narrow">
            <article class="dga-prose">
                {!! getDefaultValueKey(nl2br($item->body)) !!}
            </article>
        </div>
    </div>

</div>
@endsection

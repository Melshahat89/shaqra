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
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span>{{ getDefaultValueKey($item->title) }}</span>
            </nav>
            <h1 class="dga-page-title">{{ getDefaultValueKey($item->title) }}</h1>
        </div>
    </section>

    <main class="dga-sec">
        <div class="dga-wrap dga-wrap--narrow">
            <article class="dga-prose">
                {!! getDefaultValueKey(nl2br($item->body)) !!}
            </article>
        </div>
    </main>

</div>
@endsection

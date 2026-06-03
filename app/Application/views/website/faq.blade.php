@extends(layoutExtend('website'))

@section('title'){{ trans('faq.faq') }} | {{ trans('home.HomeTitle') }}@endsection
@section('description'){{ trans('faq.faq') }} — {{ trans('home.HomeDescription') }}@endsection

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    <section class="dga-page-hero">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span>الأسئلة الشائعة</span>
            </nav>
            <h1 class="dga-page-title">الأسئلة الشائعة</h1>
            <p class="dga-page-sub">إجابات على أكثر الأسئلة شيوعاً — لم تجد ما تبحث عنه؟ تواصل معنا مباشرة</p>
        </div>
    </section>

    <section class="dga-sec">
        <div class="dga-wrap dga-wrap--narrow">
            @if(isset($faq) && count($faq))
            <div class="dga-faq">
                @foreach($faq as $item)
                <details class="dga-faq-item">
                    <summary>
                        <span>{{ $item->question_lang }}</span>
                        <svg class="dga-faq-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                    </summary>
                    <div class="dga-faq-body">
                        {!! $item->answer_lang !!}
                    </div>
                </details>
                @endforeach
            </div>
            @else
            <p style="text-align:center;color:var(--dga-gray-500);">لا توجد أسئلة متاحة حالياً.</p>
            @endif

            <div class="dga-faq-cta">
                <h3>لم تجد إجابتك؟</h3>
                <p>فريقنا متاح للإجابة على جميع استفساراتك</p>
                <a href="{{ url('contact') }}" class="dga-btn dga-btn-green">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    تواصل معنا
                </a>
            </div>
        </div>
    </section>

</div>
@endsection

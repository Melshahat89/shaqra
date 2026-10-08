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
                {!! dgaIcon('arrow-left-01', '', ['height' => 16]) !!}
                <span aria-current="page">الأسئلة الشائعة</span>
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
                        {!! dgaIcon('arrow-down-01', 'dga-faq-icon', ['height' => 16]) !!}
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
                    {!! dgaIcon('comment-01', '', ['width' => 14, 'height' => 14]) !!}
                    تواصل معنا
                </a>
            </div>
        </div>
    </section>

</div>
@endsection

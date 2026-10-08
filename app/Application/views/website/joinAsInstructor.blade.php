@extends(layoutExtend('website'))

@section('title'){{ trans('website.joinAsInstructor') }}@endsection
@section('description'){{ trans('home.MeduoHomeDescription') }}@endsection
@section('keywords'){{ trans('home.MeduoHomeKeywords') }}@endsection

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    {{-- HERO --}}
    <section class="dga-page-hero" style="min-height:340px;">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                {!! dgaIcon('arrow-left-01', '', ['height' => 16]) !!}
                <span aria-current="page">{{ trans('home.become an instructor') }}</span>
            </nav>
            <h1 class="dga-page-title">{{ trans('home.become an instructor') }}</h1>
            <p class="dga-page-sub">{{ trans('website.Medical training and rehabilitation') }}</p>
            <div style="margin-top:24px;">
                <a href="#applynow" class="dga-btn dga-btn-gold">
                    {!! dgaIcon('user-multiple', '', ['width' => 16, 'height' => 16]) !!}
                    {{ trans('Join Us Now') }}
                </a>
            </div>
        </div>
    </section>

    {{-- WHY CHOOSE US + VIDEO --}}
    <section class="dga-sec dga-sec-gray">
        <div class="dga-wrap">
            <div class="dga-sec-head center">
                <div class="dga-line"></div>
                <h2>{{ trans('website.Why Choose IGTS') }}</h2>
            </div>
            <div style="display:flex;justify-content:center;">
                <div style="width:100%;max-width:720px;aspect-ratio:16/9;border-radius:var(--dga-r-lg);overflow:hidden;box-shadow:var(--dga-sh-lg);">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/BrAXHkfqqxk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- BENEFITS --}}
    <section class="dga-sec">
        <div class="dga-wrap">
            <div class="dga-sec-head center">
                <div class="dga-line"></div>
                <h2>{{ trans('website.The benefits of E-Learning on IGTS') }}</h2>
            </div>
            <div class="dga-why-grid" style="grid-template-columns: repeat(3, 1fr);">
                @php
                    $benefits = [
                        ['icon' => dgaIcon('certificate-01', '', ['height' => 28]), 't'=>'A great addition to your C.V', 'd'=>'HR managers are always looking for energetic employees who do different jobs to serve their communities'],
                        ['icon' => dgaIcon('star', '', ['height' => 28]), 't'=>'Self-confidence', 'd'=>'When you see the positive interaction of the trainees with your distinguished courses, this will increase your self-confidence and thus increase your functional and social skills.'],
                        ['icon' => dgaIcon('user-multiple', '', ['height' => 28]), 't'=>'Experience', 'd'=>'By offering online courses, you prove your distinguished expertise in your field, and this is what human resource managers are looking for.'],
                        ['icon' => dgaIcon('activity-01', '', ['height' => 28]), 't'=>'Improve your performance', 'd'=>'When you see yourself in the educational videos in your online courses, your style as a professional trainer in communicating information improves automatically.'],
                        ['icon' => dgaIcon('laptop', '', ['height' => 28]), 't'=>'Featured Tools', 'd'=>'IGTS provides the tools needed to create courses and we will help you at every step of the way to create professional courses.'],
                        ['icon' => dgaIcon('target-02', '', ['height' => 28]), 't'=>'Special Support', 'd'=>'We offer you special support as a coach to help you become a professional coach through the IGTS website, so we are always in touch to provide the best for the trainees'],
                    ];
                @endphp
                @foreach($benefits as $b)
                <div class="dga-why-card">
                    <div class="dga-why-icon">{!! $b['icon'] !!}</div>
                    <h3>{{ trans('website.'.$b['t']) }}</h3>
                    <p>{{ trans('website.'.$b['d']) }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- APPLY NOW --}}
    <section id="applynow" class="dga-sec dga-sec-gray">
        <div class="dga-wrap dga-wrap--narrow">
            <div class="dga-sec-head center">
                <div class="dga-line"></div>
                <h2>{{ trans('website.Apply Now To Become an Instructor') }}</h2>
            </div>
            <div class="dga-contact-form-wrap">
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/shell.js"></script>
                <script>
                    hbspt.forms.create({
                        portalId: "7171341",
                        formId: "d8c9a560-f9f5-4c43-870e-ba1fbcb201ba"
                    });
                </script>
            </div>
        </div>
    </section>

</div>
@endsection

@push('script')
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/7171341.js"></script>
@endpush

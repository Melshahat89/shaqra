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
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span>{{ trans('home.become an instructor') }}</span>
            </nav>
            <h1 class="dga-page-title">{{ trans('home.become an instructor') }}</h1>
            <p class="dga-page-sub">{{ trans('website.Medical training and rehabilitation') }}</p>
            <div style="margin-top:24px;">
                <a href="#applynow" class="dga-btn dga-btn-gold">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
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
                        ['icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>', 't'=>'A great addition to your C.V', 'd'=>'HR managers are always looking for energetic employees who do different jobs to serve their communities'],
                        ['icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>', 't'=>'Self-confidence', 'd'=>'When you see the positive interaction of the trainees with your distinguished courses, this will increase your self-confidence and thus increase your functional and social skills.'],
                        ['icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg>', 't'=>'Experience', 'd'=>'By offering online courses, you prove your distinguished expertise in your field, and this is what human resource managers are looking for.'],
                        ['icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>', 't'=>'Improve your performance', 'd'=>'When you see yourself in the educational videos in your online courses, your style as a professional trainer in communicating information improves automatically.'],
                        ['icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/></svg>', 't'=>'Featured Tools', 'd'=>'IGTS provides the tools needed to create courses and we will help you at every step of the way to create professional courses.'],
                        ['icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>', 't'=>'Special Support', 'd'=>'We offer you special support as a coach to help you become a professional coach through the IGTS website, so we are always in touch to provide the best for the trainees'],
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

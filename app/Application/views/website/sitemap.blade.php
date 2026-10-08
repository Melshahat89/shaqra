@extends(layoutExtend('website'))

@section('title'){{ trans('home.HomeTitle') }} | خريطة الموقع@endsection
@section('description')خريطة الموقع — جميع صفحات وخدمات منصة الشهادات الاحترافية بجامعة شقراء@endsection

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    <section class="dga-page-hero">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                {!! dgaIcon('arrow-left-01', '', ['width' => 16, 'height' => 16]) !!}
                <span aria-current="page">خريطة الموقع</span>
            </nav>
            <h1 class="dga-page-title">خريطة الموقع</h1>
            <p class="dga-page-sub">دليل شامل لجميع صفحات المنصة وخدماتها لتسهيل التنقل والوصول إلى المحتوى</p>
        </div>
    </section>

    <section class="dga-sec">
        <div class="dga-wrap">
            <style>
                .dga-sitemap { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: var(--dga-space-3xl); }
                .dga-sitemap-group { padding: var(--dga-space-3xl); }
                .dga-sitemap-group h2 { font-size: var(--dga-text-lg); line-height: var(--dga-text-lg-lh); margin: 0 0 var(--dga-space-xl); padding-bottom: var(--dga-space-lg); border-bottom: 1px solid var(--dga-color-gray-200); display: flex; align-items: center; gap: var(--dga-space-md); }
                .dga-sitemap-group h2 svg { width: 20px; height: 20px; color: var(--dga-color-primary-700); }
                .dga-sitemap-group ul { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: var(--dga-space-md); }
                .dga-sitemap-group ul ul { margin-top: var(--dga-space-md); padding-inline-start: var(--dga-space-xl); border-inline-start: 2px solid var(--dga-color-gray-200); }
                .dga-sitemap-group a { color: var(--dga-color-gray-700); font-size: var(--dga-text-md); }
                .dga-sitemap-group a:hover { color: var(--dga-color-primary-700); text-decoration: underline; text-underline-offset: .2em; }
            </style>

            <div class="dga-sitemap">

                <section class="dga-card dga-sitemap-group" aria-labelledby="sm-main">
                    <h2 id="sm-main">
                        {!! dgaIcon('home-01', '') !!}
                        الصفحات الرئيسية
                    </h2>
                    <ul>
                        <li><a href="{{ url('/') }}">الرئيسية</a></li>
                        <li><a href="{{ url('professional-certificates/category') }}">الشهادات الاحترافية</a></li>
                        <li><a href="{{ url('allcourses/category') }}">جميع الدورات</a></li>
                        <li><a href="{{ url('subscriptions') }}">خطط الاشتراك</a></li>
                        <li><a href="{{ url('instructors/All') }}">المدربون</a></li>
                        <li><a href="{{ url('partners') }}">الشركاء</a></li>
                        <li><a href="{{ url('page/about') }}">من نحن</a></li>
                    </ul>
                </section>

                <section class="dga-card dga-sitemap-group" aria-labelledby="sm-cats">
                    <h2 id="sm-cats">
                        {!! dgaIcon('layers-01', '') !!}
                        تصنيفات الدورات
                    </h2>
                    <ul>
                        @foreach($categories as $cat)
                            @if(!$cat->parent_id)
                            <li>
                                <a href="{{ url('allcourses/category/'.$cat->slug) }}">{{ $cat->name_lang }}</a>
                                @if($cat->childs && $cat->childs->count())
                                <ul>
                                    @foreach($cat->childs as $child)
                                        @if($child->show_menu)
                                        <li><a href="{{ url('allcourses/category/'.$child->slug) }}">{{ $child->name_lang }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </section>

                <section class="dga-card dga-sitemap-group" aria-labelledby="sm-services">
                    <h2 id="sm-services">
                        {!! dgaIcon('security-check', '') !!}
                        الخدمات
                    </h2>
                    <ul>
                        <li><a href="{{ url('verifycertificate') }}">التحقق من الشهادة</a></li>
                        <li><a href="{{ url('subscriptions') }}">الاشتراك في المنصة</a></li>
                        <li><a href="{{ url('joinAsInstructor') }}">انضم كمدرب</a></li>
                        <li><a href="{{ url('contact') }}">الدعم الفني والتواصل</a></li>
                        <li><a href="{{ url('faq') }}">الأسئلة الشائعة</a></li>
                    </ul>
                </section>

                <section class="dga-card dga-sitemap-group" aria-labelledby="sm-account">
                    <h2 id="sm-account">
                        {!! dgaIcon('user', '') !!}
                        حسابي
                    </h2>
                    <ul>
                        @if(Auth::check())
                            <li><a href="{{ url('account/myCourses') }}">دوراتي</a></li>
                            <li><a href="{{ url('account/myProgress') }}">تقدمي</a></li>
                            <li><a href="{{ url('account/myCertificates') }}">شهاداتي</a></li>
                            <li><a href="{{ url('account/myFavourites') }}">المفضلة</a></li>
                            <li><a href="{{ url('account/mySubscriptions') }}">اشتراكاتي</a></li>
                            <li><a href="{{ url('account/edit') }}">بيانات الحساب</a></li>
                        @else
                            <li><a href="{{ url('login') }}">تسجيل الدخول</a></li>
                            <li><a href="{{ url('register') }}">إنشاء حساب</a></li>
                            <li><a href="{{ url('password/reset') }}">استعادة كلمة المرور</a></li>
                        @endif
                    </ul>
                </section>

                <section class="dga-card dga-sitemap-group" aria-labelledby="sm-policies">
                    <h2 id="sm-policies">
                        {!! dgaIcon('file-02', '') !!}
                        الشروط والسياسات
                    </h2>
                    <ul>
                        <li><a href="{{ url('page/termsOfUse') }}">الشروط والأحكام</a></li>
                        <li><a href="{{ url('page/privacyPolicy') }}">سياسة الخصوصية</a></li>
                        <li><a href="{{ url('page/accessibility') }}">بيان إمكانية الوصول</a></li>
                        <li><a href="{{ url('sitemap') }}" aria-current="page">خريطة الموقع</a></li>
                        <li><a href="{{ url('sitemap.xml') }}" class="dga-no-ext">خريطة الموقع لمحركات البحث (XML)</a></li>
                    </ul>
                </section>

                <section class="dga-card dga-sitemap-group" aria-labelledby="sm-external">
                    <h2 id="sm-external">
                        {!! dgaIcon('link-square-02', '') !!}
                        روابط رسمية
                    </h2>
                    <ul>
                        <li><a href="https://www.su.edu.sa" target="_blank" rel="noopener">جامعة شقراء</a></li>
                        <li><a href="https://www.vision2030.gov.sa" target="_blank" rel="noopener">رؤية المملكة 2030</a></li>
                        <li><a href="https://moe.gov.sa" target="_blank" rel="noopener">وزارة التعليم</a></li>
                        <li><a href="https://www.my.gov.sa" target="_blank" rel="noopener">المنصة الوطنية الموحدة</a></li>
                        <li><a href="https://dga.gov.sa" target="_blank" rel="noopener">هيئة الحكومة الرقمية</a></li>
                    </ul>
                </section>

            </div>
        </div>
    </section>
</div>
@endsection

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
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
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

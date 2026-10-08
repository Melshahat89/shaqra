@extends(layoutExtend('website'))

@section('title'){{ trans('website.Contact Us') }}@endsection
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
                <span aria-current="page">تواصل معنا</span>
            </nav>
            <h1 class="dga-page-title">تواصل معنا</h1>
            <p class="dga-page-sub">يسعدنا تواصلك معنا — فريقنا متاح للإجابة على استفساراتك في أي وقت</p>
        </div>
    </section>

    <section class="dga-sec">
        <div class="dga-wrap">
            <div class="dga-contact-grid">

                {{-- Left: Info cards --}}
                <div class="dga-contact-info">
                    @if(getSetting('email'))
                    <div class="dga-contact-card">
                        <div class="dga-contact-card-icon">
                            {!! dgaIcon('mail-02', '', ['height' => 22]) !!}
                        </div>
                        <div>
                            <span class="dga-contact-label">البريد الإلكتروني</span>
                            <a href="mailto:{{ getSetting('email') }}" class="dga-contact-val">{{ getSetting('email') }}</a>
                        </div>
                    </div>
                    @endif

                    @if(getSetting('phone'))
                    <div class="dga-contact-card">
                        <div class="dga-contact-card-icon">
                            {!! dgaIcon('call-02', '', ['height' => 22]) !!}
                        </div>
                        <div>
                            <span class="dga-contact-label">الهاتف</span>
                            <a href="tel:{{ getSetting('phone') }}" class="dga-contact-val">{{ getSetting('phone') }}</a>
                        </div>
                    </div>
                    @endif

                    @if(getSetting('address'))
                    <div class="dga-contact-card">
                        <div class="dga-contact-card-icon">
                            {!! dgaIcon('location-06', '', ['height' => 22]) !!}
                        </div>
                        <div>
                            <span class="dga-contact-label">العنوان</span>
                            <span class="dga-contact-val">{{ getSetting('address') }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="dga-contact-card">
                        <div class="dga-contact-card-icon">
                            {!! dgaIcon('clock-01', '', ['height' => 22]) !!}
                        </div>
                        <div>
                            <span class="dga-contact-label">ساعات العمل</span>
                            <span class="dga-contact-val">الأحد - الخميس · 9:00 ص - 5:00 م</span>
                        </div>
                    </div>

                    {{-- Social --}}
                    <div class="dga-contact-social">
                        <span class="dga-contact-label">تابعنا على</span>
                        <div class="dga-social" style="margin-top: 10px;">
                            @if(getSetting('twitter'))<a href="{{ getSetting('twitter') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="تويتر">{!! dgaIcon('new-twitter', '', ['width' => 14, 'height' => 14]) !!}</a>@endif
                            @if(getSetting('linkedin'))<a href="{{ getSetting('linkedin') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="لينكد إن">{!! dgaIcon('linkedin-02', '', ['width' => 14, 'height' => 14]) !!}</a>@endif
                            @if(getSetting('facebook'))<a href="{{ getSetting('facebook') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="فيسبوك">{!! dgaIcon('facebook-02', '', ['width' => 14, 'height' => 14]) !!}</a>@endif
                            @if(getSetting('instagram'))<a href="{{ getSetting('instagram') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="إنستغرام">{!! dgaIcon('instagram', '', ['width' => 14, 'height' => 14]) !!}</a>@endif
                            @if(getSetting('youtube'))<a href="{{ getSetting('youtube') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="يوتيوب">{!! dgaIcon('youtube', '', ['width' => 14, 'height' => 14]) !!}</a>@endif
                        </div>
                    </div>
                </div>

                {{-- Right: Form --}}
                <div class="dga-contact-form-wrap">
                    <h2 class="dga-contact-form-title">{{ trans('website.Keep in touch') }}</h2>
                    <p class="dga-contact-form-sub">اكتب رسالتك وسنعود إليك في أقرب وقت ممكن</p>

                    <form action="{{ concatenateLangToUrl('contact') }}" method="post" class="dga-form">
                        @csrf

                        <div class="dga-form-row">
                            <div class="dga-form-group">
                                <label for="contact-name">الاسم</label>
                                <input id="contact-name" type="text" name="name" required
                                       placeholder="اكتب اسمك"
                                       value="{{ auth()->check() ? auth()->user()->fullname_lang : old('name') }}">
                                @error('name')<span class="dga-form-err" role="alert">{{ $message }}</span>@enderror
                            </div>
                            <div class="dga-form-group">
                                <label for="contact-email">البريد الإلكتروني</label>
                                <input id="contact-email" type="email" name="email" required
                                       placeholder="example@email.com"
                                       value="{{ auth()->check() ? auth()->user()->email : old('email') }}">
                                @error('email')<span class="dga-form-err" role="alert">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="dga-form-row">
                            <div class="dga-form-group">
                                <label for="contact-phone">الهاتف</label>
                                <input id="contact-phone" type="tel" name="phone" placeholder="+966 5x xxx xxxx" value="{{ old('phone') }}">
                                @error('phone')<span class="dga-form-err" role="alert">{{ $message }}</span>@enderror
                            </div>
                            <div class="dga-form-group">
                                <label for="contact-subject">الموضوع</label>
                                <input id="contact-subject" type="text" name="subject" required placeholder="موضوع الرسالة" value="{{ old('subject') }}">
                                @error('subject')<span class="dga-form-err" role="alert">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="dga-form-group">
                            <label for="contact-message">الرسالة</label>
                            <textarea id="contact-message" name="message" required rows="6" placeholder="اكتب رسالتك هنا...">{{ old('message') }}</textarea>
                            @error('message')<span class="dga-form-err" role="alert">{{ $message }}</span>@enderror
                        </div>

                        <button type="submit" class="dga-btn dga-btn-green">
                            {!! dgaIcon('sent', '', ['width' => 14, 'height' => 14]) !!}
                            {{ trans('website.send now') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection

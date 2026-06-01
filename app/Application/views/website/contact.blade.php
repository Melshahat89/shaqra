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
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span>تواصل معنا</span>
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
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
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
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.24h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.89a16 16 0 0 0 6 6l.94-.94a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
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
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <span class="dga-contact-label">العنوان</span>
                            <span class="dga-contact-val">{{ getSetting('address') }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="dga-contact-card">
                        <div class="dga-contact-card-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
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
                            @if(getSetting('twitter'))<a href="{{ getSetting('twitter') }}" target="_blank" rel="noopener" class="dga-social-link"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622L18.244 2.25z"/></svg></a>@endif
                            @if(getSetting('linkedin'))<a href="{{ getSetting('linkedin') }}" target="_blank" rel="noopener" class="dga-social-link"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg></a>@endif
                            @if(getSetting('facebook'))<a href="{{ getSetting('facebook') }}" target="_blank" rel="noopener" class="dga-social-link"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>@endif
                            @if(getSetting('instagram'))<a href="{{ getSetting('instagram') }}" target="_blank" rel="noopener" class="dga-social-link"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/></svg></a>@endif
                            @if(getSetting('youtube'))<a href="{{ getSetting('youtube') }}" target="_blank" rel="noopener" class="dga-social-link"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-2C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 2A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg></a>@endif
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
                                <label>الاسم</label>
                                <input type="text" name="name" required
                                       placeholder="اكتب اسمك"
                                       value="{{ auth()->check() ? auth()->user()->fullname_lang : old('name') }}">
                                @error('name')<span class="dga-form-err">{{ $message }}</span>@enderror
                            </div>
                            <div class="dga-form-group">
                                <label>البريد الإلكتروني</label>
                                <input type="email" name="email" required
                                       placeholder="example@email.com"
                                       value="{{ auth()->check() ? auth()->user()->email : old('email') }}">
                                @error('email')<span class="dga-form-err">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="dga-form-row">
                            <div class="dga-form-group">
                                <label>الهاتف</label>
                                <input type="tel" name="phone" placeholder="+966 5x xxx xxxx" value="{{ old('phone') }}">
                                @error('phone')<span class="dga-form-err">{{ $message }}</span>@enderror
                            </div>
                            <div class="dga-form-group">
                                <label>الموضوع</label>
                                <input type="text" name="subject" required placeholder="موضوع الرسالة" value="{{ old('subject') }}">
                                @error('subject')<span class="dga-form-err">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="dga-form-group">
                            <label>الرسالة</label>
                            <textarea name="message" required rows="6" placeholder="اكتب رسالتك هنا...">{{ old('message') }}</textarea>
                            @error('message')<span class="dga-form-err">{{ $message }}</span>@enderror
                        </div>

                        <button type="submit" class="dga-btn dga-btn-green">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                            {{ trans('website.send now') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

</div>
<script src="https://www.google.com/recaptcha/api.js"></script>
@endsection

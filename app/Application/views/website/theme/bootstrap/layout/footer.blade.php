<footer class="dga-footer" dir="rtl" lang="ar">

    {{-- ══ Top accent bar with brand + Vision 2030 alignment ══ --}}
    <div class="dga-footer-accent">
        <div class="dga-footer-accent-inner">
            <div class="dga-footer-accent-brand">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                <span>منصة الشهادات الاحترافية · جامعة شقراء</span>
            </div>
            <div class="dga-footer-accent-badges">
                <span class="dga-accent-badge">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    رؤية 2030
                </span>
                <span class="dga-accent-badge">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    معتمد رقمياً
                </span>
            </div>
        </div>
    </div>

    {{-- ══ Main 5-column grid ══ --}}
    <div class="dga-footer-main">

        {{-- 1. Brand + Social --}}
        <div class="dga-footer-brand">
            <a href="{{ url('/') }}" class="dga-footer-logo">
                <div class="dga-footer-logo-mark">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                </div>
                <div class="dga-footer-logo-text">
                    <strong>منصة الشهادات الاحترافية</strong>
                    <span>تعلّم وتطور واحترف</span>
                </div>
            </a>

            <p class="dga-footer-desc">منصة تعليمية متكاملة تقدّم شهادات احترافية معتمدة في مختلف المجالات، بالشراكة مع نخبة من المدربين والخبراء المعتمدين.</p>

            <div class="dga-footer-trust">
                <div class="dga-footer-trust-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span>شهادات معتمدة</span>
                </div>
                <div class="dga-footer-trust-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span>متاح على مدار الساعة</span>
                </div>
            </div>

            <div class="dga-social">
                @if(getSetting('twitter'))
                <a href="{{ getSetting('twitter') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="تويتر">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                @endif
                @if(getSetting('linkedin'))
                <a href="{{ getSetting('linkedin') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="لينكد إن">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                </a>
                @endif
                @if(getSetting('facebook'))
                <a href="{{ getSetting('facebook') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="فيسبوك">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                @endif
                @if(getSetting('instagram'))
                <a href="{{ getSetting('instagram') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="إنستغرام">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                </a>
                @endif
                @if(getSetting('youtube'))
                <a href="{{ getSetting('youtube') }}" target="_blank" rel="noopener" class="dga-social-link" aria-label="يوتيوب">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-2C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 2A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
                </a>
                @endif
                @if(getSetting('whatsapp'))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', getSetting('whatsapp')) }}" target="_blank" rel="noopener" class="dga-social-link dga-social-wa" aria-label="واتساب">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                </a>
                @endif
            </div>
        </div>

        {{-- 2. عن المنصة --}}
        <div class="dga-footer-col">
            <h3 class="dga-footer-col-title">عن المنصة</h3>
            <ul class="dga-footer-links">
                <li><a href="{{ url('page/about') }}">من نحن</a></li>
                <li><a href="{{ url('professional-certificates/category') }}">الشهادات الاحترافية</a></li>
                <li><a href="{{ url('verifycertificate') }}">التحقق من الشهادة</a></li>
                <li><a href="{{ url('faq') }}">الأسئلة الشائعة</a></li>
            </ul>
        </div>

        {{-- 3. روابط مفيدة (Vision 2030 style) --}}
        <div class="dga-footer-col">
            <h3 class="dga-footer-col-title">روابط مفيدة</h3>
            <ul class="dga-footer-links">
                <li><a href="https://www.su.edu.sa" target="_blank" rel="noopener">جامعة شقراء</a></li>
                <li><a href="https://www.vision2030.gov.sa" target="_blank" rel="noopener">رؤية المملكة 2030</a></li>
                <li><a href="https://moe.gov.sa" target="_blank" rel="noopener">وزارة التعليم</a></li>
                <li><a href="https://www.my.gov.sa" target="_blank" rel="noopener">البوابة الوطنية</a></li>
            </ul>
        </div>

        {{-- 4. الشروط والسياسات --}}
        <div class="dga-footer-col">
            <h3 class="dga-footer-col-title">الشروط والسياسات</h3>
            <ul class="dga-footer-links">
                <li><a href="{{ url('page/termsOfUse') }}">الشروط والأحكام</a></li>
                <li><a href="{{ url('page/privacyPolicy') }}">سياسة الخصوصية</a></li>
                <li><a href="{{ url('subscriptions') }}">خطط الاشتراك</a></li>
                <li><a href="{{ url('contact') }}">الدعم الفني</a></li>
            </ul>
        </div>

        {{-- 5. تواصل معنا --}}
        <div class="dga-footer-col">
            <h3 class="dga-footer-col-title">تواصل معنا</h3>
            <div class="dga-footer-contact">
                @if(getSetting('email'))
                <div class="dga-footer-contact-item">
                    <div class="dga-footer-contact-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div>
                        <span class="dga-contact-label">البريد الإلكتروني</span>
                        <a href="mailto:{{ getSetting('email') }}">{{ getSetting('email') }}</a>
                    </div>
                </div>
                @endif
                @if(getSetting('phone'))
                <div class="dga-footer-contact-item">
                    <div class="dga-footer-contact-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.24h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.89a16 16 0 0 0 6 6l.94-.94a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <div>
                        <span class="dga-contact-label">الهاتف</span>
                        <a href="tel:{{ getSetting('phone') }}">{{ getSetting('phone') }}</a>
                    </div>
                </div>
                @endif
                @if(getSetting('address'))
                <div class="dga-footer-contact-item">
                    <div class="dga-footer-contact-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <span class="dga-contact-label">العنوان</span>
                        <span class="dga-contact-val">{{ getSetting('address') }}</span>
                    </div>
                </div>
                @endif
                @if(!getSetting('email') && !getSetting('phone'))
                <div class="dga-footer-contact-item">
                    <div class="dga-footer-contact-icon">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </div>
                    <div>
                        <span class="dga-contact-label">تواصل معنا</span>
                        <a href="{{ url('contact') }}">نموذج التواصل</a>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>{{-- /dga-footer-main --}}

    <hr class="dga-footer-divider">

    {{-- ══ Bottom bar: copyright + last update + trust badges ══ --}}
    <div class="dga-footer-bottom">
        <p class="dga-footer-copy">
            &copy; {{ date('Y') }} جميع الحقوق محفوظة — منصة الشهادات الاحترافية، جامعة شقراء
            <span class="dga-footer-sep">·</span>
            <a href="{{ url('page/privacyPolicy') }}">سياسة الخصوصية</a>
            <span class="dga-footer-sep">·</span>
            <a href="{{ url('page/termsOfUse') }}">الشروط والأحكام</a>
        </p>
        <div class="dga-footer-meta">
            <span class="dga-footer-updated">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                آخر تحديث: {{ date('Y/m/d') }}
            </span>
            <div class="dga-footer-badges">
                <span class="dga-footer-badge">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    اتصال آمن
                </span>
                <span class="dga-footer-badge">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    محتوى معتمد
                </span>
            </div>
        </div>
    </div>

</footer>

@if(!Auth::check() && Illuminate\Support\Facades\Route::currentRouteName() != 'post')
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.login');
</div>
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    @include('website.theme.bootstrap.layout.popup.register');
</div>
@endif

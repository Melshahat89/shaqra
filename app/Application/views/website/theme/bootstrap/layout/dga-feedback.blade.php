{{--
    DGA Platforms Code — Feedback section (التعليقات والاقتراحات)
    Mirrors the approved su.edu.sa pattern: card before the footer on every page
    with a single CTA to the contact form (criterion 40).
--}}
@php $isAr = config('app.locale') == 'ar'; @endphp
<section class="dga-feedback" aria-labelledby="dga-feedback-title" dir="{{ getDir() }}">
    <div class="dga-wrap">
        <div class="dga-card dga-feedback-card">
            <span class="dga-featured-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </span>
            <div class="dga-feedback-text">
                <h2 id="dga-feedback-title" class="dga-feedback-title">{{ $isAr ? 'التعليقات والاقتراحات' : 'Feedback and suggestions' }}</h2>
                <p>{{ $isAr ? 'يسرّنا استقبال استفساراتكم وملاحظاتكم المتعلقة بالخدمات عبر تعبئة البيانات المطلوبة.' : 'We welcome your questions and feedback about our services through the contact form.' }}</p>
            </div>
            <div>
                <a href="{{ url('contact') }}" class="dga-btn dga-btn-primary dga-btn-lg">{{ $isAr ? 'تواصل معنا' : 'Contact us' }}</a>
            </div>
        </div>
    </div>
</section>

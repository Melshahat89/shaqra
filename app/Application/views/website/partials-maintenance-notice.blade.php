@if(config('app.payments_disabled'))
{{-- Maintenance notice: toggled by PAYMENTS_DISABLED in .env --}}
<div role="alert" style="background:#fdecea;border:2px solid #c62828;border-radius:8px;color:#b71c1c;margin:32px 16px;padding:20px 24px;text-align:center;font-size:20px;font-weight:700;line-height:1.7;">
    &#9888; الموقع تحت الصيانة حالياً، وخدمة الدفع متوقفة مؤقتاً. نعتذر عن الإزعاج.
</div>
@endif

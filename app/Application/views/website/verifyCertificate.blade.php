@extends(layoutExtend('website'))

@section('title'){{ trans('page.Certificate Verification') }}@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
@endpush

@section('content')
<div class="dga-home" dir="rtl" lang="ar">

    <section class="dga-page-hero">
        <div class="dga-hero-overlay"></div>
        <div class="dga-page-hero-inner">
            <nav class="dga-breadcrumb" aria-label="مسار التنقل">
                <a href="{{ url('/') }}">الرئيسية</a>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
                <span>{{ trans('page.Certificate Verification') }}</span>
            </nav>
            <h1 class="dga-page-title">{{ trans('page.Certificate Verification') }}</h1>
            <p class="dga-page-sub">تحقق من صحة الشهادات الصادرة من المنصة عبر إدخال رقم الشهادة</p>
        </div>
    </section>

    <section class="dga-sec">
        <div class="dga-wrap dga-wrap--narrow">

            <div class="dga-verify-card">
                <div class="dga-verify-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <h2>أدخل رقم الشهادة</h2>
                <p>تأكد من صحة وموثوقية أي شهادة صادرة من المنصة</p>

                <form id="verify-certificate" action="{{ concatenateLangToUrl('verifycertificate') }}" method="post" class="dga-form">
                    @csrf
                    <div class="dga-form-group">
                        <label for="certificate_id">{{ trans('page.Certificate ID') }}</label>
                        <input id="certificate_id" type="text" name="certificate_id"
                               placeholder="* {{ trans('page.Certificate ID') }}" required autofocus>
                    </div>
                    <button type="submit" class="dga-btn dga-btn-green">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        {{ trans('page.search') }}
                    </button>
                </form>
            </div>

            @if(isset($certificate))
            <div class="dga-verify-result">
                <div class="dga-verify-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="9 12 11 14 15 10"/></svg>
                    شهادة صالحة وموثقة
                </div>
                <table class="dga-table" id="certificatesVerification">
                    <thead>
                        <tr>
                            <th>رقم الشهادة</th>
                            <th>المتدرب</th>
                            <th>الدورة</th>
                            <th>تاريخ الإصدار</th>
                            <th>إجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $certificate->id }}</td>
                            <td>{{ $certificate->user->name }}</td>
                            <td>{{ $certificate->quiz->courses->title_lang }}</td>
                            <td>{{ $certificate->created_at }}</td>
                            <td>
                                <a href="{{ url(env('CERTIFICATE_PATH_1') . '/' . getCertificateFromId($certificate->id)) }}" target="_blank" class="dga-btn dga-btn-sm dga-btn-green">
                                    {{ trans('page.View') }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </section>

</div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    if ($('#certificatesVerification').length) {
        $('#certificatesVerification').DataTable({
            searching: false,
            lengthChange: false,
            info: true,
            scrollX: true,
            order: [[0, 'desc']]
        });
    }
});
</script>
@endpush

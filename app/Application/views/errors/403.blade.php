<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ getDir() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ getDir() == 'rtl' ? 'غير مصرح (403)' : 'Forbidden (403)' }} | {{ config('app.name') }}</title>

    <link href="{{ asset('website') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('website') }}/css/front/dga-design-system.css" rel="stylesheet">
    @if(getDir() == 'rtl')
        <link href="{{ asset('website') }}/css/front/custom-rtl.css" rel="stylesheet">
    @else
        <link href="{{ asset('website') }}/css/front/custom.css" rel="stylesheet">
    @endif
    <style>
        .error-nav { background:#00261E; padding:14px 24px; display:flex; align-items:center; justify-content:space-between; }
        .error-nav a { color:#fff; text-decoration:none; }
        .error-nav img { height:40px; }
        .error-body { display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:calc(100vh - 60px); text-align:center; padding:40px 20px; }
        .error-code { font-size:120px; font-weight:800; color:#7c3aed; line-height:1; }
        .error-title { font-size:24px; font-weight:700; color:#1a1a2e; margin:12px 0 8px; }
        .error-desc { color:#6b7280; max-width:420px; margin:0 auto 28px; }
    </style>
</head>
<body>

<nav class="error-nav" aria-label="{{ getDir() == 'rtl' ? 'التنقل الرئيسي' : 'Main navigation' }}">
    <a href="/">
        <img src="{{ asset('website') }}/images/shaqracs.svg" alt="{{ config('app.name') }}">
    </a>
    <div style="display:flex;gap:16px;">
        <a href="/">{{ getDir() == 'rtl' ? 'الرئيسية' : 'Home' }}</a>
        <a href="{{ url('contact') }}">{{ getDir() == 'rtl' ? 'الدعم' : 'Support' }}</a>
    </div>
</nav>

<main class="error-body" id="main-content">
    <div class="error-code" aria-hidden="true">403</div>
    <h1 class="error-title">
        {{ getDir() == 'rtl' ? 'غير مصرح بالوصول' : 'Access Forbidden' }}
    </h1>
    <p class="error-desc">
        @if(isset($exception) && $exception->getMessage())
            {{ $exception->getMessage() }}
        @else
            {{ getDir() == 'rtl'
                ? 'ليس لديك صلاحية للوصول إلى هذه الصفحة.'
                : 'You do not have permission to access this page.' }}
        @endif
    </p>
    <a href="/" class="dga-btn dga-btn-green">
        {{ getDir() == 'rtl' ? 'العودة للرئيسية' : 'Back to Home' }}
    </a>
</main>

</body>
</html>

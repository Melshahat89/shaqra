@extends(layoutExtend('website'))

@section('title'){{ getDir() == 'rtl' ? 'غير مصرح بالوصول (403)' : 'Access Denied (403)' }} | {{ trans('home.HomeTitle') }}@endsection
@section('description'){{ getDir() == 'rtl' ? 'ليس لديك صلاحية الوصول إلى هذه الصفحة' : 'You do not have permission to access this page' }}@endsection

@section('content')
@include('errors.partials.dga-error', [
    'code'  => '403',
    'title' => getDir() == 'rtl' ? 'غير مصرح بالوصول' : 'Access Denied',
    'desc'  => getDir() == 'rtl' ? 'عذراً، ليس لديك صلاحية الوصول إلى هذه الصفحة. سجّل الدخول بحساب مخوّل أو تواصل مع الدعم الفني.' : 'Sorry, you do not have permission to access this page. Sign in with an authorised account or contact support.',
])
@endsection

@extends(layoutExtend('website'))

@section('title'){{ getDir() == 'rtl' ? 'الصفحة غير موجودة (404)' : 'Page Not Found (404)' }} | {{ trans('home.HomeTitle') }}@endsection
@section('description'){{ getDir() == 'rtl' ? 'الصفحة التي تبحث عنها غير موجودة' : 'The page you are looking for does not exist' }}@endsection

@section('content')
@include('errors.partials.dga-error', [
    'code'  => '404',
    'title' => getDir() == 'rtl' ? 'الصفحة غير موجودة' : 'Page Not Found',
    'desc'  => getDir() == 'rtl' ? 'عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها. تحقق من الرابط أو عد إلى الصفحة الرئيسية.' : 'Sorry, the page you are looking for does not exist or has been moved. Check the link or go back to the home page.',
])
@endsection

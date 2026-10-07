@extends(layoutExtend('website'))

@section('title'){{ getDir() == 'rtl' ? 'خطأ في الخادم (500)' : 'Server Error (500)' }} | {{ trans('home.HomeTitle') }}@endsection
@section('description'){{ getDir() == 'rtl' ? 'حدث خطأ غير متوقع' : 'An unexpected error occurred' }}@endsection

@section('content')
@include('errors.partials.dga-error', [
    'code'  => '500',
    'title' => getDir() == 'rtl' ? 'خطأ في الخادم' : 'Server Error',
    'desc'  => getDir() == 'rtl' ? 'عذراً، حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى أو التواصل مع الدعم الفني.' : 'Sorry, an unexpected error occurred. Please try again or contact support.',
])
@endsection

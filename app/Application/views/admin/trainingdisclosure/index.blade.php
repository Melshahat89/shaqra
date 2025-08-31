@extends(layoutExtend())

@section('title')
     {{ trans('trainingdisclosure.trainingdisclosure') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('admin/trainingdisclosure/pluck') }}" ><i class="fa fa-trash"></i></button>
    <button class="btn btn-success" onclick="checkAll(this)"  ><i class="fa fa-check-circle"></i> </button>
    <button class="btn btn-warning" onclick="unCheckAll(this)"  ><i class="fa fa-close"></i>  </button>
@endpush

@push('search')
    <form method="get" class="form-inline">
        <div class="form-group">
            <input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans('admin.from') }}" value="{{ request()->has('from') ? request()->get('from') : '' }}">
        </div>
        <div class="form-group">
            <input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans('admin.to') }}" value="{{ request()->has('to') ? request()->get('to') : '' }}">
        </div>
		<div class="form-group">
			<input type="text" name="name" class="form-control " placeholder="{{ trans("trainingdisclosure.name") }}" value="{{ request()->has("name") ? request()->get("name") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="email" class="form-control " placeholder="{{ trans("trainingdisclosure.email") }}" value="{{ request()->has("email") ? request()->get("email") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="phone" class="form-control " placeholder="{{ trans("trainingdisclosure.phone") }}" value="{{ request()->has("phone") ? request()->get("phone") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="country" class="form-control " placeholder="{{ trans("trainingdisclosure.country") }}" value="{{ request()->has("country") ? request()->get("country") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="company" class="form-control " placeholder="{{ trans("trainingdisclosure.company") }}" value="{{ request()->has("company") ? request()->get("company") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="numberoftrainees" class="form-control " placeholder="{{ trans("trainingdisclosure.numberoftrainees") }}" value="{{ request()->has("numberoftrainees") ? request()->get("numberoftrainees") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="websiteurl" class="form-control " placeholder="{{ trans("trainingdisclosure.websiteurl") }}" value="{{ request()->has("websiteurl") ? request()->get("websiteurl") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="service" class="form-control " placeholder="{{ trans("trainingdisclosure.service") }}" value="{{ request()->has("service") ? request()->get("service") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/trainingdisclosure') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('trainingdisclosure.trainingdisclosure') , 'model' => 'trainingdisclosure' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection
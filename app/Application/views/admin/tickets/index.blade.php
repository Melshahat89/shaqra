@extends(layoutExtend())

@section('title')
     {{ trans('tickets.tickets') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/tickets/pluck') }}" ><i class="fa fa-trash"></i></button>
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
			<input type="text" name="reciver_id" class="form-control " placeholder="{{ trans("tickets.reciver_id") }}" value="{{ request()->has("reciver_id") ? request()->get("reciver_id") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="status" class="form-control " placeholder="{{ trans("tickets.status") }}" value="{{ request()->has("status") ? request()->get("status") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="type" class="form-control " placeholder="{{ trans("tickets.type") }}" value="{{ request()->has("type") ? request()->get("type") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="title" class="form-control " placeholder="{{ trans("tickets.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="message" class="form-control " placeholder="{{ trans("tickets.message") }}" value="{{ request()->has("message") ? request()->get("message") : "" }}">
		</div>
		<div class="form-group">
			<input type="text" name="priority" class="form-control " placeholder="{{ trans("tickets.priority") }}" value="{{ request()->has("priority") ? request()->get("priority") : "" }}">
		</div>

        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/tickets') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>
@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('tickets.tickets') , 'model' => 'tickets' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection
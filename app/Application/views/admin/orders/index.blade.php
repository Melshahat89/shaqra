<?php

use App\Application\Model\User;

?>
@extends(layoutExtend())

@section('title')
     {{ trans('orders.orders') }} {{ trans('home.control') }}
@endsection

@section('style')
    @include('admin.shared.style')
@endsection

@push('header')
    <button class="btn btn-danger" onclick="deleteThemAll(this)" data-link="{{ url('lazyadmin/orders/pluck') }}" ><i class="fa fa-trash"></i></button>
    <button class="btn btn-success" onclick="checkAll(this)"  ><i class="fa fa-check-circle"></i> </button>
    <button class="btn btn-warning" onclick="unCheckAll(this)"  ><i class="fa fa-close"></i>  </button>
@endpush

<?php //dd($data); ?>
@push('search')
    <form method="get" class="form-inline">
        <div class="form-group">
            <input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans('admin.from') }}" value="{{ request()->has('from') ? request()->get('from') : '' }}">
        </div>
        <div class="form-group">
            <input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans('admin.to') }}" value="{{ request()->has('to') ? request()->get('to') : '' }}">
        </div>
		<div class="form-group">
            {{ Form::select('status', order_status(),null,['class' => 'form-control']) }}
        </div>
		<div class="form-group">
            {{ Form::select('tamara', ['' => 'Tamara' , 1 => 'Yes' , 0 => 'No'],null,['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::select('free', order_free(),null,['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::select('orderType', order_type(),null,['class' => 'form-control', 'placeholder' => 'Order Type']) }}
        </div>
        <div class="form-group">
			<input type="text" name="email" class="form-control " placeholder="User email" value="">
		</div>
        @if(Auth::user()->group_id == User::TYPE_ADMIN || Auth::user()->group_id == User::TYPE_ACCOUNTANT || Auth::user()->group_id == User::TYPE_SALES_MANAGER)
        <div class="form-group">
            {{ Form::select('employee', salesAgents(),null,['class' => 'form-control', 'placeholder' => 'Select Employee']) }}
		</div>
        @endif
        <button class="btn btn-success" type="submit" ><i class="fa fa-search"></i></button>
        <a href="{{ url('lazyadmin/orders') }}" class="btn btn-danger" ><i class="fa fa-close"></i></a>
    </form>

    <a class="dt-button buttons-excel btn btn-primary btn-sm m-r-xs m-b-xs waves-effect" 
    tabindex="0" aria-controls="dataTableBuilder" href="{{Request::fullUrl()}}&action=excel"><span>
        <i class="fa fa-file-excel-o"></i> Custom Export</span>
    </a>


@endpush

@section('content')
    @include(layoutTable() , ['title' => trans('orders.orders') , 'model' => 'orders' , 'table' => $dataTable->table([] , true) ])
@endsection

@section('script')
    @include('admin.shared.scripts')
@endsection
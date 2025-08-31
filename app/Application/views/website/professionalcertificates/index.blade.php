@extends(layoutExtend('website'))

@section('title')
     {{ trans('professionalcertificates.professionalcertificates') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.professionalcertificates') }}</h1></div>
     <div><a href="{{ url('professionalcertificates/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.professionalcertificates') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="startdate" class="form-control datepicker2" placeholder="{{ trans("professionalcertificates.startdate") }}" value="{{ request()->has("startdate") ? request()->get("startdate") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="appointment" class="form-control select2" placeholder="{{ trans("professionalcertificates.appointment") }}" > 
				<option value="1" {{ request()->has("appointment") && request()->get("appointment") === 1 ? "selected" : "" }}>{{trans("professionalcertificates.Yes") }} </option> 
				<option value="0" {{request()->has("appointment") && request()->get("appointment") === 0 ? "selected" : "" }}>{{trans("professionalcertificates.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="days" class="form-control " placeholder="{{ trans("professionalcertificates.days") }}" value="{{ request()->has("days") ? request()->get("days") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="hours" class="form-control " placeholder="{{ trans("professionalcertificates.hours") }}" value="{{ request()->has("hours") ? request()->get("hours") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="seats" class="form-control " placeholder="{{ trans("professionalcertificates.seats") }}" value="{{ request()->has("seats") ? request()->get("seats") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="registrationdeadline" class="form-control " placeholder="{{ trans("professionalcertificates.registrationdeadline") }}" value="{{ request()->has("registrationdeadline") ? request()->get("registrationdeadline") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("professionalcertificates") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("professionalcertificates.startdate") }}</th> 
				<th>{{ trans("professionalcertificates.edit") }}</th> 
				<th>{{ trans("professionalcertificates.show") }}</th> 
				<th>{{
            trans("professionalcertificates.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->startdate , 20) }}</td> 
				<td> @include("website.professionalcertificates.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.professionalcertificates.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.professionalcertificates.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection

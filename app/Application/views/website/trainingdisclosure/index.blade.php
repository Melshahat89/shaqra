@extends(layoutExtend('website'))

@section('title')
     {{ trans('trainingdisclosure.trainingdisclosure') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.trainingdisclosure') }}</h1></div>
     <div><a href="{{ url('trainingdisclosure/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.trainingdisclosure') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
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
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("trainingdisclosure") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("trainingdisclosure.name") }}</th> 
				<th>{{ trans("trainingdisclosure.edit") }}</th> 
				<th>{{ trans("trainingdisclosure.show") }}</th> 
				<th>{{
            trans("trainingdisclosure.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{ str_limit($d->name , 20) }}</td> 
				<td> @include("website.trainingdisclosure.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.trainingdisclosure.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.trainingdisclosure.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection

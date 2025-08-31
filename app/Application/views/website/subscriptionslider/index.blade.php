@extends(layoutExtend('website'))

@section('title')
     {{ trans('subscriptionslider.subscriptionslider') }} {{ trans('home.control') }}
@endsection

@section('content')
 <div class="pull-{{ getDirection() }} col-lg-9">
    <div><h1>{{ trans('website.subscriptionslider') }}</h1></div>
     <div><a href="{{ url('subscriptionslider/item') }}" class="btn btn-default"><i class="fa fa-plus"></i> {{ trans('website.subscriptionslider') }}</a><br></div>
 	<form method="get" class="form-inline">
		<div class="form-group">
			<input type="text" name="from" class="form-control datepicker2" placeholder="{{ trans("admin.from") }}"value="{{ request()->has("from") ? request()->get("from") : "" }}">
		 </div>
		<div class="form-group">
			<input type="text" name="to" class="form-control datepicker2" placeholder="{{ trans("admin.to") }}"value="{{ request()->has("to") ? request()->get("to") : "" }}">
		</div>
		<div class="form-group"> 
			<input type="text" name="title" class="form-control " placeholder="{{ trans("subscriptionslider.title") }}" value="{{ request()->has("title") ? request()->get("title") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="description" class="form-control " placeholder="{{ trans("subscriptionslider.description") }}" value="{{ request()->has("description") ? request()->get("description") : "" }}"> 
		</div> 
		<div class="form-group" > 
			<select style="width:80px;" name="status" class="form-control select2" placeholder="{{ trans("subscriptionslider.status") }}" > 
				<option value="1" {{ request()->has("status") && request()->get("status") === 1 ? "selected" : "" }}>{{trans("subscriptionslider.Yes") }} </option> 
				<option value="0" {{request()->has("status") && request()->get("status") === 0 ? "selected" : "" }}>{{trans("subscriptionslider.No") }} </option> 
			</select> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="cta_text" class="form-control " placeholder="{{ trans("subscriptionslider.cta_text") }}" value="{{ request()->has("cta_text") ? request()->get("cta_text") : "" }}"> 
		</div> 
		<div class="form-group"> 
			<input type="text" name="cta_link" class="form-control " placeholder="{{ trans("subscriptionslider.cta_link") }}" value="{{ request()->has("cta_link") ? request()->get("cta_link") : "" }}"> 
		</div> 
		 <button class="btn btn-success" type="submit" ><i class="fa fa-search" ></i ></button>
		<a href="{{ url("subscriptionslider") }}" class="btn btn-danger" ><i class="fa fa-close" ></i></a>
	 </form > 
<br ><table class="table table-responsive table-striped table-bordered"> 
		<thead > 
			<tr> 
				<th>{{ trans("subscriptionslider.title") }}</th> 
				<th>{{ trans("subscriptionslider.edit") }}</th> 
				<th>{{ trans("subscriptionslider.show") }}</th> 
				<th>{{
            trans("subscriptionslider.delete") }}</th> 
				</thead > 
		<tbody > 
		@if (count($items) > 0) 
			@foreach ($items as $d) 
				 <tr>
					<td>{{str_limit($d->title_lang , 20) }}</td> 
				<td> @include("website.subscriptionslider.buttons.edit", ["id" => $d->id])</td> 
					<td> @include("website.subscriptionslider.buttons.view", ["id" => $d->id])</td> 
					<td> @include("website.subscriptionslider.buttons.delete", ["id" => $d->id])</td> 
					</tr> 
					@endforeach
				@endif
			 </tbody > 
		</table > 
	@include(layoutPaginate() , ["items" => $items])
		
</div>
@endsection

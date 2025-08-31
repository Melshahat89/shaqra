@extends(layoutExtend('website'))

@section('title')
    {{ trans('subscriptionslider.subscriptionslider') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('subscriptionslider') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('subscriptionslider/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
             		 <div class="form-group  {{  $errors->has("title.en")  &&  $errors->has("title.ar")  ? "has-error" : "" }}" >
			<label for="title">{{ trans("subscriptionslider.title")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "title", isset($item->title) ? $item->title : old("title") , "text" , "subscriptionslider") !!}
		</div>
			@if ($errors->has("title.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("title.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("title.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("title.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("description.en")  &&  $errors->has("description.ar")  ? "has-error" : "" }}" >
			<label for="description">{{ trans("subscriptionslider.description")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "description", isset($item->description) ? $item->description : old("description") , "textarea" , "subscriptionslider" ) !!}
		</div>
			@if ($errors->has("description.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("description.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("description.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("description.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("image") ? "has-error" : "" }}" > 
			<label for="image">{{ trans("subscriptionslider.image")}}</label>
				@if(isset($item) && $item->image != "")
				<br>
				<img src="{{ small($item->image) }}" class="thumbnail" alt="" width="200">
				<br>
				@endif
				<input type="file" name="image" >
		</div>
			@if ($errors->has("image"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("image") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
			<label for="status">{{ trans("subscriptionslider.status")}}</label>
				 <div class="form-check">
					<label class="form-check-label">
					<input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
					{{ trans("subscriptionslider.No")}}
				 </label > 
				<label class="form-check-label">
				<input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
									{{ trans("subscriptionslider.Yes")}}
				 </label> 
				</div> 		</div>
			@if ($errors->has("status"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("status") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group  {{  $errors->has("cta_text.en")  &&  $errors->has("cta_text.ar")  ? "has-error" : "" }}" >
			<label for="cta_text">{{ trans("subscriptionslider.cta_text")}}</label>
				{!! extractFiled(isset($item) ? $item : null , "cta_text", isset($item->cta_text) ? $item->cta_text : old("cta_text") , "text" , "subscriptionslider") !!}
		</div>
			@if ($errors->has("cta_text.en"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("cta_text.en") }}</strong>
					</span>
				</div>
			@endif
			@if ($errors->has("cta_text.ar"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("cta_text.ar") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("cta_link") ? "has-error" : "" }}" > 
			<label for="cta_link">{{ trans("subscriptionslider.cta_link")}}</label>
				<input type="text" name="cta_link" class="form-control" id="cta_link" value="{{ isset($item->cta_link) ? $item->cta_link : old("cta_link") }}"  placeholder="{{ trans("subscriptionslider.cta_link")}}">
		</div>
			@if ($errors->has("cta_link"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("cta_link") }}</strong>
					</span>
				</div>
			@endif

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.subscriptionslider') }}
                </button>
            </div>
        </form>
</div>
@endsection

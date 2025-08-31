@extends(layoutExtend())

@section('title')
    {{ trans('trainingdisclosure.trainingdisclosure') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('trainingdisclosure.trainingdisclosure') , 'model' => 'trainingdisclosure' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('admin/trainingdisclosure/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

 		 <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}" > 
			<label for="name">{{ trans("trainingdisclosure.name")}}</label>
				<input type="text" name="name" class="form-control" id="name" value="{{ isset($item->name) ? $item->name : old("name") }}"  placeholder="{{ trans("trainingdisclosure.name")}}">
		</div>
			@if ($errors->has("name"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("name") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("email") ? "has-error" : "" }}" > 
			<label for="email">{{ trans("trainingdisclosure.email")}}</label>
				<input type="text" name="email" class="form-control" id="email" value="{{ isset($item->email) ? $item->email : old("email") }}"  placeholder="{{ trans("trainingdisclosure.email")}}">
		</div>
			@if ($errors->has("email"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("email") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("phone") ? "has-error" : "" }}" > 
			<label for="phone">{{ trans("trainingdisclosure.phone")}}</label>
				<input type="text" name="phone" class="form-control" id="phone" value="{{ isset($item->phone) ? $item->phone : old("phone") }}"  placeholder="{{ trans("trainingdisclosure.phone")}}">
		</div>
			@if ($errors->has("phone"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("phone") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("country") ? "has-error" : "" }}" > 
			<label for="country">{{ trans("trainingdisclosure.country")}}</label>
				<input type="text" name="country" class="form-control" id="country" value="{{ isset($item->country) ? $item->country : old("country") }}"  placeholder="{{ trans("trainingdisclosure.country")}}">
		</div>
			@if ($errors->has("country"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("country") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("company") ? "has-error" : "" }}" > 
			<label for="company">{{ trans("trainingdisclosure.company")}}</label>
				<input type="text" name="company" class="form-control" id="company" value="{{ isset($item->company) ? $item->company : old("company") }}"  placeholder="{{ trans("trainingdisclosure.company")}}">
		</div>
			@if ($errors->has("company"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("company") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("numberoftrainees") ? "has-error" : "" }}" > 
			<label for="numberoftrainees">{{ trans("trainingdisclosure.numberoftrainees")}}</label>
				<input type="text" name="numberoftrainees" class="form-control" id="numberoftrainees" value="{{ isset($item->numberoftrainees) ? $item->numberoftrainees : old("numberoftrainees") }}"  placeholder="{{ trans("trainingdisclosure.numberoftrainees")}}">
		</div>
			@if ($errors->has("numberoftrainees"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("numberoftrainees") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("websiteurl") ? "has-error" : "" }}" > 
			<label for="websiteurl">{{ trans("trainingdisclosure.websiteurl")}}</label>
				<input type="text" name="websiteurl" class="form-control" id="websiteurl" value="{{ isset($item->websiteurl) ? $item->websiteurl : old("websiteurl") }}"  placeholder="{{ trans("trainingdisclosure.websiteurl")}}">
		</div>
			@if ($errors->has("websiteurl"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("websiteurl") }}</strong>
					</span>
				</div>
			@endif
		 <div class="form-group {{ $errors->has("service") ? "has-error" : "" }}" > 
			<label for="service">{{ trans("trainingdisclosure.service")}}</label>
				<input type="text" name="service" class="form-control" id="service" value="{{ isset($item->service) ? $item->service : old("service") }}"  placeholder="{{ trans("trainingdisclosure.service")}}">
		</div>
			@if ($errors->has("service"))
				<div class="alert alert-danger">
					<span class='help-block'>
						<strong>{{ $errors->first("service") }}</strong>
					</span>
				</div>
			@endif


            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('trainingdisclosure.trainingdisclosure') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection

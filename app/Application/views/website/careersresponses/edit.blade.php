@extends(layoutExtend('website'))
 @section('title')
    {{ trans('careersresponses.careersresponses') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('careersresponses') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('careersresponses/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.careersresponses.relation.careers.edit")
                <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}" > 
   <label for="name">{{ trans("careersresponses.name")}}</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ isset($item->name) ? $item->name : old("name") }}"  placeholder="{{ trans("careersresponses.name")}}">
  </div>
   @if ($errors->has("name"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("name") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("email") ? "has-error" : "" }}" > 
   <label for="email">{{ trans("careersresponses.email")}}</label>
    <input type="text" name="email" class="form-control" id="email" value="{{ isset($item->email) ? $item->email : old("email") }}"  placeholder="{{ trans("careersresponses.email")}}">
  </div>
   @if ($errors->has("email"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("email") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("mobile") ? "has-error" : "" }}" > 
   <label for="mobile">{{ trans("careersresponses.mobile")}}</label>
    <input type="text" name="mobile" class="form-control" id="mobile" value="{{ isset($item->mobile) ? $item->mobile : old("mobile") }}"  placeholder="{{ trans("careersresponses.mobile")}}">
  </div>
   @if ($errors->has("mobile"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("mobile") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("file") ? "has-error" : "" }}" > 
   <label for="file">{{ trans("careersresponses.file")}}</label>
    @if(isset($item) && $item->file != "")
    <br>
    <img src="{{ small($item->file) }}" class="thumbnail" alt="" width="200">
    <br>
    @endif
    <input type="file" name="file" >
  </div>
   @if ($errors->has("file"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("file") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.careersresponses') }}
                </button>
            </div>
        </form>
</div>
@endsection

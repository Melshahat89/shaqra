@extends(layoutExtend('website'))
 @section('title')
    {{ trans('lecturequestions.lecturequestions') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
         @include(layoutMessage('website'))
         <a href="{{ url('lecturequestions') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
        <form action="{{ concatenateLangToUrl('lecturequestions/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("website.lecturequestions.relation.courselectures.edit")
            @include("website.lecturequestions.relation.user.edit")
                <div class="form-group {{ $errors->has("question_title") ? "has-error" : "" }}" > 
   <label for="question_title">{{ trans("lecturequestions.question_title")}}</label>
    <input type="text" name="question_title" class="form-control" id="question_title" value="{{ isset($item->question_title) ? $item->question_title : old("question_title") }}"  placeholder="{{ trans("lecturequestions.question_title")}}">
  </div>
   @if ($errors->has("question_title"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("question_title") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("question_description") ? "has-error" : "" }}" > 
   <label for="question_description">{{ trans("lecturequestions.question_description")}}</label>
    <textarea name="question_description" class="form-control" id="question_description"   placeholder="{{ trans("lecturequestions.question_description")}}" >{{isset($item->question_description) ? $item->question_description : old("question_description") }}</textarea >
  </div>
   @if ($errors->has("question_description"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("question_description") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("approve") ? "has-error" : "" }}" > 
   <label for="approve">{{ trans("lecturequestions.approve")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="approve" {{ isset($item->approve) && $item->approve == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("lecturequestions.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="approve" {{ isset($item->approve) && $item->approve == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("lecturequestions.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("approve"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("approve") }}</strong>
     </span>
    </div>
   @endif
             <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="fa fa-save"></i>
                    {{ trans('website.Update') }}  {{ trans('website.lecturequestions') }}
                </button>
            </div>
        </form>
</div>
@endsection

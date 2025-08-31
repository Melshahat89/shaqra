@extends(layoutExtend())
 @section('title')
    {{ trans('courseenrollment.courseenrollment') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('courseenrollment.courseenrollment') , 'model' => 'courseenrollment' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form class="card-body" action="{{ concatenateLangToUrl('lazyadmin/courseenrollment/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.courseenrollment.relation.courses.edit")
            @include("admin.courseenrollment.relation.user.edit")
     <div class="form-group {{ $errors->has("start_time") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="start_time">{{ trans("courseenrollment.start_time")}}</label>
    <input type="date" name="start_time" class="form-control" id="start_time" value="{{ isset($item->start_time) ? $item->start_time : old("start_time") }}"  placeholder="{{ trans("courseenrollment.start_time")}}">
  </div>
   @if ($errors->has("start_time"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("start_time") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("end_time") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="end_time">{{ trans("courseenrollment.end_time")}}</label>
    <input type="date" name="end_time" class="form-control" id="end_time" value="{{ isset($item->end_time) ? $item->end_time : old("end_time") }}"  placeholder="{{ trans("courseenrollment.end_time")}}">
  </div>
   @if ($errors->has("end_time"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("end_time") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="status">{{ trans("courseenrollment.status")}}</label>
     <div class="form-check">
     <label class="form-check-label">
     <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 0 ? "checked" : "" }} type="radio" value="0" > 
     {{ trans("courseenrollment.No")}}
     </label > 
    <label class="form-check-label">
    <input class="form-check-input" name="status" {{ isset($item->status) && $item->status == 1 ? "checked" : "" }} type="radio" value="1" > 
         {{ trans("courseenrollment.Yes")}}
     </label> 
    </div> 		</div>
   @if ($errors->has("status"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("status") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-info w-md" >
                    <i class="material-icons">pageview</i>
                    {{ trans('home.save') }}  {{ trans('courseenrollment.courseenrollment') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection

<script>
  


</script>
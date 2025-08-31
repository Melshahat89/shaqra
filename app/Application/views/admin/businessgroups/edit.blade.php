@extends(layoutExtend())
 @section('title')
    {{ trans('businessgroups.businessgroups') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('businessgroups.businessgroups') , 'model' => 'businessgroups' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form class="card-body" action="{{ concatenateLangToUrl('lazyadmin/businessgroups/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.businessgroups.relation.businessdata.edit")
     <div class="form-group {{ $errors->has("name") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="name">{{ trans("businessgroups.name")}}</label>
    <input type="text" name="name" class="form-control" id="name" value="{{ isset($item->name) ? $item->name : old("name") }}"  placeholder="{{ trans("businessgroups.name")}}">
  </div>
   @if ($errors->has("name"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("name") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("parent_id") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="parent_id">{{ trans("businessgroups.parent_id")}}</label>
    <input type="text" name="parent_id" class="form-control" id="parent_id" value="{{ isset($item->parent_id) ? $item->parent_id : old("parent_id") }}"  placeholder="{{ trans("businessgroups.parent_id")}}">
  </div>
   @if ($errors->has("parent_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("parent_id") }}</strong>
     </span>
    </div>
   @endif
              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-info w-md" >
                    <i class="material-icons">pageview</i>
                    {{ trans('home.save') }}  {{ trans('businessgroups.businessgroups') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection

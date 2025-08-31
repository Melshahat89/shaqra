@extends(layoutExtend())
 @section('title')
    {{ trans('ordersposition.ordersposition') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('ordersposition.ordersposition') , 'model' => 'ordersposition' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())
        <form class="card-body" action="{{ concatenateLangToUrl('lazyadmin/ordersposition/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.ordersposition.relation.events.edit")
            @include("admin.ordersposition.relation.user.edit")
            @include("admin.ordersposition.relation.courses.edit")
            @include("admin.ordersposition.relation.orders.edit")
     <div class="form-group {{ $errors->has("amount") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="amount">{{ trans("ordersposition.amount")}}</label>
    <input type="text" name="amount" class="form-control" id="amount" value="{{ isset($item->amount) ? $item->amount : old("amount") }}"  placeholder="{{ trans("ordersposition.amount")}}">
  </div>
   @if ($errors->has("amount"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("amount") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("notes") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="notes">{{ trans("ordersposition.notes")}}</label>
    <input type="text" name="notes" class="form-control" id="notes" value="{{ isset($item->notes) ? $item->notes : old("notes") }}"  placeholder="{{ trans("ordersposition.notes")}}">
  </div>
   @if ($errors->has("notes"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("notes") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("certificate_id") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="certificate_id">{{ trans("ordersposition.certificate_id")}}</label>
    <input type="text" name="certificate_id" class="form-control" id="certificate_id" value="{{ isset($item->certificate_id) ? $item->certificate_id : old("certificate_id") }}"  placeholder="{{ trans("ordersposition.certificate_id")}}">
  </div>
   @if ($errors->has("certificate_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("certificate_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("shipping_id") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="shipping_id">{{ trans("ordersposition.shipping_id")}}</label>
    <input type="text" name="shipping_id" class="form-control" id="shipping_id" value="{{ isset($item->shipping_id) ? $item->shipping_id : old("shipping_id") }}"  placeholder="{{ trans("ordersposition.shipping_id")}}">
  </div>
   @if ($errors->has("shipping_id"))
    <div class="alert alert-danger">
     <span class='help-block'>
      <strong>{{ $errors->first("shipping_id") }}</strong>
     </span>
    </div>
   @endif
   <div class="form-group {{ $errors->has("status") ? "has-error" : "" }}" > 
   <label class="col-md-2 col-form-label" for="status">{{ trans("ordersposition.status")}}</label>
    <input type="text" name="status" class="form-control" id="status" value="{{ isset($item->status) ? $item->status : old("status") }}"  placeholder="{{ trans("ordersposition.status")}}">
  </div>
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
                    {{ trans('home.save') }}  {{ trans('ordersposition.ordersposition') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection

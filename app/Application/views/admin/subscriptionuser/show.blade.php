@extends(layoutExtend())
 @section('title')
    {{ trans('subscriptionuser.subscriptionuser') }} {{ trans('home.view') }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('subscriptionuser.subscriptionuser') , 'model' => 'subscriptionuser' , 'action' => trans('home.view')  ])
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("subscriptionuser.subscription_id") }}</th>
     <td>{{ nl2br($item->subscription_id) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("subscriptionuser.start_date") }}</th>
     <td>{{ nl2br($item->start_date) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("subscriptionuser.end_date") }}</th>
     <td>{{ nl2br($item->end_date) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("subscriptionuser.amount") }}</th>
     <td>{{ nl2br($item->amount) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("subscriptionuser.b_type") }}</th>
     <td>{{ nl2br($item->b_type) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("subscriptionuser.is_active") }}</th>
     <td>
    {{ $item->is_active == 1 ? trans("subscriptionuser.Yes") : trans("subscriptionuser.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("subscriptionuser.is_collected") }}</th>
     <td>
    {{ $item->is_collected == 1 ? trans("subscriptionuser.Yes") : trans("subscriptionuser.No")  }}
     </td>
    </tr>
  </table>
         @include('admin.subscriptionuser.buttons.delete' , ['id' => $item->id])
        @include('admin.subscriptionuser.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection

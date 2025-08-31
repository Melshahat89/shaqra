@extends(layoutExtend())

@section('title')
    {{ trans('subscriptionslider.subscriptionslider') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('subscriptionslider.subscriptionslider') , 'model' => 'subscriptionslider' , 'action' => trans('home.view')  ])
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("subscriptionslider.title") }}</th>
					<td>{{ nl2br($item->title_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("subscriptionslider.description") }}</th>
					<td>{{ nl2br($item->description_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("subscriptionslider.image") }}</th>
					<td>
					<img src="{{ small($item->image) }}" width="100" />
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("subscriptionslider.status") }}</th>
					<td>
				{{ $item->status == 1 ? trans("subscriptionslider.Yes") : trans("subscriptionslider.No")  }}
					</td>
				</tr>
				<tr>
				<th width="200">{{ trans("subscriptionslider.cta_text") }}</th>
					<td>{{ nl2br($item->cta_text_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("subscriptionslider.cta_link") }}</th>
					<td>{{ nl2br($item->cta_link) }}</td>
				</tr>
		</table>

        @include('admin.subscriptionslider.buttons.delete' , ['id' => $item->id])
        @include('admin.subscriptionslider.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection

@extends(layoutExtend('website'))

@section('title')
    {{ trans('subscriptionslider.subscriptionslider') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('subscriptionslider') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
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

        @include('website.subscriptionslider.buttons.delete' , ['id' => $item->id])
        @include('website.subscriptionslider.buttons.edit' , ['id' => $item->id])
</div>
@endsection

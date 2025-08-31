@extends(layoutExtend('website'))

@section('title')
    {{ trans('trainingdisclosure.trainingdisclosure') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('trainingdisclosure') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("trainingdisclosure.name") }}</th>
					<td>{{ nl2br($item->name) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("trainingdisclosure.email") }}</th>
					<td>{{ nl2br($item->email) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("trainingdisclosure.phone") }}</th>
					<td>{{ nl2br($item->phone) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("trainingdisclosure.country") }}</th>
					<td>{{ nl2br($item->country) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("trainingdisclosure.company") }}</th>
					<td>{{ nl2br($item->company) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("trainingdisclosure.numberoftrainees") }}</th>
					<td>{{ nl2br($item->numberoftrainees) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("trainingdisclosure.websiteurl") }}</th>
					<td>{{ nl2br($item->websiteurl) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("trainingdisclosure.service") }}</th>
					<td>{{ nl2br($item->service) }}</td>
				</tr>
		</table>

        @include('website.trainingdisclosure.buttons.delete' , ['id' => $item->id])
        @include('website.trainingdisclosure.buttons.edit' , ['id' => $item->id])
</div>
@endsection

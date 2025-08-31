@extends(layoutExtend('website'))

@section('title')
    {{ trans('achievements.achievements') }} {{ trans('home.view') }}
@endsection

@section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('achievements') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
		 <table class="table table-bordered  table-striped" > 
				<tr>
				<th width="200">{{ trans("achievements.name") }}</th>
					<td>{{ nl2br($item->name_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("achievements.description") }}</th>
					<td>{{ nl2br($item->description_lang) }}</td>
				</tr>
				<tr>
				<th width="200">{{ trans("achievements.logo") }}</th>
					<td>
					<img src="{{ small($item->logo) }}" width="100" />
					</td>
				</tr>
		</table>

        @include('website.achievements.buttons.delete' , ['id' => $item->id])
        @include('website.achievements.buttons.edit' , ['id' => $item->id])
</div>
@endsection

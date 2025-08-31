@extends(layoutExtend())

@section('title')
    {{ trans('achievements.achievements') }} {{ trans('home.view') }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('achievements.achievements') , 'model' => 'achievements' , 'action' => trans('home.view')  ])
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

        @include('admin.achievements.buttons.delete' , ['id' => $item->id])
        @include('admin.achievements.buttons.edit' , ['id' => $item->id])
    @endcomponent
@endsection

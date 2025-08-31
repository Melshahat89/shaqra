<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('trainingdisclosure') }}</h2>
<hr>
@php $sidebarTrainingDisclosure = \App\Application\Model\TrainingDisclosure::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarTrainingDisclosure) > 0)
			@foreach ($sidebarTrainingDisclosure as $d)
				 <div>
					<p><a href="{{ url("trainingdisclosure/".$d->id."/view") }}">{{ str_limit($d->name , 20) }}</a></p > 
					<p><a href="{{ url("trainingdisclosure/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			
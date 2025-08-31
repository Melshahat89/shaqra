<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('trainingdisclosure') }}</h2>
<hr>
@php $sidebarTrainingDisclosure = \App\Application\Model\TrainingDisclosure::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarTrainingDisclosure) > 0)
			@foreach ($sidebarTrainingDisclosure as $d)
				 <div>
					<h2 > {{ str_limit($d->name , 50) }}</h2 > 
					<p> {{ str_limit($d->email , 300) }}</p > 
					<p> {{ str_limit($d->phone , 300) }}</p > 
					 <p><a href="{{ url("trainingdisclosure/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			
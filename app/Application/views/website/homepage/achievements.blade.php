<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('achievements') }}</h2>
<hr>
@php $sidebarAchievements = \App\Application\Model\Achievements::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarAchievements) > 0)
			@foreach ($sidebarAchievements as $d)
				 <div>
					<h2 > {{ str_limit($d->name_lang , 50) }}</h2 > 
					<p> {{ str_limit($d->description_lang , 300) }}</p > 
					 <img src="{{ small($d->logo)}}"  width = "80" />
					 <p><a href="{{ url("achievements/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			
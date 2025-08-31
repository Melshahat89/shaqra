<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('achievements') }}</h2>
<hr>
@php $sidebarAchievements = \App\Application\Model\Achievements::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarAchievements) > 0)
			@foreach ($sidebarAchievements as $d)
				 <div>
					<a href="{{ url("achievements/".$d->id."/view") }}" ><p>{{ str_limit($d->name_lang , 20) }}</a></p > 
					<p><a href="{{ url("achievements/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			
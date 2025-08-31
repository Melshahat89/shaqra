<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('subscriptionslider') }}</h2>
<hr>
@php $sidebarSubscriptionslider = \App\Application\Model\Subscriptionslider::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarSubscriptionslider) > 0)
			@foreach ($sidebarSubscriptionslider as $d)
				 <div>
					<a href="{{ url("subscriptionslider/".$d->id."/view") }}" ><p>{{ str_limit($d->title_lang , 20) }}</a></p > 
					<p><a href="{{ url("subscriptionslider/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			
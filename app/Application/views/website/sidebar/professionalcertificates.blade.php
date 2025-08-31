<h2>{{ ucfirst(trans('admin.Latest'))}} {{ ucfirst('professionalcertificates') }}</h2>
<hr>
@php $sidebarProfessionalcertificates = \App\Application\Model\Professionalcertificates::orderBy("id", "DESC")->limit(5)->get(); @endphp
		@if (count($sidebarProfessionalcertificates) > 0)
			@foreach ($sidebarProfessionalcertificates as $d)
				 <div>
					<p><a href="{{ url("professionalcertificates/".$d->id."/view") }}">{{ str_limit($d->startdate , 20) }}</a></p > 
					<p><a href="{{ url("professionalcertificates/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			
<h2>{{ ucfirst(trans('admin.Random'))}} {{ ucfirst('professionalcertificates') }}</h2>
<hr>
@php $sidebarProfessionalcertificates = \App\Application\Model\Professionalcertificates::inRandomOrder()->limit(5)->get(); @endphp
		@if (count($sidebarProfessionalcertificates) > 0)
			@foreach ($sidebarProfessionalcertificates as $d)
				 <div>
					<h2 > {{ str_limit($d->startdate , 50) }}</h2 > 
					{{ $d->appointment == 1 ? trans("professionalcertificates.Yes") : trans("professionalcertificates.No")  }}
					<p> {{ str_limit($d->days , 300) }}</p > 
					 <p><a href="{{ url("professionalcertificates/".$d->id."/view") }}" ><i class="fa fa-eye" ></i ></a> <small ><i class="fa fa-calendar-o" ></i > {{ $d->created_at }}</small ></p > 
				<hr > 
				</div> 
			@endforeach
		@endif
			
@extends(layoutExtend('website'))
 @section('title')
    {{ trans('professionalcertificates.professionalcertificates') }} {{ trans('home.view') }}
@endsection
 @section('content')
<div class="pull-{{ getDirection() }} col-lg-9">
        <a href="{{ url('professionalcertificates') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{ trans('website.Back') }}  </a>
   <table class="table table-bordered  table-striped" > 
    <tr>
    <th width="200">{{ trans("professionalcertificates.startdate") }}</th>
     <td>{{ nl2br($item->startdate) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("professionalcertificates.appointment") }}</th>
     <td>
    {{ $item->appointment == 1 ? trans("professionalcertificates.Yes") : trans("professionalcertificates.No")  }}
     </td>
    </tr>
    <tr>
    <th width="200">{{ trans("professionalcertificates.days") }}</th>
     <td>{{ nl2br($item->days) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("professionalcertificates.hours") }}</th>
     <td>{{ nl2br($item->hours) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("professionalcertificates.seats") }}</th>
     <td>{{ nl2br($item->seats) }}</td>
    </tr>
    <tr>
    <th width="200">{{ trans("professionalcertificates.registrationdeadline") }}</th>
     <td>{{ nl2br($item->registrationdeadline) }}</td>
    </tr>
  </table>
         @include('website.professionalcertificates.buttons.delete' , ['id' => $item->id])
        @include('website.professionalcertificates.buttons.edit' , ['id' => $item->id])
</div>
@endsection

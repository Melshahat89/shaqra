@extends(layoutExtend('website'))

@section('title'){{ trans('careers.careers') }} | {{ trans('home.HomeTitle') }}@endsection
@section('description'){{ trans('home.HomeDescription') }}@endsection

@push('css')
  <style>
    .loading { display: none !important; }
  </style>
@endpush

@section('content')
<div dir="rtl" lang="ar">

@include('website.theme.bootstrap.layout.igts.shared.innerPagesHead', ['title' => trans('careers.careers')])

@if($careers)
<section class="careers-content">
  <div class="container">
    <div id="accordion">

    @foreach($careers as $index => $career)
      @php $uid = 'career-' . $career->id; @endphp
      <div class="card mb-10">
        <div class="card-header" id="heading-{{$uid}}">
          <h2 class="mb-0">
            <a class="btn btn-link flexBetween"
               data-toggle="collapse"
               data-target="#collapse-{{$uid}}"
               aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
               aria-controls="collapse-{{$uid}}">
              <span>{{$career->title_lang}}</span>
              <i class="fa" aria-hidden="true"></i>
            </a>
          </h2>
        </div>

        <div id="collapse-{{$uid}}"
             class="collapse {{ $index === 0 ? 'show' : '' }}"
             aria-labelledby="heading-{{$uid}}"
             data-parent="#accordion">
          <div class="card-body">
            <div class="careers-contetn-area">
              @if($career->image)
              <div class="d-flex justify-content-center">
                <img src="{{large1($career->image)}}" class="w-100" alt="{{ $career->title_lang }}">
              </div>
              @endif
              {!! $career->description_lang !!}
            </div>
            <div class="text-right">
              <a class="add-to-cart" target="_blank" rel="noopener" href="{{$career->link}}">
                {{ trans('careers.Apply Now') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    </div>
  </div>
</section>
@endif

{{-- Apply modal --}}
<div class="modal fade" id="applymodal" tabindex="-1" role="dialog" aria-labelledby="applymodalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header flexRight">
        <h5 class="modal-title" id="applymodalTitle">{{ trans('careers.Apply Now') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('website.Close') }}">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="login-form" action="{{ concatenateLangToUrl('careers') }}" name="careerForm" method="post">
          @csrf
          <div class="dga-form-group">
            <label for="career-job-title">{{ trans('careers.careers') }}</label>
            <input id="career-job-title" type="text" class="form-control input-item" name="job_title" placeholder="{{ trans('careers.careers') }}" required aria-required="true">
          </div>

          <div class="dga-form-group mt-3">
            <label for="career-cv">{{ trans('careers.Apply Now') }}</label>
            <input id="career-cv" type="file" name="chooseFile" class="form-control-file">
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="add-to-cart">{{ trans('careers.Apply Now') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</div>
@endsection

@extends(layoutExtend())

@section('title')
    {{ trans('admin.Export Model') }}  {{ trans('admin.Import Model') }}
@endsection

@section('content')
    <form class="card-body" action="{{ concatenateLangToUrl('lazyadmin/export') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <div class="">
                        <label class="col-md-2 col-form-label" for="">{{ trans('admin.Export Model') }}</label>
                        <select name="primary_key" id="primary_key" class="form-control" required>
                            @foreach($models as $model)
                                <option value="{{ $model }}">{{ $model }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="{{ trans('admin.Export Model') }}" class="btn btn-default" />
        </div>
    </form>


    <form class="card-body" action="{{ concatenateLangToUrl('lazyadmin/import') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <div class="">
                        <label class="col-md-2 col-form-label" for="">{{ trans('admin.Import Model') }}</label>
                        <input type="file" required name="package">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="{{ trans('admin.Import Model') }}" class="btn btn-default" />
        </div>
    </form>

@endsection


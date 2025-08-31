@extends(layoutExtend())

@section('title')
    {{ trans('log.log') }}
    {{  isset($item) ? trans('curd.edit')  : trans('curd.add')  }}
@endsection

@section('content')
    @component(layoutForm() , ['title' => trans('log.log') , 'action' => isset($item) ? trans('curd.edit')  : trans('curd.add')  ])
    @include(layoutMessage())
        <form class="card-body" action="{{ concatenateLangToUrl('lazyadmin/log/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="form-line">
                    <input type="text" name="name" id="name" class="form-control" value="{{ isset($item) ? $item->name : '' }}"/>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-info w-md" >
                    <i class="material-icons">pageview</i>
                    {{ trans('home.save') }} {{ trans('log.log') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection

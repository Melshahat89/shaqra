@extends(layoutExtend())
@section('title')
    {{ trans('futurex.futurex') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
@section('content')
    @component(layoutForm() , ['title' => trans('futurex.futurex') , 'model' => 'futurex' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
        @include(layoutMessage())
        <form action="{{ concatenateLangToUrl('lazyadmin/futurexPost/'.$course->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}


            @isset($course->futurexid)
                <div class="form-group " >
                    <label for="name">FutureX - {{$course->futurexid}}</label>
                </div>
            @endisset


            <div class="form-group " >
                <label for="name">name</label>
                <input type="text" disabled name="name" class="form-control" id="name" value="{{ isset($name) ? $name : old("name") }}"  placeholder="name">
            </div>


            <div class="form-group " >
                <label for="pacing">pacing</label>
                <input type="text" disabled name="pacing" class="form-control" id="pacing" value="{{ isset($pacing) ? $pacing : old("pacing") }}"  placeholder="pacing">
            </div>



            <label class="col-md-2 col-form-label" for="courseCategory">courseCategory</label>

            <div class="form-group">
                <select id="courseCategory" name="courseCategory"  class="form-control mdb-select select2 md-form" >
                    @foreach( $courseCategory as  $Category)
                        <option value="{{ $Category['id'] }}">{{ $Category['name'] }}</option>
                    @endforeach
                </select>
            </div>



            <label class="col-md-2 col-form-label" for="courseLevel">courseLevel</label>

            <label for="">المستوي :  {{$course['skill_level'] ?  $course->skill_level : 'غير محدد'}} </label>


            <div class="form-group">
                <select id="courseLevel" name="courseLevel"  class="courseLevel form-control mdb-select md-form " >
                    @foreach( $courseLevel as  $Level)
                        <option value="{{ $Level['id'] }}">{{ $Level['name'] }}</option>
                    @endforeach
                </select>
            </div>


            <label class="col-md-2 col-form-label" for="skills">skills</label>

            <div class="form-group">
                <select id="skills" name="skills"  class="skills form-control mdb-select md-form select2" >
                    @foreach( $skills as  $skil)
                        <option value="{{ $skil['id'] }}">{{ $skil['name'] }}</option>
                    @endforeach
                </select>
            </div>


            <label class="col-md-2 col-form-label" for="translations">translations</label>

            <div class="form-group">
                <select id="translations" name="translations"  class="translations form-control mdb-select md-form " >
                    @foreach( $translations as  $tran)
                        <option value="{{ $tran['id'] }}">{{ $tran['name'] }}</option>
                    @endforeach
                </select>
            </div>


            <label class="col-md-2 col-form-label" for="translations">language</label>

            <div class="form-group">
                <select id="language" name="language"  class="translations form-control mdb-select md-form " >
                    @foreach( $translations as  $tran)
                        <option value="{{ $tran['id'] }}">{{ $tran['name'] }}</option>
                    @endforeach
                </select>
            </div>


            <label class="col-md-2 col-form-label" for="tags">tags</label>
            <div class="form-group">
                <select id="tags" name="tags[]" multiple class="tags form-control mdb-select md-form select2" >
                    @foreach( $tags as  $tag)
                        <option value="{{ $tag['id'] }}">{{ $tag['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-default" >
                    <i class="material-icons">check_circle</i>
                    {{ trans('home.save') }}  {{ trans('futurex.futurex') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection

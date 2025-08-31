@extends(layoutExtend())
 @section('title')
    {{ trans('quizquestionschoice.quizquestionschoice') }} {{  isset($item) ? trans('home.edit')  : trans('home.add')  }}
@endsection
 @section('content')
    @component(layoutForm() , ['title' => trans('quizquestionschoice.quizquestionschoice') , 'model' => 'quizquestionschoice' , 'action' => isset($item) ? trans('home.edit')  : trans('home.add')  ])
         @include(layoutMessage())

<script> var i = 0; </script>
        <form class="card-body" action="{{ concatenateLangToUrl('lazyadmin/quizquestionschoice/item') }}{{ isset($item) ? '/'.$item->id : '' }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @include("admin.quizquestionschoice.relation.quizquestions.edit")
     <div class="form-group  {{  $errors->has("choice.en")  &&  $errors->has("choice.ar")  ? "has-error" : "" }}" >
   <label class="col-md-2 col-form-label" for="choice">{{ trans("quizquestionschoice.choice")}}</label>
  </div>
   


  <div class="form-group" >
   <label class="col-md-2 col-form-label" for="choice">Choices</label>
    <div id="laraflat-choice">
     @if(isset($data['allChoices']))
     @php $i = 0; @endphp

       @foreach($data['allChoices'] as $choice)
       @php $i++; @endphp
       {!! extractTextFiledAutoIncrement($choice, "choice", '' , $choice->choice, null, $i) !!}
       @endforeach
      @endif
      <hr>
      <span class="btn btn-success" onclick="AddNewchoice()"><i class="fa fa-plus"></i></span>

     </div>
  </div>


              <div class="form-group">
                <button type="submit" name="submit" class="btn btn-info w-md" >
                    <i class="material-icons">pageview</i>
                    {{ trans('home.save') }}  {{ trans('quizquestionschoice.quizquestionschoice') }}
                </button>
            </div>
        </form>
    @endcomponent
@endsection

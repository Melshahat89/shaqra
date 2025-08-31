<div class=""> 
<div id="addQuestionAlert"></div>

@if(Auth::check() && $enrolled)
<form action="{{ concatenateLangToUrl('lecturequestions/item') }}" id="addQuestionForm-{{ $lectureId }}" class="form-content" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <input type="hidden" name="courselectures_id" value="{{ $lectureId }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

        <div class="input-group">
            <textarea rows="4" name="question_title" type="text" class="form_input" placeholder="{{ trans('courses.add question') }}" aria-label="Your question"></textarea>
        </div>

        <div class="d-flex justify-content-right">
            <button id="question-submit" type="submit" class="button mtmd button_wide button_primary"><i class="fas fa-paper-plane"></i></button>
        </div>
        
    </form>
@elseif(Auth::check())

@else
    <a class="button button_primary_reverse text_capitalize" href="#" data-dismiss="modal" data-remote="/login"data-toggle="modal" data-target="#loginModal">{{ trans('website.Register now to be able to add a comment') }} </a>

@endif

</div>

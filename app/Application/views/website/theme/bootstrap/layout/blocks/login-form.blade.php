@if (isset($errors) && $errors->has('email'))
    <div class="alert alert-danger mb-2" role="alert">{{ $errors->first('email') }}</div>
@endif

@if (isset($errors) && $errors->has('password'))
    <div class="alert alert-danger mb-2" role="alert">{{ $errors->first('password') }}</div>
@endif


<form class="" style="display: block;margin-right: auto; margin-left: auto;" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}


    <!-- Email -->
    <div class="form_row">
        <label for="email-login" class="sr-only">{{ trans('account.email') }}</label>
        <div class="input_with_icon">
            <i class="far fa-envelope" aria-hidden="true"></i>
            <input id="email-login" type="email" class="form-control input-item email-login-ico" name="email" value="{{ old('email') }}" autocomplete="email" placeholder='{{trans('account.email')}}' aria-required="true">
        </div>
    </div>

    <!-- Password -->
    <div class="form_row">
        <label for="password-login" class="sr-only">{{ trans('account.password') }}</label>
        <div class="input_with_icon">
            <i class="fas fa-lock" aria-hidden="true"></i>
            <input id="password-login" type="password" class="form-control input-item password-login-ico" name="password" autocomplete="current-password" placeholder='{{trans('account.password')}}' aria-required="true">
        </div>
    </div>

    <div class="text-center">

        <div class="form_row form_submit">
            <button type="submit" class="signin_btn button button_block button_primary"><span>{{trans('website.Sign in')}}</span></button>
        </div>
        <p class="pt-20">{{trans('website.Forgot your')}} <a href="{{url('/password/reset')}}" class="forget-pass">{{trans('website.password?')}}</a></p>
    </div>

</form>
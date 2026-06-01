@foreach (['name', 'email', 'country_id','nid', 'mobile', 'categories', 'password', 'password_confirmation', 'g-recaptcha-response'] as $field)
    @if (isset($errors) && $errors->has($field))
        <div class="alert alert-danger mb-2" role="alert">{{ $errors->first($field) }}</div>
@endif
@endforeach



<form class="" style="display: block;margin-right: auto; margin-left: auto;" id="register_form" role="form" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <div class="d-flex">
        <!-- Name -->
        <div class="form_row w-50">
            <label for="name" class="sr-only">{{ trans('account.Full Name') }}</label>
            <div class="input_with_icon">
                <i class="far fa-user" aria-hidden="true"></i>
                <input id="name" type="text" class="form-control input-item user-login-ico" name="name" value="{{ isset($userObject->name) ? $userObject->name : old('name') }}" autocomplete="name" placeholder='{{trans('account.Full Name')}}' required aria-required="true">
            </div>
        </div>

        <!-- Email -->
        <div class="form_row w-50">
            <label for="email-register" class="sr-only">{{ trans('account.email') }}</label>
            <div class="input_with_icon">
                <i class="far fa-envelope" aria-hidden="true"></i>
                <input id="email-register" type="email" class="form-control input-item email-login-ico" {{ isset($userObject->email) ? 'readonly' : '' }} name="email" value="{{ isset($userObject->email) ? $userObject->email : old('email') }}" autocomplete="email" placeholder='{{trans('account.email')}}' required aria-required="true">
            </div>
        </div>
    </div>



    <div class="form_row ">
        <div class="input-group" id="drop-down-parent">
            <select class="form-control" id="country-register" name="country_id" required="required">
                <option value="">{{trans('account.Select Country')}}</option>

                @foreach(allCountries() as $key => $country)
                    <option value="{{ $key }}"
                            {{
                                (isset($item->country) && $item->country == $key)
                                ||
                                (old('country_id') && old('country_id') == $key)
//                                ||
//                                (isset($errors) && !$errors->has('mobile'))
                                ? 'selected'
                                : ''
                            }}>
                        {{ $country }}
                    </option>


                @endforeach

            </select>
        </div>
    </div>




    <!-- Phone -->
    <div class="form_row" id="mobile-container" style="display: none;">
        <label for="mobile" class="sr-only">{{ trans('account.mobile') }}</label>
        <div class="d-flex align-items-center">
            <input id="mobile" type="tel" class="form-control input-item mobile-login-ico" name="mobile" value="{{ old('mobile') }}" autocomplete="tel" placeholder='{{trans('account.mobile')}}' required aria-required="true">
            <span id="mobile-code" class="border m-2 p-2"></span>
        </div>
    </div>

    <div class="d-flex">

    <div class="form_row w-50">

{{--        <div class="input-group">--}}
            <select class="form-control input-item user-login-ico" id="categories" name="categories" required="required">
                <option value="">{{trans('account.Select specialization')}}</option>
                @foreach(categoriesList() as $key => $category)
                <option value="{{$key}}" {{ ((isset($item->categories) && $item->categories == $key) || (old('categories') && old('categories') == $key)) ? 'selected' : '' }}> {{$category}} </option>
                @endforeach
            </select>
{{--        </div>--}}
    </div>

    <div class="form_row w-50">
        <label for="nid-register" class="sr-only">{{ trans('account.nid') }}</label>
        <div class="input_with_icon">
            <i class="far fa-id-card" aria-hidden="true"></i>
            <input id="nid-register" type="text" inputmode="numeric" pattern="[0-9]*" class='form-control input-item user-login-ico' {{ isset($userObject->nid) ? 'readonly' : '' }} name="nid"
                   value="{{ isset($userObject->nid) ? $userObject->nid : old('nid') }}"
                   placeholder='{{trans('account.nid')}}' required aria-required="true">
        </div>
    </div>
    </div>




    <div class="d-flex" style="{{ isset($userObject->password) ? 'display: none !important;' : '' }}">
        <!-- Password -->
        <div class="form_row w-50">
            <label for="password-register" class="sr-only">{{ trans('account.password') }}</label>
            <div class="input_with_icon">
                <i class="fas fa-lock" aria-hidden="true"></i>
                <input id="password-register" autocomplete="new-password" type="password" class="form-control input-item password-login-ico {{ isset($userObject->password) ? 'd-none' : '' }}" name="password" placeholder='{{trans('account.password')}}' required aria-required="true">
            </div>
        </div>

        <!-- Repeat Password -->
        <div class="form_row w-50">
            <label for="password_confirmation" class="sr-only">{{ trans('account.password_confirmation') }}</label>
            <div class="input_with_icon">
                <i class="fas fa-lock" aria-hidden="true"></i>
                <input id="password_confirmation" autocomplete="new-password" type="password" class="form-control input-item password-login-ico {{ isset($userObject->password) ? 'd-none' : '' }}" name="password_confirmation" placeholder='{{trans('account.password_confirmation')}}' required aria-required="true">
            </div>
        </div>
    </div>

    <p class="pb-4 pt-4 text-center">{{trans('account.By completing your registeration, you agree to IGTS')}} <a href="{{url('/page/termsOfUse')}}">{{trans('account.Terms and Conditions')}}</a> {{trans('account.and')}} <a href="{{url('/page/privacyPolicy')}}">{{trans('account.Privacy Policy')}}</a></p>

    <input type="hidden" name="facebook_identifier" id="facebook_identifier" value="{{ isset($userObject->facebook_identifier) ? $userObject->facebook_identifier : '' }}">
    <input type="hidden" name="provider" id="provider" value="{{ isset($userObject->provider) ? $userObject->provider : '' }}">
    <input type="hidden" name="token" id="token" value="{{ isset($userObject->token) ? $userObject->token : '' }}">
    <input type="hidden" name="image" id="image" value="{{ isset($userObject->image) ? $userObject->image : '' }}">

    @if(config('services.recaptcha.key'))
    <div class="g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}" data-callback='submitRegisterForm' data-bind="signup_btn_submit">
    </div>
    @endif


    <div class="form_row form_submit">
        <button type="submit" class="signup_btn button button_block button_primary" id="signup_btn_submit"><span>إنشاء حساب</span></button>
    </div>

</form>
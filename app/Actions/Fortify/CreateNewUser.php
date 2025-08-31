<?php

namespace App\Actions\Fortify;

use App\Application\Model\Businessdata;
use App\Application\Model\Businessuserspendingemails;
use App\Application\Model\Categories;
use App\Application\Model\Countries;
use App\Application\Model\FacebookConversionsAPI;
use App\Application\Model\Social;
use App\Application\Model\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'mobile' => 'required|max:15',
            'country_id' => 'required',
            'categories' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            // 'g-recaptcha-response' => 'required|recaptcha',

        ]);
        
        if($validator->fails()){
            Session::put('signupError', true);
        }

        return $validator;
    }


    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        $this->validator($input)->validate();
        

        $country = Countries::find($input['country_id']);


        // check if business
        if (filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {

            $userPending = Businessuserspendingemails::where('email', $input['email'])->first();

            if($userPending) {

                $businessdata = Businessdata::find($userPending->businessdata_id);

                if($businessdata && isValidBusiness($businessdata->id)){

                    if($businessdata->CountEnrollmentsUsers <= $businessdata->licenses){

                        $input['businessdata_id'] = $businessdata->id;

                        if(($businessdata->licenses - $businessdata->CoutEnrollments) <= 5){

                            $notifi =  User::addNotification([$businessdata->user_id], trans('website.The registration package is nearing completion'), trans('website.The registration package is nearing completion'), '/business/settings');

                        }

                    } else {

                        alert()->info(trans('website.Please contact your company for the end of the registration package'), trans('website.Success'));

                    }
                }
            }
        }


        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->mobile = $country->country_phone_code . ltrim(str_replace($country->country_phone_code, "", $input['mobile']),"0");
        $user->password = bcrypt($input['password']);
        $user->categories = $input['categories'];
        $user->group_id = env('DEFAULT_GROUP');
        // $user->verified = (isset($input['facebook_identifier']) && !empty($input['facebook_identifier'])) ? 1 : 0;
        $user->verified = 1;
        $user->activated = env('DEFAULT_activated');
        $user->activation_code = str_random(40);
        $user->businessdata_id = isset($input['businessdata_id']) ?$input['businessdata_id']:null ;

        if($input['facebook_identifier']){
            Session::pull('socialUserRegister');
            $user->facebook_identifier = $input['facebook_identifier'];

            $social = new Social();
            $social->identifier = $input['facebook_identifier'];
            $social->provider = $input['provider'];
            $social->token = $input['token'];
            $social->user_id = $user->id;
            $social->save();
        }

        $user->save();

        $userPending = Businessuserspendingemails::where('email', $input['email'])->first();

        if($userPending) {
            $userPending->delete();
        }


        $facebookConversionsApi = new FacebookConversionsAPI();
        $facebookConversionsApi->pushEvent(FacebookConversionsAPI::EVENT_SIGNINSIGNUP);

        $category = Categories::find($input['categories']);

        if($category && $category->isValidFreeCourse()){

            enrollCourse($category->courses_id, $user->id, null, $category->end_time);
        }
        
        return $user;

    }
}

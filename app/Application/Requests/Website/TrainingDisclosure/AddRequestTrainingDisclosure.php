<?php

namespace App\Application\Requests\Website\TrainingDisclosure;

use Illuminate\Foundation\Http\FormRequest;

class AddRequestTrainingDisclosure extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "",
			"email" => "",
			"title" => "",
			"phone" => "",
			"country" => "",
			"company" => "",
			"numberoftrainees" => "",
			"websiteurl" => "",
			"service" => "",
			
        ];
    }
}

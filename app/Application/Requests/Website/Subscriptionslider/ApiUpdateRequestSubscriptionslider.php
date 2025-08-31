<?php

namespace App\Application\Requests\Website\Subscriptionslider;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestSubscriptionslider
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "title" => "description.*",
			"cta_link" => "",
			
        ];
    }
}

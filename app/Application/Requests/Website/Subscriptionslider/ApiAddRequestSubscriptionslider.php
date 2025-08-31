<?php

namespace App\Application\Requests\Website\Subscriptionslider;


class ApiAddRequestSubscriptionslider
{
    public function rules()
    {
        return [
            "title" => "description.*",
			"cta_link" => "",
			
        ];
    }
}

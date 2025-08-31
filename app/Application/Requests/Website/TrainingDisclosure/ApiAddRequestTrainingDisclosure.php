<?php

namespace App\Application\Requests\Website\TrainingDisclosure;


class ApiAddRequestTrainingDisclosure
{
    public function rules()
    {
        return [
            "name" => "email",
			"service" => "",
			
        ];
    }
}

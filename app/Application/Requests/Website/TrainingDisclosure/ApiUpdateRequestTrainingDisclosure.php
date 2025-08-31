<?php

namespace App\Application\Requests\Website\TrainingDisclosure;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestTrainingDisclosure
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "name" => "email",
			"service" => "",
			
        ];
    }
}

<?php

namespace App\Application\Requests\Website\Achievements;

use Illuminate\Support\Facades\Route;

class ApiUpdateRequestAchievements
{
    public function rules()
    {
        $id = Route::input('id');
        return [
            "name" => "description.*",
			"logo" => "",
			
        ];
    }
}

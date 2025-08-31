<?php

namespace App\Application\Requests\Website\Achievements;


class ApiAddRequestAchievements
{
    public function rules()
    {
        return [
            "name" => "description.*",
			"logo" => "",
			
        ];
    }
}

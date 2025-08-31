<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class AchievementsTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "en")},
			"description" => $modelOrCollection->{lang("description" , "en")},
			"logo" => $modelOrCollection->logo,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->{lang("name" , "ar")},
			"description" => $modelOrCollection->{lang("description" , "ar")},
			"logo" => $modelOrCollection->logo,

        ];
    }

}
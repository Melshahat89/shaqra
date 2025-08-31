<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class SubscriptionsliderTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "en")},
			"description" => $modelOrCollection->{lang("description" , "en")},
			"image" => $modelOrCollection->image,
			"status" => $modelOrCollection->status,
			"cta_text" => $modelOrCollection->{lang("cta_text" , "en")},
			"cta_link" => $modelOrCollection->cta_link,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"title" => $modelOrCollection->{lang("title" , "ar")},
			"description" => $modelOrCollection->{lang("description" , "ar")},
			"image" => $modelOrCollection->image,
			"status" => $modelOrCollection->status,
			"cta_text" => $modelOrCollection->{lang("cta_text" , "ar")},
			"cta_link" => $modelOrCollection->cta_link,

        ];
    }

}
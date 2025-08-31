<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class TrainingDisclosureTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->name,
			"email" => $modelOrCollection->email,
			"phone" => $modelOrCollection->phone,
			"country" => $modelOrCollection->country,
			"company" => $modelOrCollection->company,
			"numberoftrainees" => $modelOrCollection->numberoftrainees,
			"websiteurl" => $modelOrCollection->websiteurl,
			"service" => $modelOrCollection->service,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"name" => $modelOrCollection->name,
			"email" => $modelOrCollection->email,
			"phone" => $modelOrCollection->phone,
			"country" => $modelOrCollection->country,
			"company" => $modelOrCollection->company,
			"numberoftrainees" => $modelOrCollection->numberoftrainees,
			"websiteurl" => $modelOrCollection->websiteurl,
			"service" => $modelOrCollection->service,

        ];
    }

}
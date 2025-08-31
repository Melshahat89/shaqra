<?php

namespace App\Application\Transformers;

use Illuminate\Database\Eloquent\Model;

class ProfessionalcertificatesTransformers extends AbstractTransformer
{

    public function transformModel(Model $modelOrCollection)
    {
        return [
            "id" => $modelOrCollection->id,
			"startdate" => $modelOrCollection->startdate,
			"appointment" => $modelOrCollection->appointment,
			"days" => $modelOrCollection->days,
			"hours" => $modelOrCollection->hours,
			"seats" => $modelOrCollection->seats,
			"registrationdeadline" => $modelOrCollection->registrationdeadline,

        ];
    }

    public function transformModelAr(Model $modelOrCollection)
    {
        return [
           "id" => $modelOrCollection->id,
			"startdate" => $modelOrCollection->startdate,
			"appointment" => $modelOrCollection->appointment,
			"days" => $modelOrCollection->days,
			"hours" => $modelOrCollection->hours,
			"seats" => $modelOrCollection->seats,
			"registrationdeadline" => $modelOrCollection->registrationdeadline,

        ];
    }

}
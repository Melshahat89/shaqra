<?php
 namespace App\Application\Requests\Website\Professionalcertificates;
 use Illuminate\Support\Facades\Route;
 class ApiUpdateRequestProfessionalcertificates
{
    public function rules()
    {
        $id = Route::input('id');
        return [
        	"courses_id" => "required|integer",
            "startdate" => "appointment",
   "registrationdeadline" => "",
            ];
    }
}

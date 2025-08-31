<?php
 namespace App\Application\Requests\Website\Professionalcertificates;
  class ApiAddRequestProfessionalcertificates
{
    public function rules()
    {
        return [
        	"courses_id" => "required|integer",
            "startdate" => "appointment",
   "registrationdeadline" => "",
            ];
    }
}

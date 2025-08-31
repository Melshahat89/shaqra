<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Professionalcertificates;
use App\Application\Transformers\ProfessionalcertificatesTransformers;
use App\Application\Requests\Website\Professionalcertificates\ApiAddRequestProfessionalcertificates;
use App\Application\Requests\Website\Professionalcertificates\ApiUpdateRequestProfessionalcertificates;

class ProfessionalcertificatesApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Professionalcertificates $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestProfessionalcertificates $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestProfessionalcertificates $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(ProfessionalcertificatesTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(ProfessionalcertificatesTransformers::transform($data) + $paginate), $status_code);
    }

}

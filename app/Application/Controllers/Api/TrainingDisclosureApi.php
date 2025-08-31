<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\TrainingDisclosure;
use App\Application\Transformers\TrainingDisclosureTransformers;
use App\Application\Requests\Website\TrainingDisclosure\ApiAddRequestTrainingDisclosure;
use App\Application\Requests\Website\TrainingDisclosure\ApiUpdateRequestTrainingDisclosure;

class TrainingDisclosureApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(TrainingDisclosure $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestTrainingDisclosure $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestTrainingDisclosure $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(TrainingDisclosureTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(TrainingDisclosureTransformers::transform($data) + $paginate), $status_code);
    }

}

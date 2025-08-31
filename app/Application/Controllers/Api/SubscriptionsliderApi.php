<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Subscriptionslider;
use App\Application\Transformers\SubscriptionsliderTransformers;
use App\Application\Requests\Website\Subscriptionslider\ApiAddRequestSubscriptionslider;
use App\Application\Requests\Website\Subscriptionslider\ApiUpdateRequestSubscriptionslider;

class SubscriptionsliderApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Subscriptionslider $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestSubscriptionslider $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestSubscriptionslider $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(SubscriptionsliderTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(SubscriptionsliderTransformers::transform($data) + $paginate), $status_code);
    }

}

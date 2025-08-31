<?php

namespace App\Application\Controllers\Api;


use App\Application\Controllers\Controller;
use App\Application\Model\Achievements;
use App\Application\Transformers\AchievementsTransformers;
use App\Application\Requests\Website\Achievements\ApiAddRequestAchievements;
use App\Application\Requests\Website\Achievements\ApiUpdateRequestAchievements;

class AchievementsApi extends Controller
{
    use ApiTrait;
    protected $model;

    public function __construct(Achievements $model)
    {
        $this->model = $model;
        /// send header Authorization Bearer token
        /// $this->middleware('authApi')->only();
    }

    public function add(ApiAddRequestAchievements $validation){
         return $this->addItem($validation);
    }

    public function update($id , ApiUpdateRequestAchievements $validation){
        return $this->updateItem($id , $validation);
    }

    protected function checkLanguageBeforeReturn($data , $status_code = 200, $paginate = [])
    {
       if (request()->has('lang') && request()->get('lang') == 'ar') {
            return response(apiReturn(AchievementsTransformers::transformAr($data) + $paginate), $status_code);
        }
        return response(apiReturn(AchievementsTransformers::transform($data) + $paginate), $status_code);
    }

}

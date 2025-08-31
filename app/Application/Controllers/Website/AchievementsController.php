<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Achievements;
use App\Application\Requests\Website\Achievements\AddRequestAchievements;
use App\Application\Requests\Website\Achievements\UpdateRequestAchievements;

class AchievementsController extends AbstractController
{

     public function __construct(Achievements $model)
     {
        parent::__construct($model);
     }

     public function index(){
        $items = $this->model;

        if(request()->has('from') && request()->get('from') != ''){
            $items = $items->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $items = $items->whereDate('created_at' , '<=' , request()->get('to'));
        }

			if(request()->has("name") && request()->get("name") != ""){
				$items = $items->where("name","like", "%".request()->get("name")."%");
			}

			if(request()->has("description") && request()->get("description") != ""){
				$items = $items->where("description","like", "%".request()->get("description")."%");
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.achievements.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.achievements.edit' , $id);
     }

     public function store(AddRequestAchievements $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('achievements');
     }

     public function update($id , UpdateRequestAchievements $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.achievements.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'achievements')->with('sucess' , 'Done Delete Achievements From system');
     }


}

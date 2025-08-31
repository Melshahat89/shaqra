<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\TrainingDisclosure;
use App\Application\Requests\Website\TrainingDisclosure\AddRequestTrainingDisclosure;
use App\Application\Requests\Website\TrainingDisclosure\UpdateRequestTrainingDisclosure;

class TrainingDisclosureController extends AbstractController
{

     public function __construct(TrainingDisclosure $model)
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
				$items = $items->where("name","=", request()->get("name"));
			}

			if(request()->has("email") && request()->get("email") != ""){
				$items = $items->where("email","=", request()->get("email"));
			}

			if(request()->has("phone") && request()->get("phone") != ""){
				$items = $items->where("phone","=", request()->get("phone"));
			}

			if(request()->has("country") && request()->get("country") != ""){
				$items = $items->where("country","=", request()->get("country"));
			}

			if(request()->has("company") && request()->get("company") != ""){
				$items = $items->where("company","=", request()->get("company"));
			}

			if(request()->has("numberoftrainees") && request()->get("numberoftrainees") != ""){
				$items = $items->where("numberoftrainees","=", request()->get("numberoftrainees"));
			}

			if(request()->has("websiteurl") && request()->get("websiteurl") != ""){
				$items = $items->where("websiteurl","=", request()->get("websiteurl"));
			}

			if(request()->has("service") && request()->get("service") != ""){
				$items = $items->where("service","=", request()->get("service"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.trainingdisclosure.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.trainingdisclosure.edit' , $id);
     }

     public function store(AddRequestTrainingDisclosure $request){
          $item =  $this->storeOrUpdate($request , null , true);

            Alert::success('Done Add TrainingDisclosure From system');

            return redirect()->back();

          return redirect('trainingdisclosure');
     }

     public function update($id , UpdateRequestTrainingDisclosure $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.trainingdisclosure.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'trainingdisclosure')->with('sucess' , 'Done Delete TrainingDisclosure From system');
     }


}

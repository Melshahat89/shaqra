<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Subscriptionslider;
use App\Application\Requests\Website\Subscriptionslider\AddRequestSubscriptionslider;
use App\Application\Requests\Website\Subscriptionslider\UpdateRequestSubscriptionslider;

class SubscriptionsliderController extends AbstractController
{

     public function __construct(Subscriptionslider $model)
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

			if(request()->has("title") && request()->get("title") != ""){
				$items = $items->where("title","like", "%".request()->get("title")."%");
			}

			if(request()->has("description") && request()->get("description") != ""){
				$items = $items->where("description","like", "%".request()->get("description")."%");
			}

			if(request()->has("status") && request()->get("status") != ""){
				$items = $items->where("status","=", request()->get("status"));
			}

			if(request()->has("cta_text") && request()->get("cta_text") != ""){
				$items = $items->where("cta_text","like", "%".request()->get("cta_text")."%");
			}

			if(request()->has("cta_link") && request()->get("cta_link") != ""){
				$items = $items->where("cta_link","=", request()->get("cta_link"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.subscriptionslider.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.subscriptionslider.edit' , $id);
     }

     public function store(AddRequestSubscriptionslider $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('subscriptionslider');
     }

     public function update($id , UpdateRequestSubscriptionslider $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.subscriptionslider.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'subscriptionslider')->with('sucess' , 'Done Delete Subscriptionslider From system');
     }


}

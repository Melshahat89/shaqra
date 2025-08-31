<?php

namespace App\Application\Controllers\Website;

use App\Application\Controllers\AbstractController;
use Alert;
use App\Application\Model\Professionalcertificates;
use App\Application\Requests\Website\Professionalcertificates\AddRequestProfessionalcertificates;
use App\Application\Requests\Website\Professionalcertificates\UpdateRequestProfessionalcertificates;

class ProfessionalcertificatesController extends AbstractController
{

     public function __construct(Professionalcertificates $model)
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

			if(request()->has("startdate") && request()->get("startdate") != ""){
				$items = $items->where("startdate","=", request()->get("startdate"));
			}

			if(request()->has("appointment") && request()->get("appointment") != ""){
				$items = $items->where("appointment","=", request()->get("appointment"));
			}

			if(request()->has("days") && request()->get("days") != ""){
				$items = $items->where("days","=", request()->get("days"));
			}

			if(request()->has("hours") && request()->get("hours") != ""){
				$items = $items->where("hours","=", request()->get("hours"));
			}

			if(request()->has("seats") && request()->get("seats") != ""){
				$items = $items->where("seats","=", request()->get("seats"));
			}

			if(request()->has("registrationdeadline") && request()->get("registrationdeadline") != ""){
				$items = $items->where("registrationdeadline","=", request()->get("registrationdeadline"));
			}



        $items = $items->paginate(env('PAGINATE'));
        return view('website.professionalcertificates.index' , compact('items'));
     }

     public function show($id = null){
         return $this->createOrEdit('website.professionalcertificates.edit' , $id);
     }

     public function store(AddRequestProfessionalcertificates $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('professionalcertificates');
     }

     public function update($id , UpdateRequestProfessionalcertificates $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }

     public function getById($id){
         $fields = $this->model->findOrFail($id);
         return $this->createOrEdit('website.professionalcertificates.show' , $id , ['fields' =>  $fields]);
     }

     public function destroy($id){
         return $this->deleteItem($id , 'professionalcertificates')->with('sucess' , 'Done Delete Professionalcertificates From system');
     }


}

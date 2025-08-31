<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\TrainingDisclosure\AddRequestTrainingDisclosure;
use App\Application\Requests\Admin\TrainingDisclosure\UpdateRequestTrainingDisclosure;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\TrainingDisclosuresDataTable;
use App\Application\Model\TrainingDisclosure;
use Yajra\Datatables\Request;
use Alert;

class TrainingDisclosureController extends AbstractController
{
    public function __construct(TrainingDisclosure $model)
    {
        parent::__construct($model);
    }

    public function index(TrainingDisclosuresDataTable $dataTable){
        return $dataTable->render('admin.trainingdisclosure.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.trainingdisclosure.edit' , $id);
    }

     public function store(AddRequestTrainingDisclosure $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('admin/trainingdisclosure');
     }

     public function update($id , UpdateRequestTrainingDisclosure $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.trainingdisclosure.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'admin/trainingdisclosure')->with('sucess' , 'Done Delete trainingdisclosure From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'admin/trainingdisclosure')->with('sucess' , 'Done Delete trainingdisclosure From system');
    }

}

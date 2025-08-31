<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Professionalcertificates\AddRequestProfessionalcertificates;
use App\Application\Requests\Admin\Professionalcertificates\UpdateRequestProfessionalcertificates;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\ProfessionalcertificatessDataTable;
use App\Application\Model\Professionalcertificates;
use Yajra\Datatables\Request;
use Alert;

class ProfessionalcertificatesController extends AbstractController
{
    public function __construct(Professionalcertificates $model)
    {
        parent::__construct($model);
    }

    public function index(ProfessionalcertificatessDataTable $dataTable){
        return $dataTable->render('admin.professionalcertificates.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.professionalcertificates.edit' , $id);
    }

     public function store(AddRequestProfessionalcertificates $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/professionalcertificates');
     }

     public function update($id , UpdateRequestProfessionalcertificates $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.professionalcertificates.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/professionalcertificates')->with('sucess' , 'Done Delete professionalcertificates From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/professionalcertificates')->with('sucess' , 'Done Delete professionalcertificates From system');
    }

}

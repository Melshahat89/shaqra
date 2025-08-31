<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Subscriptionslider\AddRequestSubscriptionslider;
use App\Application\Requests\Admin\Subscriptionslider\UpdateRequestSubscriptionslider;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\SubscriptionslidersDataTable;
use App\Application\Model\Subscriptionslider;
use Yajra\Datatables\Request;
use Alert;

class SubscriptionsliderController extends AbstractController
{
    public function __construct(Subscriptionslider $model)
    {
        parent::__construct($model);
    }

    public function index(SubscriptionslidersDataTable $dataTable){
        return $dataTable->render('admin.subscriptionslider.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.subscriptionslider.edit' , $id);
    }

    public function store(AddRequestSubscriptionslider $request){
        $item =  $this->storeOrUpdate($request , null , true);
        return redirect('lazyadmin/subscriptionslider');
    }

    public function update($id , UpdateRequestSubscriptionslider $request){
        $item = $this->storeOrUpdate($request, $id, true);
        return redirect()->back();

    }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('admin.subscriptionslider.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/subscriptionslider')->with('sucess' , 'Done Delete subscriptionslider From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/subscriptionslider')->with('sucess' , 'Done Delete subscriptionslider From system');
    }

}

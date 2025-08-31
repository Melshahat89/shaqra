<?php

namespace App\Application\Controllers\Admin;

use App\Application\Controllers\AbstractController;
use App\Application\DataTables\RolesDataTable;
use App\Application\Model\Role;
use App\Application\Repository\InterFaces\RolesInterface;
use App\Application\Requests\Admin\Role\AddRequestRole;
use App\Application\Requests\Admin\Role\UpdateRequestRole;
use Yajra\Datatables\Request;
use Alert;

class RoleController extends AbstractController
{
    protected  $rolesInterface;
    public function __construct(Role $model , RolesInterface $rolesInterface)
    {
        parent::__construct($model);
        $this->rolesInterface = $rolesInterface;
    }

    public function index(RolesDataTable $dataTable){
        return $dataTable->render('admin.role.index');
    }

    public function show($id = null){
        $data['roles_permission'] = $this->rolesInterface->getPermissionById($id);
        $data['permissions'] = $this->rolesInterface->getAllPermissions();
        return $this->createOrEdit('admin.role.edit' , $id , $data);
    }

    public function store(AddRequestRole $request){
         return $this->storeOrUpdate($request , null , 'lazyadmin/role');
    }

    public function update($id , UpdateRequestRole $request){
        return $this->storeOrUpdate($request , $id , 'lazyadmin/role');
    }


    public function getById($id){
        $fields = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
        return $this->createOrEdit('admin.role.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/role')->with('sucess' , 'Done Delete role From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
$explode_id = array_map('intval', explode(',', $request->id[0]));
        foreach ($explode_id as $id){
            $this->deleteItem($id);
        } return $this->deleteItem($request->id , 'lazyadmin/role')->with('sucess' , 'Done Delete role From system');
    }
}

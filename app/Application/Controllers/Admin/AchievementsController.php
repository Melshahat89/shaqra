<?php

namespace App\Application\Controllers\Admin;

use App\Application\Requests\Admin\Achievements\AddRequestAchievements;
use App\Application\Requests\Admin\Achievements\UpdateRequestAchievements;
use App\Application\Controllers\AbstractController;
use App\Application\DataTables\AchievementssDataTable;
use App\Application\Model\Achievements;
use Yajra\Datatables\Request;
use Alert;

class AchievementsController extends AbstractController
{
    public function __construct(Achievements $model)
    {
        parent::__construct($model);
    }

    public function index(AchievementssDataTable $dataTable){
        return $dataTable->render('admin.achievements.index');
    }

    public function show($id = null){
        return $this->createOrEdit('admin.achievements.edit' , $id);
    }

     public function store(AddRequestAchievements $request){
          $item =  $this->storeOrUpdate($request , null , true);
          return redirect('lazyadmin/achievements');
     }

     public function update($id , UpdateRequestAchievements $request){
          $item = $this->storeOrUpdate($request, $id, true);
return redirect()->back();

     }


    public function getById($id){
        $fields = $this->model->findOrFail($id);
        return $this->createOrEdit('lazyadmin.achievements.show' , $id , ['fields' =>  $fields]);
    }

    public function destroy($id){
        return $this->deleteItem($id , 'lazyadmin/achievements')->with('sucess' , 'Done Delete achievements From system');
    }

    public function pluck(\Illuminate\Http\Request $request){
        return $this->deleteItem($request->id , 'lazyadmin/achievements')->with('sucess' , 'Done Delete achievements From system');
    }

}

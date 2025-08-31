<?php

namespace App\Application\DataTables;

use App\Application\Model\Orders;
use App\Application\Model\User;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return datatables()
             ->eloquent($this->query())
//            ->addColumn('id', 'admin.user.buttons.id')
            ->addColumn('edit', 'admin.user.buttons.edit')
            ->addColumn('delete', 'admin.user.buttons.delete')
            ->addColumn('view', 'admin.user.buttons.view')
            ->addColumn('group', 'admin.user.buttons.group')
            ->addColumn('verified', 'admin.user.buttons.verified')
            ->addColumn('activated', 'admin.user.buttons.activated')
            ->addColumn('enrollments', 'admin.user.buttons.enrollments')
            ->addColumn('categories', 'admin.user.buttons.categories')
            ->addColumn('enrollments', function($query){
                return count($query->courseenrollment) > 0 ? 'YES' : 'NO';
            })
            ->addColumn('mobile', function($query){
                return ($query->mobile) ? $query->mobile : '';
            })
            ->rawColumns(['id', 'edit', 'delete', 'view', 'verified', 'activated'])
            ->orderColumn('id', function($query, $order){
                $query->orderBy('id', $order);
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = User::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

        if(request()->has('group_id') && request()->get('group_id') != ''){
            $query = $query->where('group_id' , '=' , request()->get('group_id'));
        }

        if(request()->has('id') && request()->get('id') != ''){
            $query = $query->where('id' , '=' , request()->get('id'));
        }

        // if(request()->has('verified') && request()->get('verified') != ''){
        //     $query = $query->where('verified' , '=' , request()->get('verified'));
        // }

        if(request()->has('name') && request()->get('name') != ''){
            $query = $query->where('name' ,'like' , "%".request()->get('name')."%");
        }

        if(request()->has('email') && request()->get('email') != ''){
            $query = $query->where('email' , request()->get('email'));
        }

        if(request()->has('enrolled') && request()->get('enrolled') == 1){
            $query = $query->select('users.*')->join('orders', 'users.id', '=', 'orders.user_id')->where('orders.status', '=', Orders::STATUS_SUCCEEDED)->groupBy('users.id');
            //dd($query->get());
            // $query = $query->has('courseenrollment');
        }elseif(request()->has('enrolled') && request()->get('enrolled') != '' && request()->get('enrolled') == 0){

            $query = $query->whereNotIn('id', function($q){
                $q->select('user_id')->from('orders')->where('orders.status', Orders::STATUS_SUCCEEDED);
            });
            // $query = $query->whereDoesntHave('courseenrollment');
        }



        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {

        $html = $this->builder()
            ->columns($this->getColumns())
            ->parameters(dataTableConfig());
        if (getCurrentLang() == 'ar') {
            $html = $html->parameters([
                'language' => [
                    'url' => url('/vendor/datatables/arabic.json')
                ]
            ]);
        }
        return $html;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => "id",
                'data' => 'id',
                'title' => trans('curd.id')
            ],
            [
                'name' => "name",
                'data' => 'name',
                'title' => trans('user.name')
            ],
            [
                'name' => "email",
                'data' => 'email',
                'title' => trans('user.email')
            ],
            [
                'name' => "mobile",
                'data' => 'mobile',
                'title' => trans('user.mobile')
            ],
            [
                'name' => "group_id",
                'data' => 'group',
                'title' => trans('user.group')
            ],
            [
                'name' => "verified",
                'data' => 'verified',
                'title' => trans('user.verified')
            ],
            [
                'name' => "activated",
                'data' => 'activated',
                'title' => trans('user.activated')
            ],
            [
                'name' => 'categories',
                'data' => 'categories',
                'title' => 'Categories',
            ],
            [
                'name' => 'enrollments',
                'data' => 'enrollments',
                'title' => 'Enrolled',
                'orderable' => false,
                'searchable' => false,
            ],
            // [
            //     'name' => "specialization",
            //     'data' => 'specialization',
            //     'title' => trans('user.specialization')
            // ],
            // [
            //     'name' => "sub_specialization",
            //     'data' => 'sub_specialization',
            //     'title' => trans('user.sub-specialization')
            // ],
            // [
            //     'name' => "other_specialization",
            //     'data' => 'other_specialization',
            //     'title' => trans('user.other-specialization')
            // ],
            [
                'name' => "view",
                'data' => 'view',
                'title' => trans('curd.view'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false
            ],
            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => trans('curd.edit'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('curd.delete'),
                'exportable' => false,
                'printable' => false,
                'searchable' => false,
                'orderable' => false
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'userdatatables_' . time();
    }
}

<?php

namespace App\Application\DataTables;

use App\Application\Model\Trainingdisclosure;
use Yajra\DataTables\Services\DataTable;

class TrainingDisclosuresDataTable extends DataTable
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
              ->addColumn('id', 'admin.trainingdisclosure.buttons.id')
             ->addColumn('edit', 'admin.trainingdisclosure.buttons.edit')
             ->addColumn('delete', 'admin.trainingdisclosure.buttons.delete')
             ->addColumn('view', 'admin.trainingdisclosure.buttons.view')
             /*->addColumn('name', 'admin.trainingdisclosure.buttons.langcol')*/
             ->rawColumns(['id', 'edit', 'delete', 'view'])
             ->make(true);
    }
    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Trainingdisclosure::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("name") && request()->get("name") != ""){
				$query = $query->where("name","=", request()->get("name"));
		}

		if(request()->has("email") && request()->get("email") != ""){
				$query = $query->where("email","=", request()->get("email"));
		}

		if(request()->has("phone") && request()->get("phone") != ""){
				$query = $query->where("phone","=", request()->get("phone"));
		}

		if(request()->has("country") && request()->get("country") != ""){
				$query = $query->where("country","=", request()->get("country"));
		}

		if(request()->has("company") && request()->get("company") != ""){
				$query = $query->where("company","=", request()->get("company"));
		}

		if(request()->has("numberoftrainees") && request()->get("numberoftrainees") != ""){
				$query = $query->where("numberoftrainees","=", request()->get("numberoftrainees"));
		}

		if(request()->has("websiteurl") && request()->get("websiteurl") != ""){
				$query = $query->where("websiteurl","=", request()->get("websiteurl"));
		}

		if(request()->has("service") && request()->get("service") != ""){
				$query = $query->where("service","=", request()->get("service"));
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
        return $this->builder()
                    ->columns($this->getColumns())
                    ->parameters(dataTableConfig());
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
                  'title' => trans('curd.id'),
             ],
			[
                'name' => 'name',
                'data' => 'name',
                'title' => "name",
                
                ],
			[
                'name' => 'title',
                'data' => 'title',
                'title' => "title",

                ],
			[
                'name' => 'email',
                'data' => 'email',
                'title' => "email",

                ],
			[
                'name' => 'phone',
                'data' => 'phone',
                'title' => "phone",

                ],
			[
                'name' => 'country',
                'data' => 'country',
                'title' => "country",

                ],
			[
                'name' => 'company',
                'data' => 'company',
                'title' => "company",

                ],
             [
                  'name' => 'view',
                  'data' => 'view',
                  'title' => trans('curd.view'),
                  'exportable' => false,
                  'printable' => false,
                  'searchable' => false,
                  'orderable' => false,
             ],
             [
                  'name' => 'edit',
                  'data' => 'edit',
                  'title' =>  trans('curd.edit'),
                  'exportable' => false,
                  'printable' => false,
                  'searchable' => false,
                  'orderable' => false,
             ],
             [
                   'name' => 'delete',
                   'data' => 'delete',
                   'title' => trans('curd.delete'),
                   'exportable' => false,
                   'printable' => false,
                   'searchable' => false,
                   'orderable' => false,
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
        return 'Trainingdisclosuredatatables_' . time();
    }
}
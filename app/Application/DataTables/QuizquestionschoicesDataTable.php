<?php

namespace App\Application\DataTables;

use App\Application\Model\Quizquestionschoice;
use Yajra\DataTables\Services\DataTable;

class QuizquestionschoicesDataTable extends DataTable
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
              ->addColumn('id', 'admin.quizquestionschoice.buttons.id')
             ->addColumn('edit', 'admin.quizquestionschoice.buttons.edit')
             ->addColumn('delete', 'admin.quizquestionschoice.buttons.delete')
             ->addColumn('view', 'admin.quizquestionschoice.buttons.view')
             /*->addColumn('name', 'admin.quizquestionschoice.buttons.langcol')*/
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
        $query = Quizquestionschoice::query();

        if(request()->has('from') && request()->get('from') != ''){
            $query = $query->whereDate('created_at' , '>=' , request()->get('from'));
        }

        if(request()->has('to') && request()->get('to') != ''){
            $query = $query->whereDate('created_at' , '<=' , request()->get('to'));
        }

		if(request()->has("choice") && request()->get("choice") != ""){
				$query = $query->where("choice","like", "%".request()->get("choice")."%");
		}

		if(request()->has("is_correct") && request()->get("is_correct") != ""){
				$query = $query->where("is_correct","=", request()->get("is_correct"));
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
                'name' => 'choice',
                'data' => 'choice',
                'title' => trans("quizquestionschoice.choice"),
                'render' => 'function(){
                        return JSON.parse(this.choice).'.getCurrentLang().';
                    }',
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
        return 'Quizquestionschoicedatatables_' . time();
    }
}
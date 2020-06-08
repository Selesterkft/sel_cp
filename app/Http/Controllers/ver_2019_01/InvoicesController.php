<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Http\Controllers\Controller;
use App\Models\UserQueryModel;
use App\Models\ver_2019_01\InvoiceModel;
use App\Models\ver_2019_01\InvoiceDetail2Model;
use Illuminate\Http\Request;

class InvoicesController extends Controller{

    public function __construct()
    {
        $this->middleware('permission:invoices-menu', [
            'only' => ['index']
        ]);
    }

    public function index(Request $request){

        if( $request->ajax() ){
            $data = InvoiceModel::getAll($request);
            return $data;
        }

        $loggedUser = \Auth::user();
        $cust_id = (int)$loggedUser->Supervisor_ID;
        $client_id = (int)$loggedUser->CompanyID;
        $query_name = ($request->has('query_name')) ? $request->get('query_name') : config('appConfig.default_query_name');
        $table_name = $request->get('table_name') ? $request->get('table_name') : (new InvoiceModel())->getTable();

        //dd('InvoicesController::index', $client_id, $cust_id, $table_name, $query_name);

        $table_columns = UserQueryModel::getTableColumns(
            $client_id,
            $cust_id,
            $table_name,
            $query_name
        );

        $arr_table_columns = json_decode($table_columns, true);

        foreach( $arr_table_columns as $row_id => $rows ){

            foreach($rows as $col_id => $column){

                $arr_table_columns[$row_id][$col_id]['title'] = trans($column['title']);
            }
        }

        $table_columns = json_encode($arr_table_columns);

        //dd('InvoicesController::index', $table_columns, $arr_table_columns);

        $company_reports = UserQueryModel::getCompanyReports(
            $client_id,
            $cust_id,
            $table_name
        );

        $partners = \App\Classes\Helper::getPartners($client_id);

        return view(session()->get('version') . '.invoices.index', [
            'partners' => $partners,
            'table_name'        => $table_name,
            'query_name'        => $query_name,
            'table_columns'     => $table_columns,
            'company_reports'   => $company_reports,
            ]);
    }
}

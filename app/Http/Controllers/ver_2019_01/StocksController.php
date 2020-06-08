<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Classes\Helper;
use App\Models\UserQueryModel;
use App\Models\ver_2019_01\StockModel;
use App\Models\ver_2019_01\wrhsTransModel;
use App\Models\ver_2019_01\wrhsStockModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StocksController extends Controller
{
    /**
     * StocksController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:stocks-menu', [
            'only' => [
                'index', 'show',
                'create', 'store',
                'edit', 'update',
                'destroy', 'restore'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $table_name = $request->get('table_name');

        if( $request->ajax() )
        {
            //dd('StockController::index ajax', $request->all());

            $data = [];
            switch($table_name){
                case 'cp_wrhs_stocks':
                    $data = wrhsStockModel::getAll();
                    break;
                case 'cp_wrhs_trans':
                    $data = wrhsTransModel::getAll();
                    //$data = [];
                    break;
                default:
                    break;
            }
            //dd('StockController::index ajax', $data);
            return $data;
        }

        $loggedUser = \Auth::user();
        $cust_id = (int)$loggedUser->Supervisor_ID;
        $client_id = (int)$loggedUser->CompanyID;
        $query_name = ($request->has('query_name')) ? $request->get('query_name') : config('appConfig.default_query_name');

        // Ha az oldal felől nem jön táblanév, akkor a készletek tábla jelenjen meg.
        // Így jó, ahogy van!!!
        $table_name = $request->get('table_name') ? $request->get('table_name') : 'cp_wrhs_stocks';

        //dd('StocksController::index', request()->all(), $client_id, $cust_id, $table_name, $query_name);

        $table_columns = UserQueryModel::getTableColumns(
            $client_id,
            $cust_id,
            $table_name,
            $query_name);

        $arr_table_columns = json_decode($table_columns, true);
        //dd('StocksController::index', $arr_table_columns);

        foreach($arr_table_columns as $id => $column){

            $arr_table_columns[$id]['title'] = trans( $column['title'] );
            /*
            switch( strtolower($column['title']) ){
                case 'id':
                    $arr_table_columns[$id]['title'] = trans('app.id');
                    break;
                case 'warehouse':
                    $arr_table_columns[$id]['title'] = trans('app.warehouse');
                    break;
                case 'status':
                    $arr_table_columns[$id]['title'] = trans('app.status');
                    break;
                case 'client_id':
                    $arr_table_columns[$id]['title'] = trans('app.clientid');
                    break;
                case 'clientid':
                    $arr_table_columns[$id]['title'] = trans('app.clientid');
                    break;
                case 'cust_id':
                    $arr_table_columns[$id]['title'] = trans('app.cust_id');
                    break;
                default:
                    $arr_table_columns[$id]['title'] = trans("{$table_name}." . strtolower($column['title']) );
                    break;
            }
            */
        }
//dd('StockController::index', $arr_table_columns);
        $table_columns = json_encode($arr_table_columns);
//dd('StockController::index', $arr_table_columns, $table_columns);
        $company_reports = UserQueryModel::getCompanyReports(
            $client_id,
            $cust_id,
            $table_name);

//dd('StocksController::index', $company_reports);

        return view(session()->get('version') . '.stocks.index', [
            'table_name' => $table_name,
            'query_name' => $query_name,
            'table_columns' => $table_columns,
            'company_reports' => $company_reports,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( $request->ajax() ){
            $client_id = (int)$request->get('client_id');
            $customer_id = (int)$request->get('cust_id');
            $table_name = $request->get('table_name');
            $old_query_name = ($request->get('old_query_name') != null) ? $request->get('old_query_name') : '';
            $new_query_name = $request->get('query_name');
            $query_description = $request->get('query_description');
            $query_description = isset($query_description) ? $query_description : '';

            $table_columns = UserQueryModel::getTableColumns(
                $client_id = $client_id,
                $customer_id = $customer_id,
                $table_name = $table_name,
                $query_name = $old_query_name);

            //dd('WrhsStocksController::store', $request->all(), $client_id, $customer_id, $table_name, $old_query_name, $query_name, $query_description, $table_columns);

            $data = [
                'client_id' => $client_id,
                'cust_id' => $customer_id,
                'table_name' => $table_name,
                'query_name' => $new_query_name,
                'query_description' => $query_description,
                'columns' => $table_columns,
            ];

            //dd('WrhsStocksController::store', $request->all(), $data);

            $res = UserQueryModel::sync($data);

            return $res;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if( $request->ajax() ){
            $config = config('appConfig.tables.user_queries');

            $query = "EXECUTE [dbo].[{$config['update']}] {$id},'{$request->get('query_name')}','{$request->get('query_description')}'";

            $res = \DB::connection($config['connection'])
                ->select(\DB::raw($query));

            return $res;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        if($request->ajax()){

            //dd('StocksController::delete', $id, $request->all());

            $config = config('appConfig.tables.user_queries');
            $query = "EXECUTE [dbo].[{$config['delete']}] {$id}";

            $res = \DB::connection($config['connection'])
                ->select(\DB::raw($query));

            return json_encode(['ID' => $id, 'res' => $res]);

        }
    }
}

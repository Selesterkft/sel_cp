<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Models\UserQueryModel;
use App\Models\ver_2019_01\wrhsStockModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WrhsStocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request)
    {
        if( $request->ajax() )
        {
            $data = wrhsStockModel::all();

            return $data;
        }

        $loggedUser = \Auth::user();
        $customer_id = (int)$loggedUser->Supervisor_ID;
        $client_id = (int)$loggedUser->CompanyID;
        $query_name = ($request->has('query_name')) ? $request->get('query_name') : config('appConfig.default_query_name');

        //$customer_id = 37127568;
        //$client_id = 1038482;

        // Lekérem a tábla nevét
        $table_name = (new wrhsStockModel())->getTable();

        // Mező adatok lekérése
        $table_columns = UserQueryModel::getTableColumns($client_id, $customer_id, $table_name, $query_name);
        //dd('WrhsStocksController::index', $client_id, $customer_id, $table_name, $query_name, $table_columns);

        // Nyelvi beállítások alkalmazása
        $arr_table_columns = json_decode($table_columns, true);

        foreach($arr_table_columns as $id => $column)
        {
            switch( strtolower($column['title']) )
            {
                case 'id':
                    $arr_table_columns[$id]['title'] = trans("app.id");
                    break;
                case 'warehouse':
                    $arr_table_columns[$id]['title'] = trans("app.warehouse");
                    break;
                case 'status':
                    $arr_table_columns[$id]['title'] = trans("app.status");
                    break;
                default:
                    //$arr_table_columns[$id]['title'] = trans("{$table_name}.{$column['title']}");
                    $arr_table_columns[$id]['title'] = trans("{$table_name}." . strtolower($column['title']) );
                    break;
            }
        }

        $table_columns = json_encode($arr_table_columns);

        //dd('WrhsStocksController::index', $client_id, $customer_id, $table_name, $query_name, $table_columns);

        $company_reports = UserQueryModel::getCompanyReports($client_id, $customer_id, $table_name);

        //dd('WrhsStocksController::index');

        return view(session()->get('version') . '.wrhs_stocks.index',
            [
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
        $config = config('appConfig.tables.user_queries');

        $query = "EXECUTE [dbo].[{$config['update']}] {$id},'{$request->get('query_name')}','{$request->get('query_description')}'";

        $res = \DB::connection($config['connection'])
        ->select(\DB::raw($query));

        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

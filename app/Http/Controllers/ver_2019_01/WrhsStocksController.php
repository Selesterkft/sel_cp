<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Models\TableColumnModel;
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

        //$loggedUser = \Auth::user();
        //$customer_id = (int)$loggedUser->Supervisor_ID;
        //$client_id = (int)$loggedUser->CompanyID;
        $customer_id = 37127568;
        $client_id = 1038482;

        // Lekérem a tábla nevét
        $table_name = (new wrhsStockModel())->getTable();

        // Mező adatok lekérése
        $table_columns = TableColumnModel::getTableColumns($client_id, $customer_id, $table_name);
        //dd('WrhsStocksController::index', $table_name, $table_columns);

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

        //echo '<pre>';
        //print_r($arr_table_columns);
        //echo '</pre>';

        //dd('WrhsStocksController::index', $arr_table_columns);

        $table_columns = json_encode($arr_table_columns);

        return view(session()->get('version') . '.wrhs_stocks.index', ['table_columns' => $table_columns]);
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
        //
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
        //
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

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
            $wrhs_stocks = wrhsStockModel::all();

            $cols = [];

            //dd('WrhsStocksController::index', $wrhs_stocks['table_columns']['Fields']);
            //echo '<pre>';
            foreach($wrhs_stocks['table_columns'] as $table_columns )
            {
                foreach( $table_columns as $field )
                {
                    $cols[] = ['field' => $field, 'title' => $field];
                    //print_r($field) . "\n";
                }
            }
            //echo '</pre>';
            //dd('WrhsStocksController::index', json_encode($cols), $cols);
            $wrhs_stocks['table_columns'] = json_encode($cols);
            //dd('WrhsStocksController::index', $wrhs_stocks);

            return $wrhs_stocks;
        }

        $loggedUser = \Auth::user();
        //$customer_id = (int)$loggedUser->Supervisor_ID;
        //$client_id = (int)$loggedUser->CompanyID;

        $customer_id = 37127568;
        $client_id = 1038482;

        $table_name = (new wrhsStockModel())->getTable();

        $cols = TableColumnModel::getTableColumns(
            $client_id  = $client_id,
            $cust_id    = $customer_id,
            $table_name = $table_name,
            $model_name = 'wrhsStockModel'
        );

        $table_columns['Fields'] = json_decode($cols['VisibleColumns']);
        $table_columns['HiddenFields'] = json_decode($cols['HiddenColumns']);

        //dd('WrhsStocksController::index', $cols, $table_columns);

        $cols = [];

        foreach( $table_columns as $table_fields)
        {
            foreach( $table_fields as $field)
            {
                $cols[] = ['field' => $field, 'title' => $field];
            }
        }

        //dd('WrhsStocksController::index', json_encode($cols));

        return view(session()->get('version') . '.wrhs_stocks.index', [
            'table_columns' => json_encode($cols)
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

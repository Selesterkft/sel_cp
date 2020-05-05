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
        }

        //$loggedUser = \Auth::user();
        //$customer_id = (int)$loggedUser->Supervisor_ID;
        //$client_id = (int)$loggedUser->CompanyID;
        $customer_id = 37127568;
        $client_id = 1038482;

        $table_name = (new wrhsStockModel())->getTable();

        // A megjelenítendő oszloplista eltárolása a Session-ben, ha még nem történt meg
        // Ha megtalálható a Session-ben, akkor...
        if( session()->has($table_name) )
        {
            // Az oszloplista kivétele a Session-ből.
            $table_columns = session()->get($table_name);
        }
        else
        {
            // Az oszloplista kivétele az adatbázisból és eltárolása a Session-ben.
            $table_columns = TableColumnModel::getTableColumns($client_id, $customer_id, $table_name);
            session()->put($table_name, $table_columns);
        }

        //dd('WrhsStocksController::index', session()->all());
        return view(session()->get('version') . '.wrhs_stocks.index', ['table_columns' => $table_columns['VisibleColumns']]);
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

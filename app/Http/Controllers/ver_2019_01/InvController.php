<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Models\ver_2019_01\InvModel;
use App\Models\ver_2019_01\InvoiceModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->ajax() )
        {
            $model = new InvModel();
            $model->setTable('CP_Inv_read2');

            $model->where('ClientID', '=', \Auth::user()->CompanyID);

            $modelCount = $model->count();

            if( $request->has('limit') )
            {
                $model = $model->take($request->get('limit'));
            }
            if( $request->has('offset') )
            {
                $model = $model->skip($request->get('offset'));
            }
            if( $request->has('sort') && $request->has('order') )
            {
                $model = $model->orderBy($request->get('sort'), $request->get('order'));
            }

            $model = $model->select('SzlaSzam'
                ,'Iktatosorszam'
                ,'Period'
                ,'TipusID'
                ,'Ref_Szamlak_ID'
                ,'Cancellation_ReasonCode'
                ,'Cust_Name'
                ,'Cust_Address'
                ,'Vendor_Address'
                ,'VevoPenzforgJelz'
                ,'BankCode'
                ,'ClassID'
                ,'Period_from_to'
                ,'Kelte'
                ,'Teljesitve'
                ,'FizMod'
                ,'Lejarat'
                ,'BeerkezesDatum'
                ,'NettoOsszesen'
                ,'AFAOsszesen'
                ,'BruttoOsszesen'
                ,'FizAllapot'
                ,'Fully_paid_date'
                ,'EddigKifizetve'
                ,'EddigKifizetveEUR'
                ,'EddigKifizetveFIBU'
                ,'FWGesamtNetto'
                ,'FWGesamtMwSt'
                ,'FWGesamtBrutto'
                ,'Wahrung'
                ,'EURNetto'
                ,'EURMwSt'
                ,'EURBrutto'
                ,'Bemerkung'
                ,'Mellekletek'
                ,'FelvUserID'
                ,'Subcontracted_Services');

            //dd('InvController.index.ajax', $model->toSql());

            $res = $model->get();

            $invoices = [
                'total' => $modelCount,
                'totalNotFiltered' => InvModel::count(),
                'rows' => $res,
            ];

            //dd('InvController.index.ajax', \Auth::user()->CompanyID, $invices);

            return json_encode($invoices);
        }

        return view(session()->get('version') . '/inv_new/index');
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

<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Http\Controllers\Controller;
use App\Models\ver_2019_01\InvoiceModel;
use App\Models\ver_2019_01\InvoiceDetail2Model;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Invoices2Controller constructor.
     */
    public function __construct()
    {
        /*
        $this->middleware('permission:invoices-menu', [
            'only' => ['index']
        ]);
        */
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loggedUser = auth()->user();
        $datum = null;
        $clientID = $loggedUser->CompanyID;
        $supervisor_id = $loggedUser->Supervisor_ID;

        if( $request->ajax() )
        {
            //dd('Invoices2Controller.show', $request->all());
            return InvoiceModel::all();
        }

        //$customers = InvoiceModel::getCustomers($clientID);
        //$vendors = InvoiceModel::getVendors($clientID);
        $customers = [];
        $vendors = [];

        return view(session()->get('version') . '.invoices.index', [
            'customers' => $customers,
            'vendors' => $vendors,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        if( $request->ajax() )
        {
            $model = new InvoiceDetail2Model();
            $details = $model->getDetails($id);

            return $details;
        }

        $invoice = InvoiceModel::getInvoice($id);

        return view(session()->get('version').'.invoices.view', compact('invoice'));
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

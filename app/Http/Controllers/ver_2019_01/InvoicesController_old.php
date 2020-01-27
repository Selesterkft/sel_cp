<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Models\ver_2019_01\InvoiceDetailModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ver_2019_01\InvoiceModel;

class InvoicesControllerOld extends Controller {

    /**
     * InvoicesController constructor.
     */
    public function __construct() {
        //$this->middleware('auth');
        $this->middleware('permission:invoices-menu', [
            'only' => ['index']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $company
     * @param $version
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd('InvoicesController.index', $request->all());

        //echo('<pre>');
        //print_r($request->all());
        //echo('</pre>');

        $loggedUser = auth()->user();
        //$rels = config('appConfig.relations');
        $datum = null;
        //$datum_days = null;
        $clientID = (int)$loggedUser->CompanyID;
        $supervisor_id = (int)$loggedUser->Supervisor_ID;
        //$vendorID = null;
        //$custID = null;

        $model = new InvoiceModel();
        $model = $model->raw(config('appConfig.raw'));

        $model = $model->select(
            'ID',             'SELEXPED_INV_ID', 'Inv_Num',      'Vendor_Name1', 'Inv_SeqNum',
            'Cust_Name1',     'InvDate',         'DeliveryDate', 'DueDate',
            'Netto_LC',       'Tax_LC',          'Brutto_LC',    'PaidAmount_DC',
            'Curr_ID',        'Curr_DC',         'Vendor_Phone', 'Vendor_Email',
            'Customer_Phone', 'Customer_Email',  'Inv_L_Num');

        $model = $model->where('ClientID', '=', $clientID);

        if( !empty($request->get('s_invNum')) )
        {
            $model = $model->where('Inv_Num', 'like', '%' . $request->get('s_invNum') . '%');
        }
        else
        {
            if( $supervisor_id == 0 )
            {
                if( $request->get('s_vendor') != 0 )
                {
                    $model = $model->where('Vendor_ID', '=', $request->get('s_vendor'));
                }
                elseif( $request->get('s_customer') != 0 )
                {
                    $model = $model->where('Cust_ID', '=', $request->get('s_customer'));
                }

                if( !empty($request->get('s_delivery_date')) )
                {
                    $datum = explode(' - ', $request->get('s_delivery_date'));
                    $model = $model->whereBetween('DeliveryDate', [$datum[0], $datum[1]]);
                }

                if( !empty($request->get('s_due_date')) )
                {
                    $datum = explode(' - ', $request->get('s_due_date'));
                    $model = $model->whereBetween('DueDate', [$datum[0], $datum[1]]);
                }
            }
            else
            {
                $model = $model->where(function($q) use($supervisor_id)
                {
                    $q->where('Vendor_ID', '=', $supervisor_id)
                            ->orWhere('Cust_ID', '=', $supervisor_id);
                });

                if( !empty($request->get('s_delivery_date')) )
                {
                    $datum = explode(' - ', $request->get('s_delivery_date'));
                    $model = $model->whereBetween('DeliveryDate', [$datum[0], $datum[1]]);
                }

                if( !empty($request->get('s_due_date')) )
                {
                    $datum = explode(' - ', $request->get('s_due_date'));
                    $model = $model->whereBetween('DueDate', [$datum[0], $datum[1]]);
                }
            }

            if( !empty($request->get('s_type')) )
            {
                $model = $model->where('TypeID' , '=', $request->get('s_type'));
            }
        }

        $model = $model->orderBy('Inv_Num', 'asc');
/*
        echo('<pre>');
        print_r("user companyID: {$loggedUser->CompanyID}\n");
        print_r("user supervisorID:{$loggedUser->Supervisor_ID}\n");
        print_r("client_ID: {$clientID}\n");
        print_r("custID: {$request->get('s_customer')}\n");
        print_r("vendorID: {$request->get('s_vendor')}\n");
        print_r("delivery:{$datum[0]}, {$datum[1]}\n");
        print_r($model->toSql());
        echo('</pre>');
        dd('asd');
*/
        $invoices = $model->get();

        // A szűrő ablakhoz kellenek az adatok
        $customers = InvoiceModel::where('ClientID', '=', $clientID)
                ->where('Cust_Name1', '<>', 'Saját cég')
                ->groupBy('Cust_Name1', 'Cust_ID')
                ->orderBy('Cust_Name1', 'asc')
                ->select('Cust_ID', 'Cust_Name1')
                ->get()
                ->toArray();

        //dd('InvoiceController.index', $customers );
        // A szűrő ablakhoz kellenek az adatok
        $vendors = InvoiceModel::where('ClientID', '=', $clientID)
                ->where('Vendor_Name1', '<>', 'Saját cég')
                ->groupBy('Vendor_Name1', 'Vendor_ID')
                ->orderBy('Vendor_Name1', 'asc')
                ->select('Vendor_ID', 'Vendor_Name1')
                ->get()
                ->toArray();

        //dd('InvoiceController.index', $customers, $vendors);

        return view(session()->get('version') . '.invoices.index', [
            'invoices' => $invoices,
            'customers' => $customers,
            'vendors' => $vendors,
        ]);
    }

    public function index_old(Request $request) {
        $loggedUser = auth()->user();
        $rels = config('appConfig.relations');
        $datum = null;
        $datum_days = null;
        $clientID = $loggedUser->CompanyID;
        $vendorID = null;
        $custID = null;

        $model = new InvoiceModel();
        $model = $model->raw(config('appConfig.raw'));

        // Ha számlaszámot keresünk, akkor...
        if ($request->has('txtInvNum')) {
            $model = $model->where('Inv_Num', 'like', '%' . $request->get('txtInvNum') . '%');
        } else {
            // Kliens szűrés
            if ($request->has('s_vendor')) {
                $vendorID = $request->get('s_vendor');
            } else {
                $vendorID = ($loggedUser->Supervisor_ID == 0) ? $clientID : $loggedUser->Supervisor_ID;
            }

            if ($request->has('s_customer')) {
                $custID = $request->get('s_customer');
            } else {
                $custID = ($loggedUser->Supervisor_ID == 0) ? $clientID : $loggedUser->Supervisor_ID;
            }

            $model = $model
                    ->where('ClientID', '=', $clientID)
                    ->where(function($q) use($vendorID, $custID)
                    {
                        $q->where('Vendor_ID', $vendorID)
                                ->orWhere('Cust_ID', $custID);
                        }
                    );

            // Dátum szűrés
            // Ha nincs dátum szűrés, akkor...
            if( empty($request->get('s_inv_date')) &&
                    empty($request->get('s_delivery_date')) &&
                    empty($request->get('s_due_date')) &&
                    empty($request->get('days')) )
            {
                $datum_days = \Carbon::now()
                        ->subDays(config('appConfig.date_filters.invoice_look_back'))
                        ->format(config('appConfig.dateFormats.' . config('app.locale') . '.carbon'));
                $model = $model->where('InvDate', '>', $datum_days);
            }
            elseif( $request->has('days') )
            {
                $datum_days = \Carbon::now()
                        ->subDays($request->get('days'))
                        ->format(config('appConfig.dateFormats.' . config('app.locale') . '.carbon'));
                $model = $model->where('InvDate', '>', $datum_days);
            }
            else
            {
                if( !empty($request->get('s_inv_date')) )
                {
                    $datum = \Carbon::parse($request->get('s_inv_date'))
                            ->format(config('appConfig.dateFormats.hu.carbon'));
                    $model = $model->where('InvDate', $rels[$request->get('s_inv_date_rel')], $datum);
                }

                if( !empty($request->get('s_delivery_date')) )
                {
                    $datum = \Carbon::parse($request->get('s_delivery_date'))
                            ->format(config('appConfig.dateFormats.hu.carbon'));
                    $model = $model->where('DeliveryDate', $rels[$request->get('s_delivery_date_rel')], $datum);
                }

                if( !empty($request->get('s_due_date')))
                {
                    $datum = \Carbon::parse($request->get('s_due_date'))
                            ->format(config('appConfig.dateFormats.hu.carbon'));
                    $model = $model->where('DueDate', $rels[$request->get('s_due_date_rel')], $datum);
                }
            }

            // Fizetetlen számlák
            if( $request->has('s_paid') )
            {
                $model = $model->where('PayStatus', $request->get('a_paid_rel'), $request->get('s_paid'));
            }

            // Számla típusok
            if( $request->has('s_type_id') )
            {
                $model = $model->where('TypeID', $request->get('s_type_id'));
            }
        }
/*
        dd('InvoicesController.index',
            "loggedUser->CompanyID: {$loggedUser->CompanyID}",
            "loggedUser->Supervisor_ID: {$loggedUser->Supervisor_ID}",
            $request->all(),
            $request->get('txtInvNum'),
            "datum:{$datum}",
            "datum_days: {$datum_days}",
            "clientID: {$clientID}",
            "vendorID: {$vendorID}",
            "custID: {$custID}",
            "typeID: {$request->get('s_type_id')}",
            "PayStatus: {$request->get('s_paid')}",
            "PayStatus Rel: {$request->get('s_paid_rel')}",
            $model->toSql());
*/
        $invoices = $model->get();

        $firstElement = collect(
                [0 => __('global.app_select_first_element')]
        );

        $customers = $firstElement->merge(
            InvoiceModel::raw(config('appConfig.raw'))
                            ->where('Cust_Name1', '<>', 'Saját cég')
                            ->groupBy('Cust_Name1', 'Cust_ID')
                            ->pluck('Cust_Name1', 'Cust_ID')
        );
        $vendors = $firstElement->merge(
                InvoiceModel::raw(config('appConfig.raw'))
                        ->where('Vendor_Name1', '<>', 'Saját cég')
                        ->groupBy('Vendor_Name1', 'Vendor_ID')
                        ->pluck('Vendor_Name1', 'Vendor_ID')
        );

        return view(session()->get('version') . '.invoices.index', [
            'invoices' => $invoices,
            'customers' => $customers,
            'vendors' => $vendors,
        ]);
    }

    public function search(Request $request, string $version) {
        //dd('controller request', $version, $request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
        $invoice = InvoiceModel::where('SELEXPED_INV_ID', '=', $id)->first();
        $details = InvoiceDetailModel::where('Inv_ID', '=', $id)->get();

        return view(session()->get('version') . "/invoices/view", [
            'invoice' => $invoice,
            'details' => $details,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}

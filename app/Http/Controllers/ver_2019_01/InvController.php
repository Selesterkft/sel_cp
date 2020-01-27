<?php

namespace App\Http\Controllers\ver_2019_01;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ver_2019_01\InvoiceModel;

class InvController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:invoices-menu', [
            'only' => ['index']
        ]);
    }

    public function index(Request $request)
    {
        $loggedUser = auth()->user();
        $datum = null;
        $clientID = $loggedUser->CompanyID;
        $supervisor_id = $loggedUser->Supervisor_ID;

        if( $request->ajax() )
        {
            //dd('InvController.index', $request->all());
            $model = new InvoiceModel();
            $model = $model->raw(config('appConfig.raw'));
            /*
            $model = $model->select(
                'ID',             'SELEXPED_INV_ID', 'Inv_Num',      'Vendor_Name1', 'Inv_SeqNum',
                'Cust_Name1',     'InvDate',         'DeliveryDate', 'DueDate',
                'Netto_LC',       'Tax_LC',          'Brutto_LC',    'PaidAmount_DC',
                'Curr_ID',        'Curr_DC',         'Vendor_Phone', 'Vendor_Email',
                'Customer_Phone', 'Customer_Email',  'Inv_L_Num');
            */
            $model = $model->where('ClientID', '=', $clientID);

            if( !empty($request->get('s_invNum')) )
            {
                $model = $model
                    ->where('Inv_Num', 'like', "%{$request->get('s_invNum')}%");
            }
            else
            {
                if( $supervisor_id == 0 )
                {
                    if( $request->get('s_vendor') != 0 )
                    {
                        $model = $model->where('Vendor_ID', '=', $request->get('s_vendor'));
                    }
                    if( $request->get('s_customer') != 0 )
                    {
                        $model = $model->where('Cust_ID', '=', $request->get('s_customer'));
                    }
                }
                else
                {
                    $model = $model->where(function($q) use($supervisor_id)
                    {
                        $q->where('Vendor_ID', '=', $supervisor_id)
                            ->orWhere('Cust_ID', '=', $supervisor_id);
                    });
                }
            }

            $delivery_date = [];
            $due_date = [];

            if( !empty($request->get('s_delivery_date')) )
            {
                $delivery_date = explode(' - ', $request->get('s_delivery_date'));
                $model = $model->whereBetween('DeliveryDate', [$delivery_date[0], $delivery_date[1]]);
            }

            if( !empty($request->get('s_due_date')) )
            {
                $due_date = explode(' - ', $request->get('s_due_date'));
                $model = $model->whereBetween('DueDate', [$due_date[0], $due_date[1]]);
            }

            if( !empty($request->get('s_type')) )
            {
                $model = $model->where('TypeID' , '=', $request->get('s_type'));
            }

            if( count($delivery_date) > 0 )
            {
                print_r("delivery:{$delivery_date[0]} - {$delivery_date[1]}\n");
            }
            if( count($due_date) > 0 ){
                print_r("due:{$due_date[0]} - {$due_date[1]}\n");
            }

            $modelCount = $model->count();

            // Sorok száma
            $limit = null;
            if( $request->has('limit') )
            {
                $limit = $request->get('limit');
            }

            // Hányadik sortól
            $offset = null;
            if( $request->has('offset') )
            {
                $offset = $request->get('offset');
            }

            // Rendezés
            $sort = null;
            if( $request->has('sort') )
            {
                $sort = $request->get('sort');
            }

            // Rendezés iránya
            $order = 'asc';
            if( $request->has('order') )
            {
                $order = $request->get('order');
            }

            if( $limit )
            {
                $model = $model->take($limit);
            }
            if( $offset )
            {
                $model = $model->skip($offset);
            }
            if( $sort && $order )
            {
                $model = $model->orderBy($sort, $order);
            }
/*
            echo('<pre>');
            print_r("user companyID: {$loggedUser->CompanyID}\n");
            print_r("user supervisorID:{$loggedUser->Supervisor_ID}\n");
            print_r("client_ID: {$clientID}\n");
            print_r("Inv_Num: {$request->get('s_invNum')}\n");
            print_r("custID: {$request->get('s_customer')}\n");
            print_r("vendorID: {$request->get('s_vendor')}\n");
            print_r("type: {$request->get('s_type')}");
            print_r("count: {$modelCount}");
            print_r($model->toSql());
            echo('</pre>');
*/
            $result = $model->select(
                'ID',             'SELEXPED_INV_ID', 'Inv_Num',      'Vendor_Name1', 'Inv_SeqNum',
                'Cust_Name1',     'InvDate',         'DeliveryDate', 'DueDate',
                'Netto_LC',       'Tax_LC',          'Brutto_LC',    'PaidAmount_DC',
                'Curr_ID',        'Curr_DC',         'Vendor_Phone', 'Vendor_Email',
                'Customer_Phone', 'Customer_Email',  'Inv_L_Num')
                    ->get()
                    ->toArray();

            //dd('InvController.index', $result);

            $invoices = [
                'total' => $modelCount,
                'totalNotFiltered' => InvoiceModel::count(),
                'rows' => $result
            ];

            //dd('InvController.index', json_encode($invoices));

            return json_encode($invoices);

        }

        $customers = InvoiceModel::where('ClientID', '=', $clientID)
                ->where('Cust_Name1', '<>', 'Saját cég')
                ->groupBy('Cust_Name1', 'Cust_ID')
                ->orderBy('Cust_Name1', 'asc')
                ->select('Cust_ID', 'Cust_Name1')
                ->get()
                ->toArray();

        $vendors = InvoiceModel::where('ClientID', '=', $clientID)
                ->where('Vendor_Name1', '<>', 'Saját cég')
                ->groupBy('Vendor_Name1', 'Vendor_ID')
                ->orderBy('Vendor_Name1', 'asc')
                ->select('Vendor_ID', 'Vendor_Name1')
                ->get()
                ->toArray();

        return view(session()->get('version') . '.invNew.index', [
            'customers' => $customers,
            'vendors' => $vendors,
        ]);
    }

}

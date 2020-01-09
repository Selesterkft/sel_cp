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
        $supervisorID = $loggedUser->Supervisor_ID;
        
        if( $request->ajax() )
        {
            //dd($request->all());
            $model = new InvoiceModel();
            $model = $model->raw(config('appConfig.raw'));
            $model = $model->where('ClientID', '=', $clientID);
            
            //$filteredCount = null;

            $limit = null;
            if( $request->has('limit') )
            {
                $limit = $request->get('limit');
            }
            
            $offset = null;
            if( $request->has('offset') )
            {
                $offset = $request->get('offset');
            }
            
            $sort = null;
            if( $request->has('sort') )
            {
                $sort = $request->get('sort');
            }
            $order = 'asc';
            if( $request->has('order') )
            {
                $order = $request->get('order');
            }
            
            /*
            if( !empty($request->get('s_invNum')) )
            {
                $model = $model
                        ->where('Inv_Num', 'like', '%' . $request->get('s_invNum') . '%');
                //echo('<pre>');
                //print_r("Inv_Num: %{$request->get('s_invNum')}%\n");
                //echo('</pre>');
            }
            else
            {
                if( $supervisorID == 0 )
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
                    $model = $model->where(function($q) use($supervisorID)
                    {
                        $q->where('Vendor_ID', '=', $supervisorID)
                                ->orWhere('Cust_ID', '=', $supervisorID);
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
            }
            */
            
            // SORTING
            //$model = $model->orderBy('Inv_Num', 'asc');
            
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
            print_r("custID: {$request->get('s_customer')}\n");
            print_r("vendorID: {$request->get('s_vendor')}\n");
            print_r("delivery:{$datum[0]}, {$datum[1]}\n");
            print_r($model->toSql());
            echo('</pre>');
            */
            
            $result = $model->select('Inv_Num'
, 'Vendor_Name1'
, 'Cust_Name1'
, 'InvDate'
, 'DeliveryDate'
, 'DueDate'
, 'PostInDate'
, 'InvInDueDate'
, 'Netto_LC'
, 'Tax_LC'
, 'Brutto_LC'
, 'PaidAmount_DC'
, 'PaidAmount_FC'
, 'Curr_ID'
, 'Brutto_LC'
, 'Tax_FC'
, 'Brutto_FC')
                    ->get()
                    ->toArray();
            
            //dd('InvController.index', $result);
            
            $invoices = [
                'total' => InvoiceModel::count(),
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
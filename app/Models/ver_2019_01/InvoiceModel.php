<?php

namespace App\Models\ver_2019_01;

use Illuminate\Database\Eloquent\Model;

class InvoiceModel extends Model
{
    protected $connection;
    protected $table;
    protected $primaryKey;
    protected $fillable = [
        'Inv_ID',                    'SELEXPED_INV_ID',    'Inv_Num',            'Inv_SeqNum',
        'ACCT_Period',                'INV_Type_ID',        'INV_Type',           'Ref_Inv',
        'Cancellation_ReasonCode',    'Partner_Name',       'Partner_Address',    'Partner_Country_ZIP_City',
        'Partner_Bank_Account',       'Type_of_Invoice',    'Period_From_To',     'InvDate',
        'DeliveryDate',               'PaymentMethod_ID',   'PaymentMethod',      'DueDate',
        'PostInDate',                 'Net_LC',             'Tax_LC',             'Gross_LC',
        'PayStatus_ID',               'PayStatus',          'PaidAmount_DC',      'PaidAmount_FC',
        'PaidAmount_LC',              'Net_DC',             'Tax_DC',             'Gross_DC',
        'Curr_DC',                    'Net_FC',             'Tax_FC',             'Gross_FC',
        'Remarks',                    'Attachments',        'Added_User',         'Cust_ID',
        'Vendor_ID'
    ];
    /**
     * Invoice2Model constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tavles.invoices.' . session()->get('version'));
        $this->setConnection($config['connection']);
        $this->setTable($config['read']);
    }

    public function getFillable()
    {
        return $this->fillable;
    }

    public static function all($columns = ['*'])
    {
        //dd('Invoice2Model::all', request()->all());
        $config = config('appConfig.tables.invoices.' . session()->get('version'));
        //dd('Invoice2Model::all', $config);
        $loggedUser = \Auth::user();
        $supervisor_id = $loggedUser->Supervisor_ID;

        $columns = implode(',', $columns);
        $session_id = session()->getId();
        $client_id = (int)$loggedUser->CompanyID;
        $cp_users_id = $loggedUser->ID;
        $lang = app()->getLocale();
        $limit = 0;
        $offset = 0;
        $where = '';

        //$model = new Invoice2Model();
        //$model->setConnection($config['connection']);
        //$model->setTable("EXECUTE [dbo].[{$config['read2']}] '{$session_id}',{$client_id},{$cp_users_id},'{$lang}',{$limit},{$offset},'{$where}''");

        //dd('Invoice2Model.all', $model->toSql());

        //$totalNotFiltered = $model->count();

        if( !empty(request()->get('s_invNum')) )
        {
            $where = "WHERE Inv_Num = ''" . request()->get('s_invNum') . "''";
        }
        else
        {
            if( $supervisor_id != 0 )
            {
                $where .= ( strlen($where) == 0 ) ? 'WHERE ' : ' AND ' . 'Partner_ID = ' . $supervisor_id;
            }elseif( !empty(request()->get('s_customer')) )
            {
                $where .= (( strlen($where) == 0 ) ? 'WHERE ' : ' AND ') . 'Partner_ID = ' . request()->get('s_customer');
            }

            if( !empty(request()->get('s_delivery_date')) )
            {
                $delivery_date = explode(' - ', request()->get('s_delivery_date'));
                $where .= ((strlen($where) == 0) ? 'WHERE ' : ' AND ') . "DeliveryDate BETWEEN ''{$delivery_date[0]}'' AND ''{$delivery_date[1]}''";
            }

            if( !empty(request()->get('s_due_date')) )
            {
                $due_date = explode(' - ', request()->get('s_due_date'));
                $where .= ((strlen($where) == 0) ? 'WHERE ' : ' AND ') . "DueDate BETWEEN ''{$due_date[0]}'' AND ''{$due_date[1]}''";
            }

            if( !empty(request()->get('s_type')) )
            {
                $where .= ((strlen($where) == 0) ? 'WHERE ' : ' AND ') . 'Inv_Type_ID = ' . request()->get('s_type');
                //dd('Invoice2Model::all', $where);
            }
        }

        //dd('Invoice2Model::all', request()->all());

        $sort = '';
        if( !empty(request()->get('sort')) )
        {
            $sort = request()->get('sort');
            $order = 'asc';
            if( !empty(request()->get('order')) )
            {
                $order = request()->get('order');
            }
            $sort .= " {$order}";
        }

        //dd('Invoice2Model::all', $sort);

        if( request()->has('limit') )
        {
            $limit = request()->get('limit');
        }
        if( request()->has('offset') )
        {
            $offset = request()->get('offset');
        }

        $query = "EXECUTE [dbo].[{$config['read2']}] '{$session_id}',{$client_id},{$cp_users_id},'{$lang}',0,0,'{$where}',''";

        $res = \DB::connection($config['connection'])
            ->select(\DB::raw($query));

        $total = count($res);

        $query = "EXECUTE [dbo].[{$config['read2']}] '{$session_id}',{$client_id},{$cp_users_id},'{$lang}',{$offset},{$limit},'{$where}', '{$sort}'";
        //dd('Invoice2Model::all', $query);
        $res = \DB::connection($config['connection'])
            ->select(\DB::raw($query));
        //dd('Invoice2Model::all', $res);
        $invoices = [
            'query' => $query,
            'where' => $where,
            'total' => $total,
            'totalNotFiltered' => count($res),
            'rows' => $res,
        ];
        return json_encode($invoices);
        //dd('Invoice2Model::all', "EXECUTE [dbo].[{$config['read2']}] '{$session_id}',{$client_id},{$cp_users_id},'{$lang}',{$offset},{$limit},'{$where}'", $res);
    }

    public static function all2($columns = ['*'])
    {
        $config = config('appConfig.tables.invoices.' . session()->get('version'));
        $loggedUser = \Auth::user();
        $supervisor_id = $loggedUser->Supervisor_ID;

        $columns = implode(',', $columns);
        $session_id = session()->getId();
        $client_id = (int)$loggedUser->CompanyID;
        $cp_users_id = $loggedUser->ID;
        $lang = app()->getLocale();
        $limit = 0;
        $offset = 0;

        $model = new InvoiceModel();
        $model->setConnection($config['connection']);

        //$model->setTable("EXECUTE [dbo].[{$config['read2']}] '{$session_id}', {$client_id}, {$cp_users_id}, '{$lang}', {$limit}, {$offset}, @where");
        $model->setTable("{$config['read']}('{$session_id}',{$client_id},{$cp_users_id},'{$lang}')");

        $totalNotFiltered = $model->count();

        if( !empty(request()->get('s_invNum')) )
        {
            $model = $model->where('Inv_Num', '=', request()->get('s_invNum'));
        }
        else
        {
            if( $supervisor_id == 0 )
            {
                if( request()->get('s_vendor') != 0 )
                {
                    $model = $model->where('Vendor_ID', '=', request()->get('s_vendor'));
                }
                if( request()->get('s_customer') != 0 )
                {
                    $model = $model->where('Cust_ID', '=', request()->get('s_customer'));
                }
            }
            else
            {
                $model = $model->where(function($q)use($supervisor_id)
                {
                    $q->where('Vendor_ID', '=', $supervisor_id)
                        ->orWhere('Cust_ID', '=', $supervisor_id);
                });
            }
        }

        if( !empty(request()->get('s_delivery_date')) )
        {
            $delivery_date = explode(' - ', request()->get('s_delivery_date'));
            $model = $model->whereBetween('DeliveryDate', $delivery_date[0], $delivery_date[1]);
        }
        if( !empty(request()->get('s_due_date')) )
        {
            $due_date = explode('', request()->get('s_due_date'));
            $model = $model->whereBetween('DueDate', $due_date[0], $due_date[1]);
        }
        if( !empty(request()->get('s_type')) )
        {
            $model = $model->where('TypeID', '=', request()->get('s_type'));
        }

        $total = $model->count();

        //dd('Invoice2Model::all', request()->all(), $model->toSql());

        // Oldaltörés
        if( request()->has('limit') )
        {
            $model = $model->take(request()->get('limit'));
        }

        if( request()->has('offset') )
        {
            $model = $model->skip(request()->get('offset'));
        }

        // Rendezés
        $sort = (request()->has('sort')) ? request()->get('sort') : null;
        $order = (request()->has('order')) ? request()->get('order') : 'asc';
        if( $sort && $order )
        {
            $model = $model->orderBy($sort, $order);
        }

        $model = $model->select($columns);
        dd('Invoice2Model', request()->all(), $model->toSql());
        $result = $model->get()->toArray();

        $invoices = [
            'total' => $total,
            'totalNotFiltered' => $totalNotFiltered,
            'rows' => $result,
        ];
        //dd('Invoice2Model', $invoices);
        return json_encode($invoices);
    }

    /*
     *  Visszaadja a számlákon szereplő vevőket
     */
    public static function getCustomers(int $clientID) : array
    {
        $config = config('appConfig.tables.invoices.' . session()->get('version'));
        $res = \DB::connection($config['connection'])
            ->select(\DB::raw("SELECT Cust_ID,Cust_Name1 
                                    FROM {$config['getCustomers']} 
                                    WHERE ClientID = :client_id 
                                    ORDER BY Cust_Name1"), ['client_id' => $clientID]);

        return $res;
    }
    /*
     *  Visszaadja a számlákon szereplő eladókat
     */
    public static function getVendors(int $clientID) : array
    {
        $config = config('appConfig.tables.invoices.' . session()->get('version'));
        $res = \DB::connection($config['connection'])
            ->select(\DB::raw("SELECT Vendor_ID,Vendor_Name1 
                                    FROM {$config['getVendors']} 
                                    WHERE ClientID = :client_id 
                                    ORDER BY Vendor_Name1"), ['client_id' => $clientID]);
        return $res;
    }

    public static function getInvoice(int $id)
    {
        $config = config('appConfig.tables.invoices.' . session()->get('version'));
        $loggedUser = \Auth::user();
        $supervisor_id = $loggedUser->Supervisor_ID;

        $session_id = session()->getId();
        $client_id = (int)$loggedUser->CompanyID;
        $cp_users_id = $loggedUser->ID;
        $lang = app()->getLocale();

        $model = new InvoiceModel();
        $model->setConnection($config['connection']);
        $model->setTable("{$config['read']}('{$session_id}',{$client_id},{$cp_users_id},'{$lang}')");
        $model = $model->where('SELEXPED_INV_ID', '=', $id);

        // Oldaltörés
        if( request()->has('limit') )
        {
            $model = $model->take(request()->get('limit'));
        }

        if( request()->has('offset') )
        {
            $model = $model->skip(request()->get('offset'));
        }

        // Rendezés
        $sort = (request()->has('sort')) ? request()->get('sort') : null;
        $order = (request()->has('order')) ? request()->get('order') : 'asc';
        if( $sort && $order )
        {
            $model = $model->orderBy($sort, $order);
        }

        //$model = $model->select(implode(',', $fillable ));

        $total = $totalNotFiltered = $model->count();

        $invoice = $model->first();

        //dd('Invoice2Model', $invoice);

        return $invoice;
    }

    public static function getCountOfInvoices()
    {
        $count = 0;

        $loggedUser = \Auth::user();

        $model = app()->make('\App\Models\\' . session()->get('version') . '\InvoiceModel');
        $config = config('appConfig.tables.invoices.' . session()->get('version'));
        //dd('InvoiceModel::getCountOfInvoices', $config);
        $model->setConnection($config['connection']);
        $model->setTable($config['table']);
        $model = $model
            ->where('ClientID', '=', $loggedUser->CompanyID);

        if( $loggedUser->Supervisor_ID != 0 )
        {
            $model = $model
                ->where('Vendor_ID', '=', $loggedUser->Supervisor_ID)
                ->orWhere('Cust_ID', '=', $loggedUser->Supervisor_ID);
        }

        //dd('InvoiceModel::getCountOfInvoices', $model);

        $count = $model->count();

        return $count;
        //return InvoiceModel::all()->count();
    }

    public function getWidgetData()
    {
        $loggedUser = \Auth::user();

        $CompanyID = $loggedUser->CompanyID;
        $Supervisor_ID = ($loggedUser->Supervisor_ID == 0) ? 0 : $loggedUser->Supervisor_ID;

        $config = config('appConfig.tables.invoices.' . session()->get('version'));
        $res = \DB::connection($config['connection'])
            ->select(\DB::connection($config['connection'])
                ->raw("EXECUTE [dbo].[{$config['widget_read']}] ?, ?"),
                [
                    (int)$CompanyID,
                    $Supervisor_ID
                ]);
        //dd('InvoiceModel.getWidgetData', $loggedUser, $CompanyID, $Supervisor_ID, $config, $res);
        return $res;

    }

}

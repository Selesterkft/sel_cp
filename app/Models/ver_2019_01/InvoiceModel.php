<?php

namespace App\Models\ver_2019_01;

//use EloquentFilter\Filterable;

use DB;

class InvoiceModel extends \Eloquent
{
    //use Filterable;

    protected $connection = 'azure';
    protected $table = 'CP_Inv_Read';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID', 'SELEXPED_INV_ID', 'ClientID', 'TransactID', 'Inv_Num', 'CancelInv_Num', 'Inv_Num_int', 'Inv_SeqNum', 'ACCT_Periods_ID',
        'TypeID', 'Ref_Inv_ID', 'Parent_INV_ID', 'Current_Valid_Correction_Note_ID', 'Inv_Status', 'FormatID',
        'Printed', 'CancelPrinted', 'CancelDate', 'Cancellation_ReasonCode', 'Cancellation_ReasonText', 'ClosedYN',
        'Note2', 'Vendor_ID', 'Vendor_Name1', 'Vendor_Name2', 'Vendor_Country', 'Vendor_State', 'Vendor_ZIP',
        'Vendor_Addr_District', 'Vendor_City', 'Vendor_Addr', 'Vendor_Addr_ps_type', 'Vendor_Addr_housenr',
        'Vendor_Addr_building', 'Vendor_Addr_stairway', 'Vendor_Addr_floor', 'Vendor_Addr_door', 'Vendor_TaxNum',
        'Vendor_TaxNum2', 'Vendor_BankCode', 'Vendor_BankAcc', 'Vendor_IBAN', 'Vendor_AccNum_ID', 'Cust_ID',
        'Cust_Name1', 'Cust_Name2', 'Cust_Country', 'Cust_State', 'Cust_ZIP', 'Customer_Addr_District', 'Cust_City',
        'Cust_Addr', 'Customer_Addr_ps_type', 'Customer_Addr_housenr', 'Customer_Addr_building',
        'Customer_Addr_stairway', 'Customer_Addr_floor', 'Customer_Addr_door', 'Cust_TaxNum', 'Cust_TaxNum2',
        'Cust_BankCode', 'Cust_BankAcc', 'Cust_IBAN', 'Cust_AccNum_ID', 'Bank_AC_ID', 'ClassID', 'Period_FROM',
        'Period_TO', 'InvDate', 'DeliveryDate', 'Curr_Dates_Method', 'CurrDate', 'AccDate', 'PaymentMethod',
        'DueDate', 'PostInDate', 'InvInDueDate', 'Netto_LC', 'Tax_LC', 'Brutto_LC', 'PayStatus', 'Fully_paid_date',
        'PaidAmount_DC', 'PaidAmount_FC', 'PaidAmount_LC', 'Netto_DC', 'Tax_DC', 'Brutto_DC', 'Lang', 'Curr_ID',
        'Netto_FC', 'Tax_FC', 'Brutto_FC', 'Remarks', 'Attachments', 'Added_Date', 'Added_Users_ID', 'ACC_Info',
        'SAP_DocEntry', 'Subcontracted_Services', 'Wrhs_Tran_ID', 'Prev_Ref_INV_ID', 'UserFld_int01', 'UserFld_int02',
        'UserFld_int03', 'UserFld_float01', 'UserFld_float02', 'UserFld_float03', 'UserFld_nvarchar01',
        'UserFld_nvarchar02', 'UserFld_nvarchar03', 'UserFld_date01', 'UserFld_date02', 'UserFld_date03'];

    protected $dates = [
        'InvDate'
    ];
    protected $dateFormat = '';

    public function reszletek()
    {
        $res = $this->hasMany('App\Models\\' . session()->get('version') . '\InvoiceDetailModel', 'SELEXPED_INV_ID', 'Inv_ID');
        //dd('InvoiceModel.reszletek', $res);
        return $res;
        //return $this->hasMany('App\Models\\' . session()->get('version') . '\InvoiceDetailModel', 'Inv_ID', 'SELEXPED_INV_ID');
    }

    public function client()
    {
        return $this->hasOne('\App\Models\\' . session()->get('version') . '\CompanyModel', 'ID', 'ClientID');
    }

    public function vendor()
    {
        //return $this->hasOne(\App\Models\CompanyModel::class, 'ID', 'Vendor_ID');
        return $this->hasOne('\App\Models\\' . session()->get('version') . '\CompanyModel', 'ID', 'Vendor_ID');
    }

    public function customer()
    {
        return $this->hasOne('\App\Models\\' . session()->get('version') . '\CompanyModel', 'ID', 'Cust_ID');
    }

    //public function modelFilter()
    //{
    //    return $this->provideFilter(\App\ModelFilters\InvoiceFilter::class);
    //}

    public static function getCountOfInvoices()
    {
        $count = 0;
        $loggedUser = \Auth::user();

        $model = app()->make('\App\Models\\' . session()->get('version') . '\InvoiceModel');
        $model = $model
                ->where('ClientID', '=', $loggedUser->CompanyID);

        if( $loggedUser->Supervisor_ID != 0 )
        {
            $model = $model
                    ->where('Vendor_ID', '=', $loggedUser->Supervisor_ID)
                    ->orWhere('Cust_ID', '=', $loggedUser->Supervisor_ID);
        }

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
        $res = DB::connection($config['connection'])
            ->select(DB::connection($config['connection'])
                ->raw("EXECUTE [dbo].[{$config['widget_read']}] ?, ?"),
            [
                (int)$CompanyID,
                $Supervisor_ID
            ]);
        //dd('InvoiceModel.getWidgetData', $loggedUser, $CompanyID, $Supervisor_ID, $config, $res);
        return $res;

    }

    /**
     * InvoiceModel constructor.
     * @param string $connection
     */
    public function __construct()
    {
        $config = config('appConfig.tables.invoices.' . session()->get('version'));
        //dd('InvoiceModel.construct', $config);
        $this->connection = $config['connection'];
        $this->table = $config['read'];
    }
}

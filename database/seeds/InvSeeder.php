<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class InvSeeder extends Seeder
{
    protected $connection, $table;
    /**
     * invSeeder constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.invoices');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = Carbon::now();

        for($i = 1; $i <= 10; $i++)
        {
            $data[] = [
                'ID' => $i, 'ClientID' => '', 'TransactID' => '0', 'Inv_Num' => "Teszt_inv_{$i}", 'CancelInv_Num' => '0',
                'Inv_Num_int' => '0', 'Inv_SeqNum' => '0', 'ACCT_Periods_ID' => '0', 'TypeID' => 202, 'Ref_Inv_ID' => '0',
                'Parent_INV_ID' => '0', 'Current_Valid_Correction_Note_ID' => '0', 'Inv_Status' => '4', 'FormatID' => '0', 'Printed' => false,
                'CancelPrinted' => false, 'CancelDate' => null, 'Cancellation_ReasonCode' => '0', 'Cancellation_ReasonText' => '', 'ClosedYN' => false,
                'Note2' => '', 'Vendor_ID' => '1', 'Vendor_Name1' => "Vendor_{$i}", 'Vendor_Name2' => '', 'Vendor_Country' => 'HU',
                'Vendor_State' => '', 'Vendor_ZIP' => '', 'Vendor_Addr_District' => '', 'Vendor_City' => 'Budapest', 'Vendor_Addr' => '',
                'Vendor_Addr_ps_type' => '', 'Vendor_Addr_housenr' => '', 'Vendor_Addr_building' => '', 'Vendor_Addr_stairway' => '', 'Vendor_Addr_floor' => '',
                'Vendor_Addr_door' => '', 'Vendor_TaxNum' => '', 'Vendor_TaxNum2' => '', 'Vendor_BankCode' => '', 'Vendor_BankAcc' => '',
                'Vendor_IBAN' => '', 'Vendor_AccNum_ID' => '1408', 'Cust_ID' => '1409', 'Cust_Name1' => "Cust_{$i}", 'Cust_Name2' => '',
                'Cust_Country' => 'HU', 'Cust_State' => '', 'Cust_ZIP' => '', 'Customer_Addr_District' => '', 'Cust_City' => 'Budapest',
                'Cust_Addr' => '', 'Customer_Addr_ps_type' => '', 'Customer_Addr_housenr' => '', 'Customer_Addr_building' => '', 'Customer_Addr_stairway' => '',
                'Customer_Addr_floor' => '', 'Customer_Addr_door' => '', 'Cust_TaxNum' => '', 'Cust_TaxNum2' => '', 'Cust_BankCode' => '',
                'Cust_BankAcc' => '', 'Cust_IBAN' => '', 'Cust_AccNum_ID' => '', 'Bank_AC_ID' => '', 'ClassID' => '',
                'Period_FROM' => '', 'Period_TO' => '', 'InvDate' => $carbon, 'DeliveryDate' => $carbon, 'Curr_Dates_Method' => '0',
                'CurrDate' => '', 'AccDate' => $carbon, 'PaymentMethod' => '', 'DueDate' => $carbon, 'PostInDate' => $carbon,
                'InvInDueDate' => $carbon, 'Netto_LC' => 1000, 'Tax_LC' => 100, 'Brutto_LC' => 900, 'PayStatus' => 1,
                'Fully_paid_date' => null, 'PaidAmount_DC' => 0, 'PaidAmount_FC' => 0, 'PaidAmount_LC' => 0, 'Netto_DC' => 1230,
                'Tax_DC' => 2342, 'Brutto_DC' => 13123, 'Lang' => 'H', 'Curr_ID' => 1405, 'Netto_FC' => 11.233,
                'Tax_FC' => 234.23, 'Brutto_FC' => 4564.7, 'Remarks' => 'Teszt számla', 'Attachments' => '', 'Added_Date' => $carbon,
                'Added_Users_ID' => 1403, 'ACC_Info' => '', 'SAP_DocEntry' => '', 'Subcontracted_Services' => true, 'Wrhs_Tran_ID' => 0,
                'Prev_Ref_INV_ID' => 0, 'UserFld_int01' => 0, 'UserFld_int02' => 0, 'UserFld_int03' => 0, 'UserFld_float01' => 0,
                'UserFld_float02' => 0, 'UserFld_float03' => 0, 'UserFld_nvarchar01' => '', 'UserFld_nvarchar02' => '', 'UserFld_nvarchar03' => '',
                'UserFld_date01' => null, 'UserFld_date02' => null, 'UserFld_date03' => null
            ];

            $inv = new App\Models\Invoices\InvoiceModelNew();
            $inv->save($data);
            dd($inv);
        }
    }
}

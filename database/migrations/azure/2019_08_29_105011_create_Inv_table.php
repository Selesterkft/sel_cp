<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Inv', function(Blueprint $table)
		{
			$table->integer('ID');
			$table->integer('ClientID');
			$table->integer('TransactID');
			$table->string('Inv_Num', 25);
			$table->integer('CancelInv_Num');
			$table->integer('Inv_Num_int');
			$table->integer('Inv_SeqNum');
			$table->integer('ACCT_Periods_ID');
			$table->integer('TypeID');
			$table->integer('Ref_Inv_ID');
			$table->integer('Parent_INV_ID');
			$table->integer('Current_Valid_Correction_Note_ID');
			$table->integer('Inv_Status');
			$table->integer('FormatID');
			$table->boolean('Printed');
			$table->boolean('CancelPrinted');
			$table->dateTime('CancelDate')->nullable();
			$table->integer('Cancellation_ReasonCode');
			$table->string('Cancellation_ReasonText');
			$table->boolean('ClosedYN');
			$table->string('Note2', 50);
			$table->integer('Vendor_ID');
			$table->string('Vendor_Name1', 100);
			$table->string('Vendor_Name2', 50);
			$table->string('Vendor_Country', 3);
			$table->string('Vendor_State', 10);
			$table->string('Vendor_ZIP', 12);
			$table->string('Vendor_Addr_District', 24);
			$table->string('Vendor_City', 50);
			$table->string('Vendor_Addr', 100);
			$table->string('Vendor_Addr_ps_type', 24);
			$table->string('Vendor_Addr_housenr', 24);
			$table->string('Vendor_Addr_building', 24);
			$table->string('Vendor_Addr_stairway', 24);
			$table->string('Vendor_Addr_floor', 24);
			$table->string('Vendor_Addr_door', 24);
			$table->string('Vendor_TaxNum', 20);
			$table->string('Vendor_TaxNum2', 50);
			$table->string('Vendor_BankCode', 12);
			$table->string('Vendor_BankAcc', 26);
			$table->string('Vendor_IBAN', 70);
			$table->integer('Vendor_AccNum_ID');
			$table->integer('Cust_ID');
			$table->string('Cust_Name1', 100);
			$table->string('Cust_Name2', 50);
			$table->string('Cust_Country', 3);
			$table->string('Cust_State', 10);
			$table->string('Cust_ZIP', 12);
			$table->string('Customer_Addr_District', 24);
			$table->string('Cust_City', 50);
			$table->string('Cust_Addr', 100);
			$table->string('Customer_Addr_ps_type', 24);
			$table->string('Customer_Addr_housenr', 24);
			$table->string('Customer_Addr_building', 24);
			$table->string('Customer_Addr_stairway', 24);
			$table->string('Customer_Addr_floor', 24);
			$table->string('Customer_Addr_door', 24);
			$table->string('Cust_TaxNum', 20);
			$table->string('Cust_TaxNum2', 50);
			$table->string('Cust_BankCode', 12);
			$table->string('Cust_BankAcc', 26);
			$table->string('Cust_IBAN', 70);
			$table->integer('Cust_AccNum_ID');
			$table->integer('Bank_AC_ID');
			$table->integer('ClassID');
			$table->dateTime('Period_FROM')->nullable();
			$table->dateTime('Period_TO')->nullable();
			$table->dateTime('InvDate');
			$table->dateTime('DeliveryDate');
			$table->integer('Curr_Dates_Method');
			$table->dateTime('CurrDate')->nullable();
			$table->dateTime('AccDate');
			$table->integer('PaymentMethod');
			$table->dateTime('DueDate');
			$table->dateTime('PostInDate');
			$table->dateTime('InvInDueDate');
			$table->float('Net_LC', 53, 0);
			$table->float('Tax_LC', 53, 0);
			$table->float('Gross_LC', 53, 0);
			$table->integer('PayStatus');
			$table->dateTime('Fully_paid_date')->nullable();
			$table->float('PaidAmount_DC', 53, 0);
			$table->float('PaidAmount_FC', 53, 0);
			$table->float('PaidAmount_LC', 53, 0);
			$table->float('Net_DC', 53, 0);
			$table->float('Tax_DC', 53, 0);
			$table->float('Gross_DC', 53, 0);
			$table->string('Lang', 3);
			$table->integer('Curr_ID');
			$table->float('Net_FC', 53, 0);
			$table->float('Tax_FC', 53, 0);
			$table->float('Gross_FC', 53, 0);
			$table->string('Remarks')->nullable();
			$table->string('Attachments')->nullable();
			$table->dateTime('Added_Date')->nullable();
			$table->integer('Added_Users_ID');
			$table->string('ACC_Info', 20);
			$table->integer('SAP_DocEntry');
			$table->boolean('Subcontracted_Services');
			$table->integer('Wrhs_Tran_ID');
			$table->integer('Prev_Ref_INV_ID');
			$table->integer('UserFld_int01');
			$table->integer('UserFld_int02');
			$table->integer('UserFld_int03');
			$table->float('UserFld_float01', 53, 0);
			$table->float('UserFld_float02', 53, 0);
			$table->float('UserFld_float03', 53, 0);
			$table->string('UserFld_nvarchar01', 50);
			$table->string('UserFld_nvarchar02', 50);
			$table->string('UserFld_nvarchar03', 50);
			$table->dateTime('UserFld_date01')->nullable();
			$table->dateTime('UserFld_date02')->nullable();
			$table->dateTime('UserFld_date03')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Inv');
	}

}

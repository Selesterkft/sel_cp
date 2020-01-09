<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::connection('azure')->create('Addresses', function(Blueprint $table)
		{
			$table->integer('ID')->primary('PK_Addresses');
			$table->integer('TransactID');
			$table->integer('ParentTable_ID')->index('IX_Addresses_ParentTable_ID')->comment(' 1 = ORD; 2 = ORD_L; 3 = Wrhs_L; 4=Routes');
			$table->integer('ParentRecord_ID')->index('IX_Addresses_ParentRecord_ID');
			$table->integer('AddressTypes_ID')->index('IX_Addresses_AddressTypes_ID');
			$table->integer('SeqNum')->default(0)->index('IX_Addresses_SeqNum');
			$table->integer('Cust_ID')->index('IX_Addresses_Cust_ID');
			$table->string('Name1', 100);
			$table->string('Name2', 50);
			$table->integer('Country_ID')->default(0);
			$table->string('Country', 3)->index('IX_Addresses_Country');
			$table->string('State', 10);
			$table->string('ZIP', 12);
			$table->string('District', 24);
			$table->string('City', 50)->index('IX_Addresses_City');
			$table->string('Addr', 100);
			$table->string('Addr_ps_type', 24);
			$table->string('Addr_housenr', 24);
			$table->string('Addr_building', 24);
			$table->string('Addr_stairway', 24);
			$table->string('Addr_floor', 24);
			$table->string('Addr_door', 24);
			$table->string('Spec_Addr');
			$table->string('Contact', 50);
			$table->string('Tel', 50);
			$table->string('Fax', 50);
			$table->string('Email', 50);
			$table->string('Skype', 128)->default('');
			$table->string('OtherCommunication', 128)->default('');
			$table->string('Remarks');
			$table->dateTime('Date1_FROM')->nullable()->index('IX_Addresses_Date1_FROM');
			$table->dateTime('Date1_TO')->nullable();
			$table->dateTime('Date2_FROM')->nullable()->index('IX_Addresses_Date2_FROM');
			$table->dateTime('Date2_TO')->nullable();
			$table->dateTime('Date3_FROM')->nullable();
			$table->dateTime('Date3_TO')->nullable();
			$table->dateTime('Date4_FROM')->nullable();
			$table->dateTime('Date4_TO')->nullable();
			$table->string('DocNum01', 50)->index('IX_Addresses_DocNum1');
			$table->string('DocNum02', 50)->index('IX_Addresses_DocNum2');
			$table->string('DocNum03', 50);
			$table->string('DocNum04', 50);
			$table->string('DocNum05', 50);
			$table->string('DocNum06', 50);
			$table->string('DocNum07', 50);
			$table->string('DocNum08', 50);
			$table->string('DocNum09', 50);
			$table->string('DocNum10', 50);
			$table->boolean('Payment_Spec_Agreement_YN')->default(0);
			$table->integer('Payment_Spec_Agreement_Deadline_Type')->default(0);
			$table->integer('Payment_Spec_Agreement_Deadline_Days')->default(0);
			$table->integer('Payment_Spec_Agreement_Currency')->default(0);
			$table->string('Internal_Remarks')->default('');
			$table->unique(['ParentTable_ID','ParentRecord_ID','AddressTypes_ID'], 'IX_Addresses');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('azure')->drop('Addresses');
	}

}

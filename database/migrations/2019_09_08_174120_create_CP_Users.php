<?php

/*
 * INSERT INTO CP_Users(ID, TransactID, CompanyID, Supervisor_ID,     Supervisor_Name,              [Name],                     Email,                                                     [password], [language], last_login_at, last_login_ip,                created_at,                updated_at, deleted_at)
   VALUES				( 1,          0,        71,             0,                NULL, 'Selester Admin 01',    'admin_01@selester.hu', '$2y$10$58StagiiaouCehq9Y3XDTue6c8VlYXkn6Qh6zditwnw/AreC93zUe',       'hu',          NULL,          NULL, '2019-10-07 12:47:28.130', '2019-10-07 12:47:28.130',       NULL),
	     				(2,           0,   1038476,             0,                NULL,      'Vámunió Ádám', 'vamunio.adam@vamunio.hu', '$2y$10$58StagiiaouCehq9Y3XDTue6c8VlYXkn6Qh6zditwnw/AreC93zUe',       'hu',          NULL,          NULL, '2019-10-07 12:47:28.130', '2019-10-07 12:47:28.130',       NULL)
 * */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCPUsers extends Migration
{
    protected $connection, $table;

    /**
     * CreateCPUsers constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.users');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }


    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::connection($this->connection)
            ->dropIfExists($this->table);

		Schema::connection($this->connection)
            ->create($this->table, function(Blueprint $table)
		{
			$table->integer('ID')
                ->index('IX_cp_users_id');

			$table->integer('TransactID')->nullable();
			$table->integer('CompanyID');

			$table->integer('Supervisor_ID')
                ->nullable()
                ->default(0)
                ->index('IX_cp_users_supervisor_id');

			$table->string('Supervisor_Name', 255)
                ->nullable()
                ->index('IX_cp_users_supervisor_name');

			$table->string('Name')->nullable();
			$table->string('Email', 255)
                ->nullable()
                ->index('IX_cp_users_email');

			$table->string('password');
			$table->string('language', 2)->default('hu');

			$table->timestamp('last_login_at')->nullable();
			$table->string('last_login_ip')->nullable();

			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection($this->connection)
            ->drop($this->table);
	}

}

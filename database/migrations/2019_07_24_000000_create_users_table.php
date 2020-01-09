<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    protected $connection, $table;

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
            ->create($this->table, function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('name', 255);
                $table->string('email', 255)->unique()->index('IX_users_email');
                $table->integer('lockout_time')->default(0);
                $table->integer('company_id')->index('IX_users_company_id');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();

                $table->timestamps();
                $table->softDeletes();
            });
        /*
        Schema::create('users', function (Blueprint $table) {

        });
        */
        /*
        Artisan::call('db:seed', [
            '--class' => UserSeeder::class,
        ]);
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)
            ->dropIfExists($this->table);
    }
}

<?php

use Illuminate\Database\Seeder;
//use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    protected $connection, $table;
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = Carbon::now();

        // Az általam átadott adatokkal készül el a rekord
/*
        $user = factory(App\User::class)->create(array(
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => null,
            'password' => bcrypt('admin'),
            'remember_token' => null,
            'created_at' => $carbon,
            'updated_at' => $carbon,
        ));
*/
        $data = [
            'ID' => '1',
            'Name' => 'Kovács Zoltán',
            'Email' => 'zoltan1_kovacs@msn.com',
            'password' => bcrypt('123456'),
            'language' => 'hu',
            'TransactID' => '0',
            'CompanyID' => '71',
            'Supervisor_ID' => '0',
            'created_at' => $carbon,
            'updated_at' => $carbon,
        ];
        $usr = new \App\User();
        $user = $usr->CreateUser($data);

        // Generált adatokkal készül el a count-ban megadott számú sor
        //$count = 100;
        //factory(App\User::class, $count)->create();
    }

    /**
     * MenuSeeder constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.users');
        $this->table = $config['table'];
        $this->connection = $config['connection'];
    }
}

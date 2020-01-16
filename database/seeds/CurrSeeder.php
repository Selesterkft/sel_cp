<?php

use App\Models\CurrModel;
use Illuminate\Database\Seeder;

class CurrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = config('appConfig.tables.currencies');

        DB::connection($config['connection'])->table($config['table'])->truncate();

        $datas = [
            ['Curr_ID' => 16, 'Curr_DC' => 'HUF'],
            ['Curr_ID' => 17, 'Curr_DC' => '???'],
            ['Curr_ID' => 79718, 'Curr_DC' => 'EUR'],
            ['Curr_ID' => 79719, 'Curr_DC' => 'USD'],
            ['Curr_ID' => 296233, 'Curr_DC' => 'JPY'],
            ['Curr_ID' => 7037163, 'Curr_DC' => 'THB'],
            ['Curr_ID' => 7458443,  'Curr_DC' => 'MYR'],
            ['Curr_ID' => 7458456,  'Curr_DC' => 'CNY'],
            ['Curr_ID' => 7458474,  'Curr_DC' => 'HKD'],
            ['Curr_ID' => 29597332, 'Curr_DC' => 'KRW'],
        ];

        foreach($datas as $data)
        {
            $currModel = new CurrModel();
            $currModel->fill($data);
            $currModel->save();
        }
    }
}

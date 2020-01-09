<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    private $_table;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $carbon = Carbon::now();

        DB::table($this->_table)->truncate();

        $data = array(
            array(
                'id' => 1, 'parent' => null, 'name' => 'Műszerfal', 'icon' => 'fa fa-dashboard', 'slug' => '#', 'number' => 1,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '1||Műszerfal|fa fa-dashboard|#|1'),
                'created_at' => $carbon, 'updated_at' => $carbon,
            ),
            array(
                'id' => 2, 'parent' => null, 'name' => 'Számláim', 'icon' => 'fa fa-file-text-o', 'slug' => '#', 'number' => 2,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '2||Számláim|fa fa-file-text-o|#|2'),
                'created_at' => $carbon, 'updated_at' => $carbon,
                ),
            array(
                'id' => 3, 'parent' => null, 'name' => 'Fuvarjaim', 'icon' => 'fa fa-truck', 'slug' => '#', 'number' => 3,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '3||Fuvarjaim|fa fa-truck|#|3'),
                'created_at' => $carbon, 'updated_at' => $carbon,
            ),
            array(
                'id' => 4, 'parent' => null, 'name' => 'Készletem', 'icon' => 'fa fa-th-list', 'slug' => '#', 'number' => 4,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '4||Készletem|fa fa-th-list|#|4'),
                'created_at' => $carbon, 'updated_at' => $carbon,
            ),
            array(
                'id' => 5, 'parent' => null, 'name' => 'Biztosítások', 'icon' => 'fa fa-rocket', 'slug' => '#', 'number' => 5,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '5||Biztosítások|fa fa-rocket|#|5'),
                'created_at' => $carbon, 'updated_at' => $carbon,
            ),
            array(
                'id' => 6, 'parent' => null, 'name' => 'Rendszer adatok', 'icon' => 'fa fa-laptop', 'slug' => '#', 'number' => 6,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '6||Rendszer adatok|fa fa-laptop|#|6'),
                'created_at' => $carbon, 'updated_at' => $carbon,
            ),
            array(
                'id' => 7, 'parent' => 6, 'name' => 'Beállítások', 'icon' => 'fa fa-cogs', 'slug' => '#', 'number' => 1,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '7|6|Beállítások|fa fa-cogs|#|1'),
                'created_at' => $carbon, 'updated_at' => $carbon,
            ),
            array(
                'id' => 8, 'parent' => 6, 'name' => 'Menüpontok', 'icon' => 'fa fa-cogs', 'slug' => '#', 'number' => 2,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '8|6|Menüpontok|fa fa-cogs|#|2'),
                'created_at' => $carbon, 'updated_at' => $carbon,
            ),
            array(
                'id' => 9, 'parent' => 6, 'name' => 'Felhasználók', 'icon' => 'fa  fa-users', 'slug' => '#', 'number' => 3,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '9|6|Felhasználók|fa fa-users|#|7'),
                'created_at' => $carbon, 'updated_at' => $carbon,
            ),
            array(
                'id' => 10, 'parent' => 6, 'name' => 'Cégek', 'icon' => 'fa  fa-building-o', 'slug' => '#', 'number' => 4,
                'guid' => (Uuid::uuid4())->toString(),
                'checksum' => Uuid::uuid5(Uuid::NAMESPACE_X500, '10|6|Cégek|fa fa-building-o|#|4'),
                'created_at' => $carbon, 'updated_at' => $carbon,
            ),
        );
        DB::table($this->_table)->insert($data);
    }

    /**
     * MenuSeeder constructor.
     */
    public function __construct()
    {
        $this->_table = (config('appConfig.tables'))['menus'];
    }
}

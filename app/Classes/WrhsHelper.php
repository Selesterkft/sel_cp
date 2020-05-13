<?php

namespace App\Classes;

use App\Models\ver_2019_01\wrhsStockModel;
use Illuminate\Support\Facades\Request;

class WrhsHelper
{
    public static function cfg_db(string $table_name)
    {
        $loggedUser = \Auth::user();
        $customer_id = (int)$loggedUser->Supervisor_ID;
        $client_id = (int)$loggedUser->CompanyID;
        $table_name = (new wrhsStockModel())->getTable();

        //$customer_id = 37127568;
        //$client_id = 1038482;

        //dd('App\Classes\WrhsHelper::cfg_db', $customer_id, $client_id, $table_name);
        $data = [
            'customer_id' => $customer_id,
            'client_id' => $client_id,
            'table_name' => $table_name,
        ];
        return json_encode($data);
    }

    public static function sess_tbl(string $table_name)
    {
        $data = [
            'table_name' => $table_name
        ];
        return json_encode($data);
    }

    public static function sess_db(string $table_name)
    {
        $data = [
            'table_name' => $table_name
        ];
        return json_encode($data);
    }

    public static function db_tbl(string $table_name)
    {
        $data = [
            'table_name' => $table_name
        ];
        return json_encode($data);
    }
}

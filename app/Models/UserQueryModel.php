<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQueryModel extends Model
{
    protected   $connection = 'azure',
                $table = 'CP_UserQueries',
                $fillable = ['ClientID', 'Cust_ID', 'QueryTipes_ID', 'QueryName', 'QueryDescription', 'Columns'];

    public $timestamps = false;

    //
    /**
     * UserQueryModel constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.user_queries');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    /**
     * Visszaadja a partner táblához kapcsolódó riportjait
     * @param int $client_id Partner azonosító
     * @param int $cust_id Vevő azonosító
     * @param string $table_name Tábla neve
     * @return array
     */
    public static function getCompanyReports(int $client_id, int $cust_id, string $table_name)
    {
        $config = config('appConfig.tables.table_columns');
        $query =
            "DECLARE @Client_ID int = {$client_id}
DECLARE @Cust_ID int = {$cust_id}
DECLARE @Type nvarchar(30) = '{$table_name}'
EXECUTE [dbo].[{$config['get_company_reports']}] @Client_ID,@Cust_ID,@Type";
//dd('TableColumnModel::getCompanyReports', $query);
        $res = \DB::connection($config['connection'])
            ->select(\DB::raw($query));

        return $res;
    }

    /**
     * @param int $client_id
     * @param int $cust_id
     * @param string $table_name
     * @param string $query_name
     * @param string $query_description
     * @return false|mixed|string|void
     */
    public static function getTableColumns(int $client_id, int $cust_id, string $table_name, string $query_name)
    {
        // Ha asessionben van eltárolt oszlop adat, akkor ...
        if( session()->has("{$table_name}.{$query_name}") )
        {
            //$columns = session()->get($table_name);
            $columns = session()->get("{$table_name}.{$query_name}");
        }
        // Ha nincs, akkor ...
        else
        {
            //dd('UserQueryModel::getTableColumns', 'Nincs session');
            $config = config('appConfig.tables.table_columns');

            // Lekérdezés összeállítása
            $query = "EXECUTE [dbo].[{$config['get_table_columns']}] {$client_id},{$cust_id},'{$table_name}','{$query_name}';";

            //dd('UserQueryModel::getTableColumns', $query);

            // Lekérdezés futtatása
            $res = \DB::connection($config['connection'])->select(\DB::raw($query));

            // Ha nincs eredmény, akkor...
            if( $res[0]->Columns == '' )
            {
                // A TableColumns fájlból veszi ki a beállításokat
                $columns = json_encode(config('TableColumns.' . $table_name));

                // Mivel nincsenek az adatbázisban bejegyzések a táblázatra vonatkozóan, menteni kell
                self::sync([
                    'client_id' => $client_id,
                    'cust_id' => $cust_id,
                    'table_name' => $table_name,
                    'query_name' => $query_name,
                    'query_description' => '',
                    'columns' => $columns
                ]);
            }
            else
            {
                // Kiveszem az oszlop adatokat az eredmény halmazból.
                $columns = $res[0]->Columns;
            }

            // Mező adatokat eltárolom a session-be.
            //session()->put($table_name, $columns);
            session()->put("{$table_name}.{$query_name}", $columns);
        }

        //dd('TableColumnModel.getTableColumns', $columns);
        return $columns;
    }

    /**
     * @param array $parameters
     * [
     *      'client_id'         => (int),
     *      'cust_id'           => (int),
     *      'table_name'        => (string),
     *      'query_name'        => (string),
     *      'query_description' => (string),
     *      'columns'           => (json in string),
     * ]
     * @return array
     */
    public static function sync(array $params)
    {
        $config = config('appConfig.tables.table_columns');

        $params['columns'] = json_decode($params['columns'], true);
        //dd('UserQueryModel::sync', json_encode($params), $params);
        $query = "DECLARE @params NVARCHAR(MAX) = '" . json_encode($params) . "';EXECUTE [dbo].[{$config['column_sync']}_1] @params";

        /*
        $query = "EXECUTE [dbo].[{$config['column_sync']}]
            {$params['client_id']},
            {$params['cust_id']},
            '{$params['table_name']}',
            '{$params['query_name']}',
            '{$params['query_description']}',
            '{$params['columns']}';";
        */

        //dd('UserQueryModel::sync', $params, $query);
        //dd('UserQueryModel::sync', $query);

        $res = \DB::connection($config['connection'])
            ->select(\DB::raw($query));
        //dd('UserQueryModel::sync', $res);

        return $res;
    }
}

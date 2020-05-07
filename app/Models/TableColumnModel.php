<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableColumnModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'CP_Table_Columns';
    protected $primaryKey = 'ID';
    protected $fillable = ['Client_ID', 'Cust_ID', 'TableName', 'VisibleColumns', 'HiddenColumns'];
    //protected $dates = ['created_at', 'updated_at'];

    public $timestamps = false;

    /**
     * TableColumnModel constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.table_columns');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    public static function getTableColumns(int $client_id, int $cust_id, string $table_name)
    {
        // Ha asessionben van eltárolt oszlop adat, akkor ...
        if( session()->has($table_name) )
        {
            $columns = session()->get($table_name);
            //dd('TableColumnModel::getTableColumns', session()->all(), $columns);
        }
        // Ha nincs, akkor ...
        else
        {
            $config = config('appConfig.tables.table_columns');

            // Lekérdezés összeállítása
            $query = "EXECUTE [dbo].[{$config['get_table_columns']}] {$client_id},{$cust_id},'{$table_name}';";

            // Lekérdezés futtatása
            $res = \DB::connection($config['connection'])->select(\DB::raw($query));

            // Ha nincs eredmény, akkor...
            if( $res[0]->Columns == '' )
            {
                // A TableColumns fájlból veszi ki a beállításokat
                $columns = json_encode(config('TableColumns.' . $table_name));

                // Mivel nincsenek az adatbázisban bejegyzések a táblázatra vonatkozóan, menteni kell
                self::sync(
                    $client_id = $client_id,
                    $cust_id = $cust_id,
                    $table_name = $table_name,
                    $columns = $columns
                );
            }
            else
            {
                // Kiveszem az oszlop adatokat az eredmény halmazból.
                $columns = $res[0]->Columns;
            }

            // Mező adatokat eltárolom a session-be.
            session()->put($table_name, $columns);
        }

        //dd('TableColumnModel.getTableColumns', $columns);
        return $columns;
    }

    /**
     * @param int $client_id
     * @param int $cust_id
     * @param string $table_name
     * @param string $columns
     * @return array
     */
    public static function sync(int $client_id, int $cust_id, string $table_name, string $columns)
    {
        $config = config('appConfig.tables.table_columns');
        //dd('TableColumnModel::sync', $config);
        $query = "EXECUTE [dbo].[{$config['column_sync']}] {$client_id},{$cust_id},'{$table_name}','{$columns}';";

        //dd('TableColumnModel::sync', $query);

        $res = \DB::connection($config['connection'])
            ->select(\DB::raw($query));



        return $res;
    }

/*
    public static function getTableColumns(int $client_id, int $cust_id, string $table_name)
    {
        // A tábla oszlopadatainak betöltése.
        // A visszatérő érték tömb lesz.
        $model = new TableColumnModel();
        $model = $model
            ->where('Client_ID', $client_id)
            ->where('Cust_ID', $cust_id)
            ->where('TableName', $table_name)
            ->select('Columns');

        $resource = $model->get()->toArray();

        // Ha nincsenek oszlop adatok, akkor ...
        if( count($resource) == 0 )
        {
            // Mezők betöltése a konfigurációs fájlból
            $columns = config('TableColumns.' . $table_name);
            //dd('TableColumnModel::getTableColumns', $res);

            // Új táblaadatok mentése
            self::saveColumns($client_id, $cust_id, $table_name, $columns);

        }
        else
        {
            $columns = $resource[0];
        }

        // Az értékek JSON objektumban vannak.
        // Ezért átmenetileg tömbbé kell alakítani.
        $columns['Columns'] = json_decode($columns['Columns'], true);
        $columns['VisibleColumns'] = json_decode($columns['VisibleColumns'], true);
        $columns['HiddenColumns'] = json_decode($columns['HiddenColumns'], true);

        // Beállítom a láthatóságot
        foreach( $columns['Columns'] as $id => $column )
        {
            // Ha szerepel a HiddenColumns tömbben a mező, akkor...
            if( in_array($column['field'], $columns['HiddenColumns']) )
            {
                // a visible értéket false-ra kell állítani.
                $columns['Columns'][$id]['visible'] = false;
            }
            // Ha szerepel a VisibleColumns tömbben a mező, akkor...
            if( in_array($column['field'], $columns['VisibleColumns']) )
            {
                // ha ven visible eleme
                if( isset( $columns['Columns'][$id]['visible'] ) ){
                    unset($columns['Columns'][$id]['visible']);
                }
            }
        }

        //dd('TableColumnModel::getTableColumns', $columns);

        $columns['Columns'] = json_encode($columns['Columns']);
        $columns['VisibleColumns'] = json_encode($columns['VisibleColumns']);
        $columns['HiddenColumns'] = json_encode($columns['HiddenColumns']);

        //dd('TableColumnModel::getTableColumns', $columns);

        return $columns;
    }
*/
/*
    public static function sync(int $client_id, int $cust_id, string $table_name,
                                string $columns, string $visibleColumns, string $hiddenColumns)
    {
        $query = "EXECUTE [dbo].[CP_TableColumns_SYNC] {$client_id},{$cust_id},{$table_name},{$columns},{$visibleColumns},{$hiddenColumns}";
        dd('TableColumnModel::sync', $query);
    }
*/
/*
    public static function saveColumns(int $client_id, int $cust_id,
                                       string $table_name, array $columns)
    {
        $data = [
            'Client_ID' => $client_id,
            'Cust_ID' => $cust_id,
            'TableName' => $table_name,
            'Columns' => json_encode($columns['Columns']),
            'VisibleColumns' => json_encode($columns['VisibleColumns']),
            'HiddenColumns' => json_encode($columns['HiddenColumns']),
        ];

        //dd('TableColumnModel::saveColumns', $data);

        self::insert($data);
    }
*/
}

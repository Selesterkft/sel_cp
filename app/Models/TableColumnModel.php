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

    /**
     * @param int $client_id
     * @param int $cust_id
     * @param string $table_name
     * @return
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function getTableColumns(
        int $client_id, int $cust_id,
        string $table_name)
    {
        // A tábla oszlopadatainak betöltése
        $model = new TableColumnModel();
        $model = $model
            ->where('Client_ID', $client_id)
            ->where('Cust_ID', $cust_id)
            ->where('TableName', $table_name)
            ->select('VisibleColumns', 'HiddenColumns');

        $resource = $model->get()->toArray();

        // Ha nincsenek oszlop adatok, akkor ...
        if( count($resource) == 0 )
        {
            // Mezők betöltése a konfigurációs fájlból
            $res = config('TableColumns.' . $table_name);
            /* // Mezők betöltése a modellből
            $wrhs_model = app()
                ->make('App\Models\\' . session()->get('version') . '\\' . $model_name);
            $res = [
                'VisibleColumns' => json_encode($wrhs_model->getFillable()),
                'HiddenColumns' => json_encode([]),
            ]; */

            // Új táblaadatok mentése
            self::saveColumns($client_id, $cust_id, $table_name, $res);

        }
        else
        {
            $res = $resource[0];
        }

        return $res;
    }

    public static function saveColumns(int $client_id, int $cust_id,
                                       string $table_name, array $columns)
    {
        $data = [
            'Client_ID' => $client_id,
            'Cust_ID' => $cust_id,
            'TableName' => $table_name,
            'Columns' => '[]',
            'VisibleColumns' => $columns['VisibleColumns'],
            'HiddenColumns' => $columns['HiddenColumns'],
        ];

        self::insert($data);
    }

}

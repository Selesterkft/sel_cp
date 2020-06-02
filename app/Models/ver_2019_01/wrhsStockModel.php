<?php

namespace App\Models\ver_2019_01;

use App\Models\UserQueryModel;
use DB;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;

class wrhsStockModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'CP_WRHS_STOCKS';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID',                   'ClientID',         'Cust_ID',
        'Stock_Date',           'Items_No',         'Items_Description_1',
        'Items_Description_2',  'Expire_Date',      'Prod_Date',
        'LOT_1',                'LOT_2',            'Warehouse',
        'Location',             'Status',           'Price_UnitPrice',
        'Price_Currency',       'Price_Unit',       'Weight_Net',
        'Weight_Gross',         'Stock_Available',  'Stock_Reserved',
        'Stock_External_1',     'Stock_External_2', 'Stock_External_3'
    ];

    /**
     * wrhs_stock constructor.
     * @param string $connection
     */
    public function __construct()
    {
        parent::__construct();
        $config = config('appConfig.tables.wrhs_stocks');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    /**
     * @param array $columns
     * @return array|\Illuminate\Database\Eloquent\Collection|Model[]
     */
    public static function all($columns = ['*'])
    {
        $total = 0;
        $offset = 0;
        $limit = 10;
        $where = '';
        $sort = '';
        $group_by = '';
        // Lekérdezendő oszlopok
        $select = '';

        $loggedUser = \Auth::user();
        $cust_id = (int)$loggedUser->Supervisor_ID;
        $client_id = (int)$loggedUser->CompanyID;

        //$cust_id = 37127568;
        //$client_id = 1038482;
        // Lekérem a modelltől a tábla nevét
        $table_name = (new wrhsStockModel())->getTable();

        // Riport neve
        $query_name = (request()->has('query_name')) ? request()->get('query_name') : config('appConfig.default_query_name');
        // Riport leírása
        $query_description = (request()->has('query_description')) ? request()->get('query_description') : '';

        //dd('wrhsStockModel::all', request()->all(), $table_name, $query_name, session()->has("{$table_name}.{$query_name}"));

        // Session-ből kiveszem at oszlop listát
        //$json_table_columns = session()->get($table_name);
        $json_table_columns = session()->get("{$table_name}.{$query_name}");
        // Oszlop lista tömbbé alakítása
        $arr_table_columns = json_decode($json_table_columns, true);

        // Ha az oldal felől jön oszlop adat, akkor ...
        if( request()->has('visibleColumns') && request()->get('visibleColumns') != '' )
        {
            // Látható oszlop adatok kivétele
            $visibleColumns = json_decode(request()->get('visibleColumns'), true);
            // Nem látható oszlop adatok kivétele
            $hiddenColumns = json_decode(request()->get('hiddenColumns'), true);

            // Végig járom az oszlopok listáját, hogy a láthatóságot beállítsam.
            foreach( $arr_table_columns as $id => $arr_table_column )
            {
                // Látható mezők vizsgálata
                if( in_array($arr_table_column['field'], $visibleColumns))
                {
                    // Ha van a láthatóságra vonatkozó beállítás, ...
                    if( isset($arr_table_column['visible']) )
                    {
                        // Kiveszem a beállítások közül.
                        unset($arr_table_columns[$id]['visible']);
                    }
                }

                // Nem látható mezők vizsgálata
                if( in_array($arr_table_column['field'], $hiddenColumns))
                {
                    // Láthatóságra vonatkozó beállítás megadása
                    $arr_table_columns[$id]['visible'] = false;
                }
            }

            $json_table_columns = json_encode($arr_table_columns);

            // Új oszloplista mentése az adatbázisba és a session-be.
            $res = UserQueryModel::sync([
                'client_id' => $client_id,
                'cust_id' => $cust_id,
                'table_name' => $table_name,
                'query_name' => $query_name,
                'query_description' => $query_description,
                'columns' => $json_table_columns,
            ]);

            session()->put("{$table_name}.{$query_name}", $json_table_columns);
        }

        // Oldaltörés paraméterei
        if( request()->has('limit') )
        {
            $limit = request()->get('limit');
        }
        if( request()->has('offset') )
        {
            $offset = request()->get('offset');
        }

        // Rendezés paraméterei
        if( request()->has('sort') )
        {
            $sort = request()->get('sort');
            $order = 'asc';
            if( request()->has('order') )
            {
                $order = request()->get('order');
            }
            $sort .= " {$order}";
        }

        $model = new wrhsStockModel();
        $model = $model
            ->where('ClientID', $client_id)
            ->where('Cust_ID', $cust_id)
            ->get();
        $total = $model->count();

        // A lekérdezés mezőinek és csoportosítandó mezők listájának összeállítása
        foreach($arr_table_columns as $id => $arr_table_column)
        {
            // Ha az oszlop látható, akkor...
            if( !isset($arr_table_column['visible']) )
            {
                // Beteszem a lekérdezendő mezők listájába
                $select .= $arr_table_column['sql_field'] . ',';

                if( $arr_table_column['group'] == true)
                {
                    $group_by .= $arr_table_column['field'] . ',';
                }

                if( strlen($sort) == 0 )
                {
                    $sort = "{$arr_table_column['sql_field']} asc";
                }
            }
        }
        $select = substr_replace($select,"",-1);
        $group_by = substr_replace($group_by,"",-1);

        $query = "EXECUTE [dbo].[CP_STOCK_GET_ML_1]
            {$client_id},{$cust_id},'{$select}','{$where}','{$group_by}','{$sort}','{$offset}','{$limit}';";

        $config = config('appConfig.tables.wrhs_stocks');
        $rows = DB::connection($config['connection'])
            ->select(DB::raw($query));

        $stocks = [
            //'table_columns' => $table_columns,
            'total' => $total,
            'totalNotFiltered' => count($rows),
            'rows' => $rows,
        ];
        //dd('wrhsStockModel::all ajax', $stocks);
        return $stocks;

    }

    /**
     * @param string $table_name
     * @return array
     */
    public static function getAll(string $table_name = '')
    {
        $total = 0;
        $offset = 0;
        $limit = 10;
        $where = '';
        $sort = '';
        $group_by = '';
        // Lekérdezendő oszlopok
        $select = '';

        $loggedUser = \Auth::user();
        $cust_id = (int)$loggedUser->Supervisor_ID;
        $client_id = (int)$loggedUser->CompanyID;

        //$cust_id = 37127568;
        //$client_id = 1038482;
        // Lekérem a modelltől a tábla nevét
        $table_name = (new wrhsStockModel())->getTable();

        // Riport neve
        $query_name = (request()->has('query_name')) ? request()->get('query_name') : '*';
//dd('wrhsStockModel::all', $table_name, $query_name);
        // Riport leírása
        $query_description = (request()->has('query_description')) ? request()->get('query_description') : '';

        //dd('wrhsStockModel::all', request()->all(), $table_name, $query_name, session()->has("{$table_name}.{$query_name}"));

        // Session-ből kiveszem at oszlop listát
        //$json_table_columns = session()->get($table_name);
        $json_table_columns = session()->get("{$table_name}.{$query_name}");
        // Oszlop lista tömbbé alakítása
        $arr_table_columns = json_decode($json_table_columns, true);
//dd('wrhsStockModel::all', $table_name, $query_name, $arr_table_columns);
        // Ha az oldal felől jön oszlop adat, akkor ...
        if( request()->has('visibleColumns') && request()->get('visibleColumns') != '' )
        {
            // Látható oszlop adatok kivétele
            $visibleColumns = json_decode(request()->get('visibleColumns'), true);
            // Nem látható oszlop adatok kivétele
            $hiddenColumns = json_decode(request()->get('hiddenColumns'), true);

            // Végig járom az oszlopok listáját, hogy a láthatóságot beállítsam.
            foreach( $arr_table_columns as $id => $arr_table_column )
            {
                // Látható mezők vizsgálata
                if( in_array($arr_table_column['field'], $visibleColumns))
                {
                    // Ha van a láthatóságra vonatkozó beállítás, ...
                    if( isset($arr_table_column['visible']) )
                    {
                        // Kiveszem a beállítások közül.
                        unset($arr_table_columns[$id]['visible']);
                    }
                }

                // Nem látható mezők vizsgálata
                if( in_array($arr_table_column['field'], $hiddenColumns))
                {
                    // Láthatóságra vonatkozó beállítás megadása
                    $arr_table_columns[$id]['visible'] = false;
                }
            }

            $json_table_columns = json_encode($arr_table_columns);

            // Új oszloplista mentése az adatbázisba és a session-be.
            if(Auth::user()->hasRole('Admin')){

                $res = UserQueryModel::sync([
                    'client_id' => $client_id,
                    'cust_id' => $cust_id,
                    'table_name' => $table_name,
                    'query_name' => $query_name,
                    'query_description' => $query_description,
                    'columns' => $json_table_columns,
                ]);
            }
            session()->put("{$table_name}.{$query_name}", $json_table_columns);
        }

        // Oldaltörés paraméterei
        if( request()->has('limit') )
        {
            $limit = request()->get('limit');
        }
        if( request()->has('offset') )
        {
            $offset = request()->get('offset');
        }

        // Rendezés paraméterei
        if( request()->has('sort') )
        {
            $sort = request()->get('sort');
            $order = 'asc';
            if( request()->has('order') )
            {
                $order = request()->get('order');
            }
            $sort .= " {$order}";
        }

        $model = new wrhsStockModel();
        $model = $model
            ->where('ClientID', $client_id)
            ->where('Cust_ID', $cust_id)
            ->get();
        $total = $model->count();

        // A lekérdezés mezőinek és csoportosítandó mezők listájának összeállítása
        foreach($arr_table_columns as $id => $arr_table_column)
        {
            // Ha az oszlop látható, akkor...
            if( !isset($arr_table_column['visible']) )
            {
                // Beteszem a lekérdezendő mezők listájába
                $select .= $arr_table_column['sql_field'] . ',';

                if( $arr_table_column['group'] == true)
                {
                    $group_by .= $arr_table_column['field'] . ',';
                }

                if( strlen($sort) == 0 )
                {
                    $sort = "{$arr_table_column['sql_field']} asc";
                }
            }
        }
        $select = substr_replace($select,"",-1);
        $group_by = substr_replace($group_by,"",-1);

        $query = "EXECUTE [dbo].[CP_STOCK_GET_ML_1]
            {$client_id},{$cust_id},'{$select}','{$where}','{$group_by}','{$sort}','{$offset}','{$limit}';";

        //dd('wrhsStockModel::getAll', $query);

        $config = config('appConfig.tables.wrhs_stocks');
        $rows = DB::connection($config['connection'])
            ->select(DB::raw($query));

        $stocks = [
            //'table_columns' => $table_columns,
            'total' => $total,
            'totalNotFiltered' => count($rows),
            'rows' => $rows,
        ];
        //dd('wrhsStockModel::all ajax', $stocks);
        return $stocks;

    }

    /*
    public static function sync(
        int $client_id, int $supervisor_id,
        string $table_name, ?string $visibleColumns, ?string $hiddenColumns) : array
    {
        try {
            $res_array = TableColumnModel::getTableColumns(
                $client_id = $client_id,
                $cust_id = $supervisor_id,
                $table_name = $table_name,
                'wrhsStockModel');
        } catch (BindingResolutionException $e) {
        }

        //dd('wrhsStockModel::all', $res_array);

        return $res_array;
    }
    */

    /**
     * @return mixed|string
     */
    public function getTable()
    {
        return strtolower(( config('appConfig.tables.wrhs_stocks') )['table']);
    }
}

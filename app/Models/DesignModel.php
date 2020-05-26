<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignModel extends Model
{
    protected $connection = 'azure';
    protected $table = 'CP_design';

    /**
     * DesignModel constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.designs');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
        //dd('DesignsModel::construct', $config);
    }

    public static function readDesignsToSelect()
    {
        $config = config('appConfig.tables.designs');
        /*
        $resources = \DB::connection($config['connection'])
            ->table($config['table'])
            ->select('id', 'name')
            ->get()->toArray();
        */
        $resources = (new DesignModel())
            ->pluck('name', 'name')
            ->all();
        //dd('DesignModel::readDesignsToSelect', $resources);
        $designs = [0 => trans('app.select_first_element')] + $resources;
        //dd('DesignModel::readDesignsToSelect', $designs);
        return $designs;
    }

    public static function all($columns = ['*'])
    {
        /*
        $config = config('appConfig.tables.designs');

        $designs = [];

        $query = "SELECT id, [name], created_at, updated_at FROM {$config['table']};";
        //dd('DesignModel::all', $query);
        $result = \DB::connection($config['connection'])
            ->select(\DB::raw($query));
        //dd('DesignModel::all', $result);
        if( !empty($result) )
        {
            //
        }

        return $designs;
        */
    }

    public static function getCompanyDesign(int $company_id)
    {
        $design = config('appConfig.default_design');

        $config = config('appConfig.tables.company_design');

        //dd('DesignModel::getCompanyDesign', $config);

        $result = \DB::connection($config['connection'])
            ->select(\DB::raw("SELECT [design] FROM [{$config['table']}] WHERE company_id = :id"),
                ['id' => $company_id]);

        if( !empty($result) )
        {
            $design = $result[0]->design;
        }

        return $design;
    }

}

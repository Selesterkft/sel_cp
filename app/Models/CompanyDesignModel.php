<?php

namespace App\Models;

use App\Classes\Helper;
use Illuminate\Database\Eloquent\Model;
use DB;

class CompanyDesignModel extends Model
{
    protected   $connection = 'azure',
                $table      = 'CP_company_design',
                $fillable   = ['company_id', 'design'];

    /**
     * CompanyDesignModel constructor.
     * @param string $connection
     */
    public function __construct()
    {
        $config = config('appConfig.tables.company_design');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    public function save(array $options = [])
    {
        $config = config('appConfig.tables.company_design');
        $company_id = $options['company_id'];
        $design = $options['design'];

        $query = "EXECUTE [dbo].[{$config['insert']}] ?, ?, ?";

        $res = DB::connection($config['connection'])
            ->select(DB::raw($query), [
                $company_id,
                $design,
                Helper::get_timestamp()
            ]);
        $cd = new CompanyDesignModel();
        Helper::resToClass($res[0], $cd);

        return $cd;
    }

    public function update(array $attributes = [], array $options = []) : CompanyDesignModel
    {
        //dd('CompanyDesignModel::update', $attributes, $options);
        $config = config('appConfig.tables.company_design');

        $id = (int)$attributes['id'];
        $company_id = (int)$attributes['company_id'];
        $design = $attributes['design'];

        //dd('CompanyDesignModel::update', $id, $company_id, $design, Helper::get_timestamp());

        $query = "EXECUTE [dbo].[CP_Company_Design_Update] {$id},{$company_id},'{$design}','" . Helper::get_timestamp() . "'";
        $res = DB::connection($config['connection'])
            ->select(DB::raw($query));
        //dd('CompanyDesignModel::update', $res);
/*
        $res = DB::connection($config['connection'])
            ->select(DB::raw("EXECUTE [dbo].[{$config['update']}] ?, ?, ?, ?", [
                $id,
                $company_id,
                $design,
                Helper::get_timestamp()
            ]));
*/
        $cd = new CompanyDesignModel();
        Helper::resToClass($res, $cd);

        return $cd;
    }

    public function delete()
    {
        $config = config('appConfig.tables.company_design');
        $res = DB::connection($config['connection'])
            ->select(DB::raw("EXECUTE [dbo].[{$config['delete']}] ?"), [$this->id]);
    }

    public static function readAll()
    {
        $config = config('appConfig.tables.company_design');
        //dd('CompanyDesignModel::readAll', $config);
        $resources = \DB::connection($config['connection'])
            ->table($config['table'])
            ->select('id', 'company_id', 'design')
            ->get();

        $res = [];

        foreach( $resources as $resource)
        {
            $cd = new CompanyDesignModel();
            Helper::resToClass($resource, $cd);
            $res[] = $cd;
        }

        return $res;
    }

    public static function all($columns = ['*'])
    {
        $config = config('appConfig.tables.company_design');

        $resources = DB::connection($config['connection'])
            ->table($config['table'])
            ->select('id', 'company_id', 'design')
            ->get();

        $res = [];
        foreach( $resources as $resource )
        {
            $cd = new CompanyDesignModel();
            Helper::resToClass($resource, $cd);
            $res[] = $cd;
        }

        return $res;

        /*
        $query = "SELECT id, company_id, design FROM {$config['table']};";

        //dd('CompanyDesignModel', $query);

        $result = \DB::connection($config['connection'])
            ->select(\DB::raw($query));
        //dd('CompanyDesignModel', $result);

        return $result;
        */
    }

    public function company()
    {
        return $this->hasOne(\App\Models\CompanyModel::class, 'ID', 'company_id');
    }
}

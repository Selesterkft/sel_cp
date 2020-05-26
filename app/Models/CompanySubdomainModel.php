<?php

namespace App\Models;

use App\Classes\Helper;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySubdomainModel extends Model
{
    use SoftDeletes;

    protected $connection = 'azure',
        $table = 'company_has_subdomain',
        $primaryKey = 'id',
        $fillable = ['CompanyID', 'CompanyName', 'CompanyNickName', 'SubdomainName'];

    function __construct()
    {
        parent::__construct();
        $config = config('appConfig.tables.company_has_subdomain');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }

    public static function readAll()
    {
        $config = config('appConfig.tables.company_has_subdomain');
        $resources = DB::connection($config['connection'])
            ->table($config['read'])
            ->select([
                'id',                   'CompanyID',        'CompanyName'
                , 'CompanyNickName',    'SubdomainName',    'created_at'
                , 'updated_at',         'deleted_at'])
            ->get();
//dd('', $resources);
/*
        $res = [];

        foreach( $resources as $resource )
        {
            $cs = new CompanySubdomainModel();
            foreach($resource as $key => $val)
            {
                $cs->$key = $val;
            }
            $res[] = $cs;
        }
*/
        return $resources;
    }

    public static function getByID(int $id) : CompanySubdomainModel
    {
        $config = config('appConfig.tables.company_has_subdomain');

        $res = DB::connection($config['connection'])
            ->table($config['read'])->find($id);

        $cs = new CompanySubdomainModel();
        Helper::resToClass($res, $cs);
        return $cs;
    }

    public function save(array $options = []): CompanySubdomainModel
    {
        $config = config('appConfig.tables.company_has_subdomain');
        //dd('CompanySubdomainModel.save', $config, $options);
        $CompanyID = $options['CompanyID'];
        $CompanyName = Helper::getCompanyNameByID($CompanyID);
        //dd('CompanySubdomainModel.save');
        $CompanyNickName = Helper::remove_accents($CompanyName);
        //dd('CompanySubdomainModel.save', $CompanyID, $CompanyName, $CompanyNickName);
        $SubdomainName = $options['SubdomainName'];

        /*dd('CompanySubdomainModel.save',
            $options,
            $config,
            $CompanyID,
            $CompanyName,
            $CompanyNickName,
            $SubdomainName);*/

        $res = DB::connection($config['connection'])
            ->select(
                DB::connection($config['connection'])
                    ->raw("EXECUTE {$config['insert']} ?, ?, ?, ?, ?"), [
                        $CompanyID,
                        $CompanyName,
                        $CompanyNickName,
                        $SubdomainName,
                        Helper::get_timestamp()
                ]
        );
        //dd('itt5', $res);
        $cs = new CompanySubdomainModel();
        Helper::resToClass($res[0], $cs);

        return $cs;
    }

    public function update(array $attributes = [], array $options = []) : CompanySubdomainModel
    {
        $config = config('appConfig.tables.company_has_subdomain');

        //dd('CompanySubdomainModel.save', $config, $options);
        $CompanyID = $attributes['CompanyID'];
        $CompanyName = Helper::getCompanyNameByID($CompanyID);
        $CompanyNickName = Helper::remove_accents($CompanyName);
        //dd('CompanySubdomainModel.save', $CompanyID, $CompanyName, $CompanyNickName);
        $SubdomainName = $attributes['SubdomainName'];

        $res = DB::connection($config['connection'])
            ->select(DB::connection($config['connection'])
                ->raw("EXECUTE [dbo].{$config['update']} ?, ?, ?, ?, ?, ?"), [
                $attributes['ID'],
                $CompanyID,
                $CompanyName,
                $CompanyNickName,
                $SubdomainName,
                Helper::get_timestamp()
            ]);
        $cs = new CompanySubdomainModel();
        Helper::resToClass($res, $cs);

        return $cs;
    }

    public function delete()
    {
        $config = config('appConfig.tables.company_has_subdomain');
        DB::connection($config['connection'])
            ->select(DB::connection($config['connection'])
                ->raw("EXECUTE {$config['delete']} ?, ?"), [
                $this->id,
                1
            ]);
    }
}

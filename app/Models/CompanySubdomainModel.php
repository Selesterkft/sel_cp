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
        $resources = DB::connection()
            ->table($config['read'])
            ->select([
                'id',                   'CompanyID',        'CompanyName'
                , 'CompanyNickName',    'SubdomainName',    'created_at'
                , 'updated_at',         'deleted_at'])
            ->get();

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

        return $res;
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

        $res = DB::connection($config['connection'])
            ->select(
                DB::connection($config['connection'])
                    ->raw("EXECUTE {$config['insert']} ?, ?, ?, ?"), [
                        $options['VersionID'],
                        $options['CompanyID'],
                        (!empty($options['Active'])) ? $options['Active'] : 0,
                        Helper::get_timestamp()
                ]
        );

        $cs = new CompanySubdomainModel();
        Helper::resToClass($res[0], $cs);

        return $cs;
    }

    public function update(array $attributes = [], array $options = []) : CompanySubdomainModel
    {
        $config = config('appConfig.tables.company_has_subdomain');

        $res = DB::connection($config['connection'])
            ->select(DB::connection($config['connection'])
                ->select("EXECUTE [dbo].{$config['update']} ?, ?, ?, ?, ?"), [
                $attributes['ID'],
                $attributes['VersionID'],
                $attributes['CompanyID'],
                (!empty($attributes['Active'])) ? $attributes['Active'] : 0,
                Helper::get_timestamp()
            ]);
        $cs = new CompanySubdomainModel();
        Helper::resToClass($res, $cs);

        return true;
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

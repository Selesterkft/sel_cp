<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class VersionCompanyModel extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected $connection = 'azure',
        $table = 'version_has_company',
        $primaryKey = 'ID',
        $fillable = ['CompanyID', 'VersionID', 'Active'];

    // ================================================
    // Naplózás
    // ================================================
    protected static $logFillable = true;
    // Naplózandó mezők
    protected static $logAtributes = [
        'CompanyID', 'PropertyName', 'PropertyValue'
    ];
    // Naplózandó események
    protected static $recordEvents = [
        'created', 'updated', 'deleted'
    ];
    // Naplózásból kihagyandó mezők
    protected static $ignoreChangedAttributes = [];

    // Csak a ténylegesen megváltozott mezőket naplózza
    protected static $logOnlyDirty = true;

    public static function readAll()
    {
        $config = config('appConfig.tables.version_has_company');
        $resources = \DB::connection($config['connection'])
            ->table($config['read'])
            ->select(['ID', 'CompanyID', 'VersionID', 'Active'])
            ->get();
        //dd('VersionCompanyModel.readAll', $res);

        $res = [];

        foreach( $resources as $resource )
        {
            $vc = new VersionCompanyModel();
            foreach( $resource as $key => $val )
            {
                $vc->$key = $val;
            }
            //dd('VersionCompanyModel.readAll', $vc);
            $res[] = $vc;
        }

        return $res;
    }

    public function save(array $options = [])
    {
        //dd('VersionCompanyModel.save', $options);
        $config = config('appConfig.tables.version_has_company');
        $res = \DB::connection($config['connection'])
            ->select("EXECUTE dbo.{$config['insert']} ?, ?, ?", [
                $options['VersionID'],
                $options['CompanyID'],
                (!empty($options['Active'])) ? $options['Active'] : 0
            ]);
        $VersionComapny = $this->find($res[0]->ID);
        //dd('VersionCompanyModel.save', $res, $VersionComapny);
        return $VersionComapny;
    }

    public function update(array $attributes = [], array $options = [])
    {
        //dd('VersionCompanyModel.update', $attributes);
        $config = config('appConfig.tables.version_has_company');
        $res = \DB::connection($config['connection'])
            ->select(
                \DB::connection($config['connection'])
                    ->raw("EXECUTE {$config['update']} ?, ?, ?, ?"), [
                        $attributes['ID'],
                        $attributes['VersionID'],
                        $attributes['CompanyID'],
                        (!empty($attributes['Active'])) ? $attributes['Active'] : 0
            ]);
    }

    public function delete()
    {
        $config = config('appConfig.tables.version_has_company');
        $res = \DB::connection($config['connection'])
            ->select(
                \DB::connection($config['connection']
                    ->raw("EXECUTE {$config['delete']} ?, ?")), [
                        $this->ID,
                        1
                ]
            );
    }

    public function company()
    {
        return $this->hasOne('App\Models\\' . session()->get('version') . '\CompanyModel', 'ID', 'CompanyID')->select(['Nev1']);
    }

    public function version()
    {
        return $this->hasOne(VersionModel::class, 'ID', 'VersionID');
    }

    //
    /**
     * VersionCompanyModel constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.version_has_company');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }
}

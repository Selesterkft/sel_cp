<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Spatie\Activitylog\Traits\LogsActivity;

class VersionModel extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $connection = 'azure';
    protected $table = 'version';

    protected $primaryKey = 'ID';
    protected $fillable = ['Version', 'Active'];
    protected $dates = ['deleted_at'];

    // ================================================
    // Naplózás
    // ================================================
    protected static $logFillable = true;
    // Naplózandó mezők
    //protected static $logAtributes = ['Version', 'Active'];
    // Naplózandó események
    //protected static $recordEvents = ['created', 'updated', 'deleted'];
    // Naplózásból kihagyandó mezők
    //protected static $ignoreChangedAttributes = [];

    // Csak a ténylegesen megváltozott mezőket naplózza
    //protected static $logOnlyDirty = true;

    public static function readAll()
    {
        $config = config('appConfig.tables.versions');

        $res = DB::connection($config['connection'])
            ->table($config['read'])
            ->select('ID', 'Version', 'Active')
            ->get();
        //dd('VersionModel.readAll', $res);
        return $res;
    }

    public function getByID(int $id) : VersionModel
    {
        $config = config('appConfig.tables.versions');
        $instance = new VersionModel();

        $eloquent_builder = new Builder(
            DB::connection($config['connection'])
                ->table($config['read'])
                ->select(['ID', 'Version', 'Active'])
                ->find($id)
        );
        $eloquent_builder->setModel($instance);
        $version = $eloquent_builder->get();

        dd('VersionModel.getByID', $version);

        return $version;
    }

    public function save(array $options = [])
    {
        //dd('VersionModel.save', $options);
        $config = config('appConfig.tables.versions');
        $res = DB::connection($config['connection'])
            ->select(
                DB::connection($config['connection'])
                    ->raw("EXECUTE dbo.{$config['insert']} ?, ?, ?")
            , [
                $options['Version'],
                (!empty($options['Active'])) ? $options['Active'] : 0,
                \App\Classes\Helper::get_timestamp()
            ]);
        //dd('VersionModel.save', $res);
        $version = new VersionModel();
        foreach($res[0] as $key => $val)
        {
            $version->$key = $val;
        }

        return $version;
    }

    public function update(array $attributes = [], array $options = [])
    {
        //dd('VersionModel.update', $attributes);
        $config = config('appConfig.tables.versions');
        $res = DB::connection($config['connection'])
            ->select(
                DB::connection($config['connection'])
                    ->raw('EXECUTE dbo.CP_Versions_Update ?, ?, ?')
            , [
                $attributes['ID'],
                $attributes['Version'],
                (!empty($attributes['Active'])) ? $attributes['Active'] : 0,
                ''
            ]);
        //dd('VersionModel.update', $res);
        $version = new VersionModel();
        foreach($res[0] as $key => $val)
        {
            $version->$key = $val;
        }

        return $version;
    }

    public function delete()
    {
        //dd('VersionModel.delete', $this);
        $config = config('appConfig.tables.versions');
        $res = DB::connection($config['connection'])
            ->select(
                DB::connection($config['connection'])
                    ->raw("EXECUTE dbo.{$config['delete']} ?, ?")
            , [
                $this->ID,
                1
            ]);
        //dd('VersionModel.delete', $res);
        return true;
    }

    /**
     * VersionModel constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.versions');
        $this->connection = $config['connection'];
        $this->table = $config['table'];
    }
}

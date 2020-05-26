<?php

namespace App\Models;

use App\Classes\Helper;
use App\Traits\Auditable;
use App\User;
use DB;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class VersionModel extends Model
{
    use HasEvents;
    use SoftDeletes;

    protected $connection = 'azure';
    protected $table = 'Versions';

    protected $primaryKey = 'ID';
    protected $fillable = ['Version', 'Active'];
    //protected $dates = ['deleted_at'];
    /*
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logAttributes = ['Version', 'Active'];
    */

    public static function readAll()
    {
        $config = config('appConfig.tables.versions');

        $res = DB::connection($config['connection'])
            ->table($config['read'])
            ->whereNull('deleted_at')
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

        //if ($this->fireModelEvent('saving') === false) { return false; }

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
        Helper::resToClass($res, $version);

        return $version;
    }

    public function update(array $attributes = [], array $options = [])
    {
        // Az "Active" érték nem jön át, ha 0 értékű
        if( empty($attributes['Active']) )
        {
            $attributes['Active'] = 0;
        }

        $this->fill($attributes);

        $config = config('appConfig.tables.versions');
        $res = DB::connection($config['connection'])
            ->select(
                DB::connection($config['connection'])
                    ->raw('EXECUTE dbo.CP_Versions_Update ?, ?, ?, ?')
            , [
                $attributes['ID'],
                $attributes['Version'],
                (!empty($attributes['Active'])) ? $attributes['Active'] : 0,
                \App\Classes\Helper::get_timestamp()
            ]);

        return $this;
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class User extends Authenticatable implements Searchable
{
    use Notifiable;
    use HasRoles;
    use HasEvents;
    use SoftDeletes;

    protected $connection = 'azure';
    protected $table = 'CP_Users';
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'TransactID', 'CompanyID', 'Supervisor_ID', 'Supervisor_Name',
        'Name', 'Email', 'password', 'language', 'last_login_at', 'last_login_ip'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logAttributes = [
        'TransactID', 'CompanyID', 'Supervisor_ID', 'Supervisor_Name',
        'Name', 'Email', 'password', 'language', 'last_login_at', 'last_login_ip'];

    /**
     * User constructor.
     * @param string $connection
     */
    public function __construct()
    {
        parent::__construct();

        //dd('User.construct', session()->get('version'), request()->all());

        $config = config('appConfig.tables.users');

        $this->table = $config['table'];
        $this->connection = $config['connection'];
    }

    public static function all($columns = '*')
    {
        $config = config('appConfig.tables.users');
        $loggedUser = \Auth::user();
        $supervisor_id = (int)$loggedUser->Supervisor_ID;
        $company_id = (int)$loggedUser->CompanyID;
        $sort = '';
        $order = 'asc';
        $limit = 0;
        $offset = 0;

        $model = new User();
        $model->setConnection($config['connection']);
        $model->setTable($config['read']);
        $model = $model
            ->where('CompanyID', '=', $company_id)
            ->where('Supervisor_ID', '=', $supervisor_id);

        $total = $model->count();

        if( !empty(request()->get('sort')) )
        {
            $model = $model->orderBy(request()->get('sort'), $order);
        }

        if( request()->has('limit') )
        {
            //$limit = (int)request()->get('limit');
            $model = $model->limit($limit);
        }
        if( request()->has('offset') )
        {
            //$offset = request()->get('offset');
            $model = $model->offset($offset);
        }

        $res = $model
            ->get()
            ->toArray();

        $users = [
            'total' => $total,
            'totalNotFiltered' => count($res),
            'rows' => $res,
        ];
        //dd('User::all', $users);
        return json_encode($users);
    }

    public function company()
    {
        /*
        $res = $this->hasOne(
            '\App\Models\\' . session()->get('version') . '\CompanyModel',
            'ID',
            'CompanyID')->select(['Nev1']);
        */
        $res = $this->hasOne(
            'App\Models\CompanyModel',
            'ID',
            'CompanyID')
            ->select(['Nev1']);
        return $res;
    }

    public function CreateUser($request)
    {
        $parameters = $request;

        $parameters['Supervisor_Name'] = (empty($parameters['Supervisor_Name'])) ? '' : empty($parameters['Supervisor_Name']);

        $config = config('appConfig.tables.users');
        $res = \DB::connection($config['connection'])
            ->select(\DB::connection($config['connection'])
                ->raw('EXECUTE dbo.' . $config['insert'] . ' ?, ?, ?, ?, ?, ?, ?, ?'),
            [
                $parameters['CompanyID'],
                $parameters['Supervisor_ID'],
                $parameters['Supervisor_Name'],
                $parameters['Name'],
                $parameters['Email'],
                $parameters['password'],
                $parameters['language'],
                \App\Classes\Helper::get_timestamp()
            ]);

        $user = User::find($res[0]->ID);

        return $user;
    }

    public function update(array $attributes = [], array $options = [])
    {
        //if (! $this->exists) { return false; }

        $this->fill($attributes);

        //dd('User.update', $attributes, $this);

        //if( $this->fireModelEvent('saving') === false ){ return false; }

        $config = config('appConfig.tables.users');

        if( !empty($attributes['last_login_ip']) )
        {
            $res = \DB::connection($config['connection'])
                ->select(
                    \DB::connection()->raw('EXECUTE [dbo].[' . $config['register'] . '] ?, ?, ?, ?'),
                [
                    $this->ID,
                    $attributes['last_login_ip'],
                    $attributes['last_login_at'],
                    \App\Classes\Helper::get_timestamp()
                ]);
        }
        else
        {
            $res = \DB::connection($config['connection'])
                ->select(\DB::connection($config['connection'])
                    ->raw('EXECUTE [dbo].[' . $config['update'] . '] ?, ?, ?, ?, ?'),
                    [
                        $attributes['ID'],
                        $attributes['Name'],
                        $attributes['Email'],
                        $attributes['language'],
                        \App\Classes\Helper::get_timestamp()
                    ]);
        }

        //$this->fireModelEvent('saved', false);

        return $res;
    }

    public function restore($id = null)
    {
        if( empty($id) )
        {
            $id = $this->ID;
        }

        $config = config('appConfig.tables.users');
        $res = \DB::connection($config['connection'])
            ->select(\DB::connection($config['connection'])
                ->raw("EXECUTE [dbo].[{$config['restore']}] ?, ?"), [
                    $id,
                    \App\Classes\Helper::get_timestamp()
            ]);
        return $res;
    }

    public function getSearchResult(): SearchResult
    {
        //$a = Helper::getCompanyAndVersion();
        return new SearchResult($this, $this->Name, route('users.show'));
    }
}

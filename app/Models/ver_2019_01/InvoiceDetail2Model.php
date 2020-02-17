<?php

namespace App\Models\ver_2019_01;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail2Model extends Model
{
    protected $connection = 'azure',
        $table = 'Inv_L',
        $primaryKey = '';

    public static function allDetails(int $selexped_inv_id)
    {
        $config = config('appConfig.tables.invoice_details2.' . session()->get('version'));
        $loggedUser = \Auth::user();
        $supervisor_id = $loggedUser->Supervisor_ID;

        $session_id = session()->getId();
        $client_id = (int)$loggedUser->CompanyID;
        $cp_users_id = $loggedUser->ID;
        $lang = app()->getLocale();

        $model = new InvoiceModel();
        $columns = implode(',', $model->getFillable());
        $model->setConnection($config['connection']);
        $model->setTable("{$config['read']}({$session_id}, {$client_id}, {$cp_users_id}, {$lang}, {$selexped_inv_id}");

        $totalNotFiltered = $model->count();

        $total = $model->count();

        // Oldaltörés
        if( request()->has('limit') )
        {
            $model = $model->take(request()->get('limit'));
        }

        if( request()->has('offset') )
        {
            $model = $model->skip(request()->get('offset'));
        }

        // Rendezés
        $sort = (request()->has('sort')) ? request()->get('sort') : null;
        $order = (request()->has('order')) ? request()->get('order') : 'asc';
        if( $sort && $order )
        {
            $model = $model->orderBy($sort, $order);
        }

        $model = $model->select($columns);

        $result = $model->get()->toArray();

        $details = [
            'total' => $total,
            'totalNotFiltered' => $totalNotFiltered,
            'rows' => $result,
        ];
        return json_encode($details);
    }

    /**
     * InvoiceDetail2Model constructor.
     */
    public function __construct()
    {
        $config = config('appConfig.tables.invoice_details2.' . session()->get('version'));
        $this->setConnection($config['connection']);
        $this->setTable($config['table']);
    }

    public function getDetails(int $id)
    {
        $config = config('appConfig.tables.invoice_details2.' . session()->get('version'));
        $loggedUser = \Auth::user();
        $session_id = session()->getId();
        $client_id = (int)$loggedUser->CompanyID;
        $cp_users_id = $loggedUser->ID;
        $lang = app()->getLocale();

        $model = new InvoiceDetail2Model();
        $model->setConnection($config['connection']);
        $model->setTable("{$config['read']}('{$session_id}', $client_id, {$cp_users_id}, '{$lang}', {$id})");

        // Oldaltörés
        if( request()->has('limit') )
        {
            $model = $model->take(request()->get('limit'));
        }

        if( request()->has('offset') )
        {
            $model = $model->skip(request()->get('offset'));
        }

        // Rendezés
        $sort = (request()->has('sort')) ? request()->get('sort') : null;
        $order = (request()->has('order')) ? request()->get('order') : 'asc';
        if( $sort && $order )
        {
            $model = $model->orderBy($sort, $order);
        }

        $total = $totalNotFiltered = $model->count();

        //dd('InvoiceDetail2Model.getDetails', $model->toSql());

        $result = $model->get()->toArray();

        $details = [
            'total' => $total,
            'totalNotFiltered' => $totalNotFiltered,
            'rows' => $result,
        ];

        //dd('InvoiceDetail2Model.getDetails', $details);
        return json_encode($details);
    }
}

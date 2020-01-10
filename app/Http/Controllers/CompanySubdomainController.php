<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySubdomainModel;
use App\Classes\Helper;
use Illuminate\Http\Response;

class CompanySubdomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $company_subdomain = CompanySubdomainModel::all();

        return view('companysubdomain.index', [
            'company_subdomain' => $company_subdomain
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $companies = Helper::getCompanies();

        return view('companysubdomain.create', [
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $config = config('appConfig.tables.company_has_subdomain');
        $this->validate($request, [
            'CompanyID' => 'required|unique:' . $config['connection'] . '.' . $config['table'] . ',CompanyID',
            'SubdomainName' => 'required|min:5|max:255|unique:' . $config['connection'] . '.' . $config['table'] . ',SubdomainName',
        ]);

        $companyModel = app()->make('\App\Models\\' . session()->get('version') . '\CompanyModel');
        $company = $companyModel->find($request->get('CompanyID'));
        //dd('CompanySubdomainController', $company, $CompanyName, $CompanyNickName);

        $cs = new CompanySubdomainModel();

        try
        {
            $cs->save($request->all());

            return redirect()
                ->to( url('companysubdomain') )
                ->with('success', 'A kapcsolat létrejött');
        }
        catch (\Exception $e)
        {
            //dd('CompanySubdomainController.store', $e->getMessage());
            return redirect()
                    ->back()
                    ->withErrors('errors', __('Hiba a mentés folyamán'))
                    ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $cs = CompanySubdomainModel::getByID($id);

        $companies = Helper::getCompanies();

        //dd('CompanySubdomainController.edit', $cs, $companies);

        return view('companysubdomain.edit', [
            'cs' => $cs,
            'companies' => $companies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $config = config('appConfig.tables.company_has_subdomain');

        $this->validate($request, [
            'CompanyID' => 'required|unique:' . $config['connection'] . '.' . $config['table'] . ',CompanyID',
            'SubdomainName' => 'required|min:5|max:255|unique:' . $config['connection'] . '.' . $config['table'] . ',SubdomainName',
        ]);

        $cs = CompanySubdomainModel::getByID($id);
        $cs->update($request->all());

        return redirect()
            ->to('companysubdomain')
            ->with('success', __('global.app_messages.update_successfully', ['name' => __('global.app_data')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cs = CompanySubdomainModel::getByID($id);
        $cs->delete();

        return redirect()
            ->route('companysubdomain.index')
            ->with('success', __('appConfig.app_messages.delete_successfully', ['name' => __('global.app_data')]));
    }

    function __construct()
    {
        $this->middleware('role:Admin', [
            'only' => [
                'index', 'show',
                'create', 'store',
                'edit', 'update',
                'destroy', 'restore'
            ]
        ]);
    }

}

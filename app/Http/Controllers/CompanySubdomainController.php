<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanySubdomainModel;
use App\Classes\Helper;

class CompanySubdomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        $cs->CompanyID = $request->CompanyID;
        $cs->CompanyName = $company->Nev1;
        $cs->CompanyNickName = \App\Classes\Helper::remove_accents($company->Nev1);
        $cs->SubdomainName = $request->SubdomainName;
        
        try
        {
            $cs->save();
            
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

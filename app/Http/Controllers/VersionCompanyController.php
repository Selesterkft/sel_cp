<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Models\VersionCompanyModel;
use App\Models\VersionModel;
use Illuminate\Http\Request;
use Session;

class VersionCompanyController extends Controller
{
    function __construct()
    {
        $this->middleware('role:Admin', [
            'only' => [
                'index',    'show',
                'create',   'store',
                'edit',     'update',
                'destroy',  'restore'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return null;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create()
    {
        // Verziók a combohoz
        $versions = Helper::getVersions();

        // Companies adatok a combo boxhoz
        $companies = Helper::getCompanies();

        return view('versioncompany.create', [
            'versions' => $versions,
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $config = config('appConfig.tables.version_has_company');
        $this->validate($request, [
            'CompanyID' => 'required|numeric|not_in:0|unique:' . $config['table'] . ',CompanyID',
            'VersionID' => 'required|numeric|not_in:0'
        ]);

        $vc = new VersionCompanyModel();
        $vc->save($request->all());

        return redirect()
            ->to('versions')
            ->with('success', trans('messages.create_successfully', ['name' => trans('global.versions.connection')]));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function show($id)
    {
        $vc = VersionCompanyModel::getByID($id);

        $versions = Helper::getVersions();
        $companies = Helper::getCompanies();

        return view('versioncompany.show', [
            'vc' => $vc,
            'versions' => $versions,
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit($id)
    {
        //dd('VersionCompanyController.edit', session()->all());
        $vc = VersionCompanyModel::getByID($id);
        $versions = Helper::getVersions();
        $companies = Helper::getCompanies();

        return view('versioncompany.edit', [
            'vc' => $vc,
            'versions' => $versions,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        // Adatbázis konfiguráció betöltése
        $config = config('appConfig.tables.version_has_company');

        // Bejövő adatok validálása
        $this->validate($request, [
            'CompanyID' => 'required|numeric|not_in:0|unique:' . $config['table'] . ',CompanyID,' . $id,
            'VersionID' => 'required|numeric|not_in:0'
        ]);

        // Szerkesztendő rekord lekérése az adatbázisból
        $vc = VersionCompanyModel::getByID($id);
        $vc->update($request->all());

        // Ha az aktuális céget szerkesztem, akkor...
        if ($request->get('CompanyID') == session()->get('company_id'))
        {
            // Verziónév lekérése az adatbázisból
            $version_name = (VersionModel::find($request->get('VersionID')))->Version;

            // Ha megváltozott a verziószám, akkor...
            if(session()->get('version') != $version_name )
            {
                // Új verziószám a SESSION-be
                //\Session::set('version', $version_name);
                Session::put('version', $version_name);
            }
        }

        // Átirányítás a VERSIONS.INDEX oldalra üzenetekkel
        return redirect()
            ->to('versions')
            ->with('success', trans('messages.update_successfully', ['name' => trans('versions.connection')]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vc = VersionCompanyModel::find($id);

        $vc->delete();

        return redirect()
            ->route('versions.index')
            ->with('success', trans('messages.delete_successfully', ['name' => trans('versions.connection')]));
    }

    /*
     * Vue.js-hez szolgáltat adatokat
     */
    public function getCompanyVersions(Request $request)
    {
        $companies_versions = VersionCompanyModel::latest()->paginate(5);

        foreach( $companies_versions as $c_version)
        {
            //dd('VersionCompany::getCompanyVersions', $c_version->version->Version);
            $c_version->CompanyName = $c_version->company->Nev1;
            $c_version->Version = $c_version->version->Version;
        }

        //dd('VersionCompany::getCompanyVersions', $companies_versions);

        $response = [
            'pagination' => [
                'total' => $companies_versions->total(),
                'per_page' => $companies_versions->perPage(),
                'current_page' => $companies_versions->currentPage(),
                'last_page' => $companies_versions->lastPage(),
                'from' => $companies_versions->firstItem(),
                'to' => $companies_versions->lastItem(),
            ],
            'compaies_versions' => $companies_versions
        ];

        return $response;
    }

    public function storeCompanyVersion(Request $request){

        $config = config('appConfig.tables.version_has_company');
        $this->validate($request, [
            'CompanyID' => 'required|numeric|not_in:0|unique:' . $config['table'] . ',CompanyID',
            'VersionID' => 'required|numeric|not_in:0'
        ]);

        $vc = new VersionCompanyModel();
        $res = $vc->save($request->all());

        return $res;
    }

    public function updateCompanyVersion(Request $request, $id){

        $config = config('appConfig.tables.version_has_company');

        $this->validate($request, [
            'CompanyID' => 'required|numeric|not_in:0|unique:' . $config['table'] . ',CompanyID,' . $id,
            'VersionID' => 'required|numeric|not_in:0'
        ]);

        $vc = VersionCompanyModel::getByID($id);
        $res = $vc->update($request->all());

        if ($request->get('CompanyID') == session()->get('company_id')){

            $version_name = (VersionModel::find($request->get('VersionID')))->Version;

            if(session()->get('version') != $version_name ){

                Session::put('version', $version_name);
            }
        }

        return $res;
    }
}

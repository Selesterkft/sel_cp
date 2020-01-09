<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Models\VersionCompanyModel;
use App\Models\VersionModel;
use Illuminate\Http\Request;

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
            ->with('success', __('global.app_messages.create_successfully', ['name' => __('global.version.connection')]));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return void
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
                \Session::put('version', $version_name);
            }
        }

        // Átirányítás a VERSIONS.INDEX oldalra üzenetekkel
        return redirect()
            ->to('versions')
            ->with('success', __('global.app_messages.update_successfully', ['name' => __('global.version.connection')]));

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
            ->with('success', __('appConfig.app_messages.delete_successfully', ['name' => __('global.version.connection')]));
    }
}

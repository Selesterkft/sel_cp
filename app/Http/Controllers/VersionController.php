<?php

namespace App\Http\Controllers;

use App\Models\ver_2019_01\CompanyModel;
use App\Models\VersionCompanyModel;
use App\Models\VersionModel;
use Illuminate\Http\Request;

class VersionController extends Controller {

    /**
     * VersionController constructor.
     */
    public function __construct() {
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
     */
    public function index()
    {
        //$versions = VersionModel::all();
        $versions = VersionModel::readAll();

        //$version_companies = VersionCompanyModel::all();
        $version_companies = VersionCompanyModel::readAll();

        return view('versions.index', [
            'versions' => $versions,
            'version_companies' => $version_companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //dd('VersionController.create');
        // TODO: Átállítani nézetre
        $companies = CompanyModel::orderBy('Nev1', 'asc')
                ->pluck('Nev1', 'ID')
                ->all();

        return view('versions.create', [
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Adatbázis paraméterek betöltése
        $config = config('appConfig.tables.versions');

        // Bejövő adatok validálása
        $this->validate($request, [
            'Version' => 'required|unique:' . $config['table'] . ',Version'
        ]);

        // Új model betöltése
        $version = new VersionModel();
        $version->save($request->all());

        // Bejövő adatok betöltése a modelbe
        //$version->Version = $request['Version'];
        //$version->Active = (!empty($request['Active']) ) ? $request['Active'] : 0;
        // Mentés
        //$version->save();

        // Visszairányítás az INDEX oldalra üzenettel.
        return redirect()
                ->to('versions')
                ->with('success', __('global.app_messages.create_successfully', ['name' => __('global.version.title')]));
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id) {
        // Megjelenítendő rekord lekérése az adatbázisból
        $version = VersionModel::find($id);

        // SHOW oldal betöltése
        return view('versions.show', ['version' => $version]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // Szerkesztendő adat lekérése az adatbázisból
        $version = VersionModel::find($id);

        // Szerkesztő oldal betöltése
        return view('versions.edit', [
            'version' => $version
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
    public function update(Request $request, $id) {
        // Adatbázis paraméterek betöltése
        $config = config('appConfig.tables.versions');

        // Bejövő adatok validálása
        $this->validate($request, [
            'Version' => 'required|unique:' . $config['table'] . ',Version,' . $id,
        ]);

        // Szerkesztendő rekord lekérése
        $version = VersionModel::find($id);
        //dd('VersionController.update', $request->all());
        $version->update($request->all());

        // Visszairányítás a VERSIONS oldalra üzenetekkel
        return redirect()
                ->to('versions')
                ->with('success', __('global.app_messages.update_successfully', ['name' => __('global.version.title')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $version = VersionModel::find($id);
        // Törlés tárolt eljárással
        $res = $version->delete();

        // A törlendő rekord lekérése és törlése
        //$res = VersionModel::find($id)->delete($id);

        // Ha nincs visszatérő érték, akkor...
        if (empty($res)) {
            // Visszairányítás az USERS.INDEX oldalra hiba üzenettel
            return redirect()
                    ->to('versions')
                    ->with('error', __('global.app_messages.delete_error', ['name' => __('global.version.title')]));
        }

        // Visszairánytás az USER.INDEX oldalra üzenettel.
        return redirect()
                ->to('versions')
                ->with('success', __('global.app_messages.delete_successfully', ['name' => __('global.version.title')]));
    }

    public function restore($id) {
        // Rekord lekérése az adatbázisból, és visszaállítás
        //$version = VersionModel::withTrashed()->find($id)->restore();
        $version = VersionModel::find($id)->restore();

        if(empty($version))
        {
            return restore()
                    ->to('versions')
                    ->with('error', __('global.app_messages.restore_error', ['name' => __('global.version.title')]));
        }

        //
        return redirect()
                ->to('versions')
                ->with('success', __('global.app_messages.restore_successfully', ['name' => __('global.version.title')]));
    }

}

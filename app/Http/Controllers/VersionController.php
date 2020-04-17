<?php

namespace App\Http\Controllers;

//use App\Models\ver_2019_01\CompanyModel;
use App\Models\CompanySubdomainModel;
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

        $version_companies = VersionCompanyModel::readAll();

        $company_subdomain = CompanySubdomainModel::readAll();

        return view('versions.index', [
            'versions' => $versions,
            'version_companies' => $version_companies,
            'company_subdomains' => $company_subdomain,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('versions.create');
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
                ->with('success', trans('global.app_messages.create_successfully', ['name' => trans('versions.title')]));
    }

    public function storeVersion(Request $request){

        $config = config('appConfig.tables.versions');
        $this->validate($request, [
            'Version' => 'required|unique:' . $config['table'] . ',Version'
        ]);

        $version = new Version();
        $res = $version->save($request->all());

        return $res;
    }

    public function updateVersion(Request $request, $id){

        //dd('VersionController::updateVersion', $request->all(), $id);
        $config = config('appConfig.tables.versions');

        $this->validate($request, [
            'Version' => 'required|unique:' . $config['table'] . ',Version,' . $id
        ]);

        $version = VersionModel::find($id);
        $res = $version->update($request->all());

        return $res;
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
                ->with('success', trans('messages.update_successfully', ['name' => trans('versions.title')]));
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
                    ->with('error', trans('messages.delete_error', ['name' => trans('versions.title')]));
        }

        // Visszairánytás az USER.INDEX oldalra üzenettel.
        return redirect()
                ->to('versions')
                ->with('success', trans('messages.delete_successfully', ['name' => trans('versions.title')]));
    }

    public function restore($id) {
        // Rekord lekérése az adatbázisból, és visszaállítás
        //$version = VersionModel::withTrashed()->find($id)->restore();
        $version = VersionModel::find($id)->restore();

        if(empty($version))
        {
            return redirect()
                    ->to('versions')
                    ->with('error', trans('messages.restore_error', ['name' => trans('versions.title')]));
        }

        //
        return redirect()
                ->to('versions')
                ->with('success', trans('messages.restore_successfully', ['name' => title('versions.title')]));
    }

    public function getVersions()
    {
        $versions = VersionModel::latest()->paginate(5);

        $response = [
            'pagination' => [
                'total'         => $versions->total(),
                'per_page'      => $versions->perPage(),
                'current_page'  => $versions->currentPage(),
                'last_page'     => $versions->lastPage(),
                'from'          => $versions->firstItem(),
                'to'            => $versions->lastItem(),
            ],
            'versions' => $versions
        ];
        return $response;
    }

    public function getVersionsToSelect()
    {
        $res = VersionModel::where('Active', '=', 1)
            ->select('ID', 'Version')
            ->get()
            ->toArray();

        return $res;
    }

}

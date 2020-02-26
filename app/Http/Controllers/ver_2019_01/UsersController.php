<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Classes\Helper;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Searchable\Search;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:user-menu', [
            'only' => [
                'index', 'show',
                'create', 'store',
                'edit', 'update',
                'destroy', 'restore'
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
        // Bejelentkezett felhasználó
        $loggedUser = \Auth::user();
        /*
        // Az összes felhasználó név szerint rendezve
        $model = User::where('CompanyID', '=', $loggedUser->CompanyID)
                ->where('Supervisor_ID', '=', $loggedUser->Supervisor_ID)
                ->orderBy('Name');
        */

        $config = config('appConfig.tables.users');

        $model = \DB::connection($config['connection'])
            ->table($config['read'])
            ->where('CompanyID', '=', $loggedUser->CompanyID)
            ->where('Supervisor_ID', '=', $loggedUser->Supervisor_ID)
            ->orderBy('Name', 'desc');
        //dd('UsersController.index', $model->toSql());

        $users = $model->get();
        $users2 = [];

        foreach($users as $user)
        {
            $usr = new \App\User();
            foreach( $user as $key => $val )
            {
                $usr->$key = $val;
            }
            $users2[] = $usr;
        }

        $users = $users2;

        return view(session()->get('version') . '.users.index', [
            'users' => $users
        ]);
    }

    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(User::class, ['Name', 'Email'])
            ->registerAspect(\App\SearchAspects\UsersSearchAspect::class)
            ->search($request['q']);

        return view(session()->get('version') . "/users/search", [
            'searchResults' => $searchResults,
        ]);
    }

    /**
     * Mutassa meg az új erőforrás létrehozásának űrlapját.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Szerepkörök listája
        //$roles = Helper::getRoles();
        $roles = Role::raw(config('appConfig.raw'))
                ->pluck('name', 'name');

        // Cégek listája
        $companies = Helper::getCompanies();
        // Alap jogkör
        //$defaultRole = '';

        //dd('UsersController.create', $roles, $companies);

        // Ha a bejelentkezett felhasználó Admin jogkörrel rendelkezik, akkor...
        /*
        if( \Auth::user()->hasRole('Admin') )
        {
            $defaultRole = 'Master';
        }
        */
        // users.create oldal betöltése
        return view(session()->get('version') . "/users/create", [
            'companies' => $companies,
            'roles' => $roles,
            //'defaultRole' => $defaultRole,
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
        //dd('UserController.store', $request->all());
        // Bejelentkezett felhasználó
        $loggedUser = \Auth::user();
        // Users tábla adatbázis beállításai
        $config = config('appConfig.tables.users');
        // Validációs szabályok
        $this->validate($request, [
            'Name' => 'required',
            'Email' => 'required|email|unique:' . $config['table'] . ',email',
            'CompanyID' => 'required|not_in:0',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        // Űrlaptól jövő adatok változóba töltése
        $input = $request->all();
        // Jelszó kódolása
        $input['password'] = \Hash::make($input['password']);
        // Új rekord azonosító beszerzése
        //$input['ID'] = (string) User::max('id') + 1;
        // Tranzakció azonosító
        $input['TransactID'] = '0';
        // Supervisor azonosító
        //$input['Supervisor_ID'] = '0';
        // Adatbázis tranzakció kezdete
        \DB::beginTransaction();

        //dd('UserController.store', $request->all(), $input);

        // Új User osztály
        $user = new User();
        //dd('UserController.store new user', $user);
        // Az űrlapból jövő adatokat beteszem az új user osztályba és elmentem
        $user = $user->CreateUser($input);
        //dd('UsersController.store', $user);
        //$user = User::create($input);
        // Jogkörök szikronizálása
        $user = $user->assignRole($request->input('roles'));

        // Ha a szinkronizálás nem sikerült, akkor...
        if( !$user || !$user->hasRole($request->input('roles')))
        {
            // Tranzakció visszavonása
            \DB::rollBack();
            // Visszairányítás az index oldalra üzenettel.
        return redirect()
                ->to('users')
                ->with('error', trans('messages.errors_create'));
        }
        else
        {
            // Tranzakció megerősítése
            \DB::commit();
        }

        // Visszairányítás az index oldalra üzenettel.
        return redirect()
                ->to('users')
                ->with('success', trans('messages.success_create'));
    }

    /**
     * A megadott erőforrás megjelenítése.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Aktuális rekord lekérése az adatbázisból
        $user = User::find($id);
        // Jogkörök listája
        $roles = Helper::getRoles();

        // SHOW oldal meghívása a szükséges adatok átadásával
        return view(session()->get('version') . "/users/show", [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $user->getRoleNames()
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
        // Aktuális rekord lekérése az adatbázisból
        $user = User::find($id);
        // Jogkörök listája
        $roles = Role::raw(config('appConfig.raw'))
                ->pluck('name', 'name');

        // Cégek listája
        //$companies = Helper::getCompanies();
        // Alapértelmezett jogkör
        //$defaultRole = '';

        // A felhasználó szerepkörei
        $userRoles = $user->getRoleNames();

        //dd('UsersController.edit', $userRoles);

        // Az EDIT oldal meghívása és a szükséges adatok átadása
        return view(session()->get('version') . "/users/edit", [
            'user' => $user,
            //'companies' => $companies,
            'roles' => $roles,
            'userRoles' => $userRoles,
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
        // Adatbázis beállítások lekérése
        $config = config('appConfig.tables.users');

        // Validációs szabályok
        $this->validate($request, [
            'Name' => 'required',
            'Email' => 'required|email|unique:' . $config['table'] . ',email,' . $id,
            'password' => 'same:confirm-password',
        ]);

        // Űrlap felől jövő adatok változóba töltése
        $input = $request->all();

        // Ha a bejövő adatok közötta PASSWORD is szerepel, akkor...
        if( !empty($input['password']) )
        {
            // Jelszó kódolása
            $input['password'] = \Hash::make($input['password']);
        }
        else
        {
            // A PASSWORD mező eltávolítása az input tömbből
            $input = array_except($input, ['password']);
        }

        // Tranzakció kezdete
        \DB::beginTransaction();

        // A szerkesztendő USER lekérése az adatbázisból
        $user = User::find($id);
        // A rekord frissítése a bejövő adatokkal
        $user->update($input);

        // Adatbázis konfiguráció betöltése
        $config = config('appConfig.tables.model_has_roles');

        // Jogkör kapcsolatok törlése
        \DB::connection($config['connection'])
            ->table($config['table'])
            ->where('model_id', $id)
            ->delete();
        // Új jogkör kapcsolatok mentése
        $user = $user->assignRole($input['roles']);

        // Ha az USER vagy a jogkörök mentése nem sikerült, akkor...
        if( !$user || !$user->hasRole($request->input('roles')))
        {
            // Tranzakció visszavonása
            \DB::rollBack();
            // Visszairányítás az USERS.INDEX hiba üzenettel
            return redirect()
                    ->to('users')
                    ->with('error', trans('messages.errors_update'));
        }
        else
        {
            // Tranzakvió megerősítése
            \DB::commit();
        }

        // Ha a szerkesztett USER megegyezik a bejelentkezett felhasználóval,
        // és a nyelvet megváltoztatták, akkor...
        if( $user->Name == \Auth::user()->Name &&
            $user->language != \App::getLocale() )
        {
            // Nyelv módosítása
            session()->put('locale', $user->language);
        }

        // Visszairányítás az USERS.INDEX oldalra
        return redirect()
                ->to('users')
                ->with('success', trans('messages.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // A törlendő rekord lekérése és törlése
        $res = User::find($id)->delete();

        // Ha nincs visszatérő érték, akkor...
        if( empty($res) )
        {
            // Visszairányítás az USERS.INDEX oldalra hiba üzenettel
            return redirect()
                    ->to('users')
                    ->with('error', trans('messages.errors_delete'));
        }

        // Visszairánytás az USER.INDEX oldalra üzenettel.
        return redirect()
                ->to('users')
                ->with('success', trans('messages.success_delete'));
    }

    public function restore($id)
    {
        $res = User::restore($id);

        return redirect()
                ->to('users')
                ->with('success', trans('messages.success_restore'));
    }
}

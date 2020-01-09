<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Classes\Helper;
use App\Http\Controllers\Controller;
use App\Models\CompanyModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::find($id);

        $a = Helper::getCompanyAndVersion();

        return view($a['url'] . '/users/profile', [
            'user' => $user,
            'version' => $a['version'],
            ]);
    }

    public function index_old()
    {
        $user = \Auth::user();

        if( $user->hasRole('Admin') )
        {
            // Ha Admin jogú a bejelentkezett felhasználó,
            // akkor az összes cég bekerül a listába
            $companies = CompanyModel::raw('SET SESSION TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;')
                ->orderBy('Nev1', 'asc')
                ->pluck('Nev1', 'ID')
                ->all();

            $companies = [0 => Lang::get('global.app_select_first_element')] + $companies;

            // akkor minden jogot kioszthat
            $roles = Role::pluck('name', 'name')->all();
        }
/*
        $companies = CompanyModel::raw('SET SESSION TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;')
            ->where('ID', '=', $user->company_id)
            ->pluck('Nev1', 'ID');

        $roles = Role::where('name', '<>', 'Admin')
            ->pluck('name', 'name')
            ->all();
*/
        $userRole = $user->roles
            ->pluck('name','name')
            ->all();

        $disabled = 'disabled';
        //dd($roles, $userRole);
        return view('users.profile', compact('user', 'companies', 'disabled', 'roles', 'userRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        dd($request, $id);
    }

    public function update_old(Request $request, $id)
    {
        //dd($request->all(), $id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        //dd($input);
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()
            ->route('users.profile')
            ->with('success','User updated successfully');
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        //$this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        //$this->middleware('permission:role-create', ['only' => ['create','store']]);
        //$this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //$this->middleware('permission:role-delete', ['only' => ['destroy']]);
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
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'asc')
            ->paginate(config('appConfig.paginate_number'));
        //dd($roles);

        return view('roles.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();

        //$a = Helper::getCompanyAndVersion();

        return view('roles.create', [
            'permission' => $permission,
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
        $config = config('appConfig.tables.roles');
        $this->validate($request, [
            'name' => 'required|unique:' . $config['table'] . ',name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()
                ->to('roles')
                ->with('success', trans('messages.create_successfully', ['name' => trans('roles.role_title')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join(
            "role_has_permissions",
            "role_has_permissions.permission_id",
            "=",
            "permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        //$a = Helper::getCompanyAndVersion();

        return view('roles.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
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
        //dd($request->all(), $id);
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);

        if( $role->name != $request->input('name') )
        {
            $role->name = $request->input('name');
            $role->save();
        }

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success', trans('messages.create_successfully', ['name' => trans('roles.role_title')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
            ->with('success',trans('messages.create_successfully', ['name' => trans('roles.role_title')]));
    }
}

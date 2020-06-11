<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * PermissionsController constructor.
     */
    public function __construct()
    {
        $this->middleware('', [
            'only' => [
                'index',    'show',
                'create',   'store',
                'edit',     'update',
                'destroy',  'restore',
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
        $permissions = Permission::orderBy('id', 'asc')
            ->paginate(config('appConfig.paginate_number'));

        return view('permissions.index', ['permissions' => $permissions]);

        //return view('permissions.index');
    }

    public function getPermissions()
    {
        $permissions = Permission::paginate(config('appConfig.paginate_number'));

        $response = [
            'pagination' => [
                'total'         => $permissions->total(),
                'per_page'      => $permissions->perPage(),
                'current_page'  => $permissions->currentPage(),
                'last_page'     => $permissions->lastPage(),
                'from'          => $permissions->firstItem(),
                'to'            => $permissions->lastItem(),
            ],
            'permissions' => $permissions
        ];

        return $response;
    }

    public function storePermission(Request $request)
    {
        $config = config('appConfig.tables.permissions');
        $this->validate($request, [
            'name' => 'required|unique:' . $config['table'] . ',name'
        ]);

        $permissions = Permission::create(['name' => $request['name']]);

        return ['done'];
    }

    public function updatePermission(Request $request, $id)
    {
        $config = config('appConfig.tables.permissions');
        $this->validate($request, [
            'name' => 'required|unique:' . $config['table'] . ',name,' . $id
        ]);

        $permissions = Permission::find($id);
        $permissions->update($request->all());

        return ['done'];
    }

    public function getPermissionsToSelect()
    {
        $permissions = Permission::select('id', 'name')
            ->get()
            ->toArray();
        return $permissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $config = config('appConfig.tables.permissions');
        $this->validate($request, [
            'name' => 'required|unique:' . $config['table'] . ',name'
        ]);

        $permissions = Permission::create(['name' => $request['name']]);

        return redirect()
            ->to('permissions')
            ->with('success', trans('messages.create_successfully', ['name' => trans('permissions.permission_title')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);

        return view('permissions.show', ['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $config = config('appConfig.tables.permissions');
        $this->validate($request, [
            'name' => 'required|unique:' . $config['table'] . ',name,' . $id
        ]);

        $permissions = Permission::find($id);
        $permissions->update($request->all());

        return redirect()
            ->to('permissions')
            ->with('success', trans('messages.update_successfully', ['name' => trans('permissions.title')]));
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

    public function restore($id)
    {
        //
    }
}

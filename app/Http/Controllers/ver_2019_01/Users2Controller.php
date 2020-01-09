<?php

namespace App\Http\Controllers\ver_2019_01;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class Users2Controller extends Controller
{
    /**
     * Users2Controller constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:users-menu', [
            'only' => ['index']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$version = session()->get('version');
        //dd($version);
        //$companyModel = app()->make("\App\Models\\" . $version . "\CompanyModel");
        //$companies = $companyModel->orderBy('Nev1', 'asc')->pluck('Nev1', 'ID')->all();

        if( $request->ajax() )
        {
            $users = User::all();
            $companyModel = app()->make("\App\Models\\ver_2019_01\CompanyModel");
            $companies = $companyModel->orderBy('Nev1', 'asc')->pluck('Nev1', 'ID')->all();

            foreach( $users as $user )
            {
                if( $user->Supervisor_ID == 0 )
                {
                    $user->CompanyName = $companies[$user->CompanyID];
                }
                else
                {
                    $user->CompanyName = $user->Supervisor_Name;
                }
            }
            return json_encode($users);
        }

        return view(session()->get('version') . '.users2.index');
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
}

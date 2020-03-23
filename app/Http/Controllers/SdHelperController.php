<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SdHelperController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $companyModel = '\App\Models\\' . session()->get('version') . '\CompanyModel';
        $query = $companyModel::orderBy('Nev1', 'asc')->get();

        $map = $query->map(function($items)
        {
            $subdomain = \App\Classes\Helper::getCompanyNickName($items->Nev1);
            $data['ID'] = $items->ID;
            $data['Nev1'] = $items->Nev1;
            $data['Subdomain'] = $subdomain;
            $data['Url'] = "http://{$subdomain}.webandtrace.com/cp/public/index.php";

            return $data;
        });

        //dd('SdHelperController.index', $map);

        return view('subdomain_helper.index', [
            'companies' => $map
        ]);
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

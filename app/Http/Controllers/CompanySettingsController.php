<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Models\VersionModel;
use Illuminate\Http\Request;

class CompanySettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Helper::getPartners(\Auth::user()->CompanyID);

        return view('settings.company.index', [
            'companies' => $companies
        ]);
    }

    public function getCompanyVersion(Request $request)
    {
        $company_version = CompanyVersionModel::latest()->paginate(5);

        $response = [
            'pagination' => [
                'total' => $company_version->total(),
                'per_page' => $company_version->perPage(),
                'current_page' => $company_version->currentPage(),
                //'current_page' => $request->get('page'),
                'last_page' => $company_version->lastPage(),
                'from' => $company_version->firstItem(),
                'to' => $company_version->lastItem(),
            ],
            'versions' => $company_version
        ];
        return $response;
    }

    public function storeCompanyVersion(Request $request)
    {
        //
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

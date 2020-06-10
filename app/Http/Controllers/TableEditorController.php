<?php

namespace App\Http\Controllers;

use App\Models\CompanyModel;
use App\Models\QueryTypeModel;
use App\Models\UserQueryModel;
use App\User;
use Illuminate\Http\Request;

class TableEditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registeredCompanies = User::getRegisteredCompanies();

        $query_types = QueryTypeModel::all()->toArray();
        foreach ($query_types as $id => $query_type){
            $query_types[$id]['Columns'] = json_decode($query_type['Columns'], true);
        }
        //dd('TableEditorController::index', $query_types);

        $user_queries = UserQueryModel::all()->toArray();
        foreach($user_queries as $id => $user_query){
            $user_queries[$id]['Columns'] = json_decode($user_query['Columns'], true);
        }
        //dd('TableEditorController::index', $user_queries);

        $registeredCompanies['user_queries'] = $user_queries;
        $registeredCompanies['query_types'] = $query_types;

        //dd('TableEditorController::index', $registeredCompanies);

        $aa = json_encode($registeredCompanies);

        //dd('TableEditorController::index', $aa);

        return view('table_editor.index', [
            'registeredCompanies' => $aa,
            'query_types' => $query_types,
            'user_queries' => $user_queries,
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

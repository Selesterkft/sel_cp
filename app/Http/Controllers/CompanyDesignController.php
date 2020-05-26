<?php

namespace App\Http\Controllers;

use App\Classes\Helper;
use App\Models\CompanyDesignModel;
use App\Models\DesignModel;
use Illuminate\Http\Request;

class CompanyDesignController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create()
    {
        //dd('CompanyDesignController::create');
        $companies = Helper::getCompanies();
        $designs = DesignModel::readDesignsToSelect();

        return view('company_design.create', [
            'companies' => $companies,
            'designs' => $designs
        ]);
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
        $config = config('appConfig.tables.company_design');
        //dd('CompanyDesignController::store', $request->all(), $config);
        $this->validate($request, [
            'company_id' => "required|unique:{$config['connection']}.{$config['table']},company_id",
            'design' => 'required',
        ]);

        $cd = new CompanyDesignModel();

        try
        {
            $cd->save($request->all());

            return redirect()
                ->to('versions')
                ->with('success', 'A kapcsolat létrejött.');
            /*
            return redirect()
                ->to(url('versions'))
                ->with('success', 'A kapcsolat létrejött.');
            */
        }
        catch(Exception $e)
        {
            return redirect()
                ->back()
                ->withErrors('errors', trans('message.errors_save'))
                ->withInput();
        }
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
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit($id)
    {
        //dd('CompanyDesignController::edit', $id);
        $cd = CompanyDesignModel::find($id);
        $companies = Helper::getCompanies();
        $designs = DesignModel::readDesignsToSelect();

        return view('company_design.edit', [
            'company_design' => $cd,
            'companies' => $companies,
            'designs' => $designs
        ]);
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
        $config = config('appConfig.tables.company_design');
        //dd('CompanyDesignController::update', $config);
        $this->validate($request, [
            'design' => 'required',
        ]);

        $cd = CompanyDesignModel::find($id);
        $cd->update($request->all());

        return redirect()
            ->to('versions')
            ->with('success', trans('messages.update_successfully', ['name' => trans('company_design.title')]));
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

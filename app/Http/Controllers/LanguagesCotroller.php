<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Waavi\Translation\Models\Language;
use Waavi\Translation\Repositories\LanguageRepository;

class LanguagesCotroller extends Controller
{
    protected $repository;
    /**
     * TranslationsCotroller constructor.
     */
    public function __construct()
    {
        $this->middleware('role:Admin', ['only' => [
            'index', 'show',
            'create', 'store',
            'edit', 'update',
            'destroy', 'restore',
        ]]);
        $this->repository = new LanguageRepository(new Language(), app());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        return view('vendor.translation.languages.index', ['languages' => $languages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.translation.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()
            ->to('languages')
            ->with('success', trans('messages.language_added'));
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

    public function restore($id){}
}

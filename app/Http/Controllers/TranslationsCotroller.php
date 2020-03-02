<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Waavi\Translation\Facades\TranslationCache;
use Waavi\Translation\Models\Language;
use Waavi\Translation\Models\Translation;
use Waavi\Translation\Repositories\TranslationRepository;

class TranslationsCotroller extends Controller
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
        $this->repository = new TranslationRepository(new Translation(), app());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($language)
    {
        if( request()->has('language') && request()->get('language') !== $language )
        {
            $language = request()->get('language');
        }

        $model = new Translation();
        $model = $model->where('locale', $language);

        if( request()->has('group') && request()->get('group') )
        {
            $model = $model->where('group', request()->get('group'));
        }

        if( request()->has('filter') && request()->get('filter') )
        {
            $model = $model->where('text', '%' . request()->get('group') .'%');
        }

        $languages = Language::select('locale', 'name')->get()->toArray();
        $groups = Translation::groupBy('group')
            ->select('group')
            ->get()->toArray();
        $translations = $model->get();

        return view('vendor.translation.languages.translations.index', [
            'translations' => $translations,
            'languages' => $languages,
            'groups' => $groups,
            'language' => $language,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($language)
    {
        return view('vendor.translation.languages.translations.create', ['language' => $language]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $language)
    {
        //dd('TranslationsCotroller::store', $request->all(), $language);
        $this->repository->create($request->all());

        if( !empty($this->repository->validationErrors()) )
        {
            //
        }

        TranslationCache::flush(
            $request->get('locale'),
            $request->get('group'),
            $request->get('namespace')
        );

        return redirect()
            ->to('translations/' . $language)
            ->with('success', 'messages.translation_added');
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
    public function edit($language, $id)
    {
        //dd('TranslationsCotroller::edit', $language, $id);
        $translation = Translation::find($id);

        return view('vendor.translation.languages.translations.edit', [
            'id' => $id,
            'language' => $language,
            'translation' => $translation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $language, $id)
    {
        //dd('TranslationsCotroller::update', $request->all(), $language, $id);
        $this->repository->update($id, $request->text);

        if( !empty($this->repository->validationErrors()) )
        {
            //
        }

        TranslationCache::flush(
            $request->get('locale'),
            $request->get('group'),
            $request->get('namespace')
        );

        return redirect()
            ->to('translations/' . $language)
            ->with('success', trans('messages.translation_updated'));
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

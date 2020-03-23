<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*
        $design = session()->get('design');
        return view("{$design}/home", [
            'design' => $design,
        ]);
        */
        /*
        return \view(\session()->get('version') . "/home", [
            'company' => \session()->get('company'),
        ]);
        */
        return view(session()->get('design').'.home');
    }
}

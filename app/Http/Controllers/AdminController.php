<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WidgetAction;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = WidgetAction::all()->jsonSerialize();
        return view('admin', array(
            'widgets' => $data
        ));
    }
}

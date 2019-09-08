<?php

namespace App\Http\Controllers;

use App\Flat;
use Illuminate\Http\Request;

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
      $flat = Flat::paginate(12); //cambiare poi il controllo con gli appartamenti in evidenza (in promozione)
      return view('home', compact('flat'));
    }
}

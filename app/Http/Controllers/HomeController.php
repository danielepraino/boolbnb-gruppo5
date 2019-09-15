<?php

namespace App\Http\Controllers;

use App\Flat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Sponsorship;
use DB;
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
      $flat = DB::table('flats')
            ->join('sponsorships', 'flats.id', '=', 'sponsorships.flat_id')
            ->whereDate('sponsorships_expires', '>', Carbon::now())
            ->get();

       //cambiare poi il controllo con gli appartamenti in evidenza (in promozione)
      return view('home', compact('flat'));
    }
}

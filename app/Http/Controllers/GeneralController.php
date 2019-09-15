<?php

namespace App\Http\Controllers;

use App\Flat;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Sponsorship;

class GeneralController extends Controller
{
    public function home(){
      $flat = DB::table('flats')
            ->join('sponsorships', 'flats.id', '=', 'sponsorships.flat_id')
            ->whereDate('sponsorships_expires', '>', Carbon::now())
            ->get();

      return view('/home', compact('flat'));
    }

}

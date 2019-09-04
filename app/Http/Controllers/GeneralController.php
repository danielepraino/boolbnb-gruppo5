<?php

namespace App\Http\Controllers;

use App\Flat;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function home(){
      $flat = Flat::all(); //cambiare poi il controllo con gli appartamenti in evidenza (in promozione)
      return view('home', compact('flat'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Flat;

class SearchController extends Controller
{
    public function index(){
      
        $flat = Flat::all();

        $raggio = $_POST['radius'];
        $userLat = $_POST['lat'];
        $userLon = $_POST['lon'];
        $filtered_flat = [];

        if ($_POST['lat'] > 0 && $_POST['lon'] > 0) {
          $filtered_flat = Flat::filterByRadius($flat, $raggio, $userLat, $userLon);
        }

        return view('/search', compact('filtered_flat'));
    }
}

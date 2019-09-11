<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Flat;
use App\Service;
use Illuminate\Support\Facades\DB;

class ResearchFlatController extends Controller
{

  public function index(){

    //return response()->json(Flat::all());
    $filtered_flat = new Flat;
    $filtered_flat = $filtered_flat->get();
    $services = new Service;
    $services = $services->get();

    if (\Request::ajax()){
      $query = '';


    	if (isset($_POST["room"])){
        $filtered_flat = $filtered_flat->where('room', '=', $_POST["room"]);
        //echo($filtered_flat);

    	}

    	if (isset($_POST["bed"])){
        $filtered_flat = $filtered_flat->where('bed', '=', $_POST["bed"]);
        //echo($filtered_flat);

    	}

    	if (isset($_POST["wifi"])){
        $filtered_flat = $filtered_flat
              ->join('services', 'services.flats_id', '=', 'flats.id')
              //->where('services.wifi', $_POST["wifi"])
              ;
    	}

    	if (isset($_POST["parking"])){
    		$query .= "Service::where('parking', '=', ".$_POST["parking"].")->get()";
    	}

      if (isset($_POST["pool"])){
        $query .= "Service::where('pool', '=', ".$_POST["pool"].")->get()";
      }

      if (isset($_POST["concierge"])){
        $query .= "Service::where('concierge', '=', ".$_POST["concierge"].")->get()";
      }

      if (isset($_POST["sauna"])){
        $query .= "Service::where('sauna', '=', ".$_POST["sauna"].")->get()";
      }

      if (isset($_POST["sea_view"])){
        $query .= "Service::where('sea_view', '=', ".$_POST["sea_view"].")->get()";
      }


      return response()->json($filtered_flat);
      }
    }
}

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

  public function filter() {

    $flats = DB::table('services')
                 ->join('flats', 'services.flat_id', '=', 'flats.id')
                 ->where('visible', '=', "1")
                 ->get();

    if (\Request::ajax()) {
      foreach($_POST as $filterKey => $filterValue) {
          $flats = $flats->where($filterKey, '=', $filterValue);
      }

     $response =  response()->json($flats);
     return $response;
    }
  }
}

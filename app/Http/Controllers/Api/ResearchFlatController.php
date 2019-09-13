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

  public function index() {

    $filtered_flat = DB::table('services')
                 ->join('flats', 'services.flat_id', '=', 'flats.id')
                 ->get();

    if (\Request::ajax()) {

      foreach($_POST as $filterKey => $filterValue) {
        $filtered_flat = $filtered_flat->where($filterKey, '=', $filterValue);
      }

      $response =  response()->json($filtered_flat);

      return $response;
      //return view('search', compact($response));
    }
  }
}

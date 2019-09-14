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
<<<<<<< HEAD
                 ->where('visible', '=', "1")
=======
>>>>>>> rebase
                 ->get();

    if (\Request::ajax()) {

      foreach($_POST as $filterKey => $filterValue) {
          $flats = $flats->where($filterKey, '=', $filterValue);
      }

      // $output = '';
      // if (count($flats) > 0) {
      //   foreach ($flats as $key => $value) {
      //
      //     $output .= '
      //       <div class="col-md-9 appartamenti-filtrati">
      //         <div class="flat_box">
      //           <img src="https://dummyimage.com/100x100/fff/aaa" alt="">
      //             <h3 id = "flat_title">Titolo:'. $value->title .'</h3>
      //             <small id = "flat_address" data-lat ="'.$value->lat.'" data-lon ="'.$value->lon.'">Indirizzo:'.$value->address.'</small>
      //             <p id = "flat_description">Descrizione: '.$value->description.'</p>
      //             <small id = "flat_price">Prezzo: '.$value->price.'</small>
      //         </div>
      //       </div>
      //     ';
      //   }
      // }else{
      //   $output .= '
      //   <div class="col-md-6 offset-md-3">
      //     <h3 class="text-warning">Nessun risultato</h3>
      //   </div>
      //   ';
      // }



     $response =  response()->json($flats);

     return $response;
      //return view('search', compact($response));
    }
  }
}

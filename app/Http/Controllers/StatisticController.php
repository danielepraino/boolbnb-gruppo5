<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\FlatViews;
use App\Charts\MessageViews;
use App\Flat;
use Auth;
use DB;
use Carbon\Carbon;

class StatisticController extends Controller
{
  public function index() {

    $arr_chart_label = [];

    $userFlats = DB::table('users')
            ->join('flats', 'users.id', '=', 'flats.user_id')
            ->where('users.id', Auth::user()->id)
            ->get();

    $today = Carbon::today('l jS \\of F Y h:i:s A');
    for ($i=0; $i < 5; $i++) {
      array_push($arr_chart_label, $today->subDay()->toFormattedDateString());
    }

    //FlatViews chart
    $flatViews = new FlatViews;
    $flatViews->labels(array_reverse($arr_chart_label));
    foreach ($userFlats as $flats) {
        $flat = Flat::find($flats->id);
        $flatUniqueViews = views($flat)->unique()->count();
        $flatViews->dataset($flats->title, 'line', [$flatUniqueViews]);
    }
    $flatViews->options(['display', false]);
    $flatViews->height(250);
    $flatViews->loader(true);

    //MessageViews chart
    $messageViews = new MessageViews;
    $messageViews->labels(array_reverse($arr_chart_label));
    $messageViews->dataset('Messaggi ricevuti', 'bar', [1, 2, 2.5, 3, 4]);
    $messageViews->height(250);
    $messageViews->loader(true);

    return view('statistic', compact('flatViews', 'messageViews'));
  }
}

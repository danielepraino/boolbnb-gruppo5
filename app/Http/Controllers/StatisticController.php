<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\FlatViews;
use App\Charts\MessageViews;
use App\Flat;
use Auth;
use DB;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Support\Period;

class StatisticController extends Controller
{
  public function index() {

    $totalViews = 0;
    $totalMessages = 0;
    $arr_chart_dataset = [];
    $arr_chart_label = [];

    $userFlats = DB::table('users')
            ->join('flats', 'users.id', '=', 'flats.user_id')
            ->where('users.id', Auth::user()->id)
            ->get();

    $userMessages = DB::table('flats')
            ->join('messages', 'flats.id', '=', 'messages.flat_id')
            ->where('flats.user_id', Auth::user()->id)
            ->get();

    foreach ($userMessages as $message) {
      $totalMessages += 1;
    }

    $today = Carbon::today('l jS \\of F Y h:i:s A');
    for ($i=0; $i < 5; $i++) {
      array_push($arr_chart_label, $today->subDay()->toFormattedDateString());
    }

    //FlatViews chart
    $flatViews = new FlatViews;
    $flatViews->labels($arr_chart_label);
    foreach ($userFlats as $flats) {
        $flat = Flat::find($flats->id);
        $flatUniqueViews = views($flat)->unique()->count();

        //dd(views($flat)->unique()->count(Period::subDays(1)));

        $flatViews->dataset($flats->title, 'line', [$flatUniqueViews]);
        $totalViews += $flatUniqueViews;
    }
    $flatViews->options(['display', false]);
    $flatViews->height(250);
    $flatViews->loader(true);

    //MessageViews chart
    $messageViews = new MessageViews;
    $messageViews->labels($arr_chart_label);
    $messageViews->dataset('Messaggi ricevuti', 'bar', [1, 2, 2.5, 3, 4]);
    $messageViews->height(250);
    $messageViews->loader(true);



    return view('statistic', compact('flatViews', 'messageViews', 'totalViews', 'totalMessages'));
  }
}

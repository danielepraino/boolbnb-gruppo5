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
    $daysCount = 0;
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

    $today = Carbon::today();

    for ($i=0; $i < 5; $i++) {
      if ($i == 0) {
        array_push($arr_chart_label, $today->toFormattedDateString());
      } else {
        array_push($arr_chart_label, $today->subDay()->toFormattedDateString());
      }
    }

    //FlatViews chart
    $flatViews = new FlatViews;
    $flatViews->labels($arr_chart_label);
    foreach ($userFlats as $flats) {
        $flat = Flat::find($flats->id);
        $flatUniqueViews = views($flat)->remember(now()->subDays($daysCount))->unique()->count();
        array_push($arr_chart_dataset, $flatUniqueViews);
        $flatViews->dataset($flats->title, 'line', [$arr_chart_dataset]);
        $totalViews += $flatUniqueViews;
        $daysCount++;
    }
    //dd(views($flat)->remember(now()->subDays($daysCount))->unique()->count());

    $flatViews->options(['display', false]);
    $flatViews->height(250);
    $flatViews->loader(true);

//-------------------------------------------------------------------------------------------
    $arr_days = [];
    $arr_msg_by_day = [];

    $filteredMessages = DB::table('flats')
        ->join('messages', 'flats.id', '=', 'messages.flat_id')
        ->where('flats.user_id', Auth::user()->id)
        ->where('messages.created_at', '>', Carbon::today()->subDays(4))
        ->get();

    $msgsGroupedByDay = $filteredMessages
        ->sortBy('created_at')
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        })
        ->map(function ($countByDay) {
          return $countByDay->count();
        });

        $today1 = Carbon::today()->toDateString();
        for ($i = 0; $i < 5; $i++) {
          array_push($arr_days, Carbon::parse($today1)->format('Y-m-d'));
          $today1 = Carbon::parse($today1)->subDay()->toDateString();
        }



        foreach ($msgsGroupedByDay as $key => $value) {
          $arr_msg_by_day[$key] = $value;
        }

//dd($arr_msg_by_day);
$arr_test=[];

        foreach ($arr_days as $daysKey => $daysValue ) {
          foreach ($arr_msg_by_day as $msgKey => $msgValue) {
            array_push($arr_test, $msgKey);
            if ($daysValue == $msgKey) {
              //dd($msgValue);
              if(!in_array($daysValue, $arr_msg_by_day)) {
                $arr_msg_by_day[$daysValue] = $msgValue;
              }
              //$arr_msg_by_day[$daysValue] = $msgValue;
            // } else if (!in_array($daysValue, $arr_msg_by_day)) {
            //   $arr_msg_by_day[$daysValue] = 0;
            else {
              $arr_msg_by_day[$daysValue] = 0;
            }
            }

          }
        }
dd($arr_msg_by_day);






    //MessageViews chart
    $messageViews = new MessageViews;
    $messageViews->labels($arr_chart_label);
    $messageViews->dataset('Messaggi ricevuti', 'bar', array_reverse($arr_msg_by_day));
    $messageViews->height(250);
    $messageViews->loader(true);



    return view('statistic', compact('flatViews', 'messageViews', 'totalViews', 'totalMessages'));
  }
}

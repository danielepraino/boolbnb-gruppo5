<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\FlatViews;
use App\Charts\MessageViews;
use App\Flat;
use App\Message;
use Auth;
use DB;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Support\Period;

class StatisticController extends Controller
{
  public function index(Request $request) {

    $checkDays = 5;
    $arr_days = [];
    $arr_chart_label = [];
    $arr_line_dataset = [];
    $arr_bar_dataset = [];

    $currentFlatId = $request->flatId;
    $flat = Flat::find($currentFlatId);
    $messages = Message::where('messages.flat_id', $currentFlatId)->get();
    $totalMessages = count($messages);

    for ($j=0; $j < $checkDays; $j++) {
      $dateTime = Carbon::today()->subDay($j);
      $arr_days[$dateTime->format('Y-m-d')] = 0;
    }

    for ($i=0; $i < $checkDays; $i++) {
     if ($i == 0) {
       array_push($arr_chart_label, Carbon::today()->toFormattedDateString());
     } else {
       array_push($arr_chart_label, Carbon::today()->subDay($i)->toFormattedDateString());
     }

     $startDateTime = Carbon::today()->subDay($i);
     $endDateTime = Carbon::today()->subDay($i-1);
     $uniqueViews = views($flat)->period(Period::create($startDateTime, $endDateTime))->unique()->count();
     $totalUniqueViews = views($flat)->unique()->count();
     array_push($arr_line_dataset, $uniqueViews);

     foreach ($messages as $message) {
       $formattedCreatedAt = $message->created_at->format('Y-m-d');
       $messageNum = Message::where('messages.flat_id', $currentFlatId)->whereDate('messages.created_at', $message->created_at->format('Y-m-d'))->get();
       if (in_array($arr_days[$formattedCreatedAt], $arr_days)) {
         $arr_days[$formattedCreatedAt] = count($messageNum);
       }
     }
    }

    foreach ($arr_days as $key => $value) {
      array_push($arr_bar_dataset, $value);
    }

    //FlatViews chart
    $flatViews = new FlatViews;
    $flatViews->labels($arr_chart_label);
    $flatViews->dataset($flat->title, 'line', $arr_line_dataset)->backgroundColor(collect(['#2ecc71']));
    $flatViews->height(250);
    $flatViews->loader(true);

    //MessageViews chart
    $messageViews = new MessageViews;
    $messageViews->labels($arr_chart_label);
    $messageViews->dataset('Messaggi ricevuti', 'bar', $arr_bar_dataset)->backgroundColor(collect(['#3498db']));;
    $messageViews->height(250);
    $messageViews->loader(true);

    return view('statistic', compact('flat', 'flatViews', 'messageViews', 'totalUniqueViews', 'totalMessages'));
  }
}

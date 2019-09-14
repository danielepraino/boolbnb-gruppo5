<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\FlatViews;
use App\Charts\MessageViews;
use App\Flat;
<<<<<<< HEAD
use App\Message;
=======
>>>>>>> rebase
use Auth;
use DB;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Support\Period;

class StatisticController extends Controller
{
<<<<<<< HEAD
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
=======
  public function index() {

    $totalViews = 0;
    $statDays = 5;
    $arr_chart_label = [];
    $arr_chart_dataset = [];
    $flatId = $_GET['flatId'];

    $userFlat = DB::table('flats')
                ->where('flats.id', $flatId)
                ->get();

    $userMessages = DB::table('flats')
                 ->join('messages', 'flats.id', '=', 'messages.flat_id')
                 ->where('flats.id', $flatId)
                 ->get();

    $today = Carbon::today();
    for ($i=0; $i < $statDays; $i++) {
     if ($i == 0) {
       array_push($arr_chart_label, $today->toFormattedDateString());
     } else {
       array_push($arr_chart_label, $today->subDay()->toFormattedDateString());
     }

    }




    // foreach ($userFlat as $flats) {
    //   $flat = Flat::find($flats->id);
    //   $flatUniqueViews = views($flat)->remember(now()->subDays())->unique()->count();
    //   dd($flatUniqueViews);
    // }

// $flatUniqueViews = views($flat)->remember(now()->subDays(1))->unique()->count();


    array_push($arr_chart_dataset, $flatUniqueViews);
    $totalViews += $flatUniqueViews;
>>>>>>> rebase

    //FlatViews chart
    $flatViews = new FlatViews;
    $flatViews->labels($arr_chart_label);
<<<<<<< HEAD
    $flatViews->dataset($flat->title, 'line', $arr_line_dataset);
=======
    $flatViews->dataset($flats->title, 'line', $arr_chart_dataset);
    //dd(views($flat)->remember(now()->subDays($daysCount))->unique()->count());

>>>>>>> rebase
    $flatViews->options(['display', false]);
    $flatViews->height(250);
    $flatViews->loader(true);

<<<<<<< HEAD
    //MessageViews chart
    $messageViews = new MessageViews;
    $messageViews->labels($arr_chart_label);
    $messageViews->dataset('Messaggi ricevuti', 'bar', $arr_bar_dataset);
    $messageViews->height(250);
    $messageViews->loader(true);

    if (Auth::user()->id == $flat->user_id) {
      return view('statistic', compact('flat', 'flatViews', 'messageViews', 'totalUniqueViews', 'totalMessages'));
    } else {
      abort(403, 'Unauthorized action.');
    }
=======

    //MessageViews chart
    $messageViews = new MessageViews;
    $messageViews->labels($arr_chart_label);
    $messageViews->dataset('Messaggi ricevuti', 'bar', [1,2,3,4,5]);
    $messageViews->height(250);
    $messageViews->loader(true);

//     $totalViews = 0;
//     $totalMessages = 0;
//     $daysCount = 0;
//     $arr_chart_dataset = [];
//     $arr_chart_label = [];
//
//     $userFlats = DB::table('users')
//             ->join('flats', 'users.id', '=', 'flats.user_id')
//             ->where('users.id', Auth::user()->id)
//             ->get();
//
//     $userMessages = DB::table('flats')
//             ->join('messages', 'flats.id', '=', 'messages.flat_id')
//             ->where('flats.user_id', Auth::user()->id)
//             ->get();
//
//     foreach ($userMessages as $message) {
//       $totalMessages += 1;
//     }
//
//     $today = Carbon::today();
//
//     for ($i=0; $i < 5; $i++) {
//       if ($i == 0) {
//         array_push($arr_chart_label, $today->toFormattedDateString());
//       } else {
//         array_push($arr_chart_label, $today->subDay()->toFormattedDateString());
//       }
//     }
//
//     //FlatViews chart
//     $flatViews = new FlatViews;
//     $flatViews->labels($arr_chart_label);
//     foreach ($userFlats as $flats) {
//         $flat = Flat::find($flats->id);
//         $flatUniqueViews = views($flat)->remember(now()->subDays($daysCount))->unique()->count();
//         array_push($arr_chart_dataset, $flatUniqueViews);
//         $flatViews->dataset($flats->title, 'line', [$arr_chart_dataset]);
//         $totalViews += $flatUniqueViews;
//         $daysCount++;
//     }
//     //dd(views($flat)->remember(now()->subDays($daysCount))->unique()->count());
//
//     $flatViews->options(['display', false]);
//     $flatViews->height(250);
//     $flatViews->loader(true);
//
// //-------------------------------------------------------------------------------------------
//     $arr_days = [];
//     $arr_msg_by_day = [];
//
//     $filteredMessages = DB::table('flats')
//         ->join('messages', 'flats.id', '=', 'messages.flat_id')
//         ->where('flats.user_id', Auth::user()->id)
//         ->where('messages.created_at', '>', Carbon::today()->subDays(4))
//         ->get();
//
//     $msgsGroupedByDay = $filteredMessages
//         ->sortBy('created_at')
//         ->groupBy(function($date) {
//             return Carbon::parse($date->created_at)->format('Y-m-d');
//         })
//         ->map(function ($countByDay) {
//           return $countByDay->count();
//         });
//
//         $today1 = Carbon::today()->toDateString();
//         for ($i = 0; $i < 5; $i++) {
//           array_push($arr_days, Carbon::parse($today1)->format('Y-m-d'));
//           $today1 = Carbon::parse($today1)->subDay()->toDateString();
//         }
//
//
//
//         foreach ($msgsGroupedByDay as $key => $value) {
//           $arr_msg_by_day[$key] = $value;
//         }
//
// //dd($arr_msg_by_day);
// $arr_test=[];
//
//         foreach ($arr_days as $daysKey => $daysValue ) {
//           foreach ($arr_msg_by_day as $msgKey => $msgValue) {
//             array_push($arr_test, $msgKey);
//             if ($daysValue == $msgKey) {
//               //dd($msgValue);
//               if(!in_array($daysValue, $arr_msg_by_day)) {
//                 $arr_msg_by_day[$daysValue] = $msgValue;
//               }
//               //$arr_msg_by_day[$daysValue] = $msgValue;
//             // } else if (!in_array($daysValue, $arr_msg_by_day)) {
//             //   $arr_msg_by_day[$daysValue] = 0;
//             else {
//               $arr_msg_by_day[$daysValue] = 0;
//             }
//             }
//
//           }
//         }
// //dd($arr_msg_by_day);
//
//
//
//
//
//
//     //MessageViews chart
//     $messageViews = new MessageViews;
//     $messageViews->labels($arr_chart_label);
//     $messageViews->dataset('Messaggi ricevuti', 'bar', array_reverse($arr_msg_by_day));
//     $messageViews->height(250);
//     $messageViews->loader(true);



    return view('statistic', compact('flat', 'flatViews', 'messageViews', 'totalViews'));
>>>>>>> rebase
  }
}

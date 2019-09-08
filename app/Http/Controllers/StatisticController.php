<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\FlatViews;
use App\Charts\MessageViews;

class StatisticController extends Controller
{
  public function index() {
    $flatViews = new FlatViews;
    $flatViews->labels(['One', 'Two', 'Three', 'Four']);
    $flatViews->dataset('Visualizzazioni', 'line', [1, 2, 2.5, 3, 4]);
    $flatViews->height(250);
    $flatViews->loader(true);

    $messageViews = new MessageViews;
    $messageViews->labels(['One', 'Two', 'Three', 'Four', 'Five']);
    $messageViews->dataset('Messaggi ricevuti', 'bar', [1, 2, 2.5, 3, 4]);
    $messageViews->height(250);
    $messageViews->loader(true);

    return view('statistic', compact('flatViews', 'messageViews'));
  }
}

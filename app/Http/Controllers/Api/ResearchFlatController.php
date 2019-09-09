<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Flat;
use App\service;

class ResearchFlatController extends Controller
{
    public function index(){
      return response()->json(Flat::all());
    }

    public function wifi_service(){
      return response()->json(Service::where('wifi', '1')->get());
    }
    public function parking_service(){
      return response()->json(Service::where('parking', '1')->get());
    }
    public function pool_service(){
      return response()->json(Service::where('pool', '1')->get());
    }
    public function concierge_service(){
      return response()->json(Service::where('concierge', '1')->get());
    }
    public function sauna_service(){
      return response()->json(Service::where('sauna', '1')->get());
    }
    public function sea_view_service(){
      return response()->json(Service::where('sea_view', '1')->get());
    }
}

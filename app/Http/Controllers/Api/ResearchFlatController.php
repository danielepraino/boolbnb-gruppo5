<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Flat;

class ResearchFlatController extends Controller
{
    public function index(){
      return response()->json(Flat::all());
    }
}

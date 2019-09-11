<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SearchController extends Controller
{
    public function index(){
      $view = View::make('search');

      if(\Request::ajax()) {
        $sections = $view->renderSections(); // returns an associative array of 'content', 'head' and 'footer'
        return $sections['content']; // this will only return whats in the content section
      }
      
      return $view;
    }
}

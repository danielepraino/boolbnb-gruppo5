<?php

namespace App\Http\Controllers;

use App\Sponsorship;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Auth;
use App\Flat;
use Carbon\Carbon;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      return view('sponsorship.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $gateway = new Gateway([
          'environment' => config('services.braintree.environment'),
          'merchantId' => config('services.braintree.merchantId'),
          'publicKey' => config('services.braintree.publicKey'),
          'privateKey' => config('services.braintree.privateKey')
      ]);

      $token = $gateway->ClientToken()->generate();

      $flatId = $request->flatId;

      $flat = Flat::where('flats.id', $flatId)->get();

      foreach ($flat as $flatValue) {
        if (Auth::user()->id == $flatValue->user_id) {
          return view('sponsorship.create', [
            'token' => $token,
            'flatValue' => $flatValue
          ]);
        } else {
          abort(403, 'Unauthorized action.');
        }
      }

<<<<<<< HEAD
=======

>>>>>>> rebase
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function show(sponsorship $sponsorship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function edit(sponsorship $sponsorship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sponsorship $sponsorship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function destroy(sponsorship $sponsorship)
    {
        //
    }
}

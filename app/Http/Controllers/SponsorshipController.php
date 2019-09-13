<?php

namespace App\Http\Controllers;

use App\Sponsorship;
use Illuminate\Http\Request;
use Braintree\Gateway;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $gateway = new Gateway([
          'environment' => config('services.braintree.environment'),
          'merchantId' => config('services.braintree.merchantId'),
          'publicKey' => config('services.braintree.publicKey'),
          'privateKey' => config('services.braintree.privateKey')
      ]);

      $token = $gateway->ClientToken()->generate();

      return view('sponsorship', [
        'token' => $token
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

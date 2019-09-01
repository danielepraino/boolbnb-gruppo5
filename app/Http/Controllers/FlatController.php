<?php

namespace App\Http\Controllers;

use App\flat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $flats = flat::orderBy('id', 'asc')->get();
      return view('flats.index', compact('flats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        "title" => "required|max:255",
        // "room" => "required|max:255",
        // "bed" => "required|max:255",
        // "bathroom" => "required|max:255",
        // "sm" => "required|max:255",
        // "address" => "required|max:255",
        // "image" => "nullable|max:255",
        // "visible" => "required|max:255",
        // "lon" => "required|max:255",
        // "lat" => "required|max:255",
        // "price" => "required|max:255",
        // "user_id" => "required|max:255",
      ]);

      $data = $request->all();
      $image = Storage::put('flats_images', $data['image']);
      $newFlat = new flat();
      $newFlat->fill($data);
      $newFlat->image = $image;
      $newFlat->save();

      return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show(flat $flat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit(flat $flat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, flat $flat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy(flat $flat)
    {
        //
    }
}

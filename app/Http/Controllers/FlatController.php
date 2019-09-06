<?php

namespace App\Http\Controllers;

use App\Flat;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FlatController extends Controller
{
    public function __construct() {
      $this->middleware('auth')->except(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $flat = Flat::orderBy('id', 'asc')->get();
      return view('flats.index', compact('flat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('flats.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      dd($request->all());

      $validatedData = $request->validate([
        "title" => "required|max:255",
        // "room" => "required|max:255",
        // "bed" => "required|max:255",
        // "bathroom" => "required|max:255",
        // "sm" => "required|max:255",
        // "address" => "required|max:255",
        // "image" => "nullable|max:255",
        // "visible" => "required|max:255",
        // "price" => "required|max:255",
      ]);

      $data = $request->all();

      $image = Storage::put('flats_images', $data['image']);
      $newFlat = new Flat();
      $newFlat->fill($data);
      $newFlat->image = $image;
      $newFlat->save();

      return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show($flatId)
    {
      $flat = Flat::find($flatId);

      if (empty($flat)) {
        abort(404);
      }

      return view('flats.show', compact('flat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit($flatId)
    {
      $flat = Flat::find($flatId);

      return view('flats.edit', compact('flat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $flatId)
    {
      $validatedData = $request->validate([
        "title" => "required|max:255",

      ]);

      $data = $request->all();
      $newFlat = Flat::find($flatId);
      $newFlat->update($data);

      return redirect()->route('flats.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy($flatId)
    {
      $flat = Flat::find($flatId)->delete();

      return redirect()->route('flats.index');
    }
}

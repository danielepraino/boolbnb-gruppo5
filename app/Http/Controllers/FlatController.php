<?php

namespace App\Http\Controllers;

use Auth;
use App\Flat;
use App\Service;
use App\Sponsorship;
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

      $validatedData = $request->validate([
        "title" => "required|max:255",
        "description" => "required|max:255",
        "room" => "required|regex:/^[0-9]*$/|max:3",
        "bed" => "required|regex:/^[0-9]*$/|max:3",
        "bathroom" => "required|regex:/^[0-9]*$/|max:3",
        "sm" => "required|regex:/^[0-9]*$/|max:5",
        "address" => "required|max:255",
        "image" => "nullable|max:2550",
        "price" => "required|regex:/^[0-9]*$/|max:5",
      ]);

      $data = $request->all();

      $image = Storage::put('flats_images', $data['image']);
      $newFlat = new Flat();
      $newFlat->fill($data);
      $newFlat->image = $image;

      if (isset($_POST['visible'])) {
        $newFlat->visible = 1;
      } else {
        $newFlat->visible = 0;
      }

      $newFlat->save();

      $newService = new Service();
      $newService->fill($data);

      $arr_services = ['wifi', 'parking', 'pool', 'concierge', 'sauna', 'sea_view'];

      if (isset($_POST['services'])) {
        foreach ($_POST['services'] as $key => $value) {
          $newService->$key = 1;
        }
      } else {
        foreach ($arr_services as $service) {
          $newService->$service = 0;
        }

        $_POST['services'] = [
          'wifi' => 0
        ];
      }

      $newService->flat_id = $newFlat->id;
      $newService->save();

      if (Auth::user()->id == $newFlat->user_id) {
        return redirect()->route('home');
      } else {
        abort(403, 'Unauthorized action.');
      }
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
      views($flat)->record();
      $services = Service::where('flat_id', $flatId)->first();

      if (empty($flat)) {
        abort(404);
      }

      return view('flats.show', compact('flat', 'services'));
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
      $services = Service::where('flat_id', $flatId)->first();

      return view('flats.edit', compact('flat', 'services'));
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
        "description" => "required|max:255",
        "room" => "required|regex:/^[0-9]*$/|max:3",
        "bed" => "required|regex:/^[0-9]*$/|max:3",
        "bathroom" => "required|regex:/^[0-9]*$/|max:3",
        "sm" => "required|regex:/^[0-9]*$/|max:5",
        "address" => "required|max:255",
        "image" => "nullable|max:2550",
        "price" => "required|regex:/^[0-9]*$/|max:5",
      ]);

      $data = $request->all();
      $newFlat = Flat::find($flatId);
      $newFlat->update($data);

      $newService = Service::where('flat_id', $flatId)->first();

      $arr_services = ['wifi', 'parking', 'pool', 'concierge', 'sauna', 'sea_view'];

      if (isset($_POST['services'])) {
        foreach ($arr_services as $service) {
          $newService->$service = 0;
        }
        foreach ($_POST['services'] as $key => $value) {
          $newService->$key = 1;
        }
      } else {
        foreach ($arr_services as $service) {
          $newService->$service = 0;
        }

        $_POST['services'] = [
          'wifi' => 0
        ];
      }

      $newService->update($data);

      if (Auth::user()->id == $newFlat->user_id) {
        return redirect()->route('flats.index');
      } else {
        abort(403, 'Unauthorized action.');
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy($flatId)
    {
      $newFlat = Flat::find($flatId);
      $flat = Flat::find($flatId)->delete();


      if (Auth::user()->id == $newFlat->user_id) {
        return redirect()->route('flats.index');
      } else {
        abort(403, 'Unauthorized action.');
      }
    }
}

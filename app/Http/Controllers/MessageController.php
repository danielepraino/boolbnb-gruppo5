<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Auth;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    ;
      return view('messages.received-messages');
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
      //validazione dati
      $validatedData = $request->validate([
        "sender" => "required|max:255|regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/",
        "subject" => "required|max:50",
        "message" => "required|max:255"
      ]);

      $data = $request->all();
      $newMessage = new Message();
      $newMessage->fill($data);
      $newMessage->save();
      return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($messageId)
    {
      $message = Message::find($messageId);


      if (empty($message)) {
        abort(404);
      }

      return view('messages/show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($messageId)
    {
      $message = Message::find($messageId)->delete();;



      if (Auth::user()) {
          return redirect('/messages');
      } else {
        abort(403, 'Unauthorized action.');
      }
    }
}

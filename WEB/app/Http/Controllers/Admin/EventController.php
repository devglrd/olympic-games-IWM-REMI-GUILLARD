<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    const PATH_VIEW = 'admin.entities.cms.events.';

    public function index()
    {
        try{


        $response = Http::get('http://127.0.0.1:3000/api/events');
        $data = json_decode($response->body())->data;

        return view(self::PATH_VIEW . 'index')->with([
            "sports" => $data
        ]);

        }catch (\Exception $exception){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function create()
    {

        try {


        $response = Http::get('http://127.0.0.1:3000/api/sports');
        $sports = json_decode($response->body())->data;
        $response = Http::get('http://127.0.0.1:3000/api/category');
        $events = json_decode($response->body())->data;

        return view(self::PATH_VIEW . 'create')->with([
            'sports' => $sports,
            'events' => $events
        ]);

        }catch (\Exception $exception){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"     => "required",
            "time"     => "required",
            "startAt"  => "required",
            "location" => "required",
            "content"  => "required",
            "sport"    => "required",
            "event"    => "required",
        ]);
        $token = $request->token;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://127.0.0.1:3000/api/events', [
            "name"     => $request->get('name'),
            "time"     => $request->get('time'),
            "startAt"  => $request->get('startAt'),
            "content"  => $request->get('content'),
            "location" => $request->get('location'),
            "sport" => $request->get('sport'),
            "event" => $request->get('event'),
        ]);
        if (isset(json_decode($response->body())->data)) {
            $data = json_decode($response->body())->data;

            return redirect()->action([self::class, 'index'])->with('success', 'Event  sucessfully saved');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        try {


        $response = Http::get('http://127.0.0.1:3000/api/events/' . $id);
        $event = json_decode($response->body())->data;

        return view(self::PATH_VIEW . 'edit')->with([
            'event' => $event
        ]);

        }catch (\Exception $exception){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            "name"     => "required",
            "location" => "required",
            "startAt"  => "required",
            "content"  => "required",
        ]);
        $token = $request->token;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('http://127.0.0.1:3000/api/events/' . $id, [
            "name"     => $request->get('name'),
            "location" => $request->get('location'),
            "startAt"  => $request->get('startAt'),
            "content"  => $request->get('content'),
        ]);
        if (isset(json_decode($response->body())->data)) {
            $data = json_decode($response->body())->data;

            return redirect()->action([self::class, 'index'])->with('success', 'Event  sucessfully saved');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function delete(Request $request, $id)
    {
        try {
            $token = $request->token;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->delete('http://127.0.0.1:3000/api/events/' . $id, [], []);
        } catch (\Exception $e) {

        }

        return redirect()->action([EventController::class, 'index']);

    }
}

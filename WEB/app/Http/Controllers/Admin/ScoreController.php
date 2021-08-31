<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ScoreController extends Controller
{
    const PATH_VIEW = 'admin.entities.cms.scores.';

    public function index()
    {
        $response = Http::get('http://127.0.0.1:3000/api/scores/admin');
        $data = json_decode($response->body())->data;

        return view(self::PATH_VIEW . 'index')->with([
            "scores" => $data
        ]);
    }


    public function create()
    {

        $response = Http::get('http://127.0.0.1:3000/api/events/');
        $events = json_decode($response->body())->data;

        return view(self::PATH_VIEW . 'create')->with([
            'events' => $events
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            "type"     => "required",
            "unit" => "required",
            "score"  => "required",
            "event"  => "required",
        ]);
        $token = $request->token;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://127.0.0.1:3000/api/scores/admin', [
            "type"     => $request->get('type'),
            "unit" => $request->get('unit'),
            "score"  => $request->get('score'),
            "event"  => $request->get('event'),
            'admin' => true
        ]);
        if (isset(json_decode($response->body())->data)) {
            $data = json_decode($response->body())->data;

            return redirect()->action([self::class, 'index'])->with('success', 'Event enregistré.');
        }

        return redirect()->back()->with('error', 'Un problème est survenue');
    }

    public function edit($id)
    {
        $response = Http::get('http://127.0.0.1:3000/api/scores/' . $id);
        $score = json_decode($response->body())->data;

        $response = Http::get('http://127.0.0.1:3000/api/events/');
        $events = json_decode($response->body())->data;

        return view(self::PATH_VIEW . 'edit')->with([
            'score' => $score,
            'events' => $events
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            "type"     => "required",
            "unit" => "required",
            "score"  => "required",
            "event"  => "required",
        ]);
        $token = $request->token;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('http://127.0.0.1:3000/api/scores/' . $id, [
            "type"     => $request->get('type'),
            "unit" => $request->get('unit'),
            "score"  => $request->get('score'),
            "event"  => $request->get('event'),
            'admin' => true
        ]);
        if (isset(json_decode($response->body())->data)) {
            $data = json_decode($response->body())->data;

            return redirect()->action([self::class, 'index'])->with('success', 'Score successfully updated.');
        }

        return redirect()->back()->with('error', 'Un problème est survenue');
    }

    public function delete(Request $request, $id)
    {
        try {
            $token = $request->token;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->delete('http://127.0.0.1:3000/api/scores/' . $id, [], []);
        } catch (\Exception $e) {

        }

        return redirect()->action([ScoreController::class, 'index']);

    }
}

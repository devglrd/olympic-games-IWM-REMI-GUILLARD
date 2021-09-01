<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SportController extends Controller
{
    const PATH_VIEW = 'admin.entities.cms.sports.';

    public function index()
    {
        try {


            $response = Http::get('http://127.0.0.1:3000/api/sports');
            $data = json_decode($response->body())->data;

            return view(self::PATH_VIEW . 'index')->with([
                "sports" => $data
            ]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function create()
    {
        return view(self::PATH_VIEW . 'create')->with([
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'content' => 'required',
        ]);
        $token = $request->token;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://127.0.0.1:3000/api/sports', [
            "name"    => $request->get('name'),
            "content" => $request->get('content'),
        ]);

        if (isset(json_decode($response->body())->data)) {
            $data = json_decode($response->body())->data;

            return redirect()->action([self::class, 'index'])->with('success', 'Sport  sucessfully saved');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        try {


            $response = Http::get('http://127.0.0.1:3000/api/sports/' . $id);
            $sport = json_decode($response->body())->data;

            return view(self::PATH_VIEW . 'edit')->with([
                'sport' => $sport
            ]);

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required',
            'content' => 'required',
        ]);
        $token = $request->token;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('http://127.0.0.1:3000/api/sports/' . $id, [
            "name"    => $request->get('name'),
            "content" => $request->get('content'),
        ]);


        if (isset(json_decode($response->body())->data)) {
            $data = json_decode($response->body())->data;

            return redirect()->action([self::class, 'index'])->with('success', 'Sport modifié.');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function delete(Request $request, $id)
    {
        try {
            $token = $request->token;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->delete('http://127.0.0.1:3000/api/sports/' . $id, [], []);
        } catch (\Exception $e) {

        }

        return redirect()->action([SportController::class, 'index']);

    }
}

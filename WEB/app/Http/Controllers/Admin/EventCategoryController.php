<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventCategoryController extends Controller
{
    const PATH_VIEW = 'admin.entities.cms.category.';

    public function index()
    {
        try {

            $response = Http::get('http://127.0.0.1:3000/api/category');
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
        try {


        $response = Http::get('http://127.0.0.1:3000/api/sports');
        $sports = json_decode($response->body())->data;

        return view(self::PATH_VIEW . 'create')->with([
            'sports' => $sports
        ]);
        }catch (\Exception $exception){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'name'  => 'required',
            'type'  => 'required',
            'sport' => 'required',
        ]);
        $token = $request->token;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://127.0.0.1:3000/api/category', [
            "name"  => $request->get('name'),
            "type"  => $request->get('type'),
            "sport" => $request->get('sport'),
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


        $response = Http::get('http://127.0.0.1:3000/api/category/' . $id);
        $cat = json_decode($response->body())->data;

        return view(self::PATH_VIEW . 'edit')->with([
            'cat' => $cat
        ]);
        }catch (\Exception $exception){
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);
        $token = $request->token;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('http://127.0.0.1:3000/api/category/' . $id, [
            "name" => $request->get('name'),
            "type" => $request->get('type'),
        ]);

        if (isset(json_decode($response->body())->data)) {
            $data = json_decode($response->body())->data;

            return redirect()->action([self::class, 'index'])->with('success', 'Sport  sucessfully saved');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function delete(Request $request, $id)
    {
        try {
            $token = $request->token;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->delete('http://127.0.0.1:3000/api/category/' . $id, [], []);
        } catch (\Exception $e) {

        }

        return redirect()->action([EventCategoryController::class, 'index']);

    }
}

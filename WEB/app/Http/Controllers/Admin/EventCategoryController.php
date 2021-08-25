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
        $response = Http::get('http://127.0.0.1:3000/api/category');
        $data = json_decode($response->body())->data;

        return view(self::PATH_VIEW . 'index')->with([
            "sports" => $data
        ]);
    }


    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete(Request  $request, $id)
    {
        try {
            $token = $request->token;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '. $token,
            ])->delete('http://127.0.0.1:3000/api/category/' . $id, [],[]);
        } catch (\Exception $e) {

        }

        return redirect()->action([EventCategoryController::class, 'index']);

    }
}
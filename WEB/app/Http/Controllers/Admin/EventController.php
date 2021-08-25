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
        $response = Http::get('http://127.0.0.1:3000/api/events');
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

    public function delete()
    {

    }
}

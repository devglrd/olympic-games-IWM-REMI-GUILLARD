<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class StaticsController extends Controller
{
    const PATH_VIEW = 'app.entities.statics.';
    const AUTH_VIEW = 'app.entities.auth.';

    const CONTROLLER = 'App\StaticsController@';

    public function home(Request $request)
    {


        $response = Http::get('http://127.0.0.1:3000/api/sports');
        $data =json_decode($response->body())->data;
        return view(self::PATH_VIEW . 'home')->with([
            "sports" => $data
        ]);
    }


    public function login(Request $request)
    {

        return view(self::AUTH_VIEW . 'login')->with([
        ]);
    }

}

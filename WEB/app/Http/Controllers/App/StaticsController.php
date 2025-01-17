<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Admin\AdminController;
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

    public function store(Request $request)
    {

        $request->validate([
            "sport" => "required",
            "event" => "required",
            "type"  => "required",
            "score" => "required",
            "unit"  => "required",
            "email" => "required",
        ]);


        $response = Http::post('http://127.0.0.1:3000/api/scores', [
            "type"  => $request->get('type'),
            "event" => $request->get('event'),
            "score" => $request->get('score'),
            "unit"  => $request->get('unit'),
            "email" => $request->get('email'),
        ]);
        if (!isset(json_decode($response->body())->data) && isset(json_decode($response->body())->message)) {
            return redirect()->back()->with('error', "Event is not today");
        }
        if (isset(json_decode($response->body())->data)) {
            $data = json_decode($response->body())->data;

            return redirect()->back()->with('success', 'Score sucessfully saved');
        }

        return redirect()->back()->with('error', 'Something went wrong');

    }


    public
    function home(Request $request)
    {
        try {
            $response = Http::get('http://127.0.0.1:3000/api/sports');
            $data = json_decode($response->body())->data;

            $response = Http::get('http://127.0.0.1:3000/api/sports');
            $form = json_decode($response->body())->data;

            return view(self::PATH_VIEW . 'home')->with([
                "sports" => $data,
                "forms"  => $form
            ]);
        } catch (\Exception $exception) {
            abort(500);
        }
    }


    public
    function loginView(Request $request)
    {

        return view(self::AUTH_VIEW . 'login')->with([
        ]);
    }


    public
    function login(Request $request)
    {
        try {


            $response = Http::post('http://127.0.0.1:3000/api/auth/login', [
                "email"    => $request->get('email'),
                "password" => $request->get('password'),
            ]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
        if (isset(json_decode($response->body())->accessToken)) {
            $data = json_decode($response->body());
            session()->put('auth', true);
            session()->put('token', $data->accessToken);
            session()->put('user', json_encode($data->user));

            return redirect()->action([AdminController::class, 'dashboard']);
            //return redirect()->back()->with('success', 'Votre score à bien été  sucessfully saved');
        }

        return redirect()->back()->with('error', 'Wrong credentials');


    }

}

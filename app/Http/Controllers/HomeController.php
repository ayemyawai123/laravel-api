<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $client = new Client();
        $res = $client->request('POST', 'http:/127.0.0.1:8000/api/students', [
            'form_params' => [
                'name' => 'test_id',
                'course' => 'test_secret',
            ]
        ]);

        $result= $res->getBody();
        dd($result);
    }
}

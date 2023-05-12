<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->Middleware('auth');
    // }

    public function index()
    {
        return view('backend.index');
    }

    public function widget()
    {
        $client = new Client();
        $request = $client->get('https://api.publicapis.org/entries');

        if($request->getStatusCode()== 200){

            $response = json_decode($request->getBody());

            // dd($response);
            $response = $response->entries;
        }

        return view('backend.widget',compact('response'));
    }
}

<?php

namespace App\Http\Controllers;

use Alhoqbani\SmsaWebService\Smsa;
use Illuminate\Support\Facades\Cache;

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
     * @param Smsa $smsa
     * @return \Illuminate\Http\Response
     */
    public function index(Smsa $smsa)
    {

        // We fetch all cities served by Smsa to use in all vue components.
        // We cache the results for 1 weak.
        $cities = Cache::remember('smsa.cities', 60 * 24 * 7, function () use ($smsa) {
            $result = $smsa->cities();

            return $result->data;
        });

        // We fetch all Smsa retails to use in all vue components.
        // We cache the results for 1 weak.
        $retails = Cache::remember('smsa.retails', 60 * 24 * 7, function () use ($smsa) {
            $result = $smsa->retails();

            return $result->data;
        });

        return view('home', compact('cities', 'retails'));
    }
}

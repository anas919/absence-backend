<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activitie;
use App\Propertie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login'/*, [
            'matches'=> array_slice( $matches , 0, 6),
        ]*/);
    }

    public function admin()
    {
        /*$user = \Auth::user();
        if( !$user || ( $user && $user->role != "ADMIN" ) )
            return redirect()->route('login');*/
        return view('home');
    }
    public function gigs(Request $request)
    {
        return response()
            ->json(['name' => 'Abigail', 'state' => 'CA', 'user' => $request->user()]);
    }
}

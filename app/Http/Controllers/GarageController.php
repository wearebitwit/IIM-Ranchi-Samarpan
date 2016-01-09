<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GarageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->has('user')) {
         		return view('dashboard.home');
        }
        
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
      	$username = $request->input('username');
      	$password = $request->input('password');

      	if(env('username') === $username && env('password') === $password){
      		$request->session()->put('user', 'loggedIn');
      		return ['error' => false];
      	}else {
      		return ['error' => true];
      	}	
    }

    /**
     * Logs out a user and destroy session
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    
    public function logout(Request $request)
    {
      	$request->session()->flush();
      	return redirect('/');
    }

}

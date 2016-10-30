<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Event;
use Illuminate\Support\Facades\DB;

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
            $data = Event::select(DB::raw('name,count(name) as count'))->groupBy('name')->get();
         		return view('dashboard.home',['data' => $data]);
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

      	if(config('app.admin_user') == $username && config('app.admin_pass') == $password){
      		$request->session()->put('user', 'loggedIn');
      		return ['error' => false];
      	}else {
      		return ['error' => true];
      	}
    }

    /**
     * Display the specified registrations for a event.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $name)
    {
      if ($request->session()->has('user')) {
          $signups =  Event::where('name',$name)->get()->toArray();
          $keys = array_keys(json_decode($signups[0]['data'], true));
          return view('dashboard.list', ['list' => $signups,'keys' => $keys]);
      }

      return view('auth.login');
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

    /**
     * redirects with a set of params
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function redirectWithParams(Request $request, $url, $params)
    {
    	$appendParams = [];
    	foreach ($params as $param) {
    		if ($request[$params]) {
    			$appendParams.push($request[$params]);
    		}
    	}

    	return redirect($url + '?' + $appendParams.join('&'));
    }

}

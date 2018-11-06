<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\LoginLogs;
use Carbon\Carbon;

class LogController extends Controller
{
    public function index(Request $request){
        Auth::user()->id;
        // Missing IP Addr
        LoginLogs::insert(['login_time'=>Carbon::now(),'user_id'=>Auth::user()->id,'ip_address'=>$request->ip()]);
        return redirect('/home');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Students;
use Hash;
use App\Http\Requests;
use App\Http\Requests\ForgotPasswordRequest;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function forgot(){
        return view('forgot');
    }
    public function forgotCheck(ForgotPasswordRequest $request){ 
        if(!Hash::check($request->old_password, Auth::user()->password)){
            return redirect('/home')->withErrors('Password salah');
        }
        $pass = ['password'=>Hash::make($request->password)];
        User::where(['id'=>Auth::user()->id])->update($pass);
        return redirect('/home')->withErrors('Berhasil');
    }
}

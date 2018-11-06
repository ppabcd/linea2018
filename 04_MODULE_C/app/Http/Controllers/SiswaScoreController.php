<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assess;

class SiswaScoreController extends Controller
{
    public function index(){
        $data['assess'] = Assess::where(['id_student'=>\Auth::user()->id])->get();
        return view('score.home',$data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classrooms;

class ClassController extends Controller
{
    public function index(){
        dd(Classrooms::get());
    }
    public function add(){
        return view('classroom.add');
    }
    public function addSubmit(Request $request){
        $c = Classrooms::where('name',$request->name)->first();
        if($c){
            return redirect('/classroom/add?error=Classroom sudah tersedia');
        }
        Classrooms::insert($request->except(['_token']));
        return redirect('/classroom?success=berhasil');
    }
}

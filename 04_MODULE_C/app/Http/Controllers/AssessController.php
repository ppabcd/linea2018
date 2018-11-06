<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exams;
use App\Models\Students;
use App\Models\MultipleChoiceQuestions;
use App\Models\EssayQuestions;
use App\Models\StudentMultipleChoiceAnswers;
use App\Models\Assess;
use \Auth;

class AssessController extends Controller
{
    public function index(){
        $data['exams'] = Exams::where('created_by',Auth::user()->id)->get();
        return view('assess.home',$data);
    }
    public function show($id){
        $data['exam'] = Exams::where(['created_by'=>Auth::user()->id,'id'=>$id])->first();
        return view('assess.students',$data);
    }
    public function student($id,$sid){
        $data['multiple'] = MultipleChoiceQuestions::where(['exam_id'=>$id])->get();
        $data['essay'] = EssayQuestions::where(['exam_id'=>$id])->get();

        $data['exam'] = Exams::where(['created_by'=>Auth::user()->id,'id'=>$id])->first();
        $data['student'] = Students::where(['id'=>$sid])->first();
        return view('assess.score',$data);
    }
    public function score(Request $request, $id,$sid){
        $data['exam'] = Exams::where(['created_by'=>Auth::user()->id,'id'=>$id])->first();
        $data['student'] = Students::where(['id'=>$sid])->first();

        if($request->sum_essay > $request->limit){
            return redirect('/assess/'.$id.'/'.$sid.'/?error=Nilai essay melebihi limit');
        }
        $check = Assess::where(['id_exam'=>$id,'id_student'=>$sid,'created_by'=>\Auth::user()->id]);
        if($check->first()){
            $check->update(['score'=>($request->sum_essay+$request->sum_pg)]);
        }
        else {
            Assess::insert(['id_exam'=>$id,'id_student'=>$sid,'score'=>($request->sum_essay+$request->sum_pg),'created_by'=>\Auth::user()->id]);
        }
        return redirect('/assess/'.$id.'?berhasil');
    }
}

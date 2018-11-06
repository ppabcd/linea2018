<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exams;
use App\Models\HistoryStudentMultipleChoiceAnswers;
use App\Models\HistoryStudentEssayAnswers;
use App\Models\StudentMultipleChoiceAnswers;
use App\Models\StudentEssayAnswers;

class SiswaExamController extends Controller
{
    public function index(){
        $data['exams'] = Exams::where('classroom_id','=',\Auth::user()->student->classroom_id)->get();
        return view('answer.home',$data);
    }
    public function show($id){
        $data['exams'] = Exams::where(['classroom_id'=>\Auth::user()->student->classroom_id,'id'=>$id])->firstOrFail();
        return view('answer.show',$data);
    }
    public function showSubmit(Request $request,$id){
        $data['exams'] = Exams::where(['classroom_id'=>\Auth::user()->student->classroom_id,'id'=>$id])->firstOrFail();
        // if($data['exams']->multiple->count())
        // dd($data['exams']->multiple->count());
        // dd($request->all());
        $req = $request->except(['_token']);
        $reqK = array_keys($req);
        foreach($req as $key => $val){
            $temp = explode('s-',$key);
            if(count($temp)>1){
                $val = explode("j",$val)[1];
                $check = StudentMultipleChoiceAnswers::where(['question_id'=>$temp[1],'student_id'=>\Auth::user()->student->id]);
                if($check->first()){
                    $check->update(['option_id'=>$val]);
                    HistoryStudentMultipleChoiceAnswers::where(['question_id'=>$temp[1],'student_id'=>\Auth::user()->student->id])
                        ->update(['option_id'=>$val]);
                }
                else {
                    HistoryStudentMultipleChoiceAnswers::insert(['question_id'=>$temp[1],'option_id'=>$val,'student_id'=>\Auth::user()->student->id]);
                    StudentMultipleChoiceAnswers::insert(['question_id'=>$temp[1],'option_id'=>$val,'student_id'=>\Auth::user()->student->id]);
                }
            }
            $temp = null;
            $check = null;
            $temp = explode('essay-',$key);
            if(count($temp)>1){
                $check = StudentEssayAnswers::where(['student_id'=>\Auth::user()->student->id,'essay_question_id'=>$temp[1]]);
                if($check->first()){
                    $check->update(['answer'=>$val]);
                    HistoryStudentEssayAnswers::where(['student_id'=>\Auth::user()->student->id,'essay_question_id'=>$temp[1]])
                        ->update(['answer'=>$val]);
                }
                else {
                    HistoryStudentEssayAnswers::insert(['answer'=>$val,'student_id'=>\Auth::user()->student->id,'essay_question_id'=>$temp[1]]);
                    StudentEssayAnswers::insert(['answer'=>$val,'student_id'=>\Auth::user()->student->id,'essay_question_id'=>$temp[1]]);
                }
            }
        }
        return redirect('/answer?success')->withErrors("Berhasil mengisi data");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classrooms;
use App\Models\Exams;
use App\Models\MultipleChoiceQuestions;
use App\Models\MultipleChoiceOptions;
use App\Models\EssayQuestions;
use App\Models\EssayKeywords;
use Auth;
use App\Http\Requests\ExamAddRequest;
use App\Http\Requests\ExamEssayRequest;
use App\Http\Requests\ExamMultipleRequest;

class ExamController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','guru']);
    }
    public function index(){
        $data['class'] = Classrooms::get();
        $data['exams'] = Exams::where('created_by',Auth::user()->id)->get();
        return view('exam.add',$data);
    }
    public function addSubmit(ExamAddRequest $request){
        $data = $request->except(['_token']);
        $data['start'] = $request->start_date." ".$request->start_time.":00";
        $data['end'] = $request->end_date." ".$request->end_time.":00";
        $data['created_by'] = Auth::user()->id;
        unset($data['start_time']);
        unset($data['start_date']);
        unset($data['end_time']);
        unset($data['end_date']);

        Exams::insert($data);
        return redirect('/exam?success=Berhasil');
    }
    public function delete($id){
        if(!Exams::where(['created_by'=>Auth::user()->id,'id'=>$id])->first()){
            return redirect('/exam?error=Tidak ditemukan');
        }
        Exams::where(['created_by'=>Auth::user()->id,'id'=>$id])->delete();
        
        return redirect('/exam?success=Berhasil');
    }
    // Manage Exam
    public function manage($id){
        $data['exams'] = Exams::where(['id'=>$id,'created_by'=>Auth::user()->id])->first();
        $data['multiple'] = MultipleChoiceQuestions::where(['exam_id'=>$id])->get();
        $data['essay'] = EssayQuestions::where(['exam_id'=>$id])->get();
        if($data['exams'] == null){
            return redirect('/exam/?error=Tidak ditemukan');
        }
        return view('exam.manage',$data);
    }

    public function multiple(ExamMultipleRequest $request, $id){

        $data['exams'] = Exams::where(['id'=>$id,'created_by'=>Auth::user()->id])->first();
        if($data['exams']->sumdata['remaining'] < $request->weight){
            return redirect('/exam/manage/'.$id)->withErrors("Total weight cannot exceed 100 points");
        }
        if($data['exams'] == null){
            return redirect('/exam/?error=Tidak ditemukan');
        }
        $ret = $request->except(['_token']);
        $ret['exam_id'] = $id;

        $qRet = $ret;
        // echo $ret['option'][$ret['correct_answer_id']];
        // die();
        unset($qRet['option']);
        unset($qRet['correct_answer_id']);

        $q = MultipleChoiceQuestions::insert($qRet);
        
        $m = MultipleChoiceQuestions::where(['exam_id'=>$id])->orderBy('created_at','DESC')->first();
        $Mid = $m->id;

        for($i=0; $i<count($ret['option']);$i++){
            MultipleChoiceOptions::insert(['text'=>$ret['option'][$i],'multiple_choice_id'=>$Mid]);
            if($ret['correct_answer_id'] == $i){
                $correct_answer_id = MultipleChoiceOptions::where(['multiple_choice_id'=>$Mid])->orderBy('created_at','DESC')->first()->id;
            }
        }
        $correct_answer_id = MultipleChoiceOptions::where(['text'=>$ret['option'][$ret['correct_answer_id']], 'multiple_choice_id'=>$Mid])->first()->id;

        MultipleChoiceQuestions::where(['id'=>$Mid])->update(['correct_answer_id'=>$correct_answer_id]);
        return redirect('/exam/manage/'.$id.'?success=Berhasil');
    }
    public function multipleDelete($id, $m){
        $data['exams'] = Exams::where(['id'=>$id,'created_by'=>Auth::user()->id])->first();
        if($data['exams'] == null){
            return redirect('/exam/manage/'.$id.'?success=Tidak ditemukan');
        }
        $data['multiply'] = MultipleChoiceQuestions::where(['id'=>$m,'exam_id'=>$id])->first();
        if($data['multiply'] == null){
            return redirect('/exam/manage/'.$id.'?success=Tidak ditemukan');
        }
        MultipleChoiceQuestions::where(['id'=>$m])->delete();
        MultipleChoiceOptions::where(['multiple_choice_id'=>$m])->delete();
        return redirect('/exam/manage/'.$id.'?success=Berhasil');
    }

    public function essay(ExamEssayRequest $request, $id){
        $data['exams'] = Exams::where(['id'=>$id,'created_by'=>Auth::user()->id])->first();
        if($data['exams']->sumdata['remaining'] < $request->weight){
            return redirect('/exam/manage/'.$id)->withErrors("Total weight cannot exceed 100 points");
        }
        if($data['exams'] == null){
            return redirect('/exam/manage/'.$id.'?success=Tidak ditemukan');
        }

        $req = $request->except(['_token']);
        $req['keywords'] = explode('|',$req['keywords']);
        $req['exam_id'] = $id;

        $reqQ = $req;
        unset($reqQ['keywords']);
        
        EssayQuestions::insert($reqQ);
        $m = EssayQuestions::where(['exam_id'=>$id])->orderBy('created_at','DESC')->first();
        $Mid = $m->id;

        foreach($req['keywords'] as $k){
            EssayKeywords::insert(['text'=>$k,'essay_id'=>$Mid]);
        }
        return redirect('/exam/manage/'.$id.'?success=Berhasil');
    }
    public function essayDelete($id, $m){
        $data['exams'] = Exams::where(['id'=>$id,'created_by'=>Auth::user()->id])->first();
        if($data['exams'] == null){
            return redirect('/exam/manage/'.$id.'?success=Tidak ditemukan');
        }
        $data['essay'] = EssayQuestions::where(['id'=>$m,'exam_id'=>$id])->first();
        if($data['essay'] == null){
            return redirect('/exam/manage/'.$id.'?success=Tidak ditemukan');
        }
        EssayQuestions::where(['id'=>$m])->delete();
        return redirect('/exam/manage/'.$id.'?success=Berhasil');
    }
}

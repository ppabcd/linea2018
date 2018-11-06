<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    protected $table = 'exams';
    protected $fillable = ['title', 'classroom_id', 'start', 'end', 'created_by'];

    public function classroom(){
        return $this->belongsTo('\App\Models\Classrooms');
    }

    public function essay(){
        return $this->hasMany("\App\Models\EssayQuestions", 'exam_id');
    }
    public function multiple(){
        return $this->hasMany("\App\Models\MultipleChoiceQuestions", 'exam_id');
    }

    public function getSumdataAttribute(){
        $essay = $this->essay->sum('weight');
        $multiple = $this->multiple->sum('weight');
        return ['sum'=>$essay+$multiple,'remaining'=>100-($essay+$multiple)];
    }
    

    public function getStudentAttribute(){
        
    }
}

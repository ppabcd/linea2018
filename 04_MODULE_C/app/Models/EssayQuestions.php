<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EssayQuestions extends Model
{
    protected $table = 'essay_questions';

    public function keywords(){
        return $this->hasMany('\App\Models\EssayKeywords','essay_id');
    }
}

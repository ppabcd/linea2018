<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultipleChoiceQuestions extends Model
{
    protected $table = 'multiple_choice_question';

    public function option(){
        return $this->hasMany("\App\Models\MultipleChoiceOptions",'multiple_choice_id');
    }

}

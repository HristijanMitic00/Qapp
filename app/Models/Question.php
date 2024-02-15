<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $guarded = [];

    public function answers(){
        return $this->hasMany(Answer::class,'answer_id');
    }

    public function quiz(){
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

}

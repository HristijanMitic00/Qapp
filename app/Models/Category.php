<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $guarded = [];

    public function quizzes(){
        return $this->hasMany(Quiz::class,'quiz_id');
    }
}

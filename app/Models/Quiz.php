<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

class Quiz extends Model
{
    use HasFactory;
    public $guarded = [];

    public function attempts(){
        return $this->hasMany(Attempt::class, 'attempt_id');
    }

    public function questions(){
        return $this->hasMany(Question::class,'question_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
}

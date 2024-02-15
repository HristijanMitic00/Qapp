<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController
{

    public function user_profile()
    {
        $id = Auth::id();
        $user = User::where('id','=',$id)->first();
        $allatempts = Attempt::where('user_id','=',$id)->orderBy('startedTime','DESC')->paginate(10);
        $quizzes = collect();

        foreach ($allatempts as $attempt){
            $quiz = Quiz::where('id','=',$attempt->quiz_id)->first();
            $quizzes->add($quiz);

        }

        return view('profile')->with('user',$user)->with('attempts',$allatempts)->with('quizzes',$quizzes);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\MatchQuestion;
use App\Models\Quiz;
use Illuminate\Http\Request;

class MatchQuestionController extends Controller
{
    //
    public function destroy(Request $request, $id)
    {
        $question = MatchQuestion::where('id','=', $id)->first();
        $question->delete();

        $quizzes = Quiz::all();
        return view('admin')->with('quizzes',$quizzes);
    }

}

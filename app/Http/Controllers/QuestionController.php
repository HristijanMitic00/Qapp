<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use App\Models\MatchQuestion;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Bool_;

class QuestionController extends Controller
{
    //
    public function create(Request $request, $title)
    {
        if ($request->user()->is_admin()) {
            return view('questionCreate')->with('title',$title);
        } else {
            return redirect('/')->withErrors('You do not have permission to do this!!!');
        }
    }

    public function store(Request $request)
    {
        $question  = new Question();
        $answer1 = new Answer();
        $answer2 = new Answer();
        $answer3 = new Answer();
        $answer4 = new Answer();

        $question->text = $request->get('text');
        $title = $request->get('title');
        $quiz = Quiz::where('title',$title)->first();

        $question->quiz_id = $quiz->id;

        $duplicate = Question::where('text',$question->text)->first();
        if($duplicate)
        {
            return redirect('/')->withErrors('Title already exists.')->withInput();
        }

        $correct = $request->get('correct');
        $a1 = $request->get('firstAnswer');
        $a2 = $request->get('secondAnswer');
        $a3 = $request->get('thirdAnswer');
        $a4 = $request->get('fourthAnswer');

        $question->type= 'single';

        $question->save();

        if($correct == 1){
            $answer1->correct = 1;
        }
        if($correct == 2){
            $answer2->correct = 1;
        }
        if($correct == 3){
            $answer3->correct = 1;
        }
        if($correct == 4){
            $answer4->correct = 1;
        }

        $answer1->question_id = $question->id;
        $answer2->question_id = $question->id;
        $answer3->question_id = $question->id;
        $answer4->question_id = $question->id;
        $answer1->text = $a1;
        $answer2->text = $a2;
        $answer3->text = $a3;
        $answer4->text = $a4;

        $answer1->save();
        $answer2->save();
        $answer3->save();
        $answer4->save();

        $quizzes = Quiz::all();
        return view('admin')->with('quizzes',$quizzes);
    }

    public function createMultiple(Request $request, $title)
    {
        if ($request->user()->is_admin()) {
            return view('multipleQuestionCreate')->with('title',$title);
        } else {
            return redirect('/')->withErrors('You do not have permission to do this!!!');
        }
    }

    public function storeMultiple(Request $request)
    {
        $question  = new Question();
        $answer1 = new Answer();
        $answer2 = new Answer();
        $answer3 = new Answer();
        $answer4 = new Answer();

        $question->text = $request->get('text');
        $title = $request->get('title');
        $quiz = Quiz::where('title',$title)->first();

        $question->quiz_id = $quiz->id;

        $duplicate = Question::where('text',$question->text)->first();
        if($duplicate)
        {
            return redirect('/')->withErrors('Can not create question!!!')->withInput();
        }

        $correct = $request->get('correctAnswers');
        $a1 = $request->get('firstAnswer');
        $a2 = $request->get('secondAnswer');
        $a3 = $request->get('thirdAnswer');
        $a4 = $request->get('fourthAnswer');

        $question->save();

        foreach ($correct as $c){
            if($c == 1){
                $answer1->correct = true;
            }
            if($c == 2){
                $answer2->correct = true;
            }
            if($c == 3){
                $answer3->correct = true;
            }
            if($c == 4){
                $answer4->correct = true;
            }
        }


        $answer1->question_id = $question->id;
        $answer2->question_id = $question->id;
        $answer3->question_id = $question->id;
        $answer4->question_id = $question->id;
        $answer1->text = $a1;
        $answer2->text = $a2;
        $answer3->text = $a3;
        $answer4->text = $a4;

        $answer1->save();
        $answer2->save();
        $answer3->save();
        $answer4->save();

        $quizzes = Quiz::all();
        return view('admin')->with('quizzes',$quizzes);
    }


    public function createMatching(Request $request, $title)
    {
        if ($request->user()->is_admin()) {
            return view('matchingQuestionCreate')->with('title',$title);
        } else {
            return redirect('/')->withErrors('You do not have permission to do this!!!');
        }
    }

    public function storeMatching(Request $request)
    {
        $question  = new MatchQuestion();
        $answer1 = $request->get('answer1');
        $answer2 = $request->get('answer2');
        $answer3 = $request->get('answer3');
        $answer4 = $request->get('answer4');
        $match1 =$request->get('match1');
        $match2 =$request->get('match2');
        $match3 =$request->get('match3');
        $match4 =$request->get('match4');

        $question->text = $request->get('text');
        $title = $request->get('title');
        $quiz = Quiz::where('title',$title)->first();

        $question->quiz_id = $quiz->id;

        $duplicate = MatchQuestion::where('text',$question->text)->first();
        if($duplicate)
        {
            return redirect('/')->withErrors('Title already exists.')->withInput();
        }

        $question->answer1 = $answer1;
        $question->answer2 = $answer2;
        $question->answer3 = $answer3;
        $question->answer4 = $answer4;
        $question->match1 = $match1;
        $question->match2 = $match2;
        $question->match3 = $match3;
        $question->match4 = $match4;

        $question->save();

        $quizzes = Quiz::all();
        return view('admin')->with('quizzes',$quizzes);
    }

    public function destroy(Request $request, $id)
    {
        $question = Question::where('id','=', $id)->first();
        $question->delete();

        $quizzes = Quiz::all();
        return view('admin')->with('quizzes',$quizzes);
    }


}

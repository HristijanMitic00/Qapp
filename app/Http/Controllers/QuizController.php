<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Attempt;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Arr;
use App\Models\Category;
use App\Models\MatchQuestion;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOption\None;
use Ramsey\Collection\Collection;
use function Sodium\add;

class QuizController extends Controller
{
    //

    public function admin(){
        $quizzes = Quiz::all();
        return view('admin')->with('quizzes',$quizzes);
        }


    public function index(Request $request)
    {
        $quizzes = Quiz::all();
        $categories = Category::all();

        if ($request->get('category') !== 'none') {
            foreach ($categories as $category) {
                if ($category->id == $request->get('category')) {
                    $quizzes = Quiz::where('category_id', '=', $category->id)->get();
                }
            }
        }

        if ($request->get('category') !== 'none') {
            $categorySelected = Category::where('id', '=', $request->get('category'))->first();
            return view('quizzes')->with('quizzes', $quizzes)->with('categories', $categories)->with('selected', $categorySelected);
        }
        else{
            return view('quizzes')->with('quizzes', $quizzes)->with('categories', $categories)->with('selected', null);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->user()->is_admin()) {
            $categories = Category::all();
            return view('create')->with('categories',$categories);
        } else {
            return redirect('/')->withErrors('You do not have permission to do this!!!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $quiz = new Quiz();
        $quiz->title = $request->get('title');
        $quiz->description = $request->get('description');
        $quiz->category_id = $request->get("category");
        $quiz->admin_id = $request->user()->id;


        $duplicate = Quiz::where('title',$quiz->title)->first();
        if($duplicate)
        {
            return redirect('create')->withErrors('Title already exists.')->withInput();
        }

        $quiz->admin_id = $request->user()->id;
        $quiz->save();
        $quizzes = Quiz::all();
        return view('admin')->with('quizzes',$quizzes);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $title)
    {
        $quiz = Quiz::where('title','=', $title)->first();
       # if ($quiz && ($request->user()->id == $quiz->admin_id || $request->user()->is_admin())) {
        if ($request->user()->is_admin()){
            $categories = Category::all();
            $quizC = $quiz->category_id;
            return view('edit')->with('quiz',$quiz)->with('categories',$categories)->with('selected',$quizC);
        }
        else {
            return redirect('/')->withErrors('You do not have permission to do this!!!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $quiz_id = $request->input('id');
        $quiz = Quiz::find($quiz_id);
        if ($quiz && ($quiz->admin_id == $request->user()->id || $request->user()->is_admin())) {
            $title = $request->input('title');
            $duplicate = Quiz::where('title', $title)->first();
            if ($duplicate) {
                if ($duplicate->id != $quiz_id) {
                    return redirect('editPost/' . $quiz->title)->withErrors('Title already exists.')->withInput();
                }
            }
            $title = $request->input('title');
            $description = $request->input('description');
            $category = $request->input('category');
            $cat = Category::find($category);

            if ($quiz->title !== $title){
                $quiz->title = $title;
            }
            if ($quiz->category_id !== $category){
                $quiz->category_id = $category;
            }
            if ($quiz->description !== $description){
                $quiz->description = $description;
            }

            $quiz->save();
            $quizzes = Quiz::all();
            return view('admin')->with('quizzes',$quizzes);
        } else {
            return redirect('/')->withErrors('You do not have permission to do this!!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($title)
    {
        $quiz = Quiz::where('title','=', $title)->first();
        $allQuestions = Question::where('quiz_id','=',$quiz->id)->get();
        $allMatchingQuestion = MatchQuestion::where('quiz_id','=',$quiz->id)->get();
        return view('allQuestions')->with('quiz',$quiz)->with('all',$allQuestions)->with('allMatch',$allMatchingQuestion);
    }

    public function startQuiz($title){
        $quiz = Quiz::where('title','=', $title)->first();
        $single = Question::where('quiz_id','=',$quiz->id)->where('type','=','single')->get();
        $multiple = Question::where('quiz_id','=',$quiz->id)->where('type','=','multiple')->get();
        $match = MatchQuestion::where('quiz_id','=',$quiz->id)->get();
        $arrayMatch = array();
        $collectionMatch = collect();

        $answersSingle = (Answer::where('question_id','=',0)->get());
        $answersMultiple = (Answer::where('question_id','=',0)->get());


        $attempt = new Attempt();
        $attempt->quiz_id = $quiz->id;
        $attempt->user_id = Auth::id();
        $attempt->startedTime = date('Y-m-d H:i:s');
        $attempt->finishedTime = date('Y-m-d H:i:s');
        $attempt->finalResult = 0;
        $attempt->save();


        foreach ($match as $m) {
            $shuffle = collect([$m->match1,$m->match2,$m->match3,$m->match4]);
            $shuffled = $shuffle->shuffle();
            $shuffled->prepend($m->id);
            $arrayMatch= Arr::add([$m->id => $shuffled],$m->id,$shuffled);
            $collectionMatch->put($m->id,$shuffled);
        }


        foreach ($single as $questionS){
            $answersSingle->push(Answer::where('question_id','=',$questionS->id)->get());
        }

        foreach ($multiple as $questionM){
            $answersMultiple->push(Answer::where('question_id','=',$questionM->id)->get());
        }

        return view('solvingQuiz')->with('quiz',$quiz)->with('single',$single)->with('answersSingle',$answersSingle)
            ->with('multiple',$multiple)->with('answersMultiple',$answersMultiple)->with('aid',$attempt->id)
            ->with('match',$match)->with('matches',$collectionMatch);
    }

    public function solve(Request $request){
        $quiz_id = $request->input('id');
        $quiz = Quiz::find($quiz_id);
        $questions = Question::where('quiz_id','=',$quiz->id)->get();
        $matchQuestion = MatchQuestion::where('quiz_id','=',$quiz->id)->get();
        $a = collect();
        $points = 0;



        foreach ($questions as $question){
            if($request->input('selectAnswerMultiple_'.$question->id)) {
                $answers = $request->input('selectAnswerMultiple_' . $question->id);
                $count = Answer::where('question_id','=',$question->id)->where('correct','=',true)->count();
                foreach ($answers as $answer) {
                    $ans = Answer::find($answer);
                    $a->add($ans);
                    if ($ans->correct) {
                        $points = $points + 1.0/$count;
                    }
                }
            }
            elseif($request->input('selectAnswerSingle_'.$question->id)){
                $answers = $request->input('selectAnswerSingle_'.$question->id);
                $ansS = Answer::find($answers);
                $a->add($ansS);
                if ($ansS->correct){
                    $points++;
                }
            }
        }

        foreach ($matchQuestion as $mQuestion){
            if($request->input('match_'.$mQuestion->id.'_'.$mQuestion->answer1)) {
                $answer1 = $request->input('match_'.$mQuestion->id.'_'.$mQuestion->answer1);
                if($answer1 == $mQuestion->match1){
                    $points = $points + 0.25;
                }
            }
            if($request->input('match_'.$mQuestion->id.'_'.$mQuestion->answer2)) {
                $answer2 = $request->input('match_'.$mQuestion->id.'_'.$mQuestion->answer2);
                if($answer2 == $mQuestion->match2){
                    $points = $points + 0.25;
                }
            }
            if($request->input('match_'.$mQuestion->id.'_'.$mQuestion->answer3)) {
                $answer3 = $request->input('match_'.$mQuestion->id.'_'.$mQuestion->answer3);
                if($answer3 == $mQuestion->match3){
                    $points = $points + 0.25;
                }
            }
            if($request->input('match_'.$mQuestion->id.'_'.$mQuestion->answer4)) {
                $answer4 = $request->input('match_'.$mQuestion->id.'_'.$mQuestion->answer4);
                if($answer4 == $mQuestion->match4){
                    $points = $points + 0.25;
                }
            }
        }

        $attempt_id = $request->input('aid');

        $attempt = Attempt::find($attempt_id);

        $attempt->finalResult = $points;
        $attempt->finishedTime = date('Y-m-d H:i:s');

        $countAll = Question::where('quiz_id','=',$quiz->id)->get()->count() + MatchQuestion::where('quiz_id','=',$quiz->id)->get()->count();

        $attempt->save();

        $grade = false;

        if (Attempt::where('quiz_id','=',$quiz_id)->where('user_id','=',Auth::id())->get()->count() == 1){
            $grade = true;
        }

        return view('/finishQuiz')->with('attempt',$attempt)->with('count',$countAll)->with('grade',$grade);
    }

    public function addGrade(Request $request){
        $quiz_id = $request->input('quiz_id');
        $quiz = Quiz::find($quiz_id);
        $quiz_grade= $quiz->rating;
        $quiz_grade_times = $quiz->timesRated;
        $score = $quiz_grade_times*$quiz_grade + $request->input('gradeQuiz');
        $quiz_grade_times++;
        $quiz->rating = $score/$quiz_grade_times;
        $quiz->timesRated = $quiz_grade_times;

        $quiz->save();

        $quizzes = Quiz::all();
        $categories = Category::all();
        return view('quizzes')->with('quizzes',$quizzes)->with('categories', $categories);
    }

    public function quizInfo($title){
        $quiz = Quiz::where('title','=', $title)->first();
        $category = Category::where('id','=',$quiz->category_id)->first();
        $attempts = Attempt::where('quiz_id','=',$quiz->id)->orderByDesc('finalResult')->get();
        $attemptsTopFive = $attempts->unique('user_id');
        $users = User::all();

        return view('quizInfo')->with('quiz',$quiz)->with('category',$category)->with("users",$users)->with('attempts',$attemptsTopFive);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $title)
    {
        //
        $quiz = Quiz::where('title','=', $title)->first();
        if ($quiz && ($quiz->admin_id == $request->user()->id || $request->user()->is_admin())) {
            $quiz->delete();
        } else {
            return redirect('/')->withErrors('You do not have permission to do this!!!');
        }
        $quizzes = Quiz::all();
        return view('admin')->with('quizzes',$quizzes);
    }
}

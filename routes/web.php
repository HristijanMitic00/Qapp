<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/quizzes',[\App\Http\Controllers\QuizController::class,'index']);

Route::post('filterQuiz',[\App\Http\Controllers\QuizController::class,'index']);

Route::get('/quizInfo/{title}',[\App\Http\Controllers\QuizController::class,'quizInfo']);


Route::group(['middleware' => ['auth']], function()
{
    Route::get('/admin',[\App\Http\Controllers\QuizController::class,'admin']);

    Route::get('/profile',[\App\Http\Controllers\UserController::class,'user_profile']);

    Route::get('/create',[\App\Http\Controllers\QuizController::class,'create']);

    Route::post('newQuiz',[\App\Http\Controllers\QuizController::class,'store']);

    Route::get('/edit/{title}',[\App\Http\Controllers\QuizController::class,'edit']);

    Route::post('update',[\App\Http\Controllers\QuizController::class,'update']);

    Route::get('/delete/{title}',[\App\Http\Controllers\QuizController::class,'destroy']);

    Route::get('/question/{title}',[\App\Http\Controllers\QuestionController::class,'create']);

    Route::post('newQuestion',[\App\Http\Controllers\QuestionController::class,'store']);

    Route::get('/questionMultiple/{title}',[\App\Http\Controllers\QuestionController::class,'createMultiple']);

    Route::post('newQuestionMultiple',[\App\Http\Controllers\QuestionController::class,'storeMultiple']);

    Route::get('/questionMatching/{title}',[\App\Http\Controllers\QuestionController::class,'createMatching']);

    Route::post('newQuestionMatching',[\App\Http\Controllers\QuestionController::class,'storeMatching']);

    Route::get('/allQuestions/{title}',[\App\Http\Controllers\QuizController::class,'show']);

    Route::get('/deleteQuestion/{id}',[\App\Http\Controllers\QuestionController::class,'destroy']);

    Route::get('/deleteQuestionMatch/{id}',[\App\Http\Controllers\MatchQuestionController::class,'destroy']);

    Route::get('/startQuiz/{title}',[\App\Http\Controllers\QuizController::class,'startQuiz']);

    Route::post('solveQuiz',[\App\Http\Controllers\QuizController::class,'solve']);

    Route::post('gradeQuiz',[\App\Http\Controllers\QuizController::class,'addGrade']);

});


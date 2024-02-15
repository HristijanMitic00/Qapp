@extends('layouts.app')

@section('content')

    <div style="margin-top: 50px;margin-left: 50px">
    <h3>Name - {{$quiz->title}}</h3>
    <h5>Category - {{$category->name}}</h5>
    <h5>Description - {{$quiz->description}}</h5>
    <h5>Difficulty - {{$quiz->rating}}</h5>
    <h5>Times rated - {{$quiz->timesRated}}</h5>


        <h3 style="margin-top: 20px">Top 5 quiz takers</h3>
        <table style="border: solid 2px;padding: 15px;text-align: center ">
            <thead style="border: solid 2px;padding: 15px"><th style="padding: 15px">Username</th><th style="border: solid 2px;padding: 15px;margin-left: 5px">Total points</th></thead>
    @foreach($attempts as $attempt)
        @if($attempt->quiz_id == $quiz->id)
            @foreach($users as $user)
                @if($user->id == $attempt->user_id)
                    <tr style="border: solid 2px">
                        <th style="padding: 15px">{{$user->username}}</th>
                        <th style="border: solid 2px;padding: 15px">{{$attempt->finalResult}}</th>
                            </tr>
                        @endif
            @endforeach
        @endif
    @endforeach
        </table>
    <a class="btn btn-danger" style="margin-top: 15px" href="/quizzes" >Go back</a>
        @if(Auth::check())
        <button class="btn btn-primary" style="margin-left: 10px;margin-top: 14px"><a style="text-decoration: none;color: white" href="{{ url('startQuiz/'.$quiz->title)}}">Take Quiz</a></button>
        @endif
    </div>
@endsection

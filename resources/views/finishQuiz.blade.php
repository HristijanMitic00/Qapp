@extends('layouts.app')

@section('content')
    <div><h4>Total points: {{$attempt->finalResult}}/{{$count}} ({{$attempt->finalResult / $count*100}}%)</h4></div>
        @if($grade)
            <form action="/gradeQuiz" method="post">
                <input type="hidden" name="quiz_id" value="{{ $attempt->quiz_id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <p>Grade the quiz based on difficulty.</p>
            <div><input  style="margin-right: 5px" type="radio" name="gradeQuiz" id="gradeQuiz" value="1">1</div>
            <div><input  style="margin-right: 5px" type="radio" name="gradeQuiz" id="gradeQuiz" value="2">2</div>
            <div><input  style="margin-right: 5px" type="radio" name="gradeQuiz" id="gradeQuiz" value="3">3</div>
            <div><input  style="margin-right: 5px" type="radio" name="gradeQuiz" id="gradeQuiz" value="4">4</div>
            <div><input  style="margin-right: 5px" type="radio" name="gradeQuiz" id="gradeQuiz" value="5">5</div>
            <input style="display:block;margin-top: 30px" type="submit" name='finish' class="btn btn-success" value="Finish"/>
    </form>
        @else
            <button class="btn btn-success" style="margin-top: 20px"><a style="text-decoration: none;color: white" href="/quizzes">Continue</a></button>
        @endif
@endsection

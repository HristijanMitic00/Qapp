@extends('layouts.app')

@section('content')
    <form action="/newQuestionMatching" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input type="hidden" name="title" value="{{ $title }}{{ old('title') }}">
        </div>
        <div class="form-group">
            <input required="required" value="{{ old('text') }}" placeholder="Enter question text here" type="text"
                   name = "text" class="form-control" />
        </div>
        <div class="form-group" style="margin-top: 20px">
            <h4>Enter possible answers</h4>
        </div>
        <div class="form-group" style="margin: 10px">
            <label for="answer1">
                <span>1.</span>
                <div style="margin-bottom: 20px">Answer </div><input name='answer1' required="required" class="form-control" style="margin-left: 75px;margin-top: -50px;margin-bottom: 20px">
                <div>Match</div><input name='match1' required="required" class="form-control" style="margin-left: 75px;margin-top: -30px">
            </label>
        </div>
        <div class="form-group" style="margin: 10px">
            <label for="answer2">
                <span>2.</span>
                <div style="margin-bottom: 20px">Answer</div><input name='answer2' required="required" class="form-control" style="margin-left: 75px;margin-top: -50px;margin-bottom: 20px">
                <div>Match  </div><input name='match2' required="required" class="form-control" style="margin-left: 75px;margin-top: -30px">

            </label>
        </div>
        <div class="form-group" style="margin: 10px">
            <label for="answer3">
                <span>3.</span>
                <div style="margin-bottom: 20px">Answer </div><input name='answer3' required="required" class="form-control" style="margin-left: 75px;margin-top: -50px;margin-bottom: 20px">
                <div>Match </div><input name='match3' required="required" class="form-control"  style="margin-left: 75px;margin-top: -30px">
            </label>
        </div>
        <div class="form-group" style="margin: 10px">
            <label for="answer4">
                <span>4.</span>
                <div style="margin-bottom: 20px">Answer </div><input name='answer4'  required="required" class="form-control" style="margin-left: 75px;margin-top: -50px;margin-bottom: 20px">
                <div>Match  </div><input name='match4' required="required" class="form-control" style="margin-left: 75px;margin-top: -30px">
            </label>
        </div>
        <input type="submit" name='create' class="btn btn-success" value = "Create"/>
    </form>
@endsection

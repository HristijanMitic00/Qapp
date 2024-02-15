@extends('layouts.app')

@section('content')
    <form action="/newQuestionMultiple" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <input type="hidden" name="title" value="{{ $title }}{{ old('title') }}">
        </div>
        <div class="form-group">
            <input required="required" value="{{ old('text') }}" placeholder="Enter question text here" type="text"
                   name = "text" class="form-control" />
        </div>
        <div class="form-group" style="margin-top: 20px;margin-bottom: 20px">
            <h4>Enter possible answers</h4>
        </div>
        <div class="form-group">
            <label for="firstAnswer">
                <p>1.</p>
                <input name='firstAnswer' required="required" class="form-control">{{ old('firstAnswer') }}</input>
            </label>
        </div>
        <div class="form-group">
            <label for="secondAnswer">
                <p>2.</p>
                <input name='secondAnswer' required="required" class="form-control">{{ old('secondAnswer') }}</input>
            </label>
        </div>
        <div class="form-group">
            <label for="thirdAnswer">
                <p>3.</p>
                <input name='thirdAnswer' required="required" class="form-control">{{ old('thirdAnswer') }}</input>
            </label>
        </div>
        <div class="form-group">
            <label for="fourthAnswer">
                <p>4.</p>
                <input name='fourthAnswer'  required="required" class="form-control">{{ old('fourthAnswer') }}</input>
            </label>
        </div>
        <div class="form-group" style="margin-top: 20px;margin-bottom: 20px;">
            <h5>Choose which answers are correct!</h5>
            <div class="checkbox-group required">
            <input type="checkbox" id="first" name="correctAnswers[]" value="1">
            <label for="first">First answer</label><br>
            <input type="checkbox" id="second" name="correctAnswers[]" value="2">
            <label for="second">Second answer</label><br>
            <input type="checkbox" id="third" name="correctAnswers[]" value="3">
            <label for="third">Third answer</label><br>
            <input type="checkbox" id="fourth" name="correctAnswers[]" value="4">
            <label for="fourth">Fourth answer</label><br>
            </div>
        </div>
        <input type="submit" name='create' class="btn btn-success" value = "Create"/>
    </form>
@endsection

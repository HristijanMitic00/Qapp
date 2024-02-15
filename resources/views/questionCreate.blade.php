@extends('layouts.app')

@section('content')
    <form action="/newQuestion" method="post">
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
        <div class="form-group">
            <label for="firstAnswer">
                <span>1.</span>
                <input name='firstAnswer' required="required" class="form-control">{{ old('firstAnswer') }}</input>
            </label>
        </div>
        <div class="form-group">
            <label for="secondAnswer">
                <span>2.</span>
                <input name='secondAnswer' required="required" class="form-control" >{{ old('secondAnswer') }}</input>
            </label>
        </div>
        <div class="form-group">
            <label for="thirdAnswer">
                <span>3.</span>
                <input name='thirdAnswer' required="required" class="form-control">{{ old('thirdAnswer') }}</input>
            </label>
        </div>
        <div class="form-group">
            <label for="fourthAnswer">
                <span>4.</span>
                <input name='fourthAnswer'  required="required" class="form-control">{{ old('fourthAnswer') }}</input>
            </label>
        </div>
        <div class="form-group" style="margin-bottom: 20px;margin-top: 20px">
            <h5>Choose which answer is correct!</h5>
            <select name="correct" required="required">
                <option value="">None</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <input type="submit" name='create' class="btn btn-success" value = "Create"/>
    </form>
@endsection

@extends('layouts.app')

@section('content')
    <button class="btn btn-danger" style=";margin-right: 0;float: right"><a class="btn-danger" style="text-decoration: none; color: white"
                                                                            href="{{ url('quizzes')}}">Reset filter</a>
    </button>
    <form action="/filterQuiz" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" name='filter' class="btn btn-success" value="Filter" style="float: right;margin-right: 10px"/>
        <select name="category" style="float: right;margin-right: 10px">
            @if(!isset($selected))
            <option value="none">---</option>
            @endif
                @foreach($categories as $category)
                @if(isset($selected))
                    @if($category->id === $selected->id)
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endif
            @endforeach
        </select>
    </form>
    <div style="margin-top: 100px">
    @foreach ($quizzes as $quiz)
        <div class="card col-md-4" style="display: inline-block;width: 250px;text-align: center; margin: 15px">
        <h3 style="display: block" class="card-header">{{ $quiz->title }}</h3><br>
        @foreach ($categories as $category)
            @if( $category->id == $quiz->category_id)
                <div class="card-body" style="height: 180px;text-align: center;">
                <h5 style="display: block" >{{ $category->name }}</h5><br>
                    <h5 style="display: block" >Difficulty: {{ $quiz->rating }}/5 ({{$quiz->timesRated}})</h5><br>
                </div>
                    @endif
        @endforeach

            <div class="card-footer" style="text-align: center">
                <button class="btn btn-info" style="margin-right: 10px"><a style="text-decoration: none;color: white" href="{{ url('quizInfo/'.$quiz->title)}}">Info</a>
                </button>
                @if(Auth::check())
                <button class="btn btn-primary" style="margin-left: 10px"><a style="text-decoration: none;color: white" href="{{ url('startQuiz/'.$quiz->title)}}">Take Quiz</a>
                </button>
                @endif
            </div>

        </div>
    @endforeach
    </div>
@endsection

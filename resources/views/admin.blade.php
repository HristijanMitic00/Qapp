@extends('layouts.app')

@section('content')

    <a href="/create" class="btn btn-success">Create Quiz</a>

    <table style="margin-top: 40px">
        <thead>
        <tr style="text-align: center">
            <td style="border: solid 2px;padding: 15px">Quiz name</td>
            <td style="border: solid 2px;padding: 15px">Quiz descrpition</td>
            <td style="border: solid 2px;padding: 15px">Quiz options </td>
            <td style="border: solid 2px;padding: 15px">Question options </td>
        </tr>
        </thead>
        <tbody>
        @foreach ($quizzes as $quiz)
            <tr>
                <td style="padding: 15px;border: solid 2px">{{ $quiz->title }}</td>
                <td style="border: solid 2px;padding: 15px">{{ $quiz->description }}</td>
                <td style="border: solid 2px;text-decoration: none;padding: 15px">
                <button class="btn btn-primary" style="border: solid 2px;margin: 5px"><a  style="text-decoration: none;color: white" href="{{ url('edit/'.$quiz->title)}}">Edit quiz</a></button>
                <button class="btn btn-danger" style="border: solid 2px;margin: 5px"><a style="text-decoration: none;color: white" href="{{ url('delete/'.$quiz->title)}}">Delete quiz</a>
                </button>
                </td>
                <td style="border: solid 2px">
                    <button class="btn btn-success" style="border: solid 2px;margin: 5px"><a style="text-decoration: none;color: white" href="{{ url('question/'.$quiz->title)}}">Add  sinlge choice question</a>
                    </button>
                    <button class="btn btn-success" style="border: solid 2px;margin: 5px"><a  style="text-decoration: none;color: white" href="{{ url('questionMultiple/'.$quiz->title)}}">Add
                            multiple choice question</a></button>
                    <button class="btn btn-success" style="border: solid 2px;margin: 5px"><a style="text-decoration: none;color: white" href="{{ url('questionMatching/'.$quiz->title)}}">Add
                            matching question</a></button>
                    <button class="btn btn-info" style="border: solid 2px;margin: 5px"><a  style="text-decoration: none;color: white" href="{{ url('allQuestions/'.$quiz->title)}}">View
                            questions</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

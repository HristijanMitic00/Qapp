@extends('layouts.app')

@section('content')

    <div style="margin-left: 50px">
<h3>{{$quiz->title}}</h3>

    <table style="margin-top: 40px;margin-left: 40px">
<thead>
<td style="border: solid 2px;padding: 15px">Question name</td>
<td style="border: solid 2px;padding: 15px"></td>
</thead>
        <tbody>

    @foreach ($all as $question)
        <tr>
        <td style="border: solid 2px;padding: 15px">{{ $question->text }}</td>
          <td style="border: solid 2px;padding: 15px"><button class="btn btn-danger" style="float: right"><a style="text-decoration: none;color: white" href="{{ url('deleteQuestion/'.$question->id)}}">Delete Question</a></button></td>
        </tr>
    @endforeach


        @foreach ($allMatch as $questionM)
            <tr>
        <td style="border: solid 2px;padding: 15px">{{ $questionM->text }}</td>
        <td style="border: solid 2px;padding: 15px"><button class="btn btn-danger" style="float: right"><a style="text-decoration: none;color: white" href="{{ url('deleteQuestionMatch/'.$questionM->id)}}">Delete Question</a></button></td>
            </tr>
    @endforeach

        </tbody>
    </table>
    <a href="/admin" style="margin-top: 20px" class="btn btn-info">Go back</a>
    </div>
@endsection

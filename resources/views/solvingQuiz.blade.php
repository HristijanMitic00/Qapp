@extends('layouts.app')

@section('content')
    <form action="/solveQuiz" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h3 style="margin-bottom: 40px">{{$quiz->title}}</h3>
        <input type="hidden" name="id" value="{{ $quiz->id }}{{ old('id') }}">
        <input type="hidden" name="aid" value="{{ $aid }}{{ old('aid') }}">
        <ol>
            @foreach ($single as $questionS)
                <h5 style="">
                    <li> {{ $questionS->text }}</li>
                </h5><br>
                @foreach ($answersSingle as $answerS)
                    @foreach($answerS as $aS)
                        @if($aS->question_id == $questionS->id)
                            <input type="radio" id="selectAnswerSingle" name="selectAnswerSingle.{{$questionS->id}}"
                                   value="{{$aS->id}}">
                            <span>{{$aS->text}}</span>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
            @foreach ($multiple as $questionM)
                <h5 style="">
                    <li>{{ $questionM->text }}</li>
                </h5><br>
                @foreach ($answersMultiple as $answerM)
                    @foreach($answerM as $aM)
                        @if($aM->question_id == $questionM->id)
                            <input type="checkbox" id="selectAnswerMultiple"
                                   name="selectAnswerMultiple.{{$questionM->id}}[]" value="{{$aM->id}}">
                            <span>{{$aM->text}}</span>
                        @endif
                    @endforeach
                @endforeach
            @endforeach

            @foreach($match as $maQ)
                <h5>
                    <li>{{$maQ->text}}</li>
                </h5>
                <div style="margin: 10px">
                    <p style="display: inline">{{$maQ->answer1}}<span style="margin-left: 10px">-></span></p>
                    @foreach($matches as $mat)
                        @if($mat->contains($maQ->id))
                            <select id="match.{{$maQ->id}}.{{$maQ->answer1}}"
                                    name="match.{{$maQ->id}}.{{$maQ->answer1}}" style="margin-left: 10px">
                                <option value="">None</option>
                                @foreach($mat as $mm)
                                    @if($mm != $maQ->id)
                                        <option value="{{$mm}}">{{$mm}}</option>
                                    @endif
                                @endforeach
                            </select>
                </div>
                @endif
            @endforeach
            <div style="margin: 10px">
                <p style="display: inline">{{$maQ->answer2}}<span style="margin-left: 10px">-></span></p>
                @foreach($matches as $mat)
                    @if($mat->contains($maQ->id))
                        <select id="match.{{$maQ->id}}.{{$maQ->answer2}}" name="match.{{$maQ->id}}.{{$maQ->answer2}}"
                                style="margin-left: 10px">
                            <option value="">None</option>
                            @foreach($mat as $mm)
                                @if($mm != $maQ->id)
                                    <option value="{{$mm}}">{{$mm}}</option>
                                @endif
                            @endforeach
                        </select>
            </div>
            @endif
            @endforeach
            <div style="margin: 10px">
                <p style="display: inline">{{$maQ->answer3}}<span style="margin-left: 10px">-></span></p>
                @foreach($matches as $mat)
                    @if($mat->contains($maQ->id))
                        <select id="match.{{$maQ->id}}.{{$maQ->answer3}}" name="match.{{$maQ->id}}.{{$maQ->answer3}}"
                                style="margin-left: 10px">
                            <option value="">None</option>
                            @foreach($mat as $mm)
                                @if($mm != $maQ->id)
                                    <option value="{{$mm}}">{{$mm}}</option>
                                @endif
                            @endforeach
                        </select>
            </div>
            @endif
            @endforeach
            <div style="margin: 10px">
                <p style="display: inline">{{$maQ->answer4}}<span style="margin-left: 10px">-></span></p>
                @foreach($matches as $mat)
                    @if($mat->contains($maQ->id))
                        <select id="match.{{$maQ->id}}.{{$maQ->answer4}}" name="match.{{$maQ->id}}.{{$maQ->answer4}}"
                                style="margin-left: 10px">
                            <option value="">None</option>
                            @foreach($mat as $mm)
                                @if($mm != $maQ->id)
                                    <option value="{{$mm}}">{{$mm}}</option>
                                @endif
                            @endforeach
                        </select>
            </div>
            @endif
            @endforeach
            @endforeach
        </ol>
        <input type="submit" name='finish' class="btn btn-success" value="Finish"/>
    </form>

@endsection


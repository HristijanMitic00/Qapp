@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align: center"><h3>Username - {{ $user->username }}</h3></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>Email - {{ $user->email }}</h5>
                        <h5>Role - {{ $user->role }}</h5>
                            <h5>Created at - {{ $user->created_at }}</h5>
                    </div>
                </div>
                <h3 style="margin-top: 30px">All attempts</h3>
                <table style="margin-top: 10px;border: solid 2px">
                    <tr style="border: solid 2px;padding: 15px">
                    <th  style="border: solid 2px;padding: 15px;text-align: center">Quiz name</th>
                    <th  style="border: solid 2px;padding: 15px;text-align: center">Result</th>
                    <th  style="border: solid 2px;padding: 15px;text-align: center">Start time</th>
                    <th  style="border: solid 2px;padding: 15px;text-align: center">Finish time</th>
                </tr>
                            @foreach($attempts as $attempt)
                                @foreach($quizzes as $quiz)
                     <tr>
                                    @if($attempt->quiz_id == $quiz->id)
                                        <th  style="border: solid 2px;padding: 15px;text-align: center">{{$quiz->title}}</th>
                                        @break
                                    @endif
                                @endforeach
                                <th  style="border: solid 2px;padding: 15px;text-align: center">{{$attempt->finalResult}}</th>
                                <th  style="border: solid 2px;padding: 15px;text-align: center">{{$attempt->startedTime}}</th>
                                <th  style="border: solid 2px;padding: 15px;text-align: center">{{$attempt->finishedTime}}</th>
                        @endforeach
                    </tr>
                </table>
                <div style="margin-top: 20px">
                {{ $attempts->links('pagination::bootstrap-4') }}</div>
            </div>
            </div>
    </div>
@endsection

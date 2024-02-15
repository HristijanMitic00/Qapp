@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center"><h1>Qapp - quiz web app</h1></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 style="text-align: center;">Welcome to Qapp. Web app where you can test your knowledge in various topics and compete with others. Enjoy!</h1>
                        @foreach ( $errors->all() as $error )
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    <footer style="margin-top: 200px;text-align: right">Hristijan Mitic 2024 INSSSSIOK</footer>
</div>
@endsection

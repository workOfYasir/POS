
@extends('install.app')
@section('content')
    <div class="pad-btm text-center">
        <h1 class="h3">Congratulations!!!</h1>
        <p>You have successfully completed the installation process. Please Login to continue.</p>
    </div>
    <div class="text-center">
        <a href="{{ env('APP_URL') }}" class="btn btn-primary">Start Using Now</a>
    </div>
@endsection

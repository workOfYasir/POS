@extends('install.app')
@section('content')
@if($message = Session::get('success'))

  <div class="card-body">
      <h3 class="text-lg-center p-3">
          @translate(Import Sql)</h3>
      <p>
          @translate(If You Click this button Sql File auto Save in Database)</p>
      <a href="{{route('org.create')}}" class="btn btn-block btn-success">
          @translate(Import Sql)</a>
  </div>
  
@endif

@if($message = Session::get('wrong'))

  <div class="card-body">
      <p>
          @translate(Check the Database connection)</p>
      <a href="{{route('create')}}" class="btn btn-block btn-danger">
          @translate(Go to the Database Setup)</a>
  </div>

@endif
@endsection

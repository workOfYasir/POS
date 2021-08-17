@extends('admin.master')
@section('title')
@endsection

@section('content')
    <div class="">
        <!--Begin::Dashboard 4-->
        <div class="pb-3">
            <form method="get" action="{{route('dashboard')}}">
                <div class="btn btn-group pl-0" role="group" aria-label="Basic">
                    <button value="Today" type="submit" name="query" class="btn btn-primary mr-1 @if(!Request::has('query') || Request::get('query') == 'Today')active @endif">@translate(Today)</button>
                    <button value="This Week" type="submit" name="query" class="btn btn-primary mx-1 @if(Request::get('query') == 'This Week')active @endif">@translate(This Week)</button>
                    <button value="This Month" type="submit" name="query" class="btn btn-primary mx-1 @if(Request::get('query') == 'This Month')active @endif">@translate(This Month)</button>
                    <button value="This Year" type="submit" name="query" class="btn btn-primary mx-1 @if(Request::get('query') == 'This Year')active @endif">@translate(This Year)</button>
                </div>
            </form>
        </div>

       @include('admin.home.top')

        <div class="row">
            <div class="col-12">
                @include('admin.home.charts')
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @include('admin.home.alert-report')
            </div>
        </div>


        <div class="row">
            @include('admin.home.purchase')
        </div>
    </div>

@endsection

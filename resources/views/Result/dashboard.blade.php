@extends('Result.masters.app')

@section('page-title')
    <span data-realtime="firstName">{{ Auth::user()->name }}</span> <span
        data-realtime="lastName">{{ Auth::user()->last_name }}</span>
@stop

@section('required-styles')
 

@stop

@section('content')
   
@endsection



@section('script-handler-for-this-page')
@stop

@extends('layout')

@section('content')
    
    <h1>Welcome {{ Auth::user()->name }}</hname>

@endsection
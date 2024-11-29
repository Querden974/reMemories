@extends('base')
@section('title', 'Login')
@section('content')
    <div>
        {{ dd(Auth::user()->getAttributes()) }}
    </div>
@endsection

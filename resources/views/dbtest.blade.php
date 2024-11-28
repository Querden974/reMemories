@extends('base')
@section('title', 'Login')
@section('content')
    <div>
        @php
            use App\Models\User;

            if (User::all()->count() > 0) {
                echo User::all()->count();
            }
        @endphp
    </div>
@endsection

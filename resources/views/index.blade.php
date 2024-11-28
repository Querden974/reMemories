@extends('base')
@section('content')
    <main class="flex flex-col gap-5 mt-10 ">
        <x-memory-field></x-memory-field>
        <x-card-memory></x-card-memory>
        <x-card-memory-article></x-card-memory-article>
    </main>
@endsection

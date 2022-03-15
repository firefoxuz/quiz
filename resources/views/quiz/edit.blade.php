@extends('layout.main')
@section('content')
    @livewire('admin.quiz.edit', ['quiz' => $quiz])
@endsection

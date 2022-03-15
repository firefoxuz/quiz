@extends('layout.main')
@section('content')
    @livewire('admin.quiz.add-question',['quiz_id' => $quiz])
@endsection
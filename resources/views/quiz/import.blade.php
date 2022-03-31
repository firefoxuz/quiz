@extends('layout.main')
@section('content')
    @livewire('admin.quiz.import-question',['quiz_id' => $quiz_id])
@endsection

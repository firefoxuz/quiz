@extends('layout.main')
@section('content')
    @livewire('admin.quiz-answer.add-answer',['quiz_id' => $quiz_id,'question_id' => $question_id])
@endsection
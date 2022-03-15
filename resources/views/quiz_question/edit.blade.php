@extends('layout.main')
@section('content')
    @livewire('admin.quiz-question.edit',[
            'quiz_id' => $quiz_id,
            'question_id' => $question_id,
        ])
@endsection

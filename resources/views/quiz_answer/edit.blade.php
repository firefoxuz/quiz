@extends('layout.main')
@section('content')
    @livewire('admin.quiz-answer.edit',[
            'quiz_id' => $quiz_id,
            'question_id' => $question_id,
            'answer_id' => $answer_id,
        ])
@endsection

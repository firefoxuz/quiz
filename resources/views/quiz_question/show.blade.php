@extends('layout.main')
@section('content')
    {{ Diglactic\Breadcrumbs\Breadcrumbs::render('quiz_answer',$quiz_id,$question_id) }}
    @livewire('admin.quiz-question.show', ['quiz_id' => $quiz_id, 'question_id' => $question_id])
@endsection

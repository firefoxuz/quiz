@extends('layout.main')
@section('content')
    {{ Diglactic\Breadcrumbs\Breadcrumbs::render('quiz_question',$quiz) }}
    @livewire('admin.quiz.show', ['quiz' => $quiz])
@endsection

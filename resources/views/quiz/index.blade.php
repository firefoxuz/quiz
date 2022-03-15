@extends('layout.main')
@section('content')
    {{ Diglactic\Breadcrumbs\Breadcrumbs::render('quiz') }}
    @livewire('admin.quiz.index')
@endsection

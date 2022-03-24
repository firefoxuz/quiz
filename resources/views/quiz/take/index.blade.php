@extends('layout.main')
@section('content')
    @livewire('admin.take.index',['quiz_id' => $quiz_id])
@endsection

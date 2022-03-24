@extends('layout.main')
@section('content')
    @livewire('admin.take.show',['quiz_id' => $quiz_id, 'take_id' => $take_id])
@endsection

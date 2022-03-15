@extends('layout.main')
@section('content')
    @livewire('admin.user.face-data.show', ['user_id' => $user_id])
@endsection

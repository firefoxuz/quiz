@extends('layout.main')
@section('content')
    @livewire('admin.user.api-user.update', ['api_user_id' => $api_user_id])
@endsection
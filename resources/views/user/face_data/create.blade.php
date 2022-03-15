@extends('layout.main')
@section('content')
    @livewire('admin.user.face-data.create')
@endsection
@section('scripts')
    <script src="{{asset('face_api/face-api.min.js')}}"></script>
    <script src="{{asset('face_api/app.js')}}"></script>
@endsection

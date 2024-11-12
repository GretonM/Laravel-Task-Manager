{{-- resources/views/layouts/task.blade.php --}}
@extends('layouts.app')

@section('title', 'Task Management')

@section('content')
    <div class="container mt-4">
        @yield('task-content')
    </div>
@endsection

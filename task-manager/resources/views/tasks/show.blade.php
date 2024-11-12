@extends('layouts.task')

@section('task-content')
    <h1 class="text-white">Task Details</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label text-white">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" disabled>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label text-white">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" disabled>{{ $task->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label text-white">Priority</label>
            <select class="form-select" id="priority" name="priority" disabled>
                <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>High</option>
                <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>Medium</option>
                <option value="3" {{ $task->priority == 3 ? 'selected' : '' }}>Low</option>
            </select>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="status" name="status" {{ $task->status ? 'checked' : '' }} disabled>
            <label class="form-check-label text-white" for="status">Completed</label>
        </div>

        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Task List</a>
    </form>
@endsection

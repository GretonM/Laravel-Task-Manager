@extends('layouts.task')

@section('task-content')
    <h1 class="text-white">Edit Task</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

         <div class="mb-3">
            <label for="title" class="form-label text-white">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $task->title) }}">
            
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label text-white">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $task->description) }}</textarea>
            
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label text-white">Priority</label>
            <select class="form-select" id="priority" name="priority">
                <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>High</option>
                <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>Medium</option>
                <option value="3" {{ $task->priority == 3 ? 'selected' : '' }}>Low</option>
            </select>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="status" name="status" {{ $task->status ? 'checked' : '' }}>
            <label class="form-check-label text-white" for="status">Completed</label>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

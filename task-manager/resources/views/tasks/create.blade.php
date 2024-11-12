@extends('layouts.task')

@section('task-content')
    <h1 class="text-white">Create New Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label text-white">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
            
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label text-white">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
            
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label text-white">Priority</label>
            <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority">
                <option value="1" {{ old('priority') == 1 ? 'selected' : '' }}>High</option>
                <option value="2" {{ old('priority') == 2 ? 'selected' : '' }}>Medium</option>
                <option value="3" {{ old('priority') == 3 ? 'selected' : '' }}>Low</option>
            </select>
            
            @error('priority')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

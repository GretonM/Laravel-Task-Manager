@extends('layouts.task')

@section('task-content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-white">Tasks</h1>
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
            <div class="row">
                <div class="col">
                    <select name="status" class="form-select" aria-label="Filter by Status">
                        <option value="" disabled selected>Status</option>
                        <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>Completed</option>
                        <option value="0" {{ request()->status == '0' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="col">
                    <select name="priority" class="form-select" aria-label="Filter by Priority">
                        <option value="" disabled selected>Priority</option>
                        <option value="1" {{ request()->priority == '1' ? 'selected' : '' }}>High</option>
                        <option value="2" {{ request()->priority == '2' ? 'selected' : '' }}>Medium</option>
                        <option value="3" {{ request()->priority == '3' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>

                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
    </div>

    <table class="table table-hover table-striped">
        <thead class="table-dark dark:bg-gray-700">
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Priority</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="dark:text-white">
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <span class="badge {{ $task->status ? 'bg-success' : 'bg-warning' }}">
                            {{ $task->status ? 'Completed' : 'Pending' }}
                        </span>
                    </td>
                    <td>
                        @if ($task->priority == 1)
                            <span class="badge bg-danger">High</span>
                        @elseif ($task->priority == 2)
                            <span class="badge bg-warning text-dark">Medium</span>
                        @elseif ($task->priority == 3)
                            <span class="badge bg-success">Low</span>
                        @else
                            <span class="badge bg-secondary">No Priority</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-dark me-2">Show</a>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-info me-2">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

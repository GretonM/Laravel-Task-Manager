<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Auth::user()->tasks();
    
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
    
        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }
    
        $tasks = $query->orderBy('priority')->get();
    
        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
      $task = Task::find($id);
      return view('tasks.show', compact('task'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Auth::user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Detyra u krijua me sukses.');
    }

    public function edit(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        $priority = $request->input('priority');
        $status = $request->has('status');
    
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $priority,
            'status' => $status,
        ]);
    
        return redirect()->route('tasks.index')->with('success', 'Detyra u përditësua me sukses.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
    
        return redirect()->route('tasks.index')->with('success', 'Detyra u fshi me sukses.');
    }
}


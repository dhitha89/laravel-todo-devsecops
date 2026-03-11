<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $todos = auth()->user()->todos()->latest()->get();

        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        auth()->user()->todos()->create([
            'title' => $request->title,
        ]);

        return redirect()->route('todos.index')->with('success', 'Task added!');
    }

    public function update(Todo $todo)
    {
        $this->authorize('update', $todo);
        $todo->update(['completed' => ! $todo->completed]);

        return redirect()->route('todos.index');
    }

    public function destroy(Todo $todo)
    {
        $this->authorize('delete', $todo);
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Task deleted!');
    }
}

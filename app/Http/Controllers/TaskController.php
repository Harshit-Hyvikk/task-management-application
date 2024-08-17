<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::user()->id;

        $sortBy = $request->input('sort_by', 'priority');
        $direction = $request->input('direction', 'asc');

        if (!in_array($sortBy, ['priority', 'due_date'])) {
            $sortBy = 'priority';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $tasks = Task::with('categories')
            ->where('user_id', $userId)
            ->orderBy($sortBy, $direction)
            ->get();

        $categories = Category::all();

        return view('alltasks', compact(['tasks', 'categories']));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Task.addnewtask', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tasks = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1500',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'priority' => 'required',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Pending',
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'user_id' => Auth::user()->id,
        ]);

        $task->Categories()->sync($request->categories);

        return redirect()->route('alltasks.index')->with('success', 'Task added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task, $id)
    {
        $task = Task::with('Categories')->findOrFail($id);
        return view('Task.singletask', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tasks = Task::findOrFail($id);
        if (Auth::user()->id == $tasks->user_id) {
            $task = Task::with('Categories')->findOrFail($id);
            $categories = Category::all();
            return view('Task.updatetask', compact(['task', 'categories']));
        } else {
            return redirect()->route('alltasks.index')->with('error', 'You are not valid User!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tasks = Task::findOrFail($id);
        if (Auth::user()->id == $tasks->user_id) {

            $tasks = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1500',
                'categories' => 'required|array',
                'categories.*' => 'exists:categories,id',
            ]);

            $task = Task::with('categories')->findOrFail($id);

            $task->update([
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'due_date' => $request->due_date,
            ]);

            $task->Categories()->sync($request->categories);
            // return $task;
            return redirect()->route('alltasks.edit', $id)->with('success', 'Task updated successfully!');
        } else {
            return redirect()->route('alltasks.index')->with('error', 'You are not valid User!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, $id)
    {
        $tasks = Task::findOrFail($id);

        if (Auth::user()->id == $tasks->user_id) {

            $task = Task::with('Categories')->findOrFail($id);
            $task->delete();
            foreach ($task->categories as $category) {
                $task->Categories()->detach($category->id);
            }
            if ($task) {
                return redirect()->back()->with('success', 'Tasks Deleted successfully!');
            } else {
                return redirect()->back()->with('error', 'Error, Task not deleted. Try Again!');
            }
        } else {
            return redirect()->route('alltasks.index')->with('error', 'You are not valid User!');
        }
    }

    // for soft delete

    public function softdelete($id)
    {
        $tasks = Task::findOrFail($id);

        if (Auth::user()->id == $tasks->user_id) {
            $task = Task::with('Categories')->findOrFail($id);
            $task->delete();
            return redirect()->back()->with('success', 'Task Deleted Successfully!');
        } else {
            return redirect()->route('alltasks.index')->with('error', 'You are not valid User!');
        }
    }

    public function softdeleteRetrive($id)
    {
        // $tasks = Task::onlyTrashed()->findOrFail($id);

        if (Auth::user()->id == $id) {
            $tasks = Task::with(['Categories'])->onlyTrashed()->get();
            return view('Task.trashedtasks', compact('tasks'));
        } else {
            return redirect()->route('alltasks.index')->with('error', 'You are not valid User!');
        }
    }

    public function softdeleteShow($id)
    {
        $tasks = Task::onlyTrashed()->findOrFail($id);

        if (Auth::user()->id == $tasks->user_id) {
            $task = Task::with(['Categories'])->onlyTrashed()->findOrFail($id);
            // return $task;
            return view("Task.singletask", compact("task"));
        } else {
            return redirect()->route('alltasks.index')->with('error', 'You are not valid User!');
        }
    }

    public function softdeleteRollback($id)
    {
        $tasks = Task::onlyTrashed()->findOrFail($id);

        if (Auth::user()->id == $tasks->user_id) {

            $task = Task::with(['Categories'])->onlyTrashed()->findOrFail($id);

            $task->restore();
            return redirect()->route('tasks.softdelete.retrive',Auth::user()->id)->with('soft-delete-retrive-success', 'Product RollBack Successfully!');
        } else {
            return redirect()->route('alltasks.index')->with('error', 'You are not valid User!');
        }
    }
    public function alltrashDelete()
    {
        $products = Task::with(['Categories'])->onlyTrashed()->get();
        foreach ($products as $product) {
            $product->forceDelete();
        }

        return redirect()->route('tasks.softdelete.retrive')->with('success','All Tresh Products Deleted Successfully!');
    }
}

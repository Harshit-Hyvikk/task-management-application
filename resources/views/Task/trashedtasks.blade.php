@extends('components.layout')

@section('title')
    Trashed
@endsection

@section('main-content')
    <main>
        <div class="container mt-5">
            <div class="row">
                <div class="col-10  mt-2">
                    <h3 class="my-2"><i class="fa fa-tasks" aria-hidden="true"></i> Tresh Tasks</h3>
                </div>
                <div class="col-2  mt-2">
                    <a href="{{ route('alltrash.delete') }}" class=" btn btn-danger my-2">Delete All Product</a>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <form method="GET" action="{{ route('alltasks.index') }}" class=" d-flex gap-4  ">
                            <label for="sort_by"class="mt-1"><strong>Sort By:</strong></label>
                            <div class="">
                                <select name="sort_by" id="sort_by" onchange="this.form.submit()"
                                    class="form-select rounded-3 border-primary">
                                    <option value="priority" {{ request('sort_by') == 'priority' ? 'selected' : '' }}>
                                        Priority
                                    </option>
                                    <option value="due_date" {{ request('sort_by') == 'due_date' ? 'selected' : '' }}>
                                        Due Date
                                    </option>
                                </select>

                            </div>
                            <div>
                                <select name="direction" id="direction" onchange="this.form.submit()"
                                    class="form-select rounded-3 border-primary">
                                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>
                                        Ascending
                                    </option>
                                    <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>
                                        Descending
                                    </option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 my-3">
                    <table id="tasksTable"
                        class="table table-striped table-bordered table-inverse table-responsive-sm table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Index</th>
                                <th class="col-2">Title</th>
                                <th>Description</th>
                                <th>Task Category</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Due Date</th>
                                <th class="text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($tasks->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center"> No tasks </td>
                                </tr>
                            @endif
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($tasks as $task)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                        @foreach ($task->categories as $category)
                                            {{ $category->name }}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ $task->status }}</td>
                                    <td>{{ $task->priority }}</td>
                                    <td>{{ $task->due_date->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('tasks.softdelete.show', $task->id) }}"
                                            class="btn btn-primary btn-sm mt-2">View</a>

                                        <a href="{{ route('tasks.softdelete.rollback', $task->id) }}"
                                            class="btn btn-info btn-sm mt-2">RollBack</a>

                                        <x-form action="{{ route('tasks.softdelete', $task->id) }}" method="DELETE"
                                            onsubmit="return confirm('Are you sure?');">
                                            <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                                        </x-form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

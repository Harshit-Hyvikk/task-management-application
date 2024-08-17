@extends('components.layout')


@section('title')
    Update Tasks
@endsection

@section('main-content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-10  mt-2">
                    <h3 class="my-2">Update Task</h3>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 mt-2">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-12 m-2">
                    <x-form action="{{ route('alltasks.update', $task->id) }}" method="PUT">
                        <div class="form-group">
                            <label for="title">Task Title</label>
                            <input type="text" class="form-control mt-2" name="title" id="title"
                                placeholder="Task Title" value="{{ old('title', $task->title) }}" required>
                            @error('title')
                                <div class=" text-red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="description">Task Description</label>
                            <textarea class="form-control mt-2" name="description" id="description" required>{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class=" text-red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="categories">Task Categories</label>
                            <div class="mb-3">
                                <select class="form-control" id="categories" name="categories[]" multiple required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($task->categories->contains($category->id)) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('categories')
                                <div class=" text-red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Pending" @if (old('status', $task->status) === 'Pending') selected @endif>Pending</option>
                                <option value="In Progress" @if (old('status', $task->status) === 'In Progress') selected @endif>In Progress
                                </option>
                                <option value="Completed" @if (old('status', $task->status) === 'Completed') selected @endif>Completed
                                </option>
                                <option value="Cancelled" @if (old('status', $task->status) === 'Cancelled') selected @endif>Cancelled
                                </option>
                            </select>
                            @error('status')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control" id="due_date" name="due_date"
                                value="{{ old('due_date', \Carbon\Carbon::parse($task->due_date)->format('Y-m-d')) }}"
                                required>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Update Task</button>
                        <a href="{{ route('alltasks.index') }}" class="btn btn-outline-primary mt-3 ms-2">All Tasks</a>
                    </x-form>
                </div>
            </div>
        </div>
    </main>
@endsection

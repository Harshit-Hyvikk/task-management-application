@extends('components.layout')

@section('title')
Add New Task
@endsection

@section('main-content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-10  mt-2">
                <h3 class="my-2">Add New Task</h3>
            </div>
        </div>
        <div class="row">
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
                <x-form action="{{ route('alltasks.store') }}" >
                    <div class="form-group">
                        <label for="title">Task Title</label>
                        <input type="text" class="form-control mt-2" name="title" id="title"
                            aria-describedby="helpId" placeholder="Task Title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label for="description">Task Description</label>
                        <textarea class="form-control mt-2" name="description" id="description" aria-describedby="helpId"
                            placeholder="Task Description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mt-2">
                        <label for="categories">Task Categories</label>
                        <select class="form-control mt-2" id="categories" name="categories[]" multiple required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categories[]')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority" class="form-control">
                            <option value="high" {{ old('priority', $task->priority ?? '') === 'high' ? 'selected' : '' }}>High</option>
                            <option value="medium" {{ old('priority', $task->priority ?? '') === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="low" {{ old('priority', $task->priority ?? '') === 'low' ? 'selected' : '' }}>Low</option>
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date"
                            value="{{ old('due_date') }}" required>
                        @error('due_date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                    <a href="{{url()->previous()}}" class="btn btn-primary mt-3">Back</a>
                </x-form>
            </div>
        </div>
    </div>
</main>
@endsection


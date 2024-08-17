@extends('components.layout')

@section('title')
    Task Details
@endsection

@section('main-content')
    <main>
        <div class="container align-middle mt-5">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        Task Details
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <p><strong>Task Title:</strong> {{ $task->title }}</p>
                            <p><strong>Description:</strong> {{ $task->description }}</p>
                            <p><strong>Status:</strong> {{ $task->status }}</p>
                            <p><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</p>
                            <p><strong>Categories:</strong></p>
                            <ul>
                                @foreach ($task->categories as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

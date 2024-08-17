@extends('components.layout')

@section('title')
    All Category
@endsection

@section('main-content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6 mt-3">
                    <h3 class="my-2">Categories</h3>
                </div>
                <div class="col-2 mt-3">
                    <a href="{{ route('allcategories.create') }}" class=" btn btn-primary my-2">Add New Category</a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-8 my-3">
                    <table id="tasksTable"
                        class="table table-striped table-bordered table-inverse table-responsive table-hover align-middle">
                        <thead class="thead-inverse">
                            <tr class="table-dark">
                                <th>Index</th>
                                <th>Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center"> <-- No tasks --> </td>
                                </tr>
                            @endif
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($categories as $category)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td scope="row">{{ $i }}</td>

                                    <td scope="row">{{ $category->name }}</td>

                                    <td scope="row" class="d-flex gap-2">
                                        <a href="{{ route('allcategories.show', $category->id) }}"
                                            class="btn btn-outline-primary btn-sm">View</a>
                                        <a href="{{ route('allcategories.edit', $category->id) }}"
                                            class="btn btn-outline-success btn-sm">Update</a>
                                        <x-form action="{{ route('allcategories.destroy', $category->id) }}" method="DELETE"
                                            onsubmit="return confirm('Are you sure?');">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
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

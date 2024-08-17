@extends('components.layout')

@section('title')
    Category Details
@endsection

@section('main-content')
    <main>
        <div class="container align-middle mt-5">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        Category Details
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <p>Category Name: {{ $category->name }}</p>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

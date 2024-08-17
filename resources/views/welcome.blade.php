@extends('components.layout')

@section('main-content')
    <main class="mt-6">
        <div class="container">
            <div class=" my-2  d-sm-flex flex-wrap gap-2">

                <div class="col-md-3 col-sm-5 col-12 mt-2">
                    <div class="card  border-success">
                        <div class="card-body d-flex  justify-content-between">
                            <div>
                                <h5 class="card-title mb-0 fs-5 ">All Tasks</h5>
                                <p class="card-text"><span class="info-box-number">
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($tasks as $task)
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                        {{ $count }}
                                    </span>
                                </p>
                            </div>
                            <div class="me-3 bg-primary text-white rounded-circle px-3 py-2 fs-5">
                                <i class="fa-solid fa-arrow-right mt-1 pt-1"></i>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-5 col-12 mt-2">
                    <div class="card  border-success">
                        <div class="card-body d-flex  justify-content-between">
                            <div>
                                <h5 class="card-title mb-0 fs-5 ">All Categories</h5>
                                <p class="card-text"><span class="info-box-number">
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($categories as $cat)
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                        {{ $count }}
                                    </span>
                                </p>
                            </div>
                            <div class="me-3 bg-primary text-white rounded-circle px-3 py-2 fs-5">
                                <i class="fa-solid fa-arrow-right mt-1 pt-1"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 align-middle">
                    <a href="{{ route('alltasks.index') }}" class="btn btn-warning">Task Lists</a>
                    <a href="{{ route('allcategories.index') }}" class="btn btn-primary">Task Category</a>
                </div>
            </div>
        </div>
    </main>
@endsection

@extends('components.layout')

@section('title')
    Add New Category
@endsection

@section('main-content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-10  mt-2">
                    <h3 class="my-2">Add New Category</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 m-2">
                    <x-form action="{{ route('allcategories.store') }}">
                      <div class="form-group ">
                            <label for="cname">Category Name</label>
                            <input type="text" class="form-control mt-2" name="cname" id="cname"
                                aria-describedby="helpId" placeholder="Category Name">
                            @error('cname')
                                <div class="container text-red">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </x-form>
                </div>
            </div>
        </div>
    </main>
@endsection

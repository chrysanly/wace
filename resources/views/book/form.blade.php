@extends('layouts.base')

@push('style')
@endpush

@push('script')
    
@endpush

@section('content')
    <div class="container">
        <div class="row">
            @if (session('alert'))
                <div class="container">
                    <div class="alert alert-{{ session('alert.context', 'info') }} alert-dismissible fade show"
                        role="alert">
                        @if (session('alert.title'))
                            <strong>{{ session('alert.title') }}</strong>
                        @endif

                        {{ session('alert.message') }}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="card col-md-8 mx-auto">
                <div class="card-header">Book Form</div>
                <div class="card-body">
                    <form action="{{ url('/books/book', isset($book) ? $book->id : '') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- {{ method_field($method) }}
                        @if ($method === 'PATCH')
                            <div class="mb-3 float-end">
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                    data-target="#deleteBook">Delete Book</button>
                            </div>
                        @endif --}}
                        <br>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', isset($book) ? $book->name : '') }}" id="exampleFormControlInput1"
                                placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Author</label>
                            <input type="text" class="form-control" name="author"
                                value="{{ old('author', isset($book) ? $book->author : '') }}" id="exampleFormControlInput1"
                                placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Cover</label>
                            <input type="file" class="form-control" name="cover" id="exampleFormControlInput1">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- 
   
@endsection

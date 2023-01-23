@extends('layouts.base')

@push('style')
    <style>
        .search-users {
            margin-top: -60px;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@push('script')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script>
        $('#deleteBook').on('click', function(e) {
            e.preventDefault();
            $('#delete-form').trigger('submit');
        });
    </script>
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

            <div class="card-body p-0 table-responsive">
                <a href="{{ route('book.create') }}" class="btn btn-outline-primary ">Create Book</a>
                <a class="btn btn-secondary shadow-sm float-right mr-2" data-bs-toggle="modal"
                    data-bs-target="#importBook">Import</a>
                <a class="btn btn-secondary shadow-sm float-right mr-2" href="{{ route('book.export') }}">Export</a>

                <form action="/books" method="GET" class="form-inline float-end search-users mt-2">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search" name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-active-user" role="tabpanel"
                        aria-labelledby="pills-active-user-tab">
                        <table class="table m-0 table-sm table-hover">
                            <thead>
                                <tr class="text-uppercase">
                                    <th></th>
                                    <th scope="col">
                                        Name
                                        <a
                                            href="/books?sort_type={{ request('sort_val') === 'name' && request('sort_type') === 'up' ? 'down' : 'up' }}&sort_val=name&search={{ request('search') }}"><i
                                                class="fa {{ request('sort_val') === 'name' && request('sort_type') === 'up' ? 'fa-sort-up' : (request('sort_val') === 'name' && request('sort_type') === 'down' ? 'fa-sort-down' : 'fa-sort') }}"
                                                data-fa-transform="shrink-6"></i>
                                        </a>
                                    </th>
                                    <th scope="col">
                                        Author
                                        <a
                                            href="/books?sort_type={{ request('sort_val') === 'author' && request('sort_type') === 'up' ? 'down' : 'up' }}&sort_val=author&search={{ request('search') }}"><i
                                                class="fa {{ request('sort_val') === 'author' && request('sort_type') === 'up' ? 'fa-sort-up' : (request('sort_val') === 'author' && request('sort_type') === 'down' ? 'fa-sort-down' : 'fa-sort') }}"
                                                data-fa-transform="shrink-6"></i>
                                        </a>
                                    </th>
                                    <th scope="col">
                                        Creation Date
                                        <a
                                            href="/books?sort_type={{ request('sort_val') === 'created' && request('sort_type') === 'up' ? 'down' : (request('sort_type') === null ? 'down' : 'up') }}&sort_val=created&search={{ request('search') }}"><i
                                                class="fa {{ request('sort_val') === 'created' && request('sort_type') === 'up' ? 'fa-sort-up' : (request('sort_val') === 'created' && request('sort_type') === 'down' ? 'fa-sort-down    ' : (request('sort_val') === null ? 'fa-sort-up' : 'fa-sort')) }}"
                                                data-fa-transform="shrink-6"></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($books as $book)
                                    <tr>
                                        <th scope="row" class="align-middle">
                                           <img src=" {{ $book->cover }}" width="100" alt="">
                                        </th>
                                        <td scope="row" class="align-middle">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#bookDetails{{ $book->id }}">
                                                {{ $book->name }}
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            {{ $book->author }}
                                        </td>
                                        <td class="text-monospace small">
                                            {{ $book->created_at->toCookieString() }}
                                        </td>
                                    </tr>

                                    @include('partials.modal-edit')
                                    @include('partials.modal-delete')



                                @empty
                                    <tr>
                                        @if (request('search') != null)
                                            <td colspan="5">No results found</td>
                                        @else
                                            <td colspan="5">You don't have any users</td>
                                        @endif
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.modal-import')

@endsection

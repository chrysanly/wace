<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Jobs\ExportBook;
use App\Jobs\ImportBook;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        Session::put('navActive', 'book');

        $book = Book::query();
        // $book->orderBy('name', 'asc');

        if (request('search')) {
            $book->where(function ($query) {
                $query->where('name', 'LIKE', '%' . request('search') . '%');
            });
        }
        if (request('sort_type') === 'up') {
            if (request('sort_val') === 'name') {
                $book->orderBy('name', 'desc');
            }
            if (request('sort_val') === 'author') {
                $book->orderBy('author', 'desc');
            }

            if (request('sort_val') === 'created') {
                $book->orderBy('created_at', 'desc');
            }
        }

        if (request('sort_type') === 'down') {
            if (request('sort_val') === 'name') {
                $book->orderBy('name', 'asc');
            }
            if (request('sort_val') === 'author') {
                $book->orderBy('author', 'asc');
            }

            if (request('sort_val') === 'created') {
                $book->orderBy('created_at', 'asc');
            }
        }

        if (!request('sort_val') && !request('sort_type')) {
            $book->orderBy('name', 'asc');
        }

        return view('book.index', ['books' => $book->get()]);
    }

    public function create()
    {
        return view('book.form', ['method' => 'POST']);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'unique:books,name'],
            'author' => ['required', 'unique:books,author'],
        ]);
        $cover = $this->handleUpload(request()->cover, 'library');
        $book = new Book();
        $book->name = request()->name;
        $book->author = request()->author;
        $book->cover = $cover;
        $book->save();
        return redirect()->route('book.index');
    }

    public function edit(Book $book)
    {

        return view('book.form', [
            'method' => 'PATCH',
            'book' => $book,
        ]);
    }
    public function update($book)
    {

        request()->validate([
            'name' => ['required'],
            'author' => ['required'],
        ]);
        $data = Book::find($book);



        $data->name = request()->name;
        $data->author = request()->author;
        $data->cover = '';
        $data->save();

        return redirect()->route('book.index');
    }
    public function delete($book)
    {
        $data = Book::find($book);
        $data->delete();

        return redirect()->route('book.index');
    }

    public function import()
    {
        $random = Str::random(10) . '.csv';
        request()->file('csvFile')->storeAs('public/csv', $random);
        ImportBook::dispatch(Auth::user()->email, $random);
        return redirect()->back();
    }
    public function export()
    {
        $random = Str::random(10) . '.csv';
        ExportBook::dispatch(Auth::user()->email, $random);
        return redirect()->back();
    }
}

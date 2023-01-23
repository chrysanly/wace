<?php

namespace Tests\Feature\Book;

use App\Http\Controllers\Book\BookController;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function testUserCanViewBookIndex()
    {
        $this->loginUser();
        $response = $this->get('books');

        $response->assertStatus(200);
    }
    public function testUserCanViewBookForm()
    {
        $this->loginUser();
        $response = $this->get('books/create');

        $response->assertStatus(200);
    }
    public function testUserCanCreateBook()
    {
        $this->loginUser();
        $this->post(action([BookController::class, 'store']), [
            'name' => 'test name',
            'author' => 'test aurhor',
            'cover' => '',
        ]);

        $this->assertDatabaseHas('books', ['name' => 'test name']);
    }

    public function testUserCanUpdateBook()
    {
        $this->loginUser();
        $book = Book::factory()->create();

        $data = [
            'name' => $this->faker()->name,
            'author' => $this->faker()->name,
            'cover' => ''
        ];
        $this->patch(route('book.update',$book->id), $data);
        $this->assertDatabaseHas('books',[
            'name' => $data['name'],
        ]);
    }
    public function testUserCanDeleteBook()
    {
        $this->loginUser();
        $book = Book::factory()->create();

        $this->delete(route('book.destory',$book->id));
        $this->assertDatabaseEmpty('books');
    }
}

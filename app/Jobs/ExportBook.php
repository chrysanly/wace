<?php

namespace App\Jobs;

use App\Models\Book;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ExportBook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $filename;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $filename)
    {
        $this->email = $email;
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $books = Book::get();
        $file = fopen(storage_path('app/public/csv/'.$this->filename), 'wa');
        $title = ['Name', 'Author', 'Image', 'Created Date'];
        fputcsv($file, $title);
        foreach ($books as $book) {
            fputcsv($file, [$book->name, $book->author, $book->cover, $book->created_at]);
        }
        fclose($file);
    }
}

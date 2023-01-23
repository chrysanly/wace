<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportBook implements ShouldQueue
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
        $file = fopen(storage_path('app/public/csv/'.$this->filename), 'r');
        $array = [];
        $header = null;
        while (($line = fgetcsv($file)) !== false) {
            if (! $header) {
                $header = 'active';
                continue;
            }
            $array[] = $line;
        }
        fclose($file);
        \DB::beginTransaction();
        try {
            foreach ($array as $value) {
                User::create([
                    'name' => $value[0],
                    'author' => $value[1],
                    'image' => $value[2],
                    'created_at' => $value[3],
                ]);
            }
        } catch (\Exception $error) {
            \DB::rollBack();
            throw $error;
        }
    }
}

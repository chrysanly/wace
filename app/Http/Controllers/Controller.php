<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function slugId()
    {
        $slug_id = new DateTime();
        $slug_id = $slug_id->getTimestamp();
        return $slug_id;
    }

    public function handleUpload($file, $storagePath)
    {
        $storagePath = '/' . $storagePath . '/';
        $destinationPath = public_path($storagePath);
        $newFileName = $this->slugId() . '.' . $file->extension();
        $file->move($destinationPath, $newFileName);
        // file 
        $dataName  = $storagePath . $newFileName;
        return $dataName;
    }
}

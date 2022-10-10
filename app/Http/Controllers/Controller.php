<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function photoUploader($file)
    {
//        $name = $file->getClientOriginalName();
        $path = $file->store('public/uploads/img');
        return str_replace('public', '/storage', $path) ?? $path;
    }
}

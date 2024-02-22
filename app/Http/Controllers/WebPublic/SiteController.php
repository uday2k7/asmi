<?php

namespace App\Http\Controllers\WebPublic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    /**
     * Flag for git build
     */
    public function gitPull(Request $request)
    {
        Storage::disk('root')->put('git-pull.tmp',time());
        die('Build request accepted at: '.date('Y-m-d H:i:s'));
    }
}

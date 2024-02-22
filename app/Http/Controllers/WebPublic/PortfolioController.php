<?php

namespace App\Http\Controllers\WebPublic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Flag for git build
     */
    public function index()
    {
    	return view('pages.portfolio',[
            'organization_name'=>'Home',
            //'data_arr'=>$data_arr,
        ]);
        /*Storage::disk('root')->put('git-pull.tmp',time());
        die('Build request accepted at: '.date('Y-m-d H:i:s'));*/
    }

    
}

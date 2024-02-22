<?php

namespace App\Http\Controllers\WebPublic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Flag for git build
     */
    public function index()
    {
    	return view('pages.index',[
            'organization_name'=>'Home',
            //'data_arr'=>$data_arr,
        ]);
        /*Storage::disk('root')->put('git-pull.tmp',time());
        die('Build request accepted at: '.date('Y-m-d H:i:s'));*/
    }

    public function aboutUs()
    {
    	return view('pages.about-us',[
            'organization_name'=>'About Us',
            //'data_arr'=>$data_arr,
        ]);
        /*Storage::disk('root')->put('git-pull.tmp',time());
        die('Build request accepted at: '.date('Y-m-d H:i:s'));*/
    }

    public function contactUs()
    {
    	return view('pages.contact-us',[
            'organization_name'=>'Contact Us',
            //'data_arr'=>$data_arr,
        ]);
        
    }
}

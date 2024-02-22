<?php

namespace App\Http\Controllers\WebPublic;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Flag for git build
     */
    public function services($id)
    {
        if($id==1) {
            return view('pages.services.medical',[
                'organization_name'=>'Home',
                //'data_arr'=>$data_arr,
            ]);
        } elseif($id==2) {
            return view('pages.services.home',[
                'organization_name'=>'Home',
                //'data_arr'=>$data_arr,
            ]);
        } else {
            return view('pages.services.project',[
                'organization_name'=>'Home',
                //'data_arr'=>$data_arr,
            ]);
        }

    	
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

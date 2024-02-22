<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use Redirect;
use Auth;
use App\Models\User;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() { 
        
    }
    
    public function superadminindex()
    {
        return view('superadmin.login.index');
    }

    public function index()
    {
        return view('admin.login.index');
    }

    public function superDoLogin(Request $request)
    {
        $input=$request->all();       
        $username = $input['username'];
        $password = $input['password'];
        $remember=false;
       // dd("P");
        $auth = Auth::attempt(
                    [
                        'email'  => $username,
                        'password'  => $password,
                        'is_deleted'  => '0',                 
                        'user_type'  => User::USER_TYPE_SUPERADMIN,
                        'is_locked'  => '0'   
                    ], $remember
                );        
        if ($auth) {
            if(Auth::check())
            {
                if(Auth::user()->user_type==User::USER_TYPE_SUPERADMIN)
                {
                //dd("M");
                    session()->put('username', $username);
                    //session()->put('email', $users->email);
                    session()->put('user_type', 1);
                   return Redirect::to('cpanel/user');  
                }                               
                else
                {
                   return Redirect::back()
                    ->withInput()->with('error', 'Some error occoured!');
                    
                }               
            }           
        }
        else
        {
            return Redirect::back()
            ->withInput()->with('error', 'Incorrect Username or Password');
        }
    }
    public function doLogin(Request $request)
    {
       // dd("P");
        
        $input=$request->all();       
        $username = $input['username'];
        $password = $input['password'];
       //dd($username,$password);
        $remember=false;
        
        $auth = Auth::attempt(
                    [
                        'email'  => $username,
                        'password'  => $password,
                        'is_deleted'  => '0',                 
                        'user_type'  => '2',
                        'is_locked'  => '0'   
                    ], $remember
                );  
      //  dd(Auth::user()->name);
        //dd($password);
       // dd($auth);
        if ($auth) {
            if(Auth::check())
            {
                //KLPS0000021419
                //if(Auth::user()->account_type=="1")
                //{
                //dd("M");
                    session()->put('username', $username);
                    //session()->put('email', $users->email);
                    session()->put('user_type', 2);
                   return Redirect::to('admin/campaign/list');  
                //}                
                //else
                //{
                //   return Redirect::to('/customer/dashboard');
                    
                //}               
            }           
        }
        else
        {
            return Redirect::back()
            ->withInput()->with('error', 'Incorrect Username or Password');
        }
    }

    public function logout()
    {
        if(Auth::user()->user_type=="1")
        {
            Auth::logout();     
            return Redirect::to('/cpanel/login')
            ->withInput()
            ->with('message', 'You have logout successfully.');
        }
        if(Auth::user()->user_type=="2")
        {
            Auth::logout();     
            return Redirect::to('/admin/login')
            ->withInput()
            ->with('message', 'You have logout successfully.');
        }
        else
        {
            Auth::logout();     
            return Redirect::to('/admin/login')
            ->withInput()
            ->with('message', 'You have logout successfully.');
        }
    }

}

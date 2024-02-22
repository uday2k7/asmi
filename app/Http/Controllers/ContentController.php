<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use Redirect;
use Auth;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() { 
        
    }
    
    public function add()
    {        
        return view('influencer.index');
    }

    public function store(Request $request)
    {
        //dd("Z");
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'min:6|required_with:repeat_password|same:repeat_password',
            'repeat_password' => 'min:6'
        ]);
        if ($validator->fails()) {
            return redirect('admin/add')
                ->withErrors($validator)
                ->withInput();
        }
        
        $input=$request->all();   
        $password=Hash::make($input['password']); 
       // dd($input);
        DB::beginTransaction();
        try {

            $user = new User();
            $user->full_name=$input['full_name'];
            $user->email=$input['email'];
            $user->password=$password;        
            $user->user_type=2;
            $user->date_of_birth='1970-01-01';
            //$user->genre_ids=NULl;
            $user->address=NULl;
           // $user->location=NULl;
            $user->save();
            $user_id=$user->id;
            
            

            DB::commit();
            return Redirect::to('admin/add')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            
            return Redirect::to('admin/add')->with('error', 'Unable to add data.'.$e->getMessage());
        }   
        
    }

    

}

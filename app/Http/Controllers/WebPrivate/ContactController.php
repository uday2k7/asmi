<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Organization;
use App\Models\Contact;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;



class ContactController extends Controller
{
    public function index()
    {
        //dd("a");
        $activitie=Contact::where('deleted',0)->orderBy('id','DESC')->get();
       
        $data=[];
        foreach($activitie as $details)
        {
            $data[]=[
                'id' =>$details->id,
                'name' =>$details->name,
                'email' =>$details->email,
                'contact' =>$details->contact,
                'message' =>$details->message,
                'status' =>$details->status,
                'deleted' =>$details->deleted,
                'created_at' =>$details->created_at,
                'updated_at' =>$details->updated_at,
            ];
        }
        //dd($data);
        return view('superadmin.contact.index',[
            'data'=>$data,
            'title'=>'Contact List'
        ]);
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'contact_no' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('contact-us')
                ->withErrors($validator)
                ->withInput();
        }

        $input=$request->all();
       

        DB::beginTransaction();
        try {
    

            $activitiy = new Contact();
            $activitiy->name=$input['name'];
            $activitiy->email=$input['email'];
            $activitiy->contact=$input['contact_no'];
            $activitiy->message=$input['message'];
            $activitiy->status=1;        
            $activitiy->deleted=0;
            $activitiy->save();
            DB::commit();
            return Redirect::to('contact-us')->with('message', 'Thank you for getting in touch! 

We appreciate you contacting us. One of our colleagues will get back in touch with you soon!Have a great day!');
        }catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('contact-us')->with('error', $e->getMessage());
        }


    }

    public function display($id)
    {
        $emotion=Activitiy::where('id',$id)->first();
        if($emotion->display==0) {
            $display=1;
        }
        else
        {
            $display=0;
        }
        DB::beginTransaction();
        try {
            Activitiy::where('id', $id)->update([
                'display'    => $display
            ]);            

            DB::commit();
            return Redirect::to('cpanel/activities')->with('message', 'Data updated successfully.');
        }
        catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/activities')->with('error', 'Unable to updated data.');
        }
    }
    
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            Activitiy::where('id', $id)->update([
                'deleted'    => 1
            ]);            

            DB::commit();
            return Redirect::to('cpanel/activities')->with('message', 'Data deleted successfully.');
        }
        catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/activities')->with('error', 'Unable to delete data.');
        }

    }
}

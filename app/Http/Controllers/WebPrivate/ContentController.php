<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Organization;
use App\Models\Content;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;



class ContentController extends Controller
{
    public function show($id)
    {
        //dd($id);
        $content=Content::where('status',1)->where('id',$id)->first();
       
        $data=[];
        if($content->id==2)
        {
            $page_heading="Evaluation";
        }
        elseif($content->id==3)
        {
            $page_heading="Support";
        }
        elseif($content->id==4)
        {
            $page_heading="Medical Equipments";
        }
        elseif($content->id==5)
        {
            $page_heading="Home Health Care Service";
        }
        elseif($content->id==6)
        {
            $page_heading="Project Consultation";
        }
        else
        {
            $page_heading="Review & Analysis";
        }
        $data[]=[
            'id' =>$content->id,
            'heading' =>$content->heading,
            'content_details' =>$content->content_details,
            'status' =>$content->status,
            'created_at' =>$content->created_at,
            'updated_at' =>$content->updated_at,
        ];
        return view('superadmin.content.index',[
            'data'=>$data,
            'title'=>$page_heading
        ]);
    }
    /**
     * API Register
     *
     * @param Request $request
     * @return array
     */
    public function register(Request $request): array
    {
        die('from web private');
    }

     public function edit($id)
    {
        $content=Content::where('id',$id)->first();
        if($content->id==2)
        {
            $page_heading="Evaluation";
        }
        elseif($content->id==3)
        {
            $page_heading="Support";
        }
        elseif($content->id==4)
        {
            $page_heading="Medical Equipments";
        }
        elseif($content->id==5)
        {
            $page_heading="Home Health Care Service";
        }
        elseif($content->id==6)
        {
            $page_heading="Project Consultation";
        }
        else
        {
            $page_heading="Review & Analysis";
        }
        $data_arr=[
            'id'=>$content->id,
            'heading'=>$content->heading,
            'content_details'=>$content->content_details,
        ];
        
        return view('superadmin.content.edit',[
            'title'=>"Update ".$page_heading,
            'data'=>$data_arr,
            'id'=>$id,
        ]);
    }

    public function contentupdate(Request $request)
    {
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'heading' => 'required|string|max:255',
            'content_details' => 'required|string|max:255',
        ]);

        $input=$request->all();
        $id=$input['id'];
        $heading=$input['heading'];
        $content_details=$input['content_details'];
       
        if ($validator->fails()) {
            return redirect('cpanel/content/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            // Update Details
            Content::where('id', $id)->update([
                'heading'    => $heading,
                'content_details'    => $content_details
            ]);
            DB::commit();
            return Redirect::to('cpanel/content/'.$id)->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/content/'.$id)->with('error', $msg);
        }
        
    }
    /*public function store(Request $request)
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


    }*/

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

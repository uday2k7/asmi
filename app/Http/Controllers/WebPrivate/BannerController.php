<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Organization;
use App\Models\Bannerinner;
use App\Models\Banner;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;
use App\Helper\imagehelper;



class BannerController extends Controller
{
    public function home()
    {
        $banner=Banner::where('deleted',0)->get();
       
        $data=[];
        foreach($banner as $details)
        {
            $data[]=[
                'id' =>$details->id,
                'image' =>$details->image,
                'heading' =>$details->heading,
                'description' =>$details->description,
                'display' =>$details->status,
                'deleted' =>$details->deleted,
                'created_at' =>$details->created_at,
                'updated_at' =>$details->updated_at,
            ];
        }
       
        return view('superadmin.banner.home',[
            'data'=>$data,
            'title'=>'Contact List'
        ]);
    }



    public function homeedit($id)
    {
        $solution=Banner::where('id',$id)->first();
       
        
        $image=url($solution->image);
        $data=[
            'id' =>$solution->id,
            'heading' =>$solution->heading,
            'description' =>$solution->description,
            'image' =>$image,
            'status' =>$solution->status,
            'created_at' =>$solution->created_at,
            'updated_at' =>$solution->updated_at,
        ];
        
        return view('superadmin.banner.home_edit',[
            'data'=>$data,
            'title'=>"Update Our Expertise",
        ]);
    }




    public function homeupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $input=$request->all();
        $id=$input['id'];
        $heading=$input['heading'];
        $description=$input['description'];
       
        if ($validator->fails()) {
            return redirect('cpanel/banner/home/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }


        DB::beginTransaction();
        try {            
            Banner::where('id', $id)->update([
                'heading'    => $heading,
                'description'    => $description
            ]);

            if($request->hasFile('file')){ 
                $this->validate($request, [
                    'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                ]);

                $upload_path=public_path('upload_path/');
                $image = $request->file('file');
                $fileName=rand(1,11111).time().'.'.$image->getClientOriginalExtension();
               
                $img_to_resize =imagehelper::resize_fixed($request->file('file'),$fileName,$upload_path,1920,1150);
                $image=url('upload_path/'.$img_to_resize);
                Banner::where('id', $id)->update([
                    'image'    => $image
                ]);                
            }

            DB::commit();
            return Redirect::to('cpanel/banner/home/')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/banner/home/')->with('error', $msg);
        }
    }

    public function inner()
    {
        $bannerinner=Bannerinner::where('deleted',0)->get();
       
        $data=[];
        foreach($bannerinner as $details)
        {
            //dd($details->image);
            $data[]=[
                'id' =>$details->id,
                'page_name' =>$details->page_name,
                'image' =>$details->image,
                'heading_text' =>$details->heading_text,
                'description' =>$details->description,
                'updated_at' =>$details->updated_at,
            ];
        }
        return view('superadmin.banner.inner',[
            'data'=>$data,
            'title'=>'Inner Page Banner Text'
        ]);
    }

    public function inneredit($id)
    {
        $bannerinner=Bannerinner::where('id',$id)->first();

        $data_arr=[
            'id'=>$bannerinner->id,
            'page_name'=>$bannerinner->page_name,
            'image'=>$bannerinner->image,
            'heading_text'=>$bannerinner->heading_text,
            'description'=>$bannerinner->description,
        ];
        
        return view('superadmin.banner.inneredit',[
            'title'=>'Update Inner Banner',
            'data'=>$data_arr,
            'id'=>$id,
        ]);
    }

    public function innerupdate(Request $request)
    {
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'heading_text' => 'required|string|max:255',
        ]);

        $input=$request->all();
        $id=$input['id'];
        $heading_text=$input['heading_text'];
        $description=$input['description'];
       
        if ($validator->fails()) {
            return redirect('cpanel/banner/inner/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        DB::beginTransaction();
        try {
            // Update Details
            Bannerinner::where('id', $id)->update([
                'heading_text'    => $heading_text,
                'description'    => $description
            ]);

            if($request->hasFile('icon_name')){ 

                $this->validate($request, [
                    'icon_name' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                ]);

                $upload_path=public_path('upload_path/');
                $image = $request->file('icon_name');
                $fileName=rand(1,11111).time().'.'.$image->getClientOriginalExtension();
               
                $img_to_resize =imagehelper::resize_fixed($request->file('icon_name'),$fileName,$upload_path,1920,1150);
                $image=url('upload_path/'.$img_to_resize);
                Bannerinner::where('id', $id)->update([
                    'image'    => $image
                ]);                
            }
            DB::commit();
            return Redirect::to('cpanel/banner/inner')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/banner/inner')->with('error', $msg);
        }
        
    }
}

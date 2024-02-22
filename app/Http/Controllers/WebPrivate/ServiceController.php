<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Organization;
use App\Models\Expertise;
use App\Models\Solution;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;
use App\Models\Item;
use App\Models\Itemdetails;
use Image;
use File;
use App\Helper\imagehelper;



class ServiceController extends Controller
{
    public function our_expertise()
    {
        $expertise=Expertise::where('status',1)->get();
       
        $data=[];        
        foreach ($expertise as $details) {
            $image=url($details->image);
            $data[]=[
                'id' =>$details->id,
                'heading' =>$details->heading,
                'content' =>$details->content,
                'image' =>$image,
                'status' =>$details->status,
                'created_at' =>$details->created_at,
                'updated_at' =>$details->updated_at,
            ];
        }
        
        return view('superadmin.service.our_expertise',[
            'data'=>$data,
            'title'=>"Our Expertise",
        ]);
    }


    public function our_expertise_edit($id)
    {
        $solution=Expertise::where('id',$id)->first();
       
        
        $image=url($solution->image);
        $data=[
            'id' =>$solution->id,
            'heading' =>$solution->heading,
            'content' =>$solution->content,
            'image' =>$image,
            'status' =>$solution->status,
            'created_at' =>$solution->created_at,
            'updated_at' =>$solution->updated_at,
        ];
        
        return view('superadmin.service.our_expertise_edit',[
            'data'=>$data,
            'title'=>"Update Our Expertise",
        ]);
    }




    public function our_expertise_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'content' => 'required|string|max:255',
        ]);

        $input=$request->all();
        $id=$input['id'];
        $heading=$input['heading'];
        $content=$input['content'];
       
        if ($validator->fails()) {
            return redirect('cpanel/service/our-expertise-edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }


        DB::beginTransaction();
        try {            
            Expertise::where('id', $id)->update([
                'heading'    => $heading,
                'content'    => $content
            ]);

            if($request->hasFile('file')){ 
                $this->validate($request, [
                    'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                ]);

                $upload_path=public_path('upload_path/');
                $image = $request->file('file');
                $fileName=rand(1,11111).time().'.'.$image->getClientOriginalExtension();
               
                $img_to_resize =imagehelper::resize_fixed($request->file('file'),$fileName,$upload_path,416,292);
                $image=url('upload_path/'.$img_to_resize);
                Expertise::where('id', $id)->update([
                    'image'    => $image
                ]);                
            }

            DB::commit();
            return Redirect::to('cpanel/service/our-expertise/')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/service/our-expertise/')->with('error', $msg);
        }
    }


    public function our_solutions()
    {
        $expertise=Solution::where('status',1)->get();
       
        $data=[];        
        foreach ($expertise as $details) {
            $image=url($details->image);
            $data[]=[
                'id' =>$details->id,
                'heading' =>$details->heading,
                'content' =>$details->content,
                'image' =>$image,
                'status' =>$details->status,
                'created_at' =>$details->created_at,
                'updated_at' =>$details->updated_at,
            ];
        }
        
        return view('superadmin.service.our_solutions',[
            'data'=>$data,
            'title'=>"Our Solutions",
        ]);
    }



    public function our_solutions_edit($id)
    {
        $solution=Solution::where('id',$id)->first();
       
        
        $image=url($solution->image);
        $data=[
            'id' =>$solution->id,
            'heading' =>$solution->heading,
            'content' =>$solution->content,
            'image' =>$image,
            'status' =>$solution->status,
            'created_at' =>$solution->created_at,
            'updated_at' =>$solution->updated_at,
        ];
        
        return view('superadmin.service.our_solutions_edit',[
            'data'=>$data,
            'title'=>"Update Our Solutions",
        ]);
    }



    public function our_solutions_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'content' => 'required|string|max:255',
        ]);

        $input=$request->all();
        $id=$input['id'];
        $heading=$input['heading'];
        $content=$input['content'];
       
        if ($validator->fails()) {
            return redirect('cpanel/service/our-solutions-edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }


        DB::beginTransaction();
        try {            
            Solution::where('id', $id)->update([
                'heading'    => $heading,
                'content'    => $content
            ]);

            if($request->hasFile('file')){ 
                $this->validate($request, [
                    'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                ]);

                $upload_path=public_path('upload_path/');
                $image = $request->file('file');
                $fileName=rand(1,11111).time().'.'.$image->getClientOriginalExtension();
               
                $img_to_resize =imagehelper::resize_fixed($request->file('file'),$fileName,$upload_path,416,381);
                $image=url('upload_path/'.$img_to_resize);
                Solution::where('id', $id)->update([
                    'image'    => $image
                ]);                
            }

            DB::commit();
            return Redirect::to('cpanel/service/our-solutions/')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/service/our-solutions/')->with('error', $msg);
        }
    }

   
    /*public function medical_equipments()
    {
        $expertise=Expertise::where('status',1)->get();
       
        $data=[];        
        foreach ($expertise as $details) {
            $image=url($details->image);
            $data[]=[
                'id' =>$details->id,
                'heading' =>$details->heading,
                'content' =>$details->content,
                'image' =>$image,
                'status' =>$details->status,
                'created_at' =>$details->created_at,
                'updated_at' =>$details->updated_at,
            ];
        }
        
        return view('superadmin.service.medical_equipments',[
            'data'=>$data,
            'title'=>"Medical Equipments",
        ]);
    }*/



    public function items_we_offered()
    {
        $portfolio=Item::where('deleted',0)->where('type','ITEMS_WE_OFFERED')->orderBy('id','DESC')->get();
       
        $data=[];
        foreach($portfolio as $details)
        {
            $portImage=Itemdetails::where('item_id',$details->id)->orderBy('id','DESC')->first();
            $img=url('No_Image_Available.jpg');
            if($portImage)
            {
                $img=$portImage->image;
            }
                
            $data[]=[
                'id' =>$details->id,
                'heading' =>$details->name,
                'type' =>$details->type,
                'image' =>$img,
                'status' =>$details->status,
                'deleted' =>$details->deleted,
                'created_at' =>$details->created_at,
                'updated_at' =>$details->updated_at,
            ];
        }
       // dd($data);
        return view('superadmin.service.items_we_offered',[
            'data'=>$data,
            'title'=>'Items We Offered'
        ]);
    }

    public function items_we_offered_add()
    {
        $data=[];
        return view('superadmin.service.items_we_offered_add',[
            'data'=>$data,
            'title'=>"Add Item We Offered",
        ]);
    }

    public function items_we_offered_store(Request $request)
    {
       // dd("items_we_offered_store");
        $validator = Validator::make($request->all(), [
            'group_name' => 'required|string|max:255',
        ]);

        $input=$request->all();
        $group_name=$input['group_name'];
        $type='ITEMS_WE_OFFERED';

        if ($validator->fails()) {
            return redirect('cpanel/service/items-we-offered/add')
                ->withErrors($validator)
                ->withInput();
        }
        

        DB::beginTransaction();
        try {            
            $item = new Item();
            $item->name=$group_name;
            $item->type=$type;
            $item->status=1;        
            $item->deleted=0;
            $item->save();
            DB::commit();
            return Redirect::to('cpanel/service/items-we-offered')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/service/items-we-offered')->with('error', $msg);
        }
    }

    public function items_we_offered_details($id)
    {
        $portfolio=Itemdetails::where('item_id',$id)->orderBy('id','DESC')->get();
        $item=Item::where('id',$id)->first();
        $data=[];
        foreach($portfolio as $details)
        {
            $data[]=[
                'id' =>$details->id,
                'item_id' =>$details->item_id,
                'image' =>$details->image,
               // 'description' =>$details->description,
                'status' =>$details->status,
                //'deleted' =>$details->deleted,
                'created_at' =>$details->created_at,
                'updated_at' =>$details->updated_at,
            ];
        }
       
        return view('superadmin.service.items_we_offered_details',[
            'data'=>$data,
            'title'=>'Item We Offered Images',
            'id'=>$id,
            'group_name'=>$item['name']
        ]);
    }

    public function items_we_offered_details_add($id)
    {
        $data=[];
        return view('superadmin.service.items_we_offered_adddetails',[
            'data'=>$data,
            'title'=>"Add Item We Offered Images",
            'id'=>$id,
        ]);
    }

    public function items_we_offered_details_store(Request $request)
    {
        $this->validate($request, [
            'item_id' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $input=$request->all();
        $upload_path=public_path('upload_path/');
        $image = $request->file('file');
        $fileName=rand(1,11111).time().'.'.$image->getClientOriginalExtension();
       
        $img_to_resize =imagehelper::resize_fixed($request->file('file'),$fileName,$upload_path,416,416);
        $image=url('upload_path/'.$img_to_resize);
          


        DB::beginTransaction();
        try {            
            $itemdetails = new Itemdetails();
            $itemdetails->item_id=$input['item_id'];
            $itemdetails->image=$image;
            $itemdetails->status=1;  
            $itemdetails->save();
            DB::commit();
            return Redirect::to('cpanel/service/items-we-offered/details/'.$input['item_id'])->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/service/items-we-offered/details/add/'.$input['item_id'])->with('error', $msg);
        }
    }

    public function items_we_offered_details_edit($portfolio_id,$item_id)
    {
        $solution=Itemdetails::where('id',$item_id)->first();
       
        
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
        
        return view('superadmin.service.items_we_offered_editdetails',[
            'data'=>$data,
            'title'=>"Update Item We Offered Image",
            'id'=>$portfolio_id,
        ]);
    }

    public function items_we_offered_details_update(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'img_id' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $input=$request->all();
        $item_id=$input['item_id'];
        $img_id=$input['img_id'];
        if ($validator->fails()) {
            return redirect('cpanel/service/items-we-offered/details/edit/'.$item_id.'/'.$img_id)
                ->withErrors($validator)
                ->withInput();
        }


        DB::beginTransaction();
        try {  

            $upload_path=public_path('upload_path/');
            $image = $request->file('file');
            $fileName=rand(1,11111).time().'.'.$image->getClientOriginalExtension();
           
            $img_to_resize =imagehelper::resize_fixed($request->file('file'),$fileName,$upload_path,416,416);
            $image=url('upload_path/'.$img_to_resize);
            Itemdetails::where('id', $img_id)->update([
                'image'    => $image
            ]);                

            DB::commit();
            return Redirect::to('cpanel/service/items-we-offered/details/'.$item_id)->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/service/items-we-offered/details/edit/'.$item_id.'/'.$img_id)->with('error', $msg);
        }
    }

    
}

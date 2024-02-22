<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Organization;
use App\Models\Item;
use App\Models\Itemdetails;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;
use App\Helper\imagehelper;



class PortfolioController extends Controller
{
    public function list()
    {
        $portfolio=Item::where('deleted',0)->where('type','PORTFOLIO')->orderBy('id','DESC')->get();
       
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
        return view('superadmin.portfolio.list',[
            'data'=>$data,
            'title'=>'Portfolio List'
        ]);
    }


    public function add()
    {
        
        $data=[];
        return view('superadmin.portfolio.add',[
            'data'=>$data,
            'title'=>"Add Portfolio",
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_name' => 'required|string|max:255',
        ]);

        $input=$request->all();
        $group_name=$input['group_name'];
        $type='PORTFOLIO';

        if ($validator->fails()) {
            return redirect('cpanel/portfolio/list')
                ->with('error', 'Unable to add data');
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
            return Redirect::to('cpanel/portfolio/list')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/portfolio/list')->with('error', $msg);
        }
    }

    public function details($id)
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
       
        return view('superadmin.portfolio.details',[
            'data'=>$data,
            'title'=>'Portfolio Images',
            'id'=>$id,
            'group_name'=>$item['name']
        ]);
    }

    public function adddetails($id)
    {
        $data=[];
        return view('superadmin.portfolio.adddetails',[
            'data'=>$data,
            'title'=>"Add Images",
            'id'=>$id,
        ]);
    }

    public function storedetails(Request $request)
    {
       // dd("storedetails");
        $this->validate($request, [
            'item_id' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $input=$request->all();
        //d/d($input['item_id']);
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
           // $itemdetails->deleted=0;
            $itemdetails->save();
            DB::commit();
            return Redirect::to('cpanel/portfolio/list')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/portfolio/list')->with('error', $msg);
        }
    }


    public function editdetails($portfolio_id,$item_id)
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
        
        return view('superadmin.portfolio.editdetails',[
            'data'=>$data,
            'title'=>"Update Portfolio Image",
            'id'=>$portfolio_id,
        ]);
    }




    public function updatedetails(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'img_id' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $input=$request->all();
        $item_id=$input['item_id'];
        $img_id=$input['img_id'];
        //$heading=$input['heading'];
        //$description=$input['description'];
       // dd($img_id);
        if ($validator->fails()) {
            return redirect('cpanel/portfolio/list')
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
            return Redirect::to('cpanel/portfolio/details/'.$item_id)->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            $msg=$e->getMessage();
           
            return Redirect::to('cpanel/portfolio/details/'.$item_id)->with('error', $msg);
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

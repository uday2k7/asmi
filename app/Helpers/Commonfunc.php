<?php
namespace App\Helpers;

use App\Models\Content;
use App\Models\Bannerinner;
use App\Models\Banner;
use App\Models\Expertise;
use App\Models\Solution;
use App\Models\Item;
use App\Models\Itemdetails;

Class Commonfunc
{
    public static function innerBanner($page_name){
        $bannerinner=Bannerinner::where('page_name',$page_name)->where('status',1)->where('deleted',0)->first();
        
        if($bannerinner){
            $arr=[
                'image'=>$bannerinner->image,
                'heading_text'=>$bannerinner->heading_text,
                'description'=>$bannerinner->description,
            ];
        }

        return $arr;
    }

    public static function homebanner(){
       // dd("A");
        $banner=Banner::where('status',1)->where('deleted',0)->get();
        $arr=[];
        foreach ($banner as $details) {
            $arr[]=[
                'id'=>$details->id,
                'image'=>$details->image,
                'heading'=>$details->heading,
                'description'=>$details->description,
            ];
        }
            
       // dd($arr);

        return $arr;
    }

    public static function showContent($id){
        $content=Content::where('id',$id)->where('status',1)->first();
        
        if($content){
            $arr=[
                'heading'=>$content->heading,
                'content_details'=>$content->content_details,
            ];
        }

        return $arr;
    }

    public static function expertise($id){
        $expertise=Expertise::where('id',$id)->where('status',1)->first();
        
        if($expertise){
            $arr=[
                'heading'=>$expertise->heading,
                'content'=>$expertise->content,
                'image'=>$expertise->image,
            ];
        }

        return $arr;
    }

    public static function solutions(){
        $solution=Solution::where('status',1)->get();
        
        foreach ($solution as $deatils) {
            $arr[]=[
                'id'=>$deatils->id,
                'heading'=>$deatils->heading,
                'content'=>$deatils->content,
                'image'=>$deatils->image,
            ];
        }

        return $arr;
    }

    public static function portfolio($type){
        $solution=Item::where('type',$type)->where('status',1)->where('deleted',0)->get();
        
        $cnt=0;
        foreach ($solution as $deatils) {
            $item_cnt=Itemdetails::where('status',1)->where('item_id',$deatils['id'])->count();
            $cnt=$cnt+1;
            $arr[]=[
                'id'=>$deatils->id,
                'cnt'=>$cnt,
                'name'=>$deatils->name,
                'type'=>$deatils->type,
                'image_cnt'=>$item_cnt,
            ];
        }
        //dd($arr);
        return $arr;
    }

    public static function portfoliodetails($item_id){
        //dd($item_id);
        $solution=Itemdetails::where('status',1)->where('item_id',$item_id)->get();
        $item=Item::where('id',$item_id)->first();
        $arr=[];
        foreach ($solution as $deatils) {
            $arr[]=[
                'id'=>$deatils->id,
                'item_id'=>$deatils->item_id,
                'image'=>$deatils->image,
                'name'=>$item->name,
                //'image'=>$deatils->image,
            ];
        }

        return $arr;
    }
}

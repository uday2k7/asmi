<?php

namespace App\Http\Controllers\WebPrivate\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Helpers\CommonHelper;
use App\Models\Organization;
use App\Models\Genre;
use App\Models\OrganizationGenre;
//use App\Models\Campaigninfluencer;
//use App\Models\User;
//use App\User;
//use App\Models\UserVerification;
//use JWTAuth;
//use JWTFactory;
//use League\Flysystem\Exception;
//use Tymon\JWTAuth\PayloadFactory;
//use Tymon\JWTAuth\Exceptions\JWTException;
//use Validator;
use DB, Redirect, File;
//use Illuminate\Support\Facades\Password;
//use Illuminate\Mail\Message;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Postimage;
use Config;
use App\Models\User;

class OrganizationController extends Controller
{
    public function index()
    {
        //dd("A");
        $organization_name=getOrganizationById(Auth::User()->id);
        $organization=Organization::where('admin_id',Auth::User()->id)->where('deleted',0)->first();
        $genre_all=Genre::where('deleted',0)->where('active_status',1)->get();
        //$data_arr=[];
        if(!empty($organization))
        {
            //$genre_check=Genre::where('organization_id',$organization->id)->where('deleted',0)->where('active_status',1)->get(); 
            $data_arr=[
                'id'=>$organization->id,
                'name'=>$organization->name,
                'description'=>$organization->description,
                'logo'=>$organization->logo,
                //'background'=>url('user-content/campaign_image/'.$details->image),
                'background'=>$organization->background,
               // 'genre_ids'=>$details->genre_ids,
                'active_status'=>$organization->active_status,
                'created_by'=>$organization->created_by,
            ];
            
        }
       
        $genre_arr=[];
        foreach($genre_all as $details)
        {
            $genre_check=OrganizationGenre::where('organization_id',$organization->id)
                ->where('genre_id',$details->id)
                ->where('deleted',0)
                ->where('status',1)
                ->count();
            $genre_arr[]=[
                'id'=>$details->id,
                'name'=>$details->name,
                'checked'=>($genre_check>0)?'checked':'',
            ];
        }

        return view('admin.organization.index',[
            'organization_name'=>$organization_name,
            'data_arr'=>$data_arr,
            'genre'=>$genre_arr
        ]);
    }


    public function update(Request $request,$id)
    {
        

        $validator = Validator::make($request->all(), [
            'organization_id' => 'required',
            'name' => 'required|string|max:255',
        ]);
        if($request->hasFile('image-logo')){
            $validator = Validator::make($request->all(), [
                'image-logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
        }
        if($request->hasFile('image-bg')){
            $validator = Validator::make($request->all(), [
                'image-bg' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
        }
        if ($validator->fails()) {
            return redirect('admin/organization/index')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        
        $name = $input['name'];
        $description = $input['description'];
        $id = $input['organization_id'];
        $genre_arr=[];
        if(array_key_exists('genre',$input))
        {
            $genre_arr = $input['genre'];
        }
        
        DB::beginTransaction();
        try {
            Organization::where('id', $id)->where('admin_id', Auth::User()->id)->update([
                'name'    => $name,
                'description'    => $description,
            ]); 
            if(count($genre_arr)>0)
            {
                $res=OrganizationGenre::where('organization_id',$id)->delete();
                for($i=0; $i<count($genre_arr); $i++)
                {
                    $data[] = [
                        'organization_id'=>$id,
                        'genre_id'=>$genre_arr[$i],
                        'status'=>1,
                        'deleted'=>0,
                        'created_at'=>NOW(),
                        'updated_at'=>NOW(),
                    ];
                }
                OrganizationGenre::insert($data);
            }
            if ($request->get('logo_image'))
            { 
                Organization::where('id', $id)->where('admin_id', Auth::User()->id)->update([
                    'logo'    => url('user-content/organization/logo/'.$request->get('logo_image')),
                ]); 
            }

           
            if ($request->get('bg_image'))
            { 
                Organization::where('id', $id)->where('admin_id', Auth::User()->id)->update([
                    'background'    => url('user-content/organization/background/'.$request->get('bg_image')),
                ]); 
            }

            DB::commit();
            return Redirect::to('admin/organization/index')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();            
            return Redirect::to('admin/organization/index')->with('error', 'Unable to update data.');
        }
    }

    public function uploadCropLogo(Request $request)
    {
        $image = $request->image_logo;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';

        $upload_path=public_path('user-content/organization/logo');
        if (!file_exists($upload_path)) {
            File::makeDirectory($upload_path, 0777, true, true);
        }

        $path = $upload_path.'/'.$image_name;

        file_put_contents($path, $image);
        return response()->json(['status'=>true,'img_name'=>$image_name]);
    }

    public function uploadCropBg(Request $request)
    {
        $image = $request->image_bg;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';

        $upload_path=public_path('user-content/organization/background');
        if (!file_exists($upload_path)) {
            File::makeDirectory($upload_path, 0777, true, true);
        }

        $path = $upload_path.'/'.$image_name;

        file_put_contents($path, $image);
        return response()->json(['status'=>true,'img_name'=>$image_name]);
    }

    public function data()
    {
        //dd("A");
        $organization_name=getOrganizationById(Auth::User()->id);
        $organization=Organization::where('admin_id',Auth::User()->id)->where('deleted',0)->first();
        //$genre_all=Genre::where('deleted',0)->where('active_status',1)->get();
        
        $data_arr=[];
        return view('admin.organization.data',[
            'organization_name'=>$organization_name,
            'data_arr'=>$data_arr,
            //'genre'=>$genre_arr
        ]);
    }

    public function datastore(Request $request)
    {
        DB::beginTransaction();
        try {
            $user=User::where('insta_followers','<=',0)->where('tiktok_followers','<=',0)->where('user_type',3)->get();
            foreach($user AS $details)
            {
                // /dd($details->id);
                $insta_followers=rand(700,7000);
                $tiktok_followers=rand(700,7000);
               // dd($insta_followers,$tiktok_followers);
                User::where('id', $details->id)->update([
                    'insta_followers'    => $insta_followers,
                    'tiktok_followers'    => $tiktok_followers,
                ]); 
            }
            DB::commit();
            return Redirect::to('admin/organization/data')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();            
            return Redirect::to('admin/organization/data')->with('error', 'Unable to update data.');
        }
        
    }


}

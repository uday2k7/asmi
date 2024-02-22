<?php

namespace App\Http\Controllers\WebPrivate\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Helpers\CommonHelper;
use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\User;
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
use App\Traits\GoogleTrait;
//use Auth; 
use App\Models\Campaign;
use App\Models\CampaignUser;
use App\Helpers\PushMsgLib;

class InfluencerController extends Controller
{
    use GoogleTrait;

    public function index()
    {
        //dd("P");
        $organization_name=getOrganizationById(Auth::User()->id);
        $organization=Organization::where('admin_id',Auth::User()->id)->where('deleted',0)->first();

        $all_campaign=Campaign::where('created_by',Auth::User()->id)->where('deleted',0)->select('id')->get();
        $campaign_ids=[];
        foreach($all_campaign as $all_campaign_ids)
        {
            $campaign_ids[]=$all_campaign_ids->id;
        }
        //$unique_campaign_id=array_unique($campaign_ids);
        //$organizationUser=CampaignUser::whereIn('campaign_id',$campaign_ids)->get();
        $organizationUser=OrganizationUser::where('organization_id',$organization->id)->get();
       // dd($unique_campaign_id);      
        //dd($organization->id);      
        $data_arr=[];
        foreach($organizationUser as $details)
        {
            //dd($details->toArray());
            $user=User::where('id',$details->influencer_id)->first();
            $data_arr[]=[
                'id'=>$details->id,
                'invitation_status'=>$details->invitation_status,
                'campaign_name'=>$details->campaign_id,
                'influencer_id'=>$details->influencer_id,
                'influencer_name'=>$user?$user->full_name:'NA',
            ];
        }
        //dd($data_arr);
        return view('admin.influencer.index',[
            'organization_name'=>$organization_name,
            'data_arr'=>$data_arr,
        ]);
    }
    

    public function add()
    {
        $organization_name=getOrganizationById(Auth::User()->id);
        $user=User::where('user_type',User::USER_TYPE_INFLUENCER)->where('is_deleted',0)->where('is_locked',0)->get();
        $data_arr=[];
        foreach($user as $details)
        {
            $organization_cnt=Organization::where('admin_id',$details->id)->count();
            //dd($details->id);
            if($organization_cnt <=0)
            {
               $data_arr[]=[
                    'id'=>$details->id,
                    'name'=>$details->full_name.' ( '.$details->email.' )',
                ]; 
            }
            
        }
        //dd($data_arr);
        return view('admin.influencer.add',[
            'organization_id'=>getOrganizationIdById(Auth::User()->id),
            'organization_name'=>$organization_name,
            'title'=>'Add Organization',
            'data'=>$data_arr
        ]);
    }

    public function store(Request $request)
    {

        $input = $request->all();
        $organization_id = $input['organization_id'];
        $getOrganizationNameById=getOrganizationNameById($organization_id);
        //dd($getOrganizationNameById);
        $influencer_arr=[];
        if(array_key_exists('influencer_id',$input))
        {
            $influencer_arr = $input['influencer_id'];
        }

        DB::beginTransaction();
        try {
            $data=[];
            $res=OrganizationUser::where('organization_id',$organization_id)->delete();
            for($i=0; $i<count($influencer_arr); $i++)
            {
                $data[] = [
                    'organization_id'=>$organization_id,
                    'influencer_id'=>$influencer_arr[$i],
                    'invitation_status'=>'INVITED',
                    'invitation_date'=>NOW(),
                    'created_at'=>NOW(),
                    'updated_at'=>NOW(),
                ];
            }
            //dd($data);
            OrganizationUser::insert($data);
            DB::commit();

           // $organization=Organization::where('id',$organization_id)->first();
           // $admin_id=$organization->admin_id;
            for($i=0; $i<count($influencer_arr); $i++)
            {
               // dd($influencer_arr[$i]);
                $user=User::where('id',$influencer_arr[$i])->first();
                //dd($user['fcm_token']);
                $message['to'] = $user['fcm_token'];           
                $message['sound'] = 'default';
                $message['title'] = 'You have been invited by '.$getOrganizationNameById;
                $message['body'] = 'You have been invited by '.$getOrganizationNameById;
                $message['data']['jsonInfo']['type'] = 'GENERAL'; // USE UPPERCASE
                $message['data']['jsonInfo']['id'] = $influencer_arr[$i]; // INT OR NULL
                $message['data']['jsonInfo']['details'] = ''; // STRING
                
                $messages[] = $message;            
                $result = PushMsgLib::sendExpo($messages);
            }
           // dd($admin_id);
            
            //$campaign=Campaign::where('id',$campaign_id)->first();
            //dd($user['fcm_token'],$getOrganizationNameById,$organization_id);
            

            return Redirect::to('admin/influencer/index')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
           
            return Redirect::to('admin/influencer/index')->with('error', $e->getMessage());
        }

        


    }

    public function listInfluencer($organization_id)
    {
        $organizationGenre=OrganizationGenre::where('organization_id',$organization_id)
            ->where('status',1)
            ->where('deleted',0)
            ->get();

        $user_ids=[];
        foreach($organizationGenre as $genre)
        {
            //$user=User::where('id',$details->influencer_id)->first();
            /*$user = User::whereRaw('FIND_IN_SET('.$genre->genre_id.', genre_ids)')
                    ->where('user_type',3)
                    ->get();*/
            $user = User::where('user_type',3)
                    ->orderBy('full_name','ASC')
                    ->get();
            foreach($user as $udetails)
            {
                $user_ids[]=$udetails->id;
            }
        }
        $user_arr=array_unique($user_ids);        
               
        $data_arr=[];
        foreach($user_arr as $details)
        {
            //dd($details);
            $user=User::where('id',$details)->first();
            $organizationUserCount=OrganizationUser::where('organization_id',$organization_id)
                ->where('influencer_id',$details)
                ->count();
            $data_arr[]=[
                'id'=>$details,
                'name'=>$user->full_name,
                'checked'=>($organizationUserCount >0)?'checked':'',
               // 'organization_name'=>$organization_name,
                //'influencer_id'=>$details->influencer_id,
               // 'influencer_name'=>$user?$user->full_name:'NA',
            ];
        }
       // dd($data_arr);
        return response()->json(['status'=>true,'data_arr'=>$data_arr]);
    }

    public function profile()
    {
        $user_id=Auth::User()->id;
        $organization_name=getOrganizationById($user_id);

        $user=User::where('id',$user_id)->get();               
        $data_arr=[];
        foreach($user as $details)
        {
            $data_arr[]=[
                'id'=>$details->id,
                'full_name'=>$details->full_name,
                'email'=>$details->email,
                'profile_pic'=>$details->profile_pic,
                'mobile'=>$details->mobile,
                'insta_followers'=>$details->insta_followers,
                'tiktok_followers'=>$details->tiktok_followers,
                'address'=>$details->address,
                'location'=>$details->location,
            ];
        }
       // dd($data_arr);
        return view('admin.profile.index',[
            'organization_name'=>$organization_name,
            'data_arr'=>$data_arr,
        ]);
    }

    public function edit()
    {
        $user_id=Auth::User()->id;
        $organization_name=getOrganizationById($user_id);

        $user=User::where('id',$user_id)->get();               
        $data_arr=[];
        foreach($user as $details)
        {
            $data_arr[]=[
                'id'=>$details->id,
                'full_name'=>$details->full_name,
                'email'=>$details->email,
                'mobile'=>$details->mobile,
                'profile_pic'=>$details->profile_pic,
                'insta_followers'=>$details->insta_followers,
                'tiktok_followers'=>$details->tiktok_followers,
                'address'=>$details->address,
                'location'=>$details->location,
            ];
        }
       // dd($data_arr);
        return view('admin.profile.edit',[
            'organization_name'=>$organization_name,
            'data_arr'=>$data_arr,
        ]);
    }

    public function uploadCropImage(Request $request)
    {
        $image = $request->image;
        //dd($image);
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';

        $upload_path=public_path('user-content/user_image');
        if (!file_exists($upload_path)) {
            File::makeDirectory($upload_path, 0777, true, true);
        }

        $path = $upload_path.'/'.$image_name;

        file_put_contents($path, $image);
        return response()->json(['status'=>true,'img_name'=>$image_name]);
    }

    public function update(Request $request)
    {
        $input = $request->all();

        //$address=$input['address'];
        
        //dd("a");
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'full_name' => 'required|string|max:255',
        ]);
        /*if($request->hasFile('image-logo')){
            $validator = Validator::make($request->all(), [
                'image-logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
        }
        if($request->hasFile('image-bg')){
            $validator = Validator::make($request->all(), [
                'image-bg' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
        }*/
        if ($validator->fails()) {
            return redirect('admin/profile/edit')
                ->withErrors($validator)
                ->withInput();
        }
        //dd("a");
        $full_name=$input['full_name'];
        $mobile=$input['mobile'];
        $address=$input['address'];
        //dd($address);
       // $getGeoLocations = $this->getGeoLocations($address);
        //dd($getGeoLocations);
        $getGeoLocations=[];
        $user_id=Auth::User()->id;
        //dd($user_id);
        $lat=NULL;
        $long=NULL;
        $coordinates=0;

        DB::beginTransaction();
        try {
            if(count($getGeoLocations)>0)
            {
                $lat=$getGeoLocations['lat'];
                $long=$getGeoLocations['long'];
                $coordinates=1;
            }
            User::where('id', $user_id)->update([
                'full_name'    => $full_name,
                'mobile'    => $mobile,
                'address'    => $address,
                'latitude'    => $lat,
                'longitude'    => $long,
                'coordinates'    => $coordinates,
            ]);

            if($input['user_image']){
                $user_image=$input['user_image'];
                $image=url('user-content/user_image/'.$user_image);
                User::where('id', $user_id)->update([
                    'profile_pic'    => $image,
                ]);
            }
            DB::commit();
            return Redirect::to('admin/profile')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
           
            return Redirect::to('admin/profile')->with('error', $e->getMessage());
        }

        //$organization_name=getOrganizationById($user_id);

        /*$user=User::where('id',$user_id)->get();               
        $data_arr=[];
        foreach($user as $details)
        {
            $data_arr[]=[
                'id'=>$details->id,
                'full_name'=>$details->full_name,
                'email'=>$details->email,
                'mobile'=>$details->mobile,
                'insta_followers'=>$details->insta_followers,
                'tiktok_followers'=>$details->tiktok_followers,
                'address'=>$details->address,
                'location'=>$details->location,
            ];
        }*/
        /*return view('admin.profile.edit',[
            'organization_name'=>$organization_name,
            'data_arr'=>$data_arr,
        ]);*/
    }

}

<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;



class UserController extends Controller
{
    public function index()
    {
        $user=User::where('is_deleted',0)->where('user_type',4)->get();
       /* $organization=Organization::with('adminEmail')
            ->where('deleted',0)
            ->orderBy('id','DESC')->get();*/
        $data=[];
        foreach($user as $details)
        {
            $data[]=[
                'id' =>$details->id,
                'name' =>$details->first_name.' '.$details->last_name,
                'admin_id' =>$details->admin_id,
                'admin_email' =>$details->email,
                'mobile' =>$details->mobile,
                'active_status' =>$details->is_locked,
                'created_at' =>$details->created_at,
            ];
        }
        //dd($data);
        return view('superadmin.user.index',[
            'data'=>$data,
            'title'=>'Users List'
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

    public function add()
    {
        $user=User::where('user_type',User::USER_TYPE_ADMIN)->where('is_deleted',0)->where('is_locked',0)->get();
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
        return view('superadmin.organization.add',[
            'title'=>'Add Organization',
            'data'=>$data_arr
        ]);
    }

    public function store(Request $request)
    {
       // dd("DD");
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required',
            'organization_name' => 'required|string|max:255',
           // 'surname' => 'required|string|max:50',
           // 'email' => 'required|email|unique:users',
           // 'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return redirect('admin/organization/add')
                ->withErrors($validator)
                ->withInput();
        }

        $input=$request->all();
        //$password=Hash::make($input['password']);  
        
        DB::beginTransaction();
        try {
    

            $organization = new Organization();
            $organization->name=$input['organization_name'];
            $organization->admin_id=$input['admin_id'];
            $organization->active_status=1;        
            $organization->deleted=0;
            $organization->save();
            DB::commit();
            return Redirect::to('cpanel/user')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            //dd($e->getMessage());
            return Redirect::to('cpanel/user')->with('error', $e->getMessage());
        }


    }

    public function read(Request $request)
    {
        $input=$request->all();
        $id=$input['id'];

        Notify::where('id', $id)->update([
            'read_status'    => 1
        ]);
        return true;
    }
}

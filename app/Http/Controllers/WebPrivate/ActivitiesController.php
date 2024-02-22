<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Organization;
use App\Models\Activitiy;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;



class ActivitiesController extends Controller
{
    public function index()
    {
        $activitie=Activitiy::where('deleted',0)->get();
       
        $data=[];
        foreach($activitie as $details)
        {
            $data[]=[
                'id' =>$details->id,
                'name' =>$details->name,
                'icon_path' =>$details->icon_path,
                'display' =>$details->display,
                'deleted' =>$details->deleted,
                'created_at' =>$details->created_at,
            ];
        }
        //dd($data);
        return view('superadmin.activities.index',[
            'data'=>$data,
            'title'=>'Activities List'
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
        return view('superadmin.activities.add',[
            'title'=>'Add Activity',
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activitiy_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('cpanel/activities/add')
                ->withErrors($validator)
                ->withInput();
        }

        $input=$request->all();
        $dir_path=public_path('icons');
        $filename = time() . '.' . $request->icon_name->extension();

        $request->icon_name->move($dir_path, $filename);       
        if (is_file($dir_path.'/'.$filename)) 
        {
            $icon_path=url('icons').'/'.$filename;
        }
        else
        {
            $icon_path=url('icons/no_icon.png');
        }

        DB::beginTransaction();
        try {
    

            $activitiy = new Activitiy();
            $activitiy->name=$input['activitiy_name'];
            $activitiy->icon_path=$icon_path;
            $activitiy->display=1;        
            $activitiy->deleted=0;
            $activitiy->save();
            DB::commit();
            return Redirect::to('cpanel/activities')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/activities')->with('error', $e->getMessage());
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

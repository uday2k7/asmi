<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Organization;
use App\Models\Logbook;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;



class LogController extends Controller
{
    public function index()
    {
        $logbook=Logbook::orderBy('log_datetime','DESC')->get();
       
        $data=[];
        foreach($logbook as $details)
        {
            $data[]=[
                'id' =>$details->id,
                'user_id' =>$details->user_id,
                'blood_glucose' =>$details->blood_glucose,
                'emotion' =>$details->emotion_id,
                'event' =>$details->event_id,
                'activity' =>$details->activity_id,
                'log_datetime' =>$details->log_datetime,
            ];
        }
        //dd($data);
        return view('superadmin.log.index',[
            'data'=>$data,
            'title'=>'Log List'
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
            return redirect('cpanel/log/add')
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
            return Redirect::to('cpanel/log')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/log')->with('error', $e->getMessage());
        }


    }

    
}

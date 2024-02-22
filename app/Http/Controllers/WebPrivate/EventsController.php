<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Organization;
use App\Models\Event;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;



class EventsController extends Controller
{
    public function index()
    {
        $event=Event::where('deleted',0)->get();
      
        $data=[];
        foreach($event as $details)
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
        return view('superadmin.events.index',[
            'data'=>$data,
            'title'=>'Events List'
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
        return view('superadmin.events.add',[
            'title'=>'Add Emotion',
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('cpanel/events/add')
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
    

            $event = new Event();
            $event->name=$input['event_name'];
            $event->icon_path=$icon_path;
            $event->display=1;        
            $event->deleted=0;
            $event->save();
            DB::commit();
            return Redirect::to('cpanel/events')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/events')->with('error', $e->getMessage());
        }


    }
    
    public function edit($id)
    {
        $emotion=Event::where('id',$id)->first();
        return view('superadmin.events.edit',[
            'title'=>'Update Event',
            'data'=>$emotion,
        ]);
    }

    public function update(Request $request)
    {
        $input=$request->all();
        $event_id=$input['event_id'];
        $event_name=$input['event_name'];

        $validator = Validator::make($request->all(), [
            'event_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('cpanel/events/edit/'.$event_id)
                ->withErrors($validator)
                ->withInput();
        }

        $dir_path=public_path('icons');
        $icon_path=url('icons/no_icon.png');
        if($request->hasFile('icon_name')){ 
            $filename = time() . '.' . $request->icon_name->extension();
            $request->icon_name->move($dir_path, $filename);  
            if (is_file($dir_path.'/'.$filename)) 
            {
                $icon_path=url('icons').'/'.$filename;
            }  

            Event::where('id', $event_id)->update([
                'icon_path'    => $icon_path
            ]);      
        }
       // dd($emotion_id);
        //
       // $filename = time() . '.' . $request->icon_name->extension();

        /*$request->icon_name->move($dir_path, $filename);       
        if (is_file($dir_path.'/'.$filename)) 
        {
            $icon_path=url('icons').'/'.$filename;
        }
        else
        {
            $icon_path=url('icons/no_icon.png');
        }*/

        DB::beginTransaction();
        try {    
            Event::where('id', $event_id)->update([
                'name'    => $event_name
            ]);  
            DB::commit();
            return Redirect::to('cpanel/events')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/events')->with('error', $e->getMessage());
        }
    }

    public function display($id)
    {
        $emotion=Event::where('id',$id)->first();
        if($emotion->display==0) {
            $display=1;
        }
        else
        {
            $display=0;
        }
        DB::beginTransaction();
        try {
            Event::where('id', $id)->update([
                'display'    => $display
            ]);            

            DB::commit();
            return Redirect::to('cpanel/events')->with('message', 'Data updated successfully.');
        }
        catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/events')->with('error', 'Unable to updated data.');
        }
    }
    
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            Event::where('id', $id)->update([
                'deleted'    => 1
            ]);            

            DB::commit();
            return Redirect::to('cpanel/events')->with('message', 'Data deleted successfully.');
        }
        catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/events')->with('error', 'Unable to delete data.');
        }

    }
}

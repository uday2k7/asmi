<?php

namespace App\Http\Controllers\WebPrivate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Models\Organization;
use App\Models\Emotion;
use Hash;
use DB;
use Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Notify;



class EmotionsController extends Controller
{
    public function index()
    {
        $emotion=Emotion::where('deleted',0)->get();
      
        $data=[];
        $dir_path=public_path('icons');
        foreach($emotion as $details)
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
        return view('superadmin.emotions.index',[
            'data'=>$data,
            'title'=>'Emotions List'
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
        return view('superadmin.emotions.add',[
            'title'=>'Add Emotion',
        ]);
    }

    public function store(Request $request)
    {
        //dd("a");
        $validator = Validator::make($request->all(), [
            'emotion_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('cpanel/emotions/add')
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
    

            $emotion = new Emotion();
            $emotion->name=$input['emotion_name'];
            $emotion->icon_path=$icon_path;
            $emotion->display=1;        
            $emotion->deleted=0;
            $emotion->save();
            DB::commit();
            return Redirect::to('cpanel/emotions')->with('message', 'Data added successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/emotions')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $emotion=Emotion::where('id',$id)->first();
        return view('superadmin.emotions.edit',[
            'title'=>'Update Emotion',
            'data'=>$emotion,
        ]);
    }

    public function update(Request $request)
    {
        $input=$request->all();
        $emotion_id=$input['emotion_id'];
        $emotion_name=$input['emotion_name'];

        $validator = Validator::make($request->all(), [
            'emotion_name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('cpanel/emotions/edit/'.$emotion_id)
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

            Emotion::where('id', $emotion_id)->update([
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
            Emotion::where('id', $emotion_id)->update([
                'name'    => $emotion_name
            ]);  
            DB::commit();
            return Redirect::to('cpanel/emotions')->with('message', 'Data updated successfully.');
        }catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/emotions')->with('error', $e->getMessage());
        }
    }


    public function display($id)
    {
        $emotion=Emotion::where('id',$id)->first();
        if($emotion->display==0) {
            $display=1;
        }
        else
        {
            $display=0;
        }
        DB::beginTransaction();
        try {
            Emotion::where('id', $id)->update([
                'display'    => $display
            ]);            

            DB::commit();
            return Redirect::to('cpanel/emotions')->with('message', 'Data updated successfully.');
        }
        catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/emotions')->with('error', 'Unable to updated data.');
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            Emotion::where('id', $id)->update([
                'deleted'    => 1
            ]);            

            DB::commit();
            return Redirect::to('cpanel/emotions')->with('message', 'Data deleted successfully.');
        }
        catch (\Exception $e) {                
            DB::rollback();
            return Redirect::to('cpanel/emotions')->with('error', 'Unable to delete data.');
        }

    }
}

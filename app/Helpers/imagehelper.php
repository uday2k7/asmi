<?php namespace App\Helper;
use File;
use Intervention\Image\Facades\Image;


ini_set('memory_limit', '-1');


	
class imagehelper  
{ 

    public static function resize($originalFile,$filename,$upload_path,$section='banner')
    { 
        if(!File::exists($upload_path)) {
            
           File::makeDirectory($upload_path, 0777, true, true);
        }        

        if($section=="banner")
        {
            $resize_width=env('BANNER_WIDTH');
            $resize_height=env('BANNER_HEIGHT');
        } 
        if($section=="artist")
        {
            $resize_width=env('USER_WIDTH');
            $resize_height=env('USER_HEIGHT');
        } 
        /*echo $resize_width."<br>";
        echo $resize_height."<br>";
        dd("a");*/
        //dd($section);
        $imageResize = Image::make($originalFile);
        $imageResize->orientate()
        /*->fit($resize_width, $resize_height, function ($constraint) {
            $constraint->upsize();
        })->save($upload_path . $filename);*/
        ->resize($resize_width, $resize_height, function ($constraint) {
           // $constraint->aspectRatio();
        })->save($upload_path . $filename);

        return $filename;
    }

    public static function resize_fixed($originalFile,$filename,$upload_path,$resize_width,$resize_height)
    { 
       // dd($upload_path);
        if(!File::exists($upload_path)) {
            
           File::makeDirectory($upload_path, 0777, true, true);
        }        
        $imageResize = Image::make($originalFile);
        $imageResize->orientate()        
        ->fit($resize_width, $resize_height, function ($constraint) {
          
        })->save($upload_path . $filename);
        
        return $filename;
    }

    public static function upload($originalFile,$filename,$upload_path,$section='artwork')
    { 
        if(!File::exists($upload_path)) {
            
           File::makeDirectory($upload_path, 0777, true, true);
        }
        $image_info=(getimagesize($originalFile));
        $image_width=$image_info[0];
        $image_height=$image_info[1];

        $main_size=env('STUDIO_MAIN_SIZE');

        if($image_width > $image_height)
        {
            $resize_width=$main_size;
            $resize_height=(int)(($image_height/$image_width)*$resize_width);
        }
        else if($image_width < $image_height)
        {   
            $resize_height=$main_size;         
            $resize_width=(int)(($image_width/$image_height)*$resize_height);            
        }
        else
        {
            $resize_width=$main_size;
            $resize_height=$main_size;
        }

        $imageResize = Image::make($originalFile);
        $imageResize->orientate()
        ->fit($resize_width, $resize_height, function ($constraint) {
        $constraint->upsize();
        })->save($upload_path . $filename);

        return $filename;
        //dd($upload_path);
        //echo $filename."<br>";
        /*if(!File::exists($upload_path)) {
            
           File::makeDirectory($upload_path, 0777, true, true);
        }

        if($section=="banner")
        {
            $resize_width=env('BANNER_MIN_W');
            $resize_height=env('BANNER_MIN_H');
        } 
        if($section=="artist")
        {
            $resize_width=env('USER_MIN_W');
            $resize_height=env('USER_MIN_H');
        }        
        
        $imageResize = Image::make($originalFile);
        $imageResize->orientate()
        ->fit($resize_width, $resize_height, function ($constraint) {
        $constraint->upsize();
        })->save($upload_path . $filename);

        return $filename;*/
    }


    public static function copyresize($originalFile,$filename,$upload_path,$section='artwork',$type="mid")
    { 
        if(!File::exists($upload_path)) {
            
           File::makeDirectory($upload_path, 0777, true, true);
        }
        $image_info=(getimagesize($originalFile));
        $image_width=$image_info[0];
        $image_height=$image_info[1];

        if($type=="mid")
        {
            $main_size=env('STUDIO_MID_SIZE');
        }
        elseif($type=="thumb")
        {
            $main_size=env('STUDIO_THUMB_SIZE');
        }
        else
        {
            $main_size=env('STUDIO_MAIN_SIZE');
        }
        

        if($image_width > $image_height)
        {
            $resize_width=$main_size;
            $resize_height=(int)(($image_height/$image_width)*$resize_width);
        }
        else if($image_width < $image_height)
        {   
            $resize_height=$main_size;         
            $resize_width=(int)(($image_width/$image_height)*$resize_height);            
        }
        else
        {
            $resize_width=$main_size;
            $resize_height=$main_size;
        }

        $imageResize = Image::make($originalFile);
        $imageResize->orientate()
        ->fit($resize_width, $resize_height, function ($constraint) {
        $constraint->upsize();
        })->save($upload_path . $filename);

        return $filename;
        //dd($upload_path);
        //echo $filename."<br>";
        /*if(!File::exists($upload_path)) {
            
           File::makeDirectory($upload_path, 0777, true, true);
        }

        if($section=="banner")
        {
            $resize_width=env('BANNER_MIN_W');
            $resize_height=env('BANNER_MIN_H');
        } 
        if($section=="artist")
        {
            $resize_width=env('USER_MIN_W');
            $resize_height=env('USER_MIN_H');
        }        
        
        $imageResize = Image::make($originalFile);
        $imageResize->orientate()
        ->fit($resize_width, $resize_height, function ($constraint) {
        $constraint->upsize();
        })->save($upload_path . $filename);

        return $filename;*/
    }

	public static function upload_image($image_name,$originalFile,$upload_path,$type='')
	{
        if(!File::exists($upload_path)) {
            
           File::makeDirectory($upload_path, 0777, true, true);
        }
        $thumb_size=env('MID_SIZE');
        $image_info=(getimagesize($originalFile));
        $image_width=$image_info[0];
        $image_height=$image_info[1];
        if($type=="full")
        {
            $resize_width=$image_width;
            $resize_height=$image_height;
        }
        else
        {
            if($image_width > $image_height)
            {
                $resize_width=$thumb_size;
                $resize_height=(int)(($image_height/$image_width)*$resize_width);
            }
            else if($image_width < $image_height)
            {   
                $resize_height=$thumb_size;         
                $resize_width=(int)(($image_width/$image_height)*$resize_height);            
            }
            else
            {
                $resize_width=$image_width;
                $resize_height=$image_height;
            }
        }
        
        //dd($resize_width."---".$resize_height."---".$thumb_size) ;
        /*if(!isset($width) && !isset($height))
        {
            $image_info=(getimagesize($originalFile));
            $image_width=$image_info[0];
            $image_height=$image_info[1];
        }
        else
        {
            $image_width=null;
            $image_height=null;
            if($width)
            {
                $image_width=$width;
            }
            
            if($height)
            {
                $image_height=$height;
            }
        }*/
		
        
        
        $imageResize = Image::make($originalFile);
        $imageResize->orientate()
        ->fit($image_width, $image_height, function ($constraint) {
        $constraint->upsize();
        })->save($upload_path . '/' . $image_name);

        return $image_name;
	}



    /*public static function get_width($originalFile,$resize_height)
    {
        $image_info=(getimagesize($originalFile));
        $image_width=$image_info[0];
        $image_height=$image_info[1];*/

        /*if($image_width > $image_height)
        {
            //$resize_height=
           // $resize_width=$thumb_size;
            //$resize_height=(int)(($image_height/$image_width)*$resize_width);
        }
        else if($image_width < $image_height)
        {   
            //$resize_height=$thumb_size;         
            //$resize_width=(int)(($image_width/$image_height)*$resize_height);            
        }
        else
        {
            $resize_width=$resize_height;
           // $resize_width=$image_width;
           // $resize_height=$image_height;
        }*/

       // $resize_width=(int)(($image_width/$image_height)*$resize_height);      

       // dd($resize_width);
   // }

    public static function create_micro($originalFile,$filename)
    {
        $filepath_thumb = 'public/uploads/studio/thumb/';

        $imageResize = Image::make($originalFile);
        $imageResize->orientate()
        ->fit(50, 50, function ($constraint) {
        $constraint->upsize();
        })->save($filepath_thumb . $filename);

        return $filename;

        //\File::copy($filepath_thumb.$filename,$filepath_mid.$filename);
    }

    public static function copyimage($originalFile,$filename,$upload_path)
    {
        //dd($upload_path,$filename,$originalFile);
        if(!File::exists($upload_path)) {
            
           File::makeDirectory($upload_path, 0777, true, true);
        } 
       /* $filepath_thumb = 'uploads/studio/thumb/';

        $imageResize = Image::make($originalFile);
        $imageResize->orientate()
        ->fit(50, 50, function ($constraint) {
        $constraint->upsize();
        })->save($filepath_thumb . $filename);

        return $filename;*/

        //\File::copy($filepath_thumb.$filename,$filepath_mid.$filename);


        /*$file = $request->file('image_upload')[$i];
        $file_ext = $file->clientExtension();
        $filename = 'banner-'.time().rand(1,9999).'.'.$file_ext;   */
        //dd($filename);
        //$filepath_thumb = 'uploads/studio/thumb/';
        //$filepath_mid = 'uploads/studio/mid/';
        //$filepath_main = 'uploads/studio/main/';

        $file = $originalFile;

        //$image_name=$filename;
        $file->move($upload_path, $filename);
        return $filename;
        //\File::copy($filepath_thumb.$filename,$filepath_mid.$filename);
        //\File::copy($filepath_thumb.$filename,$filepath_main.$filename);
    //}
    }
	
	
}

?>
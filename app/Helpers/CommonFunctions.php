<?php

use Illuminate\Support\Facades\Storage;
use App\Models\Organization;
use App\Models\OrganizationGenre;
use App\Models\OrganizationUser;
use App\Models\CampaignUser;
use App\Models\User;
use App\Models\GiftUser;
use App\Models\EventUser;
use App\Models\Genre;
use App\Models\Notify;

/*
 * Return true if $string is json
 * TODO: FIX IT
 */
function isJsonData($string): bool
{
    if(is_string($string))
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    return false;
}

// RETURN TRUE IF $url IS INVALID TODO: FIX IT
function isNotValidUrl($url = ""): bool
{
    $url = filter_var($url, FILTER_SANITIZE_URL);
    if (filter_var($url, FILTER_VALIDATE_URL) === FALSE)
        return true;
    return false;
}

/*
 * Read file from local
 * @params $path (string) local path (relative or absolute)
 * @returns mime of the file if exist else nothing (void)
 * Usage example:
 * getFileMimeType('storage/app/public/downloads/feeds.txt'));
 * getFileMimeType('/home/user/driverscreen/storage/app/public/downloads/feeds.txt'));
 * getFileMimeType(storage_path("app/public/downloads/feeds.txt"));
 * TODO: FIX IT
 */
function getFileMimeType($path)
{
    $path = '/'.ltrim(trim($path),'/'); // ALWAYS VALID LOCAL PATH (FULL|RELATIVE)
    $relativePath = str_replace(base_path(''),'',$path);

    return Storage::disk('root')->mimeType($relativePath);
}

/*
 * Read files from local or remote
 * @params $path (string) Fully qualified URL or local path (relative or full)
 * @returns content of the file if exist else nothing (void)
 * Usage example:
 * fileGetContents('https://demo-server.com/demo-file.zip'));
 * fileGetContents('storage/app/public/downloads/feeds.txt'));
 * fileGetContents('/home/user/driverscreen/storage/app/public/downloads/feeds.txt'));
 * fileGetContents(storage_path("app/public/downloads/feeds.txt"));
 * TODO: FIX IT
 */
function fileGetContents($path)
{
    $path = ltrim(trim($path),'/'); // ALWAYS REMOVING '/' FROM FRONT
    if(isNotValidUrl($path))
    {
        $path = '/'.$path; // ADDING '/' BEFORE PATH; ALWAYS VALID LOCAL PATH (FULL|RELATIVE)
        $relativePath = str_replace(base_path(''),'',$path);
        $fullPath = base_path($relativePath);
        if(file_exists($fullPath))
            return Storage::disk('root')->get($relativePath);
    }
    else
    {
        // HANDLING REMOTE URL CONTENT
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        return @file_get_contents($path,false, stream_context_create($arrContextOptions));
    }
}

/*
 * Write files to local path (folder will be created recursively)
 * @params $path (string) local path (relative or full)
 * @params $content (string) to write
 * @returns nothing (void)
 * Usage example:
 * filePutContents('storage/app/public/downloads/test-feeds.txt','test data'));
 * filePutContents('/home/user/driverscreen/storage/app/public/downloads/test-feeds.txt','test data'));
 * filePutContents(storage_path("app/public/downloads/test-feeds.txt",'test data'));
 * TODO: FIX IT
 */
function filePutContents($path,$content)
{
    $path = '/'.ltrim(trim($path),'/'); // ALWAYS VALID LOCAL PATH (ABSOLUTE|RELATIVE)

    $relativePath = str_replace(base_path(''),'',$path);
    $relativePathTmp = $relativePath.'.tmp';

    $absolutePath = base_path('').$relativePath;
    $absolutePathTmp = base_path('').$relativePathTmp;

    // WRITING ON THE tmp FILE AND FLUSHING
    $file = fopen($absolutePathTmp, 'w'); // IF EXISTS - TRUNCATE ITS CONTENT
    fwrite($file, $content);
    fflush($file);
    fclose($file);

    // RENAMING TO ORIGINAL FILE NAME, IF ORIGINAL EXISTS - OVERRIDING
    rename($absolutePathTmp,str_replace('.tmp','',$absolutePath));
}

/*
 * Convert full path to relative path for storage and then return
 * From: /home/user/driverscreen/storage/app/public/downloads/languages/languages.zip
 * To: public/downloads/languages/language.zip
 * TODO: USE fileGetContents() INSTEAD
 * TODO: FIX IT
 */
function storage_convert_to_relative_path($fullPath)
{
    $relativePath = str_replace(storage_path('app/'),'',$fullPath);
    return $relativePath;
}

/*
 * Read a file and return like file_get_contents
 * TODO: USE fileGetContents() INSTEAD
 * TODO: FIX IT
 */
function storage_get($fullPath)
{
    $relativePath = storage_convert_to_relative_path($fullPath);
    return Storage::get($relativePath);
}

/*
 * Save a file like file_put_contents
 * TODO: USE filePutContents() INSTEAD
 * TODO: FIX IT
 */
function storage_put($fullPath, $content)
{
    $relativePath = storage_convert_to_relative_path($fullPath);
    return Storage::put($relativePath,$content);
}

/*
 * Delete a file from storage
 * TODO: THIS SHOULD BE REMOVED AND MAKE A GOOD FUNCTION LIKE fileGetContents WHICH SHOULD HANDLE FULL AND LOCAL PATH
 * TODO: FIX IT
 */
function storage_delete($fullPath)
{
    $relativePath = storage_convert_to_relative_path($fullPath);
    return Storage::delete($relativePath);
}

/*
 * Extract zip archive to a folder in storage directory
 * TODO: FIX IT
 */
function storage_extract_zip($fullPathOfDestination, $fullPathOfSource, $shouldDelete = false)
{
    $zip = new \ZipArchive;
    if ($zip->open($fullPathOfSource) === TRUE)
    {
        $zip->extractTo($fullPathOfDestination);
        $zip->close();

        if($shouldDelete)
        {
            $relativePathZip = storage_convert_to_relative_path($fullPathOfSource);
            Storage::delete($relativePathZip);
        }

        return true;
    }
    return false;
}

// CUSTOM LOG
function customLog(string $msg, string $fileNameWithoutExt='default', string $color='black')
{
    $logFile = $fileNameWithoutExt.'--'.date('Y-m-d').'.log';
    $msg = '<span style="color:'.$color.';">'.date('H:i:s').' '.$msg.'</span>'.PHP_EOL;
    Storage::disk('private')->append('logs/'.$logFile,$msg);
}

// Returns int from parameters
function getInt($string): int
{
    return preg_replace('/[^0-9]/i', '', $string);
}

// RETURN TRUE IF $data IS NOT INT
function isNotInt($data): bool
{
    if ((is_array($data)) || (is_object($data)) || (!preg_match('/^[0-9]{1,}$/', $data)))
        return true;
    return false;
}

// Returns clean object
function getCleanObject($object)
{
    return json_decode(json_encode($object));
}

/*
 * Returns first name
 * Helpful for email greetings
 */
function getGreetingName(string $fullName): string
{
    $fullNameSegments = explode(' ', $fullName);
    $totalWordUsed = count($fullNameSegments);
    if($totalWordUsed <= 2)
        $output = $fullNameSegments[0];
    else
        $output = $fullNameSegments[0].' '. $fullNameSegments[1];

    return ucwords(strtolower($output));
}

function getOrganizationById($id)
{
    $organization=Organization::where('admin_id',$id)->first();

    return $organization?$organization->name:'Yet to assign Organization';
}

function getOrganizationIdById($id)
{
    $organization=Organization::where('admin_id',$id)->first();

    return $organization?$organization->id:'Yet to assign Organization';
}

function getOrganizationNameById($id)
{
    $organization=Organization::where('id',$id)->first();

    return $organization?$organization->name:'Yet to assign Organization';
}

function getAllOrganizationUsers($organization_id)
{
    //dd($organization_id);
    $organization=Organization::where('admin_id',$organization_id)->first();
    $organization_id=$organization->id;
    //dd($organization_id);
    $organizationUser=OrganizationUser::where('organization_id',$organization_id)
                    ->whereIn('invitation_status',['INVITED','ACCEPTED'])
                    //->select('influencer_id')
                    ->get();
    $orga_users=[];
    foreach($organizationUser as $details)
    {
        $orga_users[]=$details->influencer_id;
    }
   // dd($orga_users);
    return $orga_users;
}

function getUserDetailsById($user_id ) {
    $user=User::find($user_id);
   // $profile_pic=$user->profile_pic;
    $profile_pic=url('no_image.jpg');
    if($user->profile_pic)
    {
        $profile_pic=$user->profile_pic;
    }
    $user_data=[
        'full_name'=>$user->full_name,
        'profile_pic'=>$profile_pic,
    ];

    return $user_data;
}

function chkCampaignUser($id ) {
    $chk_campaign=CampaignUser::where('campaign_id',$id)->count();

    return $chk_campaign;
}

function chkGiftUser($id ) {
    $chk_gift=GiftUser::where('gift_id',$id)->count();

    return $chk_gift;
}

function chkImgName($path)
{
    $path="https://vava-backend.nettrackers.in/user-content/gift_image/1664254511.png";   
    $path_parts = pathinfo($path);
    
    return $path_parts['basename'];
}

function chkEventUser($id ) {
    $chk_event=EventUser::where('event_id',$id)->count();

    return $chk_event;
}

function getAllGenreByOrganization($organization_id)
{
    $organizationGenre=OrganizationGenre::where('organization_id',$organization_id)->get();

    $arr=[];
    foreach($organizationGenre as $details)
    {
        $genre=Genre::find($details->genre_id);
        $arr[]=[
            'id'=>$details->genre_id,
            'name'=>$genre->name,
        ];
    }
    return $arr;
}
/*function calculate_date($year)
{
    $days=-$year*365.' days';
    $today=strtotime(date("Y-m-d"));
    $days_ago = date('Y-m-d', strtotime($days, $today));
    return $days_ago;
}*/

function notificationCount()
{
    $notify=Notify::where('status',1)->where('deleted',0)->where('read_status',0)->count();
    
    return $notify;
}

function showNotification()
{
    $notify=Notify::where('status',1)->where('deleted',0)->orderBy('id','DESC')->get();
    $notify_arr=[];
    foreach($notify as $details)
    {
        $notify_arr[]=[
            'id'=>$details->id,
            'message'=>$details->message,
            'read_status'=>$details->read_status,
            'notify_date'=>date("F j, Y",strtotime($details->created_at)),
        ];
    }
    return $notify_arr;
}

function getAge($date_of_birth)
{
    //dd($date_of_birth);
   // $from = new DateTime($date_of_birth);
    //$to   = new DateTime('today');
    //echo $from->diff($to)->y;

    # procedural
    $age= date_diff(date_create($date_of_birth), date_create('today'))->y;
    return $age;
}

function cheImgExists($image_path)
{
    $image_name = basename($image_path);
    $site_url=url('').'/';
    $img_without_url=str_replace($site_url,'',$image_path);
    $dir_path=str_replace($image_name,'',$img_without_url);
   // dd($image_path);
   // dd($image_path,$image_name);
    //echo $image_name."A<br>";
    //$file_path =public_path('user-content/campaign_image/'.$image_name);
    //echo $file_path."A<br>";
    $img_url=url('No_Image_Available.jpg');

    if(($image_name) && file_exists($dir_path))
    {
       // dd("A");
        return true;
        //dd($image_name);
        //$img_url=url('user-content/campaign_image/'.$image_name);
    }
    return false;
   // $from = new DateTime($date_of_birth);
    //$to   = new DateTime('today');
    //echo $from->diff($to)->y;

    # procedural
   // $age= date_diff(date_create($date_of_birth), date_create('today'))->y;
    //return $age;
}



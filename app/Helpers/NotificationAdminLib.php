<?php
namespace App\Helpers;
use App\Models\Notify;
use DB;

Class NotificationAdminLib
{
    /*
     * Add notification message to admin panel
     * Example:
        use App\Helpers\NotificationAdminLib; #include at the top

        // call
        $message = 'Campaign 1 rejected by User 1';
        $fromUserId=6;

        $add_notification=NotificationAdminLib::addNotification($fromUserId,$message);
        if($add_notification)
        {
            dd("Right");
        }
        else
        {
            dd("Wrong");
        }
     */
    public static function addNotification($fromUserId,$message)
    {
        DB::beginTransaction();
        try {
            $notify = new Notify();
            $notify->send_by=$fromUserId;
            $notify->message=$message;
            $notify->read_status=0;
            $notify->status=1;
            $notify->deleted=0;
            $notify->save();

            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

}

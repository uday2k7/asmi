<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Mail;


Class MailLib
{
    /*
     * Sends email with easy way
     * Example:
     $arg['receiver_name'] = "Mr. Receiver";
     $arg['receiver_email'] = "receiveremail@domain.com";
     $arg['reply_to_name'] = "Mr. Sender"; // OPTIONAL
     $arg['reply_to_email'] = "senderemail@domain.com"; // OPTIONAL
     $arg['subject'] = "This is a subject";
     $arg['params']['content'] = 'This<br/>is a <b>HTML</b>'; // OPTIONAL; IF USED - DO NOT USE $arg['template']
     $arg['params']['name'] = 'Mr. Receiver'; // OPTIONAL
     $arg['params']['otp'] = 1234; // OPTIONAL
     $arg['template'] = "emails.verify"; // OPTIONAL
     $arg['priority'] = 4; // OPTIONAL
     $arg['attachments'][] = ['absolute_path' => "/home/atanu/Downloads/sample.png", 'parameters'=> ['as'=>"Screenshot",'mime' => 'application/pdf']]; // OPTIONAL; parameters CAN BE BLANK ARRAY
     $arg['send_now'] = false; // OPTIONAL
     MailLib::send($arg);
     */
    public static function send($arg)
    {
        $isEmailActive = env('MAIL_ACTIVE');
        if($isEmailActive != 'YES')
            return;

        if(empty($arg['template']))
            $arg['template'] = 'emails.dynamic';
        if(empty($arg['params']))
            $arg['params']['name'] = $arg['receiver_name'];
        if(!isset($arg['send_now']))
            $arg['send_now'] = false;
        if ((empty($arg['priority'])) || (isNotInt($arg['priority'])))
            $arg['priority'] = 6;

        if($arg['send_now'])
            self::triggerEmail($arg);
        else
            QueueLib::push('email', $arg, $arg['priority']);
    }

    /*
     * The actual email script
     */
    private static function triggerEmail($arg)
    {
        $name = $arg['receiver_name'];
        $email = $arg['receiver_email'];
        $subject = $arg['subject'];

        // SENDING EMAIL; DO NOT EDIT BELOW
        Mail::send($arg['template'], $arg['params'],
            function($mail) use ($email, $name, $subject, $arg){
                $mail->from(getenv('MAIL_FROM_DEFAULT_EMAIL'), getenv("MAIL_FROM_DEFAULT_NAME"));
                $mail->to($email, $name);
                $mail->subject($subject);
                if((!empty($arg['reply_to_email'])) && (!empty($arg['reply_to_name'])))
                    $mail->replyTo($arg['reply_to_email'], $arg['reply_to_name']);
                if(!empty($arg['attachments']))
                {
                    foreach($arg['attachments'] as $attachment)
                    {
                        if(!empty($attachment['absolute_path']))
                        {
                            if(file_exists($attachment['absolute_path']))
                                $mail->attach($attachment['absolute_path'], $attachment['parameters']);
                        }
                    }
                }
            });

        // REMOVING ATTACHMENTS AFTER EMAIL SENT
        if(!empty($arg['attachments']))
        {
            foreach($arg['attachments'] as $attachment)
            {
                if(!empty($attachment['absolute_path']))
                {
                    if(file_exists($attachment['absolute_path']))
                        @unlink($attachment['absolute_path']);
                }
            }
        }
    }
}

<?php
namespace App\Helpers;

use App\Models\NotificationPush;
use ExpoSDK\Expo;

Class PushMsgLib
{
    /*
     * https://github.com/ctwillie/expo-server-sdk-php
     * Send push message to app
     * Example:
        $message['toUserId'] = 1234; // INT
        $message['to'] = 'ExponentPushToken[B9vY0KPTDDLC46wPXNNtNG]';
        $message['sound'] = 'default';
        $message['title'] = 'Test notification: '.date('Y-m-d H:i:s');
        $message['body'] = 'This is a notification details with plain text';
        $message['data']['jsonInfo']['type'] = 'EVENT/GIFT/CAMPAIGN/CHAT/GENERAL'; // USE UPPERCASE
        $message['data']['jsonInfo']['id'] = 10; // INT OR NULL
        $message['data']['jsonInfo']['details'] = 'Hello World'; // STRING
        $messages = [$message];
        $result = PushMsgLib::sendExpo($messages);
     */
    public static function sendExpo(array $messages)
    {
        try {
            NotificationPush::saveInfo($messages);
            return (new Expo)->send($messages)->push();
        }
        catch (\Exception $e) {

        }
    }
}

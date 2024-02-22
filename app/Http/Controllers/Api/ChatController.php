<?php

namespace App\Http\Controllers\Api;

use App\Helpers\NotificationAdminLib;
use App\Models\CampaignUser;
use App\Models\Chat;
use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Validator;
use Namshi\JOSE\SimpleJWS;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ChatController extends Controller
{

    /*
     * API
     * Read chat message
     */
    public function read(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $payload = json_decode($request->getContent(), true);
            //$payload['email'] = rand().'@gmail.com';

            $user = JWTAuth::setToken($request->bearerToken())->toUser();

            //VALIDATING FOR REQUIRED DATA
            $rules = [
                'chat_type' => 'required|string|in:'.implode(',',Chat::$types),
                'chat_type_id' => 'required|int',
                'admin_id' => 'required|int',
                'offset' => 'required|int',
                'limit' => 'required|int',
            ];
            $customErrorMsg = [
                'chat_type.in' =>'chat_type can be: '.implode(', ', Chat::$types),
            ];

            $validator = Validator::make($payload, $rules, $customErrorMsg);
            if ($validator->fails())
            {
                $response['status'] = 403;
                $response['errors'] = $validator->errors()->all();
            }

            if(empty($response['errors']))
            {
                $result = Chat::read($user->id, $payload);

                if(!empty($result))
                {
                    $response['status'] = 200;
                    $response['data']->selfInfo = User::getPostById($user->id);
                    $response['data']->adminInfo = User::getPostById($payload['admin_id']);
                    $response['data']->conversations = $result;
                }
                else
                {
                    $response['status'] = 404;
                    $response['data']->message = 'Enter your message to start a chat';
                }
            }
        }
        catch (\Exception $exception)
        {
            $log = 'Error:: '.$exception->getMessage().'<br/>File:: '.$exception->getFile().' ['.$exception->getLine().']';
            customLog($log, 'apiException');
            $response['errors'][] = 'Something went wrong';
        }

        return self::getValidApiResult($response);
    }

    /*
     * API
     * Write chat message
     */
    public function write(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $payload = json_decode($request->getContent(), true);
            //$payload['email'] = rand().'@gmail.com';

            $user = JWTAuth::setToken($request->bearerToken())->toUser();

            //VALIDATING FOR REQUIRED DATA
            $rules = [
                'chat_type' => 'required|string|in:'.implode(',',Chat::$types),
                'chat_type_id' => 'required|int',
                'admin_id' => 'required|int',
                'message' => 'required',
            ];
            $customErrorMsg = [
                'chat_type.in' =>'chat_type can be: '.implode(', ', Chat::$types),
            ];

            $validator = Validator::make($payload, $rules, $customErrorMsg);
            if ($validator->fails())
            {
                $response['status'] = 403;
                $response['errors'] = $validator->errors()->all();
            }

            if(empty($response['errors']))
            {
                $result = Chat::write($user->id, $payload);

                if($result)
                {
                    $response['status'] = 200;
                    $response['data']->message = 'Message sent';

                    NotificationAdminLib::addNotification($user->id, $user->full_name.' sent you a message!');
                }
                else
                {
                    $response['status'] = 404;
                    $response['data']->message = 'Message not sent';
                }
            }
        }
        catch (\Exception $exception)
        {
            $log = 'Error:: '.$exception->getMessage().'<br/>File:: '.$exception->getFile().' ['.$exception->getLine().']';
            customLog($log, 'apiException');
            $response['errors'][] = 'Something went wrong';
        }

        return self::getValidApiResult($response);
    }
}

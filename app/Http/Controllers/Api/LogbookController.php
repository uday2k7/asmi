<?php

namespace App\Http\Controllers\Api;

use App\Models\CampaignStat;
use App\Models\CampaignUser;
use App\Models\GiftUser;
use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Namshi\JOSE\SimpleJWS;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogbookController extends Controller
{

    /*
     * API
     * Get calendar by year month date
     * Ex: "2022-08-24"
     */
    public function getByDate(Request $request): array
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
                'year-month-date' => 'required|string',
            ];

            $validator = Validator::make($payload, $rules);
            if ($validator->fails())
            {
                $response['status'] = 403;
                $response['errors'] = $validator->errors()->all();
            }

            if(empty($response['errors']))
            {
                $response['data']->campaigns = CampaignUser::calendarGetByDate($user->id, $payload);
                $response['data']->gifts = GiftUser::calendarGetByDate($user->id, $payload);

                // IMPORTANT: FIXING DATA TYPE FOR EMPTY
                if(empty($response['data']->campaigns))
                    $response['data']->campaigns = new \stdClass();
                if(empty($response['data']->gifts))
                    $response['data']->gifts = new \stdClass();

                $response['status'] = 200;
            }
            else
            {
                $response['status'] = 404;
                $response['data']->campaigns = [];
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
     * Add a log
     */
    public function create(Request $request): array
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
                'year-month-date' => 'required|string',
            ];

            $validator = Validator::make($payload, $rules);
            if ($validator->fails())
            {
                $response['status'] = 403;
                $response['errors'] = $validator->errors()->all();
            }

            if(empty($response['errors']))
            {
                $response['data']->campaigns = CampaignUser::calendarGetByDate($user->id, $payload);
                $response['data']->gifts = GiftUser::calendarGetByDate($user->id, $payload);

                // IMPORTANT: FIXING DATA TYPE FOR EMPTY
                if(empty($response['data']->campaigns))
                    $response['data']->campaigns = new \stdClass();
                if(empty($response['data']->gifts))
                    $response['data']->gifts = new \stdClass();

                $response['status'] = 200;
            }
            else
            {
                $response['status'] = 404;
                $response['data']->campaigns = [];
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

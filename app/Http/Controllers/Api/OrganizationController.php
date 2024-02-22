<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MailLib;
use App\Helpers\NotificationAdminLib;
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

class OrganizationController extends Controller
{


    /*
     * API
     * Get info by id
     */
    public function info(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $payload = json_decode($request->getContent(), true);
            //$payload['email'] = rand().'@gmail.com';

            if(!empty($payload))
            {
                //VALIDATING FOR REQUIRED DATA
                $rules = [
                    'organization_id' => 'required|int',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 403;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    $result = Organization::getPostById($payload['organization_id']);

                    $response['status'] = 200;
                    $response['data']->organizationInfo = $result;

                }
            }
            else
            {
                $response['status'] = 400;
                $response['errors'][] = 'Request is empty';
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
     * Get invites users
     */
    public function invites(Request $request): array
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
                'status' => 'required|in:' . implode(',', OrganizationUser::$inviteStatus),
                'offset' => 'required|int',
                'limit' => 'required|int',
            ];
            $customErrorMsg = [
                'status.in' =>'status can be: '.implode(', ', OrganizationUser::$inviteStatus),
            ];

            $validator = Validator::make($payload, $rules, $customErrorMsg);
            if ($validator->fails())
            {
                $response['status'] = 403;
                $response['errors'] = $validator->errors()->all();
            }
            else
            {
                $result = OrganizationUser::invitesList($user->id, $payload['status'], $payload['offset'], $payload['limit']);

                if (!empty($result))
                {
                    $response['status'] = 200;
                    $response['data']->invites = $result;
                }
                else
                {
                    $response['status'] = 404;
                    $response['data']->message = 'There are no invites';
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
     * Get invites users
     */
    public function inviteResponse(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $payload = json_decode($request->getContent(), true);
            //$payload['email'] = rand().'@gmail.com';

            if(!empty($payload))
            {
                $user = JWTAuth::setToken($request->bearerToken())->toUser();

                //VALIDATING FOR REQUIRED DATA
                $rules = [
                    'organization_id' => 'required|int',
                    'is_accepted' => 'required|bool',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 403;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    $invitationStatus = OrganizationUser::INVITE_DENIED;
                    if($payload['is_accepted'])
                        $invitationStatus = OrganizationUser::INVITE_ACCEPTED;

                    $search = OrganizationUser::where('organization_id',$payload['organization_id'])->where('influencer_id', $user->id)->first();

                    if(!empty($search) && (!empty($search->toArray())))
                    {
                        $update['invitation_status'] = $invitationStatus;
                        if($update['invitation_status'] == OrganizationUser::INVITE_DENIED)
                        {
                            if(empty($payload['reason_for_decline']))
                            {
                                $response['status'] = 400;
                                $response['errors'][] = 'Please select the reason of decline';
                            }
                            else
                            {
                                $update['reason_for_decline'] = $payload['reason_for_decline'];

                                if(!empty($payload['decline_message']))
                                    $update['decline_message'] = $payload['decline_message'];

                                NotificationAdminLib::addNotification($user->id, $user->full_name.' has denied your organization invitation');
                            }
                        }
                        else
                            NotificationAdminLib::addNotification($user->id, $user->full_name.' has accepted your organization invitation');

                        $search->update($update);
                        $response['status'] = 200;
                        $response['data']->message = 'Invitation '.$invitationStatus;
                    }
                    else
                    {
                        $response['status'] = 404;
                        $response['data']->message = 'Invitation not found';
                    }
                }
            }
            else
            {
                $response['status'] = 400;
                $response['errors'][] = 'Request is empty';
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
     * Email to organization
     * Influencer is sending email to organizer
     */
    public function sendEmail(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $token = $request->bearerToken();
            $payload = json_decode($request->getContent(), true);

            if(!empty($token))
            {
                $user = JWTAuth::setToken($token)->toUser();

                //VALIDATING GENERAL DATA, ALWAYS MUST BE PRESENT
                $rules = [
                    'subject' => 'required|min:2|max:255',
                    'message' => 'required|min:10',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 400;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    $organizationInfo = OrganizationUser::getOrganizationInfo($user->id);

                    if(!empty($organizationInfo))
                    {
                        $arg['receiver_name'] = $organizationInfo['adminInfo']['full_name'];
                        $arg['receiver_email'] = $organizationInfo['adminInfo']['email'];
                        $arg['reply_to_name'] = $user->full_name; // OPTIONAL
                        $arg['reply_to_email'] = $user->email; // OPTIONAL
                        $arg['subject'] = $payload['subject'];
                        $arg['params']['content'] = $payload['message']; // OPTIONAL
                        $arg['template'] = "emails.dynamic"; // OPTIONAL
                        $arg['priority'] = 1; // OPTIONAL
                        $arg['send_now'] = true; // OPTIONAL
                        MailLib::send($arg);

                        $response['status'] = 200;
                        $response['data']->message = 'Your message has been sent to organization';
                    }
                    else
                    {
                        $response['status'] = 404;
                        $response['errors'][] = 'Organization not found';
                    }
                }
            }
            else
            {
                $response['status'] = 400;
                $response['errors'][] = 'Request does not contain token';
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

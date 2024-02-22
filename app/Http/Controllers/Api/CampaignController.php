<?php

namespace App\Http\Controllers\Api;

use App\Helpers\NotificationAdminLib;
use App\Models\CampaignStat;
use App\Models\CampaignUser;
use App\Models\Campaign;
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

class CampaignController extends Controller
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

            if(!empty($payload))
            {
                //VALIDATING FOR REQUIRED DATA
                $rules = [
                    'campaign_id' => 'required|int',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 403;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    $result = Campaign::getPostById($payload['campaign_id']);

                    $response['status'] = 200;
                    $response['data']->campaignInfo = $result;

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
     * Get campaign invites for a users
     */
    public function listByGenericStatus(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $payload = json_decode($request->getContent(), true);
            //$payload['email'] = rand().'@gmail.com';

            $user = JWTAuth::setToken($request->bearerToken())->toUser();

            // Fetch campaigns based on generic status (ex: old date, today, upcoming, completed etc)

            if(empty($payload['generic_status']))
                $payload['generic_status'] = 'INVITED';

            if(in_array($payload['generic_status'], CampaignUser::$availableGenericStatus))
                $result = CampaignUser::listByGenericStatus($user->id, $payload['generic_status']);
            else
            {
                $response['status'] = 400;
                $response['errors'][] = 'Generic status can be '. implode(' or ', CampaignUser::$availableGenericStatus);
            }


            if(!empty($result))
            {
                $response['status'] = 200;
                $response['data']->campaigns = $result;
            }
            else
            {
                $response['status'] = 404;
                $response['data']->message = 'There are no '.$payload['generic_status']. ' events';
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
     * User can accept or deny the campaign request
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
                    'campaign_id' => 'required|int',
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
                    $invitationStatus = CampaignUser::STATUS_REJECTED;
                    if($payload['is_accepted'])
                        $invitationStatus = CampaignUser::STATUS_AWAITING_CAMPAIGN_STATS;

                    $search = CampaignUser::where('campaign_id',$payload['campaign_id'])->where('status', CampaignUser::STATUS_INVITED)->where('influencer_id', $user->id)->first();

                    if(!empty($search) && (!empty($search->toArray())))
                    {
                        $update['status'] = $invitationStatus;

                        if($update['status'] == CampaignUser::STATUS_REJECTED)
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

                                $message = 'You have REJECTED the invitation';

                                NotificationAdminLib::addNotification($user->id, $user->full_name.' has denied your campaign invitation');
                            }
                        }
                        else
                            NotificationAdminLib::addNotification($user->id, $user->full_name.' has accepted your campaign invitation');

                        $search->update($update);
                        $response['status'] = 200;

                        if(empty($response['errors']))
                        {
                            if(empty($message))
                                $message = 'Thank you for accepting the invitation';

                            $response['data']->message = $message;
                        }
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
     * Save stats
     */
    public function uploadStats(Request $request): array
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
                    'campaign_id' => 'required|int',
                    'stat_name' => 'required|string',
                    'stat_file' => 'required|string',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 400;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    $existingCampaignStat = CampaignStat::where('campaign_id', $payload['campaign_id'])->where('influencer_id',$user->id)->where('stat_name',$payload['stat_name'])->get()->toArray();

                    $imageExtension = explode(';', explode('/', $payload['stat_file'])[1])[0];
                    $imageData = base64_decode(explode(',', $payload['stat_file'])[1]);
                    $imageName = 'campaign-stats/'.$user->id.'-'.time().'.'.$imageExtension;
                    Storage::disk('user-content')->put($imageName, $imageData);
                    $assetUrl = Storage::disk('user-content')->url('/'.$imageName);

                    $insertOrUpdate['campaign_id'] = $payload['campaign_id'];
                    $insertOrUpdate['influencer_id'] = $user->id;
                    $insertOrUpdate['stat_name'] = $payload['stat_name'];
                    $insertOrUpdate['stat_file'] = $assetUrl;

                    if(!empty($existingCampaignStat)) // update
                    {
                        $existingCampaignStat = $existingCampaignStat[0];

                        // REMOVING OLD ASSET
                        if(!empty($user->profile_pic))
                        {
                            $oldAssetSegments = explode('/',$existingCampaignStat['stat_file']);
                            $oldAssetName = end($oldAssetSegments);
                            Storage::disk('user-content')->delete('campaign-stats/' . $oldAssetName);
                        }

                        CampaignStat::find($existingCampaignStat['id'])->update($insertOrUpdate);
                    }
                    else // insert
                        CampaignStat::insert($insertOrUpdate);

                    // UPDATING CAMPAIGN AS AWAITING FOR APPROVAL
                    CampaignUser::where('campaign_id', $payload['campaign_id'])->update(['status'=>CampaignUser::STATUS_AWAITING_CAMPAIGN_STATS_APPROVAL]);

                    $response['status'] = 200;
                    $response['data']->message = 'Stats upload success';
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

    /*
     * API
     * Get stats
     */
    public function getStats(Request $request): array
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
                    'campaign_id' => 'required|int',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 400;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    $existingCampaignStat = CampaignStat::where('campaign_id', $payload['campaign_id'])->where('influencer_id',$user->id)->get()->toArray();

                    $response['status'] = 200;
                    $response['data']->stats = $existingCampaignStat;
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

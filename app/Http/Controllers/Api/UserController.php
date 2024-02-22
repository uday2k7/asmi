<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MailLib;
use App\Models\CampaignUser;
use App\Models\NotificationPush;
use App\Models\OrganizationUser;
use App\Models\User;
use App\Models\UserGenres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Matcher\Not;
use Namshi\JOSE\SimpleJWS;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\GoogleTrait;

class UserController extends Controller
{
    use GoogleTrait;

    /**
     * API Register
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

            if(!empty($payload))
            {
                //VALIDATING FOR REQUIRED DATA
                $rules = [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'mobile' => 'required|max:25|unique:users',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 403;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    // ALL GOOD; TIME TO DB INSERT
                    $insert['user_type'] = User::USER_TYPE_TYPE1;
                    $insert['first_name'] = $payload['first_name'];
                    $insert['last_name'] = strtolower($payload['last_name']);
                    $insert['mobile'] = $payload['mobile'];
                    $userId = User::insertGetId($insert);

                    $response['status'] = 200;
                    $response['data']->message = 'Your account created successfully';
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
     * Refresh/exchange token
     */
    public function refreshToken(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $token = $request->bearerToken();

            if(!empty($token))
            {
                $user = JWTAuth::setToken($token)->toUser();

                $payload = JWTAuth::getPayload($token);

                $additionalData = ['id' => $user->id];
                $expires = time()+(86400*365);
                $token = JWTAuth::customClaims(['exp' => $expires])->fromUser($user, $additionalData); // 30 days token validity

                $response['status'] = 200;
                $response['data']->newToken = $token;
                $response['data']->newTokenExpires = $expires;
                $user->genre_ids = UserGenres::where('user_id', $user->id)->get()->toArray();
                $response['data']->userInfo = $user;
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
     * Login a user
     */
    public function login(Request $request): array
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
                    'mobile' => 'required|max:255',
                    'otp' => 'required|min:4|int',
                    'fcm_token' => 'required|max:255',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 403;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    $user = User::where('mobile', $payload['mobile'])->first();
                    if (!empty($user))
                    {
                        if ($payload['otp'] == $user->otp)
                        {
                            if($user->is_mobile_verified == User::USER_MOBILE_VERIFIED)
                            {
                                $additionalData = ['id' => $user->id];
                                $token = JWTAuth::customClaims(['exp' => time()+(86400*365)])->fromUser($user, $additionalData); // 30 days token validity

                                // SAVING fcm_token IF EXISTS
                                $user->fcm_token = $payload['fcm_token'];
                                $user->save();

                                $response['status'] = 200;
                                $response['data']->message = 'Login successful';
                                $response['data']->token = $token;
                                $response['data']->userInfo = $user;
                            }
                            else
                            {
                                $response['status'] = 403;
                                $response['errors'][] = 'The mobile number is not verified';
                            }
                        }
                        else
                        {
                            $response['status'] = 404;
                            $response['errors'][] = 'The mobile and otp is invalid';
                        }
                    }
                    else
                    {
                        $response['status'] = 404;
                        $response['errors'][] = 'The mobile and otp does not match';
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
     * Logout
     */
    public function logout(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $token = $request->bearerToken();
            JWTAuth::invalidate($token);

            $response['status'] = 200;
            $response['data']->message = 'Logout successful';
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
     * Get info by token
     */
    public function infoByToken(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $token = $request->bearerToken();

            if(!empty($token))
            {
                $user = JWTAuth::setToken($token)->toUser();
                if($user)
                    $user->genre_ids = UserGenres::where('user_id', $user->id)->get()->toArray();

                $payload = JWTAuth::getPayload($token);
                $tokenDebug['id'] = $payload['id'];
                $tokenDebug['sub'] = $payload['sub'];
                $tokenDebug['iss'] = $payload['iss'];
                $tokenDebug['iat'] = $payload['iat'];
                $tokenDebug['exp'] = $payload['exp'];
                $tokenDebug['nbf'] = $payload['nbf'];
                $tokenDebug['jti'] = $payload['jti'];

                $response['status'] = 200;
                $response['data']->userInfo = $user;
                $response['data']->tokenDebug = $tokenDebug;
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
     * Get user
     */
    public function myself(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $token = $request->bearerToken();

            if(!empty($token))
            {
                $user = JWTAuth::setToken($token)->toUser();

                $response['status'] = 200;
                $response['data']->userInfo = $user;
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
     * Get notification of an influencer
     */
    public function notification(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $token = $request->bearerToken();

            if(!empty($token))
            {
                $user = JWTAuth::setToken($token)->toUser();

                $notifications = NotificationPush::where('influencer_id',$user->id)
                    ->where('is_read', User::BOOL_NO)
                    ->get()
                    ->toArray();

                // MARKING AS READ
                NotificationPush::where('influencer_id',$user->id)
                    ->where('is_read', User::BOOL_NO)
                    ->update(['is_read' => User::BOOL_YES]);

                $response['status'] = 200;
                $response['data']->organizationPendingCount = count(OrganizationUser::inviteOrganizationInfo($user->id));
                $response['data']->campaignPendingCount = count(CampaignUser::inviteCampaignsInfo($user->id));
                $response['data']->notificationCount = count($notifications);
                $response['data']->notifications = $notifications;
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
     * Update logged in user's profile
     */
    public function profileUpdate(Request $request): array
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
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'address' => 'required',
                    'date_of_birth' => 'required|date|date_format:Y-m-d|before:today',
                    'gender' => 'required',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 400;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    if(!empty($payload['mobile']))
                        $update['mobile'] = $payload['mobile'];
                    if(!empty($payload['insta_id']))
                        $update['insta_id'] = $payload['insta_id'];
                    if(!empty($payload['tiktok_id']))
                        $update['tiktok_id'] = $payload['tiktok_id'];
                    $update['first_name'] = $payload['first_name'];
                    $update['last_name'] = $payload['last_name'];
                    $update['address'] = $payload['address'];
                    $update['date_of_birth'] = $payload['date_of_birth'];
                    $update['gender'] = $payload['gender'];
                }

                // PROFILE PIC UPDATE
                if(!empty($payload['profile_pic']))
                {
                    $rules = [
                        'profile_pic' => 'required',
                    ];

                    $validator = Validator::make($payload, $rules);
                    if ($validator->fails())
                    {
                        $response['status'] = 400;
                        $response['errors'] = $validator->errors()->all();
                    }

                    if(empty($response['errors']))
                    {
                        $imageExtension = explode(';', explode('/', $payload['profile_pic'])[1])[0];
                        $imageData = base64_decode(explode(',', $payload['profile_pic'])[1]);
                        $imageName = 'profile-pic/'.$user->id.'-'.time().'.'.$imageExtension;
                        Storage::disk('user-content')->put($imageName, $imageData);
                        $profilePicUrl = Storage::disk('user-content')->url('/'.$imageName);
                        $update['profile_pic'] = $profilePicUrl;

                        // REMOVING OLD ASSET
                        if(!empty($user->profile_pic))
                        {
                            $oldProfilePicSegments = explode('/',$user->profile_pic);
                            $oldProfilePicName = end($oldProfilePicSegments);
                            Storage::disk('user-content')->delete('profile-pic/' . $oldProfilePicName);
                        }
                    }
                }

                if(empty($response['errors']))
                {
                    // IMPORTANT: MAKE SURE ALL COLUMN NAME AS $fillable IN THE MODEL
                    if(!empty($update))
                        User::find($user->id)->update($update);

                    $response['status'] = 200;
                    $response['data']->message = 'Your profile has been updated';

                    $user = User::find($user->id);
                    $response['data']->userInfo = $user;
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
     * Send OTP to user to verify email address
     */
    public function verifyMobileSentOtp(Request $request): array
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
                    'mobile' => 'required|max:255',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 403;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    $user = User::where('mobile', trim($payload['mobile']))->first();
                    if (!empty($user))
                    {
                        $user->otp = 1234; //rand(1000,9999);
                        $user->otp_expires = (time()+360);
                        $user->save();

                        // SENDING EMAIL WITH VERIFICATION CODE
//                        $arg['receiver_name'] = $user->full_name;
//                        $arg['receiver_email'] = $user->email;
//                        $arg['subject'] = "Verify your email for VaVa";
//                        $arg['params']['name'] = $user->full_name; // OPTIONAL
//                        $arg['params']['email'] = $user->email; // OPTIONAL
//                        $arg['params']['otp'] = $user->otp; // OPTIONAL
//                        $arg['template'] = "emails.verify"; // OPTIONAL
//                        $arg['priority'] = 1; // OPTIONAL
//                        $arg['send_now'] = true; // OPTIONAL
//                        MailLib::send($arg);

                        $response['status'] = 200;
                        $response['data']->message = 'Please check your email to verify your account';
                        $response['data']->otp = $user->otp;
                        $response['data']->otpExpires = $user->otp_expires;
                    }
                    else
                    {
                        $response['status'] = 404;
                        $response['errors'][] = 'Account not found';
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
     * Check OTP to verify email address
     */
    public function verifyMobileVerifyOtp(Request $request): array
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
                    'mobile' => 'required|max:255',
                    'otp' => 'required|int',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                    $response['errors'] = $validator->errors()->all();

                if(empty($response['errors']))
                {
                    $user = User::where('mobile', trim($payload['mobile']))->first();
                    if (!empty($user))
                    {
                        if($user->otp_expires < time())
                        {
                            $response['status'] = 403;
                            $response['errors'][] = 'The OTP has expired, please try again';
                        }
                        else if($user->otp == $payload['otp'])
                        {
                            $user->is_mobile_verified = User::USER_MOBILE_VERIFIED;
                            $user->save();

                            // SEND EMAIL AS AC VERIFIED
//                            $arg['receiver_name'] = $user->full_name;
//                            $arg['receiver_email'] = $user->email;
//                            $arg['subject'] = "Account verified for VaVa";
//                            $arg['params']['name'] = $user->full_name; // OPTIONAL
//                            $arg['params']['email'] = $user->email; // OPTIONAL
//                            $arg['template'] = "emails.verified"; // OPTIONAL
//                            $arg['priority'] = 1; // OPTIONAL
//                            $arg['send_now'] = true; // OPTIONAL
//                            MailLib::send($arg);

                            $response['status'] = 200;
                            $response['data']->message = 'Your mobile has been verified';
                        }
                        else
                        {
                            $response['status'] = 403;
                            $response['errors'][] = 'Invalid OTP, please try again';
                        }
                    }
                    else
                    {
                        $response['status'] = 404;
                        $response['errors'][] = 'Account not found';
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
     * Send OTP to user to reset account password
     */
    public function resetPasswordSentOtp(Request $request): array
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
                    'email' => 'required|email|max:255',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                {
                    $response['status'] = 403;
                    $response['errors'] = $validator->errors()->all();
                }

                if(empty($response['errors']))
                {
                    $user = User::where('email', trim($payload['email']))->first();
                    if (!empty($user))
                    {
                        $user->otp = rand(1000,9999);
                        $user->otp_expires = (time()+360);
                        $user->save();

                        $arg['receiver_name'] = $user->full_name;
                        $arg['receiver_email'] = $user->email;
                        $arg['subject'] = "Confirm request for password change";
                        $arg['params']['name'] = $user->full_name; // OPTIONAL
                        $arg['params']['email'] = $user->email; // OPTIONAL
                        $arg['params']['otp'] = $user->otp; // OPTIONAL
                        $arg['template'] = "emails.passwordReset"; // OPTIONAL
                        $arg['priority'] = 1; // OPTIONAL
                        $arg['send_now'] = true; // OPTIONAL
                        MailLib::send($arg);

                        $response['status'] = 200;
                        $response['data']->message = 'Please check your email to reset your account password';
                        $response['data']->otp = $user->otp;
                        $response['data']->otpExpires = $user->otp_expires;
                    }
                    else
                    {
                        $response['status'] = 404;
                        $response['errors'][] = 'Account not found';
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
     * Check OTP to verify email address then reset the password
     */
    public function resetPasswordVerifyOtp(Request $request): array
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
                    'email' => 'required|email|max:255',
                    'otp' => 'required|int',
                    'password' => 'required|min:6|confirmed',
                ];

                $validator = Validator::make($payload, $rules);
                if ($validator->fails())
                    $response['errors'] = $validator->errors()->all();

                if(empty($response['errors']))
                {
                    $user = User::where('email', trim($payload['email']))->first();
                    if (!empty($user))
                    {
                        if($user->otp_expires < time())
                        {
                            $response['status'] = 403;
                            $response['errors'][] = 'The OTP has expired, please try again';
                        }
                        else if($user->otp == $payload['otp'])
                        {
                            $user->password = Hash::make($payload['password']);
                            $user->save();

                            // SEND EMAIL NOW WITH CONFIRMATION
                            $arg['receiver_name'] = $user->full_name;
                            $arg['receiver_email'] = $user->email;
                            $arg['subject'] = "Password updated for VaVa";
                            $arg['params']['name'] = $user->full_name; // OPTIONAL
                            $arg['params']['email'] = $user->email; // OPTIONAL
                            $arg['template'] = "emails.passwordChanged"; // OPTIONAL
                            $arg['priority'] = 1; // OPTIONAL
                            $arg['send_now'] = true; // OPTIONAL
                            MailLib::send($arg);

                            $response['status'] = 200;
                            $response['data']->message = 'Your password has been updated';
                        }
                        else
                        {
                            $response['status'] = 403;
                            $response['errors'][] = 'Invalid OTP, please try again';
                        }
                    }
                    else
                    {
                        $response['status'] = 404;
                        $response['errors'][] = 'Account not found';
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

}

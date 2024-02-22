<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MailLib;
use App\Helpers\PushMsgLib;
use App\Models\Aboutus;
use App\Models\Activitiy;
use App\Models\Emotion;
use App\Models\Event;
use App\Models\Privacy;
use App\Models\Terms;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{

    /*
     * Test
     */
    public function test(Request $request)
    {
        $message['toUserId'] = 137;
        $message['to'] = 'ExponentPushToken[ITfsqEJc62UBOXB1qhLTOq]';
        $message['sound'] = 'default';
        $message['title'] = 'Test notification: '.date('Y-m-d H:i:s');
        $message['body'] = 'This is a notification details with plain text';
        $message['data']['jsonInfo']['type'] = 'CAMPAIGN'; // 'EVENT/GIFT/CAMPAIGN/GENERAL';
        $message['data']['jsonInfo']['id'] = 10; // INT; USE 0 NOT APPLICABLE
        $message['data']['jsonInfo']['details'] = 'Hello World'; // STRING
        $messages = [$message];

        $result = PushMsgLib::sendExpo($messages);
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        exit();
    }

    /*
     * List genres
     */
    public function getIcons(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $response['data']->activities = Activitiy::all();
            $response['data']->emotions = Emotion::all();
            $response['data']->events = Event::all();
            $response['status'] = 200;
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
     * List genders
     */
    public function getGenders(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $response['data']->list = User::$genders;
            $response['status'] = 200;
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
     * Page about us
     */
    public function aboutUsPage(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $page = Aboutus::where('status', 1)
                ->where('deleted', 0)
                ->get()
                ->first();

            $response['data']->page = $page;
            $response['status'] = 200;
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
     * Page terms of service
     */
    public function termsOfServicePage(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $page = Terms::where('status', 1)
                ->where('deleted', 0)
                ->get()
                ->first();

            $response['data']->page = $page;
            $response['status'] = 200;
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
     * Page privacy policy
     */
    public function privacyPolicyPage(Request $request): array
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $page = Privacy::where('status', 1)
                ->where('deleted', 0)
                ->get()
                ->first();

            $response['data']->page = $page;
            $response['status'] = 200;
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

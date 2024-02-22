<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
     * This is a helper method of getValidApiResult($data)
     * @returns array which is standard for API result
     */
    private static function setApiError($error): array
    {
        $result['status'] = 500;
        $result['errors'][] = "Error occurred while generating API response";
        $result['errors'][] = $error;
        $result['data'] = new \stdClass();
        return $result;
    }

    /*
     * This method validates if all data is structured and present before sending as API result
     */
    public static function getValidApiResult($data): array
    {
        if (!isset($data['status']))
            return self::setApiError("'status' parameter not created");
        if (!isset($data['errors']))
            return self::setApiError("'errors' parameter not created");
        if (!isset($data['data']))
            return self::setApiError("'data' parameter not created");
        if (!is_array($data['errors']))
            return self::setApiError("'errors' parameter is not array");
        if ((!is_array($data['data'])) && (!is_object($data['data'])))
            return self::setApiError("'data' parameter is not array");

        $data['status'] = (int)$data['status'];
        return ($data);
    }
}

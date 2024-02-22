<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Closure;
//use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTToken extends Controller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response['status'] = 500;
        $response['errors'] = [];
        $response['data'] = new \stdClass();

        try
        {
            $token = $request->bearerToken();
            $user = JWTAuth::setToken($token)->toUser();

            if(empty($user))
            {
                $response['status'] = 403;
                $response['errors'][] = 'Token is corrupted';
            }

        }
        catch (TokenExpiredException $exception)
        {
            $response['status'] = 403;
            $response['errors'][] = 'Token has expired';
        }
        catch (TokenInvalidException $exception)
        {
            $response['status'] = 403;
            $response['errors'][] = 'Token is invalid';
        }
        catch (JWTException $exception)
        {
            $log = 'Error:: '.$exception->getMessage().'<br/>File:: '.$exception->getFile().' ['.$exception->getLine().']';
            customLog($log, 'apiException');
            $response['errors'][] = 'Something wrong in token';
        }

        if(!empty($response['errors']))
            return response()->json(self::getValidApiResult($response), 200);

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App;
class ApiKey
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
        if (App::environment('development'))
        {
            return $next($request);
            // $access_token = config('apitoken.dev_token');
        }else{
            $access_token = config('apitoken.token');
        }
        $header = $request->header('Authorization', ''); 
        //echo $header;exit();
        $request_token = $request->bearerToken();
        if($request_token == $access_token){
            return $next($request);
        }

        $response = [
            'success' => false,
            'message' => 'Unauthorized.',
            'data'=>[], 
        ];
        if ($request->wantsJson()) {
            return response()->json($response, 401);
        }
        return $response;
    }
}

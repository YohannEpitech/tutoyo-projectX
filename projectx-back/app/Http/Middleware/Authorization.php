<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class Authorization
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
        $token = $request->header('authorization');
        if ($token){
            $token = explode(' ',$token)[1];
            $users = User::all();
            $check = false;
            foreach ($users as $user){
                if ($user['api_token'] == $token){
                    $check = true;
                    break;
                }
            }
            if ($check) {
                return $next($request);
            }
        }

        return response()->json([
            "code"=> 401,
            "message"=> "User unauthorized"
        ]);
    }
}

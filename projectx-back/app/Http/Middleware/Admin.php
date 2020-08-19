<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class Admin
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
            $user = User::where('api_token',$token)->first();

            if ($user->role == 2) {
                return $next($request);
            }
        }

        return response()->json([
            "code"=> 401,
            "message"=> "Only admin can used this route"
        ]);
    }
}

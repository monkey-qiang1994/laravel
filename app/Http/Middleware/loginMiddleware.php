<?php

namespace App\Http\Middleware;

use Closure;

class loginMiddleware
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
        // $request 请求报文
        //检测用户是否具有登录的session
        if($request->session()->has('user_id')){
            return $next($request);
        }else{
            //跳转到登录界面
            return redirect("/login/create");
        }
    }
}

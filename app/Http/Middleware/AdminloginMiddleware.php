<?php

namespace App\Http\Middleware;

use Closure;

class AdminloginMiddleware
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
        //检测用户是否具有登录的session
        if($request->session()->has('username')){
            //获取访问模块控制器和方法名
            $actions=explode('\\', \Route::current()->getActionName()); 
            //或$actions=explode('\\', \Route::currentRouteAction()); 
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]); 
            //控制器名
            $controllerName=$func[0]; 
            $actionName=$func[1];
            // 4.获取访问控制器和方法和乃文权限列表作对比
            // echo $controllerName.":".$actionName;
            // 获取权限信息
            $nodelist=session('nodelist');
            // dd($nodelist);
            //和权限列表作对比
            // if(empty($nodelist[$controllerName])||!in_array($actionName,$nodelist[$controllerName])){
            //     return redirect("/adminx")->with('error',"抱歉,您没有权限访问该模块,请联系超级管理员");
            // }
            //执行下个请求
            return $next($request);
        }else{
            return redirect('/adminlogin/create');
        }
    }
}

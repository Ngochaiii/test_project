<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Product
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $module = json_decode(Auth::user()->module,true);
        if (Auth::user()->role == 1 || !is_null($module['product']) ) {
            return $next($request);
       }

       return redirect('')->with('alert',' Bạn chưa thể dùng tính năng này vui lòng trả nghiệm chức năng khác');
    }
}

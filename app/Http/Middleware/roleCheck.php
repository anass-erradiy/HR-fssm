<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth ;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class roleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()){
            if(Auth::user()->admin >= 1){
                return $next($request);
            }else{
                return back();
            }
        }
        else {
            return redirect()->route('login');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class IsAdminMiddleWare
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
        //if (Auth::guest() || !Auth::user()->isAdmin() ) 
        if(auth()->user()->isAdmin == 1){
            return $next($request);
            //return redirect('/', 301)->with('message', 'You need to be admin to see this page.' )
        }
        return redirect('home');
        
    }
}

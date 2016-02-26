<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class RedirectIfNoAdmin
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
        if (Auth::check()) {
            $user = Auth::user();
            if(!$user->hasPermission('is_admin')){
                return redirect('/')->withErrors(['Sie sind nicht berechtigt, auf diese Seite zuzugreifen.']);
            }
        }
        else{
           return redirect('/')->withErrors(['Sie sind nicht berechtigt, auf diese Seite zuzugreifen.']);
        }

        return $next($request);
    }
}

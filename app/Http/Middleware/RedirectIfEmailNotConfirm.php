<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfEmailNotConfirm
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
        if (! $request->user()->email_verified_at) {
            return redirect('/threads')->with('flash', 'Your email address is not verified.');
        }

        return $next($request);
    }
}

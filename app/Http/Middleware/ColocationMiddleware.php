<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ColocationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $colocation_id = $request->route('id');

        $member = Auth::user()->memberships()->where(['colocation_id'=> $colocation_id,'left_at'=>null])->exists();

        if (!$member) {
            abort(403);
        }

        return $next($request);
    }
}

<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPremium
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_premium) {
            return redirect()->route('premium.page');
        }

        return redirect()->route('normal.page');
    }
}

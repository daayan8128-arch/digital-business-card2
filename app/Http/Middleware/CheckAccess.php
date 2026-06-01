<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckAccess
{
    public function handle(Request $request, Closure $next)
    {
        $username = $request->route('username');
        $user = User::where('username', $username)->first();

        if (!$user || $user->access === 'block') {
            abort(403, 'This user profile is not accessible.');
        }

        return $next($request);
    }
}

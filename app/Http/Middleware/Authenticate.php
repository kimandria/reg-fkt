<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use App\Models\User;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $userId = $request->cookie('user_id');
        $user = User::find($userId);

        if ($user) {
            if ($user->isAdmin() || $user->fkt_id || $user->borough_id || $user->district_id || $user->prefecture_id) {
                return $next($request);
            }

            // If the code reaches this line, it means that the user is not
            // an admin and has no access to any of the territory routes (fkt,
            // borough, district, prefecture). So, we redirect the user to the
            // "unauthorized" page.
            return redirect('/unauthorized');
        }

        // If the code reaches this line, it means that the user does not exist.
        // So, we redirect the user to the login page.
        // (There's already a redirect in the controller, but this is for good measure.)
        return redirect('/login');
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}

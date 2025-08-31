<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Application\Model\User;

class TokenAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // ✅ Allow users already logged in via session to access the page
        if (Auth::check()) {
            return $next($request);
        }

        // 🔎 Get the Token from the Authorization header or Query Parameter
        $token = $request->header('Authorization') ?? $request->query('token');

        // ⚠️ If no Token is provided, redirect to the login page
        if (!$token) {
            return redirect('/login')->with('error', 'You must be logged in.');
        }

        // 🔍 Find the user associated with the Token
        $user = User::where('api_token', $token)->first();

        // ⚠️ If no user is found, redirect to the login page
        if (!$user) {
            return redirect('/login')->with('error', 'Invalid Token.');
        }

        // 🔐 Log in the user automatically
        Auth::login($user);

        return $next($request);
    }
}

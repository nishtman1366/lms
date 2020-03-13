<?php

namespace App\Http\Middleware;

use App\ClassesStudent;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShareDataToView
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!is_null($user)) {
            $userClasses = ClassesStudent::with('StudentClass')->where('user_id', $user->id)->get();
            View::share(compact('userClasses'));
        }
        return $next($request);
    }
}

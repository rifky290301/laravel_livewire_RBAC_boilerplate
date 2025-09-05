<?php

namespace App\Shared\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
	 */
	public function handle(Request $request, Closure $next, string ...$permissions): Response
	{
		if (!Auth::check()) {
			return redirect()->route('login');
		}

		/** @var \App\Domains\User\Models\User $user */
		$user = Auth::user();

		foreach ($permissions as $permission) {
			if (!$user->hasPermission($permission)) {
				abort(403, 'You do not have permission to access this resource.');
			}
		}

		return $next($request);
	}
}

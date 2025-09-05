<?php

namespace App\Shared\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next, string ...$roles): Response
  {
    if (!Auth::check()) {
      return redirect()->route('login');
    }

    /** @var \App\Domains\User\Models\User $user */
    $user = Auth::user();

    if (!$user->hasAnyRole($roles)) {
      abort(403, 'You do not have the required role to access this resource.');
    }

    return $next($request);
  }
}

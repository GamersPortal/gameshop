<?php
namespace App\Http\Middleware;

use Closure;

class AfterStoreGame
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $game = $request->route()->getParameter('game');
        /**
         * Abort if game is not active
         */
        if (!$game->active) {
            abort(404);
        }
        return $next($request);
    }
}

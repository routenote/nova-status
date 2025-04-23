<?php

namespace Jameslkingsley\NovaStatus\Http\Middleware;

use Jameslkingsley\NovaStatus\NovaStatus;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(NovaStatus::class)->authorize($request) ? $next($request) : abort(403);
    }
}

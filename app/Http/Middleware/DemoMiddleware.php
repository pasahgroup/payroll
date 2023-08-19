<?php

namespace App\Http\Middleware;

use Closure;

class DemoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('app.application_type') == 'demo') {
            if (request()->ajax()) {
                if ($request->method() == 'delete') {
                    echo "disabled in demo";
                    return redirect()->back();
                }

                return ajaxResponse(500, 'This function is disabled in demo!');

            }

            return redirect()->back()->with('error', 'This function disabled in demo!');
        }

        return $next($request);

    }
}

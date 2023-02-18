<?php

namespace App\Http\Middleware;

use Closure;

class crewApi
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
        if ($request->api_password !== env('API_password', 'a8WAadYEqz5B8tzOhs6wOc4')) {

            return response()->json(['message' => 'missing information']);
        }

        return $next($request);

        //middleware to check and get api in spasifc lang
        // app()->setLocale('ar');
        // if (isset($request->lang) && $request->lang == 'en') {
        //     app()->setLocale('en');
        // }
        // return $next($request);
    }
}

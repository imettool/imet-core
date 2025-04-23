<?php

namespace ImetCore\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If locale is toggled in the request, set it in session
        if ($request->has('lang') && in_array($request->input('lang'), ['fr', 'en', 'sp', 'pt'])) {
            Session::put('locale', $request->input('lang'));
        }

        // If locale is set in session, apply it
        if (Session::has('locale') && Session::get('locale') !== null) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}

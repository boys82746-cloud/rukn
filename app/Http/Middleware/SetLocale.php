<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locales = config('rukn.locales');
        $locale = $request->session()->get('locale', $locales[0]);

        if (! in_array($locale, $locales, true)) {
            $locale = $locales[0];
        }

        App::setLocale($locale);
        Carbon::setLocale($locale); // so "diffForHumans()" speaks the same language

        return $next($request);
    }
}

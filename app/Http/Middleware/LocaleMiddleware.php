<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\App;

class LocaleMiddleware
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
        // Locale is activated
        if (config('locale.status')) {
            if (session()->has('locale') &&
                in_array(session()->get('locale'), array_keys(config('locale.languages')))) {
                    App::setLocale(Session::get('locale'));
            } else
            {
                $userLanguages = preg_split('/,|;/', $request->server('HTTP_ACCEPT_LANGUAGE'));
                foreach ($userLanguages as $language) {
                    if (in_array($language, array_keys(config('locale.languages')))) {
                        // Set the Laravel locale
                        App::setLocale($language);

                         // Set php setLocale
                        setlocale(LC_TIME, config('locale.languages')[$language][1]);

                        // Set the locale configuration for Carbon
                        Carbon::setLocale(config('locale.languages')[$language][0]);

                        //Sets the session variable if it has RTL support
                        if (config('locale.languages')[$language][2]) {
                            session(['lang-rtl' => true]);
                        } else {
                            session()->forget('lang-rtl');
                        }
                        break;
                    }
                }
            }
        }
        return $next($request);
    }
}

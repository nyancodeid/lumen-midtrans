<?php

namespace App\Http\Middleware;

use Closure;
use Veritrans_Config;

class MidtransMiddleware
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
        $this->initialize_midtrans();

        return $next($request);
    }

    private function initialize_midtrans ()
    {
        Veritrans_Config::$serverKey = config("app.midtrans.server_key");
        Veritrans_Config::$isProduction = config("app.midtrans.is_production");
        Veritrans_Config::$isSanitized = true;
    }
}

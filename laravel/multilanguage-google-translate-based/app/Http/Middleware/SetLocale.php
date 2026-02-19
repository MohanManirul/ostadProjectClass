<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session::has('locale')){
          App::setlocale(Session::get('locale')) ; 
        }else{
            $browserLang = substr($request->server('HTTP_ACCEPT_LANGUAGE'),0,2)  ;
            $available = ['en','bn','ar'] ;
            App::setLocale(in_array($browserLang,$available)? $browserLang : 'en') ;
        }
        return $next($request);
    }
}

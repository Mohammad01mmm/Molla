<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\AdminController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AlreadyLoggedAdminIn extends AdminController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session()->has('adminLogin') && url(route('login-admin')) == $request->url()) {
            return back();
        }
        // if ($this->infoAdmin('adminLogin') != null) {
        //     if ($this->infoAdmin('adminLogin')->type == 'user' || $this->infoAdmin('adminLogin')->status == '0') {
        //         return redirect()->route('logout-admin');
        //     }
        // }
        return $next($request);
    }
}

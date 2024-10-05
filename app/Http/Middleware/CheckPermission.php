<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission extends AdminController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permissionName): Response
    {
        $infoAdmin = $this->infoAdmin('adminLogin');
        if ($infoAdmin) {
            if ($infoAdmin->type == 'user') {
                return redirect()->route('logout-admin');
            }
            if ($infoAdmin->roles()->count() == 0) {
                $infoAdmin->update([
                    'type' => 'user',
                ]);
                return redirect()->route('logout-admin');
            } else {
                $hasPermission = Permission::where('unique_name', $permissionName)
                    ->whereStatus('1')
                    ->whereHas('roles', function ($query) {
                        $query->whereIn('roles.id', $this->infoAdmin('adminLogin')->roles()->get()->pluck('id'))->whereStatus('1');
                    })
                    ->exists();
                if (!$hasPermission && $permissionName == 'ShowdashboardPermission') {
                    return redirect()->route('front.index');
                }
                if (!$hasPermission) {
                    return redirect(abort(404));
                } else {
                    return $next($request);
                }
            }
        } else {
            return redirect(abort(404));
        }
    }
}

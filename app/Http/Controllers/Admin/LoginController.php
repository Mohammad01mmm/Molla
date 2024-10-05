<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends AdminController
{
    public function login()
    {
        if (User::where('email', 'mohammad@gmail.com')->count() == 0) {
            $PermissionController = new PermissionController();
            $PermissionController->createPermissions();
            if (Role::where('title', 'مدیر اصلی')->count() == 0) {
                $r = Role::create([
                    'title' => 'مدیر اصلی',
                    'description' => 'مدیر اصلی سایت',
                    'status' => '1',
                ]);
                $r->permissions()->attach(Permission::all());
            }
            $u = User::create([
                'name' => 'Mohammad',
                'email' => 'mohammad@gmail.com',
                'password' => '13821382',
                'type' => 'admin',
                'status' => '1',
                'image' => 'admin/asset/images/profile.png',
            ]);
            $u->roles()->attach(Role::all());
        }
        return view('admin.pages.login.login');
        // http://127.0.0.1:8000/31b80c99f1d265b3f83441bdff2abf85
    }
    public function authAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email:users',
            'password' => 'required|min:8|max:12',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if ($user->status == '1') {
                if (Hash::check($request->password, $user->password)) {
                    if ($user->type == 'admin') {
                        $request->session()->put('adminLogin', $user->id);
                        return redirect(route('admin.dashboard'));
                    } else {
                        return back()->with('error', 'همچین کاربری وجود ندارد');
                    }
                } else {
                    return back()->with('error', 'رمز عبور مشکل داره');
                }
            } else {
                return back()->with('error', 'حساب غیر فعال است');
            }
        } else {
            return back()->with('error', 'این ایمیل وجود ندارد');
        }
    }
    public function dashboard()
    {
        $admin = $this->infoAdmin('adminLogin');
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.dashboard.index', compact('admin', 'currentAdmin'));
    }
    public function logout()
    {
        if (Session::has('adminLogin')) {
            Session::pull('adminLogin');
        }
        return redirect(route('front.index'));
    }
}

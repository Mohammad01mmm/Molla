<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends MainController
{
    public function login()
    {
        $header = $this->header();
        return view('front.pages.user.login', compact('header'));
    }
    public function login_user(LoginRequest $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if ($user->status == '1') {
                if (Hash::check($request->password, $user->password)) {
                    if ($user->type == 'user') {
                        $request->session()->put('userLogin', $user->id);
                        return redirect()->route('front.dashboard');
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
    public function register(RegisterRequest $request)
    {
        $image_url = 'admin/asset/images/profile.png';
        $request['status'] = '1';
        $user = User::create(array_merge($request->all(), ['image' => $image_url]));
        $request->session()->put('userLogin', $user->id);
        return redirect()->route('front.dashboard');
    }
    public function dashboard()
    {
        $header = $this->header();
        $user = $this->infoUser('userLogin');
        $payments = Checkout::where('user->email', $user->email)->get();
        return view('front.pages.user.dashboard', compact('header', 'user', 'payments'));
    }
    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
        ]);
        $user = $this->infoUser('userLogin');
        if ($request->old_password || $request->new_password || $request->re_new_password) {
            $request->validate([
                'old_password' => 'required|min:8|max:16',
                'new_password' => 'required|min:8|max:16',
                're_new_password' => 'required|min:8|max:16|same:new_password',
            ]);
            if (Hash::check($request->old_password, $user->password)) {
                if (!Hash::check($request->new_password, $user->password)) {
                    $request['password'] = $request->new_password;
                } else {
                    return back()->with('error', ' پسورد با پسورد قبلی هم خوانی دارد ');
                }
            } else {
                return back()->with('error', ' پسورد نادرست است ');
            }
        }

        if ($request->zip_code || $request->address) {
            $request->validate([
                'zip_code' => 'required|min:10',
                'address' => 'required',
            ]);
        }

        $user->update($request->all());
        return redirect()->route('front.dashboard');
    }
    public function logout()
    {
        if (Session::has('userLogin')) {
            Session::pull('userLogin');
        }
        return redirect(route('front.index'));
    }
}

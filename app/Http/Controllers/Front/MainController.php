<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class MainController extends Controller
{
    public function header()
    {
        $categories = Category::whereStatus('1');
        $menus = Menu::whereStatus('1');
        $wishlists = null;
        $carts = null;
        if ($this->infoUser('userLogin') != null) {
            $wishlists = Wishlist::with('product')
                ->where('user_id', $this->infoUser('userLogin')->id)
                ->get();
            $carts = Cart::with('product')
                ->where('user_id', $this->infoUser('userLogin')->id)
                ->get();
            $carts = $carts->groupBy(function ($cart) {
                return $cart->product_id;
            });
        }
        return compact('categories', 'menus', 'wishlists', 'carts');
    }
    public function infoUser($name_session)
    {
        $user = [];
        if (Session::has($name_session)) {
            $user = User::where('id', '=', Session::get($name_session))->where('type', 'user')->first();
        }
        return $user;
    }
}

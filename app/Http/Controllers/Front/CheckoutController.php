<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\ProductCheckout;
use App\Models\User;
use Illuminate\Http\Request;

class CheckoutController extends MainController
{
    public function index()
    {
        if (!$this->infoUser('userLogin')) {
            return redirect()->route('front.login');
        }
        $header = $this->header();
        $carts = Cart::with('product')
            ->where('user_id', $this->infoUser('userLogin')->id)
            ->get();
        $user = $this->infoUser('userLogin');
        return view('front.pages.cart.checkout', compact('header', 'carts', 'user'));
    }
    // بهینه با چت جی پی تی بعدا
    public function checkout(CheckoutRequest $request)
    {
        if (!$this->infoUser('userLogin')) {
            return redirect()->route('front.login');
        }
        $header = $this->header();
        $user = $this->infoUser('userLogin');
        if ($user->name == null || !preg_match('/^[\p{Arabic}،ء-ي\s]+$/u', $user->name)) {
            $user->update(['name' => $request->fname]);
        }
        if ($user->lname == null || !preg_match('/^[\p{Arabic}،ء-ي\s]+$/u', $user->lname)) {
            $user->update(['lname' => $request->lname]);
        }
        if ($user->email != $request->email) {
            $request['email'] = $user->email;
        }
        if ($user->city == null || !preg_match('/^[\p{Arabic}،ء-ي\s]+$/u', subject: $user->city)) {
            $user->update(['city' => $request->city]);
        }
        if ($user->address == null) {
            $user->update(['address' => $request->address]);
        }
        if ($user->zip_code == null) {
            $user->update(['zip_code' => $request->zip_code]);
        }
        if ($user->phone == null) {
            $user->update(['phone' => $request->phone_number]);
        }

        $cart_products = Cart::where('user_id', $this->infoUser('userLogin')->id)->get();

        $user_checkout = [
            'id' => $user->id,
            'name' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'phone' => $request->phone_number,
            'city' => $request->city,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'type' => $user->status,
        ];
        // dd(boolval());
        if (count($cart_products) == 0) {
            return redirect()->route('front.index');
        }
        foreach ($cart_products as $cart) {
            $cart->delete();
            $properties = [];
            foreach ($cart->product->properties()->get() as $property) {
                $properties[] = [
                    'title' => $property->title,
                    'name_property' => $property->name_property,
                    'value' => $property->value,
                    'unit' => $property->unit,
                ];
            }
            $prouduct_checkouts[] = ProductCheckout::create([
                'user' => [
                    'name' => $this->infoUser('userLogin')->name,
                    'lname' => $this->infoUser('userLogin')->lname,
                    'email' => $this->infoUser('userLogin')->email,
                ],
                'title' => $cart->product->title,
                'code' => $cart->product->code,
                'category' => $cart->product->category->title,
                'slug_url' => $cart->product->slag_url,
                'status_off' => $cart->product->status_off,
                'number_off' => $cart->product->number_off,
                'status' => $cart->product->status,
                'properties' => $properties,
                'count' => $cart->count,
                'color' => ['color' => $cart->color->title, 'hex' => $cart->color->hex],
                'final_price' => $cart->product
                    ->colors()
                    ->where('color_id', $cart->color->id)
                    ->first()->pivot->final_price,
            ]);
        }
        foreach ($prouduct_checkouts as $prouduct_checkout) {
            $prouduct_checkout_id[] = $prouduct_checkout->id;
            $prouduct_checkout_total[] = $prouduct_checkout->final_price * $prouduct_checkout->count;
        }
        $checkout = Checkout::create([
            'user' => $user_checkout,
            'product_id' => $prouduct_checkout_id,
            'total_price' => array_sum($prouduct_checkout_total),
            'total_price_payable' => array_sum($prouduct_checkout_total),
            'status' => 'successful',
            'transaction_id' => sprintf('%09d', rand(1, 999999999)),
            'discription' => $request->discription,
        ]);

        if ($checkout->status == 'successful') {
            $transaction_id = $checkout->transaction_id;
            return view('front.pages.cart.success', compact('transaction_id', 'header'));
        } else {
            $transaction_id = $checkout->transaction_id;
            return view('front.pages.cart.failed', compact('transaction_id', 'header'));
        }
    }
}

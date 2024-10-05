<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!$this->infoUser('userLogin')) {
            return redirect()->route('front.login');
        }
        $header = $this->header();
        $carts = null;
        $groupedCarts = null;
        if ($this->infoUser('userLogin') != null) {
            $carts = Cart::with('product')
                ->where('user_id', $this->infoUser('userLogin')->id)
                ->get();
            $groupedCarts = $carts->groupBy(function ($cart) {
                return $cart->product_id;
            });
        }
        return view('front.pages.cart.list', compact('header', 'carts', 'groupedCarts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$this->infoUser('userLogin')) {
            return redirect()->route('front.login');
        }
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'count' => 'required|integer',
            'color' => 'required',
        ]);

        $request['count'] = abs($request->count);

        if ($this->infoUser('userLogin') == null) {
            return redirect()->route('front.login');
        } else {
            $request['user_id'] = (string) $this->infoUser('userLogin')->id;
        }
        if (
            Product::whereStatus('1')
                ->findOrFail($request->product_id)
                ->colors()
                ->where('color_id', $request->color)
                ->first()->pivot->inventory > $request->count
        ) {
            $exists = Cart::where('user_id', $request->user_id)
                ->where('product_id', $request->product_id)
                ->where('color_id', $request->color)
                ->exists();
            if ($exists) {
                return redirect()->back()->with('error', 'این محصول قبلاً به سبد خرید اضافه شده است.');
            }
            Cart::create(['user_id' => $request->user_id, 'product_id' => $request->product_id, 'color_id' => $request->color, 'count' => $request->count]);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $product_id, Request $request)
    {
        if (!$this->infoUser('userLogin')) {
            return redirect()->route('front.login');
        }
        $user_id = $this->infoUser('userLogin')->id;
        $cart = Cart::where('product_id', $product_id)
            ->where('color_id', $request->color_id)
            ->where('user_id', $user_id)
            ->first();

        $cart->delete();
        return redirect()->back();
    }
}

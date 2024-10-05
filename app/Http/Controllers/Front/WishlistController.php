<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $header = $this->header();
        $wishlists = null;
        if ($this->infoUser('userLogin') != null) {
            $wishlists = Wishlist::with('product')
                ->where('user_id', $this->infoUser('userLogin')->id)
                ->get();
        }
        return view('front.pages.wishlist.list', compact('header', 'wishlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->back();
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
        ]);
        $request['user_id'] = (string) $this->infoUser('userLogin')->id;
        $exists = Wishlist::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'این محصول قبلاً به لیست علاقه‌مندی‌ها اضافه شده است.');
        }

        Wishlist::create(['user_id' => $request->user_id, 'product_id' => $request->product_id]);
        return redirect()->back();
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
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        if (!$this->infoUser('userLogin')) {
            return redirect()->route('front.login');
        }
        $wishlist->delete();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkouts = Checkout::get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.checkouts.list', compact('checkouts','currentAdmin'));
    }
}

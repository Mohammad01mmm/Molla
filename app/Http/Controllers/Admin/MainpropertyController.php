<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainpropertyController extends AdminController
{
    public function index()
    {
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.main-property.index', compact('currentAdmin'));
    }
}

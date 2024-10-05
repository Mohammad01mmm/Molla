<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.colors.list', compact('colors', 'currentAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.colors.create', compact('currentAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        Color::create($request->all());
        return redirect(route('colors.index'));
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
    public function edit(Color $color)
    {
        return redirect(route('colors.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, Color $color)
    {
        return redirect(route('colors.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect(route('colors.index'));
    }
}

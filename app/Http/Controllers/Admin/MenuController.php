<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.menus.list', compact('menus', 'currentAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sub_menus = Menu::where('sub_menu', 0)->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.menus.create', compact('sub_menus', 'currentAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        Menu::create($request->all());
        return redirect(route('menus.index'));
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
    public function edit(Menu $menu)
    {
        $sub_menus = Menu::where('sub_menu', $menu->id)->get();
        $sub_menus_leader = Menu::where('sub_menu', 0)->get();
        $leaders_for_sub_menu = Menu::where('id', $menu->sub_menu)->first();
        $currentAdmin = $this->currentAdmin;

        return view('admin.pages.menus.edit', compact('menu', 'sub_menus', 'sub_menus_leader', 'leaders_for_sub_menu', 'currentAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        $sub_menus = Menu::where('sub_menu', $menu->id)->get();
        if ($sub_menus->count() > 0) {
            Menu::where('sub_menu', $menu->id)->update(['status' => $request->status]);
        }
        $menu->update(array_merge($request->all()));
        return redirect(route('menus.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        Menu::where('sub_menu', $menu->id)->delete();
        $menu->delete();
        return redirect(route('menus.index'));
    }
}

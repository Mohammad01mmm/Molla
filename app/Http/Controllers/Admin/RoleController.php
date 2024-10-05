<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(100);
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.roles.list', compact('roles', 'currentAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.roles.create', compact('permissions', 'currentAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create(array_merge($request->all()));
        $role->permissions()->attach($request->permissions);
        return redirect(route('roles.index'));
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
    public function edit(Role $role)
    {
        $permissions = Permission::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.roles.edit', compact('permissions', 'role', 'currentAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update(array_merge($request->all()));
        $role->permissions()->sync($request->permissions);
        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect(route('roles.index'));
    }
}

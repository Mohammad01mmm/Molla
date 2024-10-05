<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::get();
        $this->createPermissions();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.permissions.list', compact('permissions', 'currentAdmin'));
    }

    public function createPermissions()
    {
        $permissions = [
            [
                'title' => 'مشاهده صفحه داشبورد',
                'unique_name' => 'ShowdashboardPermission',
                'description' => 'امکان مشاهده صفحه داشبورد که دارای گزارشات مربوط به سایت در آنجا وجود دارد',
            ],
            [
                'title' => 'مشاهده صفحه منو',
                'unique_name' => 'ShowmenuPermission',
                'description' => 'امکان مشاهده صفحه منو',
            ],
            [
                'title' => 'مشاهده صفحه اسلایدر',
                'unique_name' => 'ShowsliderPermission',
                'description' => 'امکان مشاهده صفحه اسلایدر',
            ],
            [
                'title' => 'مشاهده صفحه دسته بندی',
                'unique_name' => 'ShowcategoryPermission',
                'description' => 'امکان مشاهده صفحه دسته بندی',
            ],
            [
                'title' => 'مشاهده صفحه محصولات',
                'unique_name' => 'ShowproductPermission',
                'description' => 'امکان مشاهده صفحه محصولات',
            ],
            [
                'title' => 'مشاهده صفحه فاکتور ها',
                'unique_name' => 'ShowfactorPermission',
                'description' => 'امکان مشاهده صفحه فاکتور ها',
            ],
            [
                'title' => 'مشاهده صفحه بلاگ',
                'unique_name' => 'ShowblogPermission',
                'description' => 'امکان مشاهده صفحه بلاگ',
            ],
            [
                'title' => 'مشاهده صفحه کاربران',
                'unique_name' => 'ShowuserPermission',
                'description' => 'امکان مشاهده صفحه کاربران',
            ],
        ];

        foreach ($permissions as $permission) {
            $this->createPermission($permission);
        }
    }

    protected function createPermission($permission)
    {
        $permission['status'] = $permission['status'] ?? '1';

        if (!Permission::where('unique_name', $permission['unique_name'])->first()) {
            Permission::create($permission);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect(route('permissions.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect(route('permissions.index'));
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
    public function edit(Permission $permission)
    {
        $roles = Role::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.permissions.edit', compact('permission', 'roles', 'currentAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update(array_merge($request->all()));
        $permission->roles()->sync($request->roles);
        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        return redirect(route('permissions.index'));
    }
}

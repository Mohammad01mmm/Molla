<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect(route('users.index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.managers.create', compact('roles','currentAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $image_url = '';
        if ($request->file('image')) {
            $image_url = $this->upload_image('admin/asset/images/user/', $request->file('image'));
            $image_url = $this->crop_image($image_url['full_path'], $image_url['file'], '300', '300');
        } else {
            $image_url = 'admin/asset/images/profile.png';
        }
        $request['type'] = 'admin';

        $user = User::create(array_merge($request->all(), ['image' => $image_url]));
        $user->roles()->attach($request->roles);
        return redirect(route('users.index'));
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
        return redirect(route('users.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect(route('users.index'));
    }
}

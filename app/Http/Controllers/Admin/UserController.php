<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.users.list', compact('users', 'currentAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect(route('users.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
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
    public function edit(User $user)
    {
        $width = getimagesize($user->image)[0];
        $highte = getimagesize($user->image)[1];
        $file_size = filesize(public_path($user->image));
        $roles = Role::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.users.edit', compact('user', 'width', 'highte', 'file_size', 'roles', 'currentAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        if ($user->email != $request->email) {
            $request->validate([
                'email' => 'unique:users,email',
            ]);
        }
        $image_path = $user->image;
        if ($request->file('image')) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $image_url = $this->upload_image('admin/asset/images/user/', $request->file('image'));
            $image_url = $this->crop_image($image_url['full_path'], $image_url['file'], '300', '300');
        } else {
            $image_url = $image_path;
        }

        $user->update(array_merge($request->all(), ['image' => $image_url]));
        if ($request->roles) {
            $user->roles()->sync($request->roles);
        } else {
            $user->roles()->detach();
        }

        if ($request->status == 'user') {
            $user->roles()->detach();
        }
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $image_path = $user->image;
        if (File::exists($image_path)) {
            if ($image_path != 'admin/asset/images/profile.png') {
                File::delete($image_path);
            }
        }
        $user->delete();
    }
}

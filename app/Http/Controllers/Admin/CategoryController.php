<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.categories.list', compact('categories','currentAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $properties = Property::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.categories.create', compact('properties','currentAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $image_url = $this->upload_image('admin/asset/images/category/', $request->file('image'));
        $image_url = $this->crop_image($image_url['full_path'], $image_url['file'], '600', '600');
        $request['slug_url'] = str_replace(' ', '-', $request->title);
        $category = Category::create(array_merge($request->all(), ['image' => $image_url]));

        $category->properties()->attach($request->property);
        return redirect(route('categories.index'));
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
    public function edit(Category $category)
    {
        $properties = Property::whereStatus('1')->get();
        $width = getimagesize($category->image)[0];
        $highte = getimagesize($category->image)[1];
        $file_size = filesize(public_path($category->image));
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.categories.edit', compact('category', 'width', 'highte', 'file_size', 'properties','currentAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $image_path = $category->image;
        if ($request->file('image')) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $image_url = $this->upload_image('admin/asset/images/category/', $request->file('image'));
            $image_url = $this->crop_image($image_url['full_path'], $image_url['file'], '600', '600');
        } else {
            $image_url = $image_path;
        }
        $request['slug_url'] = str_replace(' ', '-', $request->title);
        $category->update(array_merge($request->all(), ['image' => $image_url]));
        $category->properties()->sync($request->property);
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $image_path = $category->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $category->delete();
        return redirect(route('categories.index'));
    }
}

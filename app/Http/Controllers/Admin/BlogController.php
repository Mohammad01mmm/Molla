<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.blogs.list', compact('blogs', 'currentAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.blogs.create', compact('currentAdmin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $image_url = $this->upload_image('admin/asset/images/blog/', $request->file('image'));
        $image_url = $this->crop_image($image_url['full_path'], $image_url['file'], '600', '600');
        $request['slug_url'] = str_replace(' ', '-', $request->title);
        Blog::create(array_merge($request->all(), ['image' => $image_url]));
        return redirect(route('blogs.index'));
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
    public function edit(Blog $blog)
    {
        $width = getimagesize($blog->image)[0];
        $highte = getimagesize($blog->image)[1];
        $file_size = filesize(public_path($blog->image));
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.blogs.edit', compact('blog', 'width', 'highte', 'file_size', 'currentAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $image_path = $blog->image;
        if ($request->file('image')) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $image_url = $this->upload_image('admin/asset/images/blog/', $request->file('image'));
            $image_url = $this->crop_image($image_url['full_path'], $image_url['file'], '600', '600');
        } else {
            $image_url = $image_path;
        }
        $request['slug_url'] = str_replace(' ', '-', $request->title);
        $blog->update(array_merge($request->all(), ['image' => $image_url]));
        return redirect(route('blogs.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $image_path = $blog->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $blog->delete();
        return redirect(route('blogs.index'));
    }
}

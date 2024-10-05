<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class ProductController extends AdminController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.products.list', compact('products', 'currentAdmin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::get();
        $categories = Category::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.products.create', compact('colors', 'categories','currentAdmin'));
    }
    public function category_info(Request $request)
    {
        $url = explode('/', $request->url);
        $id = $request->id;
        $category = Category::find($id);
        $properties = $category->properties()->whereStatus('1')->get();
        if (last($url) == 'edit') {
            $properties_product = Product::find($request->product_id)
                ->properties()
                ->whereStatus('1')
                ->get();
            return response()->json(['data' => $properties, 'properties_product' => $properties_product]);
        } else {
            return response()->json(['data' => $properties]);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        switch ($request->off['status']) {
            case 'none':
                $request['status_off'] = $request->off['status'];
                $request['number_off'] = null;
                $request['time_off'] = null;
                $request['unit_time_off'] = null;
                $request['final_date_off'] = null;
                $request['date_at_off'] = Carbon::now('Asia/Tehran');

                break;

            case 'percent':
                $request->validate([
                    'off.input_percent_num' => 'required|numeric|min:0|max:100',
                    'off.input_percent_time' => 'required|integer|min:1',
                    'off.input_percent_unit_time' => 'required',
                ]);

                $percent_final_date = $this->select_time($request->off['input_percent_unit_time'], $request->off['input_percent_time']);

                $request['status_off'] = $request->off['status'];
                $request['number_off'] = $request->off['input_percent_num'];
                $request['time_off'] = $request->off['input_percent_time'];
                $request['unit_time_off'] = $request->off['input_percent_unit_time'];
                $request['final_date_off'] = $percent_final_date;
                $request['date_at_off'] = Carbon::now('Asia/Tehran');

                break;

            case 'price':
                $request->validate([
                    'off.input_price_num' => 'required|integer|min:1000',
                    'off.input_price_time' => 'required|integer|min:1',
                    'off.input_price_unit_time' => 'required',
                ]);

                $price_final_date = $this->select_time($request->off['input_price_unit_time'], $request->off['input_price_time']);

                $request['status_off'] = $request->off['status'];
                $request['number_off'] = $request->off['input_price_num'];
                $request['time_off'] = $request->off['input_price_time'];
                $request['unit_time_off'] = $request->off['input_price_unit_time'];
                $request['final_date_off'] = $price_final_date;
                $request['date_at_off'] = Carbon::now('Asia/Tehran');

                break;
        }
        $main_property = $request->main_property;
        $collection_main_property = new Collection($main_property);
        $count_main_property = $collection_main_property->last();

        for ($i = 1; $i <= $count_main_property; $i++) {
            $request->validate([
                'main_property.price_' . $i => 'required|integer|min:1000',
                'main_property.inventory_' . $i => 'required|integer|min:1',
            ]);
        }
        try {
            DB::beginTransaction();

            $image_url = $this->upload_image('admin/asset/images/product/' . str_replace(' ', '-', $request->title . '-' . $request->code) . '/', $request->file('image'));
            $image_url = $this->crop_image($image_url['full_path'], $image_url['file'], '600', '600');

            foreach ($request->images as $key => $image) {
                $images_url = $this->upload_image('admin/asset/images/product/' . $request->title . '/', $image);
                $images_url_crop[] = $this->crop_image($images_url['full_path'], $images_url['file'], '600', '600');
            }

            $request['category_id'] = $request->category;
            $request['code'] = sprintf('%06d', rand(1, 999999));
            $request['slag_url'] = str_replace(' ', '-', $request->title . '-' . $request->code);
            if (!$request->tags) {
                $request['tags'] = [$request->title => $request->title];
            }
            $product = Product::create(array_merge($request->all(), ['image' => $image_url, 'images' => $images_url_crop]));
            for ($i = 1; $i <= $count_main_property; $i++) {
                if ($request['status_off'] == 'percent') {
                    $final_price = (abs((int) $main_property['price_' . $i]) * abs((int) $request['number_off'])) / 100 - abs((int) $main_property['price_' . $i]);
                } elseif ($request['status_off'] == 'price') {
                    $final_price = abs((int) $main_property['price_' . $i]) - abs((int) $request['number_off']);
                } else {
                    $final_price = abs((int) $main_property['price_' . $i]);
                }
                $product->colors()->attach($main_property['color_' . $i], ['color' => $main_property['color_' . $i], 'price' => abs((int) $main_property['price_' . $i]), 'inventory' => abs((int) $main_property['inventory_' . $i]), 'final_price' => abs((int) $final_price)]);
            }

            foreach ($request->properties as $key => $property) {
                $product->properties()->attach($key, ['category_id' => $request->category, 'value' => $property, 'unit' => $request->unit[$key]]);
            }

            DB::commit();
            return redirect(route('products.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'از رنگ تکراری نمیتوانید استفاده کنید');
            return redirect(route('products.create'));
        }
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
    public function edit(Product $product)
    {
        $colors = Color::get();
        $categories = Category::whereStatus('1')->get();
        $width = getimagesize($product->image)[0];
        $highte = getimagesize($product->image)[1];
        $file_size = filesize(public_path($product->image));
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.products.edit', compact('width', 'highte', 'file_size', 'product', 'colors', 'categories','currentAdmin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        switch ($request->off['status']) {
            case 'none':
                $request['status_off'] = $request->off['status'];
                $request['number_off'] = null;
                $request['time_off'] = null;
                $request['unit_time_off'] = null;
                $request['final_date_off'] = null;
                $request['date_at_off'] = Carbon::now('Asia/Tehran');

                break;

            case 'percent':
                $request->validate([
                    'off.input_percent_num' => 'required|numeric|min:0|max:100',
                    'off.input_percent_time' => 'required|integer|min:1',
                    'off.input_percent_unit_time' => 'required',
                ]);

                if ($product->status_off == 'percent') {
                    $percent_final_date = $product->final_date_off;
                    if ($request->off['input_percent_time'] != $product->time_off || $request->off['input_percent_unit_time'] != $product->unit_time_off) {
                        $percent_final_date = $this->select_time($request->off['input_percent_unit_time'], $request->off['input_percent_time']);
                    }
                } else {
                    $percent_final_date = $this->select_time($request->off['input_percent_unit_time'], $request->off['input_percent_time']);
                }

                $request['status_off'] = $request->off['status'];
                $request['number_off'] = $request->off['input_percent_num'];
                $request['time_off'] = $request->off['input_percent_time'];
                $request['unit_time_off'] = $request->off['input_percent_unit_time'];
                $request['final_date_off'] = $percent_final_date;
                $request['date_at_off'] = Carbon::now('Asia/Tehran');

                break;

            case 'price':
                $request->validate([
                    'off.input_price_num' => 'required|integer|min:1000',
                    'off.input_price_time' => 'required|integer|min:1',
                    'off.input_price_unit_time' => 'required',
                ]);

                if ($product->status_off == 'price') {
                    $price_final_date = $product->final_date_off;
                    if ($request->off['input_price_time'] != $product->offtime_off || $request->off['input_price_unit_time'] != $product->unit_time_off) {
                        $price_final_date = $this->select_time($request->off['input_price_unit_time'], $request->off['input_price_time']);
                    }
                } else {
                    $price_final_date = $this->select_time($request->off['input_price_unit_time'], $request->off['input_price_time']);
                }
                $request['status_off'] = $request->off['status'];
                $request['number_off'] = $request->off['input_price_num'];
                $request['time_off'] = $request->off['input_price_time'];
                $request['unit_time_off'] = $request->off['input_price_unit_time'];
                $request['final_date_off'] = $price_final_date;
                $request['date_at_off'] = Carbon::now('Asia/Tehran');

                break;
        }
        $main_property = $request->main_property;
        $collection_main_property = new Collection($main_property);
        $count_main_property = $collection_main_property->last();

        $q = [];
        for ($i = 1; $i <= $count_main_property; $i++) {
            if ($request->main_property['status_' . $i] == 'active') {
                $q[] = 'true';
            } else {
                $q[] = 'false';
            }
        }

        for ($i = 1; $i <= $count_main_property; $i++) {
            if ($request->main_property['status_' . $i] == 'active') {
                $request->validate([
                    'main_property.price_' . $i => 'required|integer|min:1000',
                    'main_property.inventory_' . $i => 'required|integer|min:1',
                ]);
            }
        }

        $activeItems = [];
        $count = 1;

        while (isset($request->main_property['status_' . $count])) {
            if ($request->main_property['status_' . $count] == 'active') {
                $activeItems[] = [
                    'color' => $request->main_property['color_' . $count],
                    'price' => $request->main_property['price_' . $count],
                    'inventory' => $request->main_property['inventory_' . $count],
                    'status' => $request->main_property['status_' . $count],
                    'card' => $request->main_property['card_' . $count],
                ];
            }
            $count++;
        }
        try {
            DB::beginTransaction();

            if (array_count_values($q)['true'] == 0 || count($activeItems) == 0) {
                return redirect(route('products.edit', ['product' => $product->id]));
            }
            $image_path = $product->image;
            if ($request->file('image')) {
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                $image_url = $this->upload_image('admin/asset/images/product/' . str_replace(' ', '-', $request->title . '-' . $request->code) . '/', $request->file('image'));
                $image_url = $this->crop_image($image_url['full_path'], $image_url['file'], '600', '600');
            } else {
                $image_url = $image_path;
            }

            if ($request->file('images')) {
                foreach ($product->images as $key => $image) {
                    if (File::exists($image)) {
                        File::delete($image);
                    }
                    $images_url = $this->upload_image('admin/asset/images/product/' . str_replace(' ', '-', $request->title . '-' . $request->code) . '/', $image);
                    $images_url_crop[] = $this->crop_image($images_url['full_path'], $images_url['file'], '600', '600');
                }
            } else {
                $images_url_crop = $product->images;
            }

            $request['category_id'] = $request->category;
            if ($product->code == null) {
                $request['code'] = sprintf('%06d', rand(1, 999999));
            } else {
                $request['code'] = $product->code;
            }
            $request['slag_url'] = str_replace(' ', '-', $request->title . '-' . $request->code);
            if (!$request->tags) {
                $request['tags'] = [$request->title => $request->title];
            }
            $product->update(array_merge($request->all(), ['image' => $image_url, 'images' => $images_url_crop]));

            for ($i = 1; $i <= $count_main_property; $i++) {
                $product->colors()->detach($main_property['color_' . $i]);
            }
            foreach ($activeItems as $key => $value) {
                if ($request['status_off'] == 'percent') {
                    $final_price = (abs((int) $value['price']) * abs((int) $request['number_off'])) / 100 - abs((int) $value['price']);
                } elseif ($request['status_off'] == 'price') {
                    $final_price = abs((int) $value['price']) - abs((int) $request['number_off']);
                } else {
                    $final_price = abs((int) $value['price']);
                }
                $product->colors()->attach($value['color'], ['color' => $value['color'], 'price' => abs((int) $value['price']), 'inventory' => abs((int) $value['inventory']), 'final_price' => abs((int) $final_price)]);
            }
            foreach ($request->properties as $key => $property) {
                $product->properties()->detach($key);
                $product->properties()->attach($key, ['category_id' => $request->category, 'value' => $property, 'unit' => $request->unit[$key]]);
            }
            DB::commit();
            return redirect(route('products.index'));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', ' یا رنگی انتخاب نکرده اید یا رنگ تکراری انتخاب کرده اید ');
            return redirect(route('products.edit', ['product' => $product->id]));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $image_path = $product->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        foreach ($product->images as $image) {
            if (File::exists($image)) {
                File::delete($image);
            }
        }
        $product->delete();
        return redirect(route('products.index'));
    }
}

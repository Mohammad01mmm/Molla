<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductController extends MainController
{
    public function list()
    {
        $header = $this->header();
        $categories = Category::whereStatus('1')->get();
        $colors = Color::get();
        $query_product = Product::query();
        foreach ($query_product->whereStatus('1')->get() as $product) {
            $min[] = $product->colors()->orderBy('final_price', 'DESC')->first()->pivot->final_price;
            $max[] = $product->colors()->orderBy('final_price', 'ASC')->first()->pivot->final_price;
        }
        $range = ['min' => min($min), 'max' => max($max)];
        return view('front.pages.product.list', compact('header', 'categories', 'colors', 'range'));
    }
    public function filter(Request $request)
    {
        $query = Product::query();

        // فیلتر دسته‌بندی
        if ($request->has('category')) {
            $query->whereIn('category_id', $request->category);
        }

        // فیلتر رنگ
        if ($request->has('color')) {
            $query->whereHas('colors', function ($q) use ($request) {
                $q->whereIn('hex', $request->color);
            });
        }

        // فیلتر قیمت بر اساس رنگ‌ها
        if ($request->has('range')) {
            $query->whereHas('colors', function ($q) use ($request) {
                $q->whereBetween('final_price', [(int)$request->range[0], (int)$request->range[1]]);
            });
        }

        // فیلتر بر اساس عبارت جستجو
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // در نهایت محصولات را صفحه‌بندی کن
        $products = $query->paginate(5, ['*'], 'page', $request->get('page', 1));

        // رندر کردن ویو
        $html = view('front.pages.product.product_list', compact('products'))->render();

        return response()->json(['html' => $html]);
    }

    public function single_product($product)
    {
        $products = Product::whereStatus('1')->get();
        $product = Product::where('slag_url', $product)->first();
        $header = $this->header();

        $date1 = Carbon::parse($product->final_date_off);
        $date2 = Carbon::parse(now());

        $diff = $date1->diff($date2);

        $years = $diff->y;
        $months = $diff->m;
        $days = $diff->d;
        $hours = $diff->h;
        $minutes = $diff->i;
        $seconds = $diff->s;

        $final_date_off = ['years' => $years, 'months' => $months, 'days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds];
        return view('front.pages.product.single', compact('header', 'product', 'final_date_off', 'products'));
    }
}

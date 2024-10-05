<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class IndexController extends MainController
{
    public function index()
    {
        $header = $this->header();
        $categories = Category::whereStatus('1')->get();

        // یک کوئری برای همه اسلایدرها
        $sliders = Slider::where('status', '1')
            ->whereIn('type', ['type_random_off_pro', 'type_new_off_pro', 'type_new_pro', 'type_random_pro', 'type_select_pro', 'type_select_cat', 'type_new_blog', 'type_select_blog', 'type_other'])
            ->get()
            ->groupBy('type');

        // تخصیص اسلایدرها از گروه‌بندی
        $slider_random_off_pro = $sliders->get('type_random_off_pro');
        $slider_new_off_pro = $sliders->get('type_new_off_pro');
        $slider_new_pro = $sliders->get('type_new_pro');
        $slider_random_pro = $sliders->get('type_random_pro');
        $sliders_select_pro = $sliders->get('type_select_pro');
        $sliders_select_cat = $sliders->get('type_select_cat');
        $slider_new_blog = $sliders->get('type_new_blog');
        $sliders_select_blog = $sliders->get('type_select_blog');
        $sliders_other = $sliders->get('type_other');

        // بررسی وجود اسلایدر "خوش آمدید"
        $slider_welcome = $sliders_other?->firstWhere(fn($slider) => $slider->title === 'خوش آمدید' && $slider->status === '1');

        // محصولات
        $products = Product::query();

        return view('front.pages.index.index', compact('header', 'categories', 'slider_random_off_pro', 'slider_new_off_pro', 'slider_new_pro', 'slider_random_pro', 'sliders_select_pro', 'sliders_select_cat', 'slider_new_blog', 'sliders_select_blog', 'sliders_other', 'slider_welcome', 'products'));
    }
}

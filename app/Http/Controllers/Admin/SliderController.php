<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use GuzzleHttp\Psr7\ServerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SliderController extends AdminController
{
    public function index()
    {
        $sliders = Slider::paginate(100);
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.sliders.list', compact('sliders', 'currentAdmin'));
    }

    public function create()
    {
        $products = Product::whereStatus('1')->get();
        $categories = Category::whereStatus('1')->get();
        $blogs = Blog::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.sliders.create', compact('products', 'categories', 'blogs', 'currentAdmin'));
    }

    public function getRandomProductWithOff()
    {
        return Product::where('status_off', '!=', 'none')->whereStatus('1')->inRandomOrder()->first();
    }

    public function getNewProductWithOff()
    {
        return Product::where('status_off', '!=', 'none')->whereStatus('1')->latest('date_at_off')->first();
    }

    public function getNewProduct()
    {
        return Product::whereStatus('1')->latest()->first();
    }

    public function getRandomProduct()
    {
        return Product::whereStatus('1')->inRandomOrder()->first();
    }

    public function getNewBlog()
    {
        return Blog::whereStatus('1')->latest()->first();
    }

    private function clearUnnecessaryFields(Request $request, array $fields)
    {
        foreach ($fields as $field) {
            unset($request[$field]);
        }
    }

    private function handleSliderType(Request $request, Slider $slider = null)
    {
        // $fieldsToClear = ['radio_button_for_box_select_pro', 'radio_button_for_box_select_cat', 'radio_button_for_box_select_blog', 'title', 'caption', 'url'];

        $sliderTypeHandlers = [
            'type_random_off_pro' => function () use ($request) {
                if (!Slider::where('type', 'type_random_off_pro')->exists()) {
                    $request['product_id'] = $this->getRandomProductWithOff()?->id;
                    if ($request['product_id']) {
                        $request['final_date_slider'] = $this->select_time('hour', 24);
                    } else {
                        $request['status'] = '0';
                    }
                    $this->clearUnnecessaryFields($request, ['radio_button_for_box_select_pro', 'radio_button_for_box_select_cat', 'title', 'caption', 'url']);
                } else {
                    Session::flash('error', 'از این نوع اسلایدر فقط یک عدد مجاز می‌باشد');
                    return false;
                }
            },
            'type_new_off_pro' => function () use ($request) {
                if (!Slider::where('type', 'type_new_off_pro')->exists()) {
                    $request['product_id'] = $this->getNewProductWithOff()?->id;
                    if (!$request['product_id']) {
                        $request['status'] = '0';
                    }
                    $this->clearUnnecessaryFields($request, ['radio_button_for_box_select_pro', 'radio_button_for_box_select_cat', 'title', 'caption', 'url']);
                } else {
                    Session::flash('error', 'از این نوع اسلایدر فقط یک عدد مجاز می‌باشد');
                    return false;
                }
            },
            'type_new_pro' => function () use ($request) {
                if (!Slider::where('type', 'type_new_pro')->exists()) {
                    $request['product_id'] = $this->getNewProduct()?->id;
                    if (!$request['product_id']) {
                        $request['status'] = '0';
                    }
                    $this->clearUnnecessaryFields($request, ['radio_button_for_box_select_pro', 'radio_button_for_box_select_cat', 'title', 'caption', 'url']);
                } else {
                    Session::flash('error', 'از این نوع اسلایدر فقط یک عدد مجاز می‌باشد');
                    return false;
                }
            },
            'type_random_pro' => function () use ($request) {
                if (!Slider::where('type', 'type_random_pro')->exists()) {
                    $request['product_id'] = $this->getRandomProduct()?->id;
                    if ($request['product_id']) {
                        $request['final_date_slider'] = $this->select_time('hour', 24);
                    } else {
                        $request['status'] = '0';
                    }
                    $this->clearUnnecessaryFields($request, ['radio_button_for_box_select_pro', 'radio_button_for_box_select_cat', 'title', 'caption', 'url']);
                } else {
                    Session::flash('error', 'از این نوع اسلایدر فقط یک عدد مجاز می‌باشد');
                    return false;
                }
            },
            'type_select_pro' => function () use ($request, $slider) {
                return $this->handleSelectionType($request, $slider, 'type_select_pro', 'product_id', Product::class, 'radio_button_for_box_select_pro');
            },
            'type_select_cat' => function () use ($request, $slider) {
                return $this->handleSelectionType($request, $slider, 'type_select_cat', 'category_id', Category::class, 'radio_button_for_box_select_cat');
            },
            'type_new_blog' => function () use ($request) {
                if (!Slider::where('type', 'type_new_blog')->exists()) {
                    $request['blog_id'] = $this->getNewBlog()?->id;
                    if (!$request['blog_id']) {
                        $request['status'] = '0';
                    }
                    $this->clearUnnecessaryFields($request, ['radio_button_for_box_select_pro', 'radio_button_for_box_select_cat', 'radio_button_for_box_select_blog', 'title', 'caption', 'url']);
                } else {
                    Session::flash('error', 'از این نوع اسلایدر فقط یک عدد مجاز می‌باشد');
                    return false;
                }
            },
            'type_select_blog' => function () use ($request, $slider) {
                $this->handleSelectionType($request, $slider, 'type_select_blog', 'blog_id', Blog::class, 'radio_button_for_box_select_blog');
            },
            'type_other' => function () use ($request, $slider) {
                if ($request->_method == 'PUT') {
                    $this->validate($request, ['title' => 'required', 'url' => 'required', 'caption' => 'required']);
                    $imagePath = $slider->image;
                    if ($request->file('image')) {
                        if (File::exists($imagePath)) {
                            File::delete($imagePath);
                        }
                        $imageUrl = $this->upload_image('admin/asset/images/slider/', $request->file('image'));
                        $imageUrl = $this->crop_image($imageUrl['full_path'], $imageUrl['file'], '1920', '440');
                    } else {
                        $imageUrl = $imagePath;
                    }
                    $slider->update(array_merge($request->all(), ['image' => $imageUrl]));
                } else {
                    $this->validate($request, ['title' => 'required', 'url' => 'required', 'caption' => 'required', 'image' => 'required']);
                    $imageUrl = $this->upload_image('admin/asset/images/slider/', $request->file('image'));
                    $imageUrl = $this->crop_image($imageUrl['full_path'], $imageUrl['file'], '1920', '440');
                    Slider::create(array_merge($request->all(), ['image' => $imageUrl]));
                }
            },
        ];

        $handler = $sliderTypeHandlers[$request->type] ?? null;
        if ($handler) {
            return $handler();
        }
        return true;
    }

    private function handleSelectionType(Request $request, $slider, $type, $field, $model, $inputName)
    {
        $request->validate([$inputName => 'required']);

        $id = $request->$inputName;
        $existingSlider = Slider::where('type', $type)->where($field, $id)->first();
        if (!$existingSlider || $slider->$field == $id) {
            $request['type'] = $request->type;
            $request[$field] = $model::findOrFail($id)->id;
            if (!$request[$field]) {
                $request['status'] = '0';
            }
            $this->clearUnnecessaryFields($request, ['radio_button_for_box_select_pro', 'radio_button_for_box_select_cat', 'radio_button_for_box_select_blog', 'title', 'caption', 'url']);
        } else {
            Session::flash('error', "از این $type فقط یک عدد مجاز می‌باشد");
            return redirect(route('sliders.edit', ['slider' => $slider->id]));
        }
    }

    public function store(Request $request)
    {
        if ($this->handleSliderType($request) !== false) {
            if ($request->type != 'type_other') {
                Slider::create($request->all());
            }
        }
        return redirect(route('sliders.index'));
    }

    public function edit(Slider $slider)
    {
        $products = Product::whereStatus('1')->get();
        $categories = Category::whereStatus('1')->get();
        $blogs = Blog::whereStatus('1')->get();
        $currentAdmin = $this->currentAdmin;
        return view('admin.pages.sliders.edit', compact('slider', 'products', 'categories', 'blogs','currentAdmin'));
    }

    public function update(Request $request, Slider $slider)
    {
        if ($this->handleSliderType($request, $slider) !== false) {
            if ($request->type != 'type_other') {
                $slider->update($request->all());
            }
        } else {
            return redirect(route('sliders.edit', ['slider' => $slider->id]));
        }
        return redirect(route('sliders.index'));
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect(route('sliders.index'));
    }
}

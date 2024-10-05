<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\SliderController;
use App\Models\Slider;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSlider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slider_controller = new SliderController();

        if (!Slider::where('type', 'type_random_off_pro')->exists() || !Slider::where('type', 'type_new_off_pro')->exists() || !Slider::where('type', 'type_new_pro')->exists() || !Slider::where('type', 'type_random_pro')->exists() || !Slider::where('type', 'type_new_blog')->exists()) {
            if (!Slider::where('type', 'type_random_off_pro')->exists()) {
                $type = 'type_random_off_pro';
            } elseif (!Slider::where('type', 'type_new_off_pro')->exists()) {
                $type = 'type_new_off_pro';
            } elseif (!Slider::where('type', 'type_new_pro')->exists()) {
                $type = 'type_new_pro';
            } elseif (!Slider::where('type', 'type_random_pro')->exists()) {
                $type = 'type_random_pro';
            } elseif (!Slider::where('type', 'type_new_blog')->exists()) {
                $type = 'type_new_blog';
            }
            Slider::create(['type' => $type, 'status' => '0']);
        }

        $sliders = Slider::all();
        foreach ($sliders as $slider) {
            if ($slider->type == 'type_random_off_pro') {
                if ($slider->product_id != null) {
                    foreach ($slider->product()->get() as $product_slider) {
                        if ($product_slider->status == '0') {
                            $slider->status = '0';
                            $slider->product_id = null;
                            $slider->final_date_slider = null;
                            $slider->save();
                        }
                        if ($product_slider->status_off == 'none') {
                            $slider->product_id = $slider_controller->getRandomProductWithOff()?->id;
                            if ($slider->product_id) {
                                $slider->final_date_slider = $slider_controller->select_time('hour', 24);
                                $slider->save();
                            } else {
                                $slider->status = '0';
                                $slider->save();
                            }
                            $slider->save();
                        }
                    }
                } else {
                    $slider->product_id = null;
                    $slider->category_id = null;
                    $slider->blog_id = null;
                    $slider->final_date_slider = null;
                    $slider->product_id = $slider_controller->getRandomProductWithOff()?->id;
                    if ($slider->product_id) {
                        $slider->final_date_slider = $slider_controller->select_time('hour', 24);
                        $slider->save();
                    } else {
                        $slider->status = '0';
                        $slider->save();
                    }
                    $slider->save();
                }
            } elseif ($slider->type == 'type_new_off_pro') {
                if ($slider->product_id != null) {
                    foreach ($slider->product()->get() as $product_slider) {
                        if ($product_slider->status == '0') {
                            $slider->status = '0';
                            $slider->product_id = null;
                            $slider->final_date_slider = null;
                            $slider->save();
                        }
                        if ($product_slider->status_off == 'none') {
                            $slider->product_id = $slider_controller->getNewProductWithOff()?->id;
                            if ($slider->product_id) {
                                $slider->save();
                            } else {
                                $slider->status = '0';
                                $slider->save();
                            }
                            $slider->save();
                        }
                    }
                } else {
                    $slider->product_id = null;
                    $slider->category_id = null;
                    $slider->blog_id = null;
                    $slider->final_date_slider = null;
                    $slider->product_id = $slider_controller->getNewProductWithOff()?->id;
                    if ($slider->product_id) {
                        $slider->save();
                    } else {
                        $slider->status = '0';
                        $slider->save();
                    }
                    $slider->save();
                }
            } elseif ($slider->type == 'type_new_pro') {
                if ($slider->product_id != null) {
                    foreach ($slider->product()->get() as $product_slider) {
                        if ($product_slider->status == '0') {
                            $slider->status = '0';
                            $slider->product_id = null;
                            $slider->final_date_slider = null;
                            $slider->save();
                        }
                    }
                } else {
                    $slider->product_id = null;
                    $slider->category_id = null;
                    $slider->blog_id = null;
                    $slider->final_date_slider = null;
                    $slider->product_id = $slider_controller->getNewProduct()?->id;
                    if ($slider->product_id) {
                        $slider->save();
                    } else {
                        $slider->status = '0';
                        $slider->save();
                    }
                    $slider->save();
                }
            } elseif ($slider->type == 'type_random_pro') {
                if ($slider->product_id != null) {
                    foreach ($slider->product()->get() as $product_slider) {
                        if ($product_slider->status == '0') {
                            $slider->status = '0';
                            $slider->product_id = null;
                            $slider->final_date_slider = null;
                            $slider->save();
                        }
                    }
                } else {
                    $slider->product_id = null;
                    $slider->category_id = null;
                    $slider->blog_id = null;
                    $slider->final_date_slider = null;
                    $slider->product_id = $slider_controller->getRandomProduct()?->id;
                    if ($slider->product_id) {
                        $slider->final_date_slider = $slider_controller->select_time('hour', 24);
                        $slider->save();
                    } else {
                        $slider->status = '0';
                        $slider->save();
                    }
                    $slider->save();
                }
            } elseif ($slider->type == 'type_select_pro') {
                if ($slider->product_id != null) {
                    foreach ($slider->product()->get() as $product_slider) {
                        if ($product_slider->status == '0') {
                            $slider->status = '0';
                            $slider->product_id = null;
                            $slider->final_date_slider = null;
                            $slider->save();
                        }
                    }
                } else {
                    $slider->product_id = null;
                    $slider->category_id = null;
                    $slider->blog_id = null;
                    $slider->final_date_slider = null;
                    $slider->status = '0';
                    $slider->save();
                }
            } elseif ($slider->type == 'type_select_cat') {
                if ($slider->category_id != null) {
                    foreach ($slider->category()->get() as $category_slider) {
                        if ($category_slider->status == '0') {
                            $slider->status = '0';
                            $slider->category_id = null;
                            $slider->final_date_slider = null;
                            $slider->save();
                        }
                    }
                } else {
                    $slider->product_id = null;
                    $slider->category_id = null;
                    $slider->blog_id = null;
                    $slider->final_date_slider = null;
                    $slider->status = '0';
                    $slider->save();
                }
            } elseif ($slider->type == 'type_new_blog') {
                if ($slider->blog_id != null) {
                    foreach ($slider->blog()->get() as $blog_slider) {
                        if ($blog_slider->status == '0') {
                            $slider->status = '0';
                            $slider->blog_id = null;
                            $slider->final_date_slider = null;
                            $slider->save();
                        }
                    }
                } else {
                    $slider->product_id = null;
                    $slider->category_id = null;
                    $slider->blog_id = null;
                    $slider->final_date_slider = null;
                    $slider->blog_id = $slider_controller->getNewBlog()?->id;
                    if ($slider->blog_id) {
                        $slider->save();
                    } else {
                        $slider->status = '0';
                        $slider->save();
                    }
                    $slider->save();
                }
            } elseif ($slider->type == 'type_select_blog') {
                if ($slider->blog_id != null) {
                    foreach ($slider->blog()->get() as $blog_slider) {
                        if ($blog_slider->status == '0') {
                            $slider->status = '0';
                            $slider->blog_id = null;
                            $slider->final_date_slider = null;
                            $slider->save();
                        }
                    }
                } else {
                    $slider->product_id = null;
                    $slider->blog_id = null;
                    $slider->blog_id = null;
                    $slider->final_date_slider = null;
                    $slider->status = '0';
                    $slider->save();
                }
            }
        }

        $slider_time = Slider::where('final_date_slider', '<=', Carbon::now('Asia/Tehran'))->get();
        foreach ($slider_time as $slider) {
            $slider->product_id = null;
            $slider->category_id = null;
            $slider->blog_id = null;
            $slider->final_date_slider = null;

            if ($slider->type == 'type_random_off_pro') {
                $slider->product_id = $slider_controller->getRandomProductWithOff()?->id;
                if ($slider->product_id) {
                    $slider->final_date_slider = $slider_controller->select_time('hour', 24);
                    $slider->save();
                } else {
                    $slider->status = '0';
                    $slider->save();
                }
            } elseif ($slider->type == 'type_random_pro') {
                $slider->product_id = $slider_controller->getRandomProduct()?->id;
                if ($slider->product_id) {
                    $slider->final_date_slider = $slider_controller->select_time('hour', 24);
                    $slider->save();
                } else {
                    $slider->status = '0';
                    $slider->save();
                }
            }
            $slider->save();
        }
        $s = Slider::whereTitle('خوش آمدید')->whereType('type_other')->first();
        if (!Slider::whereStatus('1')->exists()) {
            if (!$s) {
                Slider::create(['type' => 'type_other', 'title' => 'خوش آمدید', 'caption' => 'به سایت خوش آمدید', 'status' => '1']);
            } else {
                $s->status = '1';
                $s->save();
            }
        } else {
            $s->status = '0';
            $s->save();
        }
        return $next($request);
    }
}

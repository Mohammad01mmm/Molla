<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public $currentAdmin;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $loginController = new LoginController();
            if (session()->has('adminLogin')) {
                $adminInfo = $this->infoAdmin('adminLogin');
                $this->currentAdmin = $adminInfo;
                if ($adminInfo) {
                    if ($adminInfo->type == 'user' || $adminInfo->status == '0') {
                        return $loginController->logout();
                    }
                } else {
                    return $loginController->logout();
                }
            }
            return $next($request, $this->currentAdmin);
        });
    }
    public function infoAdmin($name_session)
    {
        $admin = [];
        if (Session::has($name_session)) {
            $admin = User::where('id', '=', Session::get($name_session))->first();
        }
        return $admin;
    }
    // Upload Image
    protected function upload_image($path, $file)
    {
        $img_path = $path;
        $file_name = $file->hashName();
        $file = $file->move(public_path($img_path), $file_name);
        $path = $img_path . $file_name;
        return ['path' => $img_path, 'full_path' => $path, 'file' => $file];
    }
    // Crop Image
    protected function crop_image($path_upload_image_method, $file_upload_image_method, $width, $height)
    {
        $manager = new ImageManager(new Driver());
        $manager->read($file_upload_image_method->getRealPath())->crop($width, $height)->save($path_upload_image_method);
        return $path_upload_image_method;
    }
    // Scale Image
    protected function scale_image($file_upload_image_method, array $sizes, $path_upload_image_method)
    {
        $img['original'] = $path_upload_image_method;
        foreach ($sizes as $size) {
            $explode_full_path = explode('/', $path_upload_image_method);
            $file_name = end($explode_full_path);
            $path = array_slice($explode_full_path, 0, -1);
            $path = implode('/', $path);
            $img[$size] = $path . '/' . $size . '_' . $file_name;
            $manager = new ImageManager(new Driver());
            $manager
                ->read($file_upload_image_method->getRealPath())
                ->scale(width: $size)
                ->save(public_path($img[$size]));
        }
        return $img;
    }

    // For OFF Product Add Time For OFF Product

    public function select_time($unit_time, $time)
    {
        switch ($unit_time) {
            case 'minutes':
                $final_date = Carbon::now('Asia/Tehran')->addMinutes($time);
                break;
            case 'hour':
                $final_date = Carbon::now('Asia/Tehran')->addHours($time);
                break;
            case 'day':
                $final_date = Carbon::now('Asia/Tehran')->addDays($time);
                break;
            case 'week':
                $final_date = Carbon::now('Asia/Tehran')->addWeeks($time);
                break;
            case 'month':
                $final_date = Carbon::now('Asia/Tehran')->addMonths($time);
                break;
            case 'year':
                $final_date = Carbon::now('Asia/Tehran')->addYears($time);
                break;
        }
        return $final_date;
    }
}

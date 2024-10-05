@extends('admin.master')
@section('title', 'افزودن اسلایدر')

@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            افزودن اسلایدر
        </div>
        <div class="card-body">
            <form action="{{ route('sliders.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($errors->all())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li class="m-1 mx-4">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (Session::has('error'))
                    <ul class="alert alert-danger">
                        <li class="mx-4">{{ Session::get('error') }}</li>
                    </ul>
                @endif
                <div class="form-group py-2">
                    <label class="mx-2">نوع اسلایدر</label>
                    @php
                        $sliderTypes = [
                            'type_random_off_pro' => 'رندوم بین محصولات تخفیف خورده',
                            'type_new_off_pro' => 'جدیدترین محصول تخفیف خورده',
                            'type_new_pro' => 'آخرین محصول',
                            'type_random_pro' => 'رندوم از بین محصولات',
                            'type_select_pro' => 'محصول انتخابی',
                            'type_select_cat' => 'دسته بندی',
                            'type_new_blog' => 'بلاگ جدید',
                            'type_select_blog' => 'بلاگ انتخابی',
                            'type_other' => 'دیگر',
                        ];
                    @endphp

                    @foreach ($sliderTypes as $type => $label)
                        <div class="my-2 mx-3">
                            <input class="form-check-input" type="radio" name="type" id="{{ $type }}"
                                value="{{ $type }}" @if (App\Models\Slider::where('type', $type)->exists()) disabled @endif
                                @if (!App\Models\Slider::where('type', $type)->exists() && $loop->first) checked @endif>
                            <label class="form-check-label mx-1" for="{{ $type }}">
                                {{ $label }}
                            </label>
                        </div>
                    @endforeach
                </div>


                <div class="px-4">
                    <div id="box_random_off_pro">
                        <h4> رندوم بین محصولات تخفیف خورده </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> بین محصولاتی که در موقع انتشار فعال باشد که تخفیف
                            خورده شده باشه بصورت تصادفی یکی را انتخاب میکنه و قرار میده به مدت 24 ساعت اگر هم کالایی تخفیف
                            نداشته باشه این اسلاید غیر فعال میشه </p>
                    </div>
                    <div id="box_new_off_pro">
                        <h4> جدیدترین محصول تخفیف خورده </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> جدیدترین محصولی که تخفیف خورده رو نشون میده تا زمانی
                            که یک کالا جدید تخفیف بخوره اگر هم کالایی تخفیف نداشته باشه این اسلاید غیر فعال میشه </p>
                    </div>
                    <div id="box_new_pro">
                        <h4> آخرین محصول </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> آخرین محصول ایجاد شده رو به کاربر نشون میده اگر
                            محصولی موجود نباشه این اسلاید غیر فعال میشه </p>
                    </div>
                    {{-- <div id="box_most_view_pro">
                        <h4> پر بازدیدترین محصول </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> پر بازیدترین محصول فروشگاه رو به کاربر نشون میده اگر
                            محصولی وجود نداشته باشه این اسلاید غیر فعال میشود </p>
                    </div>
                    <div id="box_favorite_pro">
                        <h4> محبوب ترین محصول </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> محبوب ترین محصولی که کاربران سایت در لیست محبوب ترین
                            کالا های حساب کاربری خودشون ذخیره کردن رو نشون میده اگر محصولی وجود نداشته باشه این اسلاید غیر
                            فعال میشود </p>
                    </div> --}}
                    <div id="box_random_pro">
                        <h4> رندوم از بین محصولات </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> از بین همه محصولات داخل سایت یک محصول را انتخاب
                            میکنه و به مدت 24 ساعت به کاربر نشون میدهد و اگر محصولی وجود نداشت این اسلاید را غیر فعال میکند
                        </p>
                    </div>
                    <div id="box_select_pro">
                        <h4> محصول انتخابی </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> محصولی که شما انتخاب کردین تا زمانی که آن محصول فعال
                            باشد به کاربر نمایش میدهد در غیر این صورت این اسلاید غیر فعال میشود </p>
                        <div>
                            <div class="row">
                                @if (!$products->count())
                                    <div class="text-center">
                                        <h4 class="text-danger"> محصولی وجود ندارد </h4>
                                        <br>
                                        <a href="{{ route('products.create') }}" class="btn btn-danger px-5">
                                            افزودن محصول
                                        </a>
                                    </div>
                                @endif
                                @foreach ($products as $product)
                                    <div class="col-md-4 col-lg-3">
                                        <input class="form-check-input" type="radio"
                                            name="radio_button_for_box_select_pro" value="{{ $product->id }}"
                                            @if (App\Models\Slider::where('type', 'type_select_pro')->where('product_id', $product->id)->exists()) disabled @endif>
                                        <div class="card">
                                            <img src="{{ asset($product->image) }}" class="card-img-top border-bottom">
                                            <div class="card-body">
                                                <h5 class="card-title"> {{ $product->title }} </h5>
                                                <small class="text-muted"> {{ $product->category()->first()->title }}
                                                </small>
                                                <div class="dir-ltr">
                                                    <small class="text-muted"> {{ $product->code }} </small>
                                                </div>
                                                <h6> توضیحات </h6>
                                                <p> {{ Illuminate\Support\Str::limit($product->description, 70) }} </p>
                                                <hr>
                                                <span> قیمت : </span>
                                                @if ($product->colors()->count() == 0)
                                                    <span> توافقی </span>
                                                @elseif($product->colors()->count() == 1)
                                                    <span
                                                        class="@if ($product->status_off != 'none') text-decoration-line-through @endif">
                                                        {{ $product->colors()->first()->pivot->price }}
                                                    </span>
                                                    @if ($product->status_off != 'none')
                                                        <span> {{ $product->colors()->first()->pivot->final_price }}
                                                        </span>
                                                    @endif
                                                @elseif($product->colors()->count() > 1)
                                                    <span
                                                        class="@if ($product->status_off != 'none') text-decoration-line-through @endif">
                                                        <span> از </span>
                                                        <span>
                                                            {{ $product->colors()->orderBy('price', 'asc')->first()->pivot->price }}
                                                        </span>
                                                        <span> تا </span>
                                                        <span>
                                                            {{ $product->colors()->orderBy('price', 'desc')->first()->pivot->price }}
                                                        </span>
                                                    </span>
                                                    @if ($product->status_off != 'none')
                                                        <br>
                                                        <span> از </span>
                                                        <span>
                                                            {{ $product->colors()->orderBy('price', 'asc')->first()->pivot->final_price }}
                                                        </span>
                                                        <span> تا </span>
                                                        <span>
                                                            {{ $product->colors()->orderBy('price', 'desc')->first()->pivot->final_price }}
                                                        </span>
                                                    @endif
                                                @endif
                                                <div class="dir-ltr">
                                                    <a href="#" class="btn btn-primary">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="box_select_cat">
                        <h4> دسته بندی </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> دسته بندی که شما انتخاب کردین رو به کاربر تا زمانی
                            که دسته بندی فعال باشد و محصولی مطلق به آن دسته بندی باشد به کاربر نشون داده میشود در غیر این
                            صورت این اسلاید غیر فعال میشود </p>
                        <div>
                            <div class="row">
                                @if (!$categories->count())
                                    <div class="text-center">
                                        <h4 class="text-danger"> دسته بندی ای وجود ندارد </h4>
                                        <br>
                                        <a href="{{ route('categories.create') }}" class="btn btn-danger px-5"> افزودن دسته
                                            بندی </a>
                                    </div>
                                @endif
                                @foreach ($categories as $category)
                                    <div class="col-md-4 col-lg-3">
                                        <input class="form-check-input" type="radio"
                                            name="radio_button_for_box_select_cat" value="{{ $category->id }}"
                                            @if (App\Models\Slider::where('type', 'type_select_cat')->where('category_id', $category->id)->exists()) disabled @endif>
                                        <div class="card">
                                            <img src="{{ asset($category->image) }}" class="card-img-top border-bottom">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="card-title"> {{ $category->title }} </h5>
                                                    <span class="badge bg-warning text-light mx-2">
                                                        {{ $category->products()->count() }}
                                                    </span>
                                                </div>
                                                <a href="#" class="btn btn-warning text-light w-100 mt-3">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="box_new_blog">
                        <h4> بلاگ جدید </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> جدیدترین بلاگی که فعال باشد را به کاربر نشون میدهد و
                            تا زمانی که بلاگی فعال باشد به کاربر نمایش داده میشود در غیر این صورت این اسلاید غیر فعال
                            میشود </p>
                    </div>
                    <div id="box_select_blog">
                        <h4> بلاگ انتخابی </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> بلاگی که شما انتخاب کرده اید را به کاربر نمایش میدهد
                            و اگر این بلاگ غیر فعال شود این اسلاید هم غیر فعال میشود </p>
                        <div>
                            <div class="row">
                                @if (!$blogs->count())
                                    <div class="text-center">
                                        <h4 class="text-danger"> بلاگی وجود ندارد </h4>
                                        <br>
                                        <a href="{{ route('blogs.create') }}" class="btn btn-danger px-5"> افزودن بلاگ </a>
                                    </div>
                                @endif
                                @foreach ($blogs as $blog)
                                    <div class="col-md-4 col-lg-3">
                                        <input class="form-check-input" type="radio"
                                            name="radio_button_for_box_select_blog" value="{{ $blog->id }}"
                                            @if (App\Models\Slider::where('type', 'type_select_blog')->where('blog_id', $blog->id)->exists()) disabled @endif>
                                        <div class="card">
                                            <img src="{{ asset($blog->image) }}" class="card-img-top border-bottom">
                                            <div class="card-body">
                                                <h5 class="card-title"> {{ $blog->title }} </h5>
                                                <hr>
                                                <h6> توضیحات </h6>
                                                <p> {{ Illuminate\Support\Str::limit($blog->description, 70) }} </p>
                                                <a href="#" class="btn btn-info text-light w-100 mt-3"
                                                    style="-webkit-text-stroke : #000000ba 1px">
                                                    <i class="bi bi-eye-fill fs-6"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="box_other">
                        <h4> دیگر </h4>
                        <p class="text-muted fw-bold small mt-4 pe-3"> شما میتوانید محتوا کاستوم خودتون رو ایجاد کنید </p>
                        <div class="form-group py-2">
                            <label for="title" class="pb-3"> عنوان </label>
                            <input id="title" name="title" type="text" class="form-control"
                                placeholder="عنوان . . .">
                        </div>
                        <div class="form-group py-2">
                            <label for="caption" class="pb-3"> توضیحات </label>
                            <input id="caption" name="caption" type="text" class="form-control"
                                placeholder="توضیحات . . .">
                        </div>
                        <div class="form-group py-2">
                            <label for="url" class="pb-3"> لینک </label>
                            <input id="url" name="url" type="text" class="form-control dir-ltr"
                                placeholder="link url . . .">
                        </div>
                        <div class="form-group py-2">
                            <label for="image" class="pb-3"> تصویر </label>
                            <input id="image" name="image" type="file" class="form-control">
                            <span class="text-muted fw-bold fs-6 p-4">
                                بهترین اندازه برای اسلایدر عرض 1920px و ارتفاع 440px است .
                            </span>
                            <div class="dir-ltr">
                                <div id ="preview" class="w-25 shadow mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group py-2">
                    <div class="form-check form-check-inline m-2">
                        <input class="form-check-input" type="radio" name="status" id="active" value="1"
                            checked>
                        <label class="form-check-label mx-1" for="active"> فعال </label>
                    </div>
                    <div class="form-check form-check-inline m-2">
                        <input class="form-check-input" type="radio" name="status" id="passive" value="0">
                        <label class="form-check-label mx-1" for="passive"> غیر فعال </label>
                    </div>
                </div>
                <input type="submit" class="btn btn-success my-3 w-100 fw-bold" value="ثبت">
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#type_select_pro').removeAttr('disabled');
            $('#type_select_cat').removeAttr('disabled');
            $('#type_select_blog').removeAttr('disabled');
            $('#type_other').removeAttr('disabled');
            $("input[name='type']:enabled").first().prop("checked", true);
            $("input[name='radio_button_for_box_select_pro']:enabled").first().prop("checked", true);
            $("input[name='radio_button_for_box_select_cat']:enabled").first().prop("checked", true);
            $("input[name='radio_button_for_box_select_blog']:enabled").first().prop("checked", true);
            const boxes = [
                '#box_random_off_pro',
                '#box_new_off_pro',
                '#box_new_pro',
                '#box_random_pro',
                '#box_select_pro',
                '#box_select_cat',
                '#box_new_blog',
                '#box_select_blog',
                '#box_other'
            ];

            function hideAllBoxes() {
                boxes.forEach(box => $(box).hide());
            }

            hideAllBoxes();
            $('#box_' + $('input[name="type"]:checked').attr('id').split('_').slice(1).join('_')).show()

            $('input[name="type"]').change(function() {
                hideAllBoxes();
                $('#box_' + $(this).attr('id').split('_').slice(1).join('_')).show();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $pic = $('<img class="img-thumbnail" id = "photo" width = "100%" height = "100%"/>');
            $("#image").change(function() {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) {
                    $("#photo").remove();
                    $lbl.appendTo("#preview");
                }
                if (/^image/.test(files[0].type)) {
                    var reader = new FileReader();
                    reader.readAsDataURL(files[0]);
                    reader.onloadend = function() {
                        $pic.appendTo("#preview");
                        $("#photo").attr("src", this.result);
                    }
                }
            });
        });
    </script>
@endsection

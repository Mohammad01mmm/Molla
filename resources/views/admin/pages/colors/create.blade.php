@extends('admin.master')
@section('title', 'افزودن رنگ')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper {
            width: 140px;
            height: 220px;
        }

        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 18px;
            font-weight: bold;
            color: #fff;
        }
    </style>
@endsection
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            افزودن رنگ
        </div>
        <div class="card-body">
            <form action="{{ route('colors.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($errors->all())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li class="m-1 mx-4">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group py-2">
                    <label for="title" class="pb-3"> عنوان </label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="عنوان . . .">
                </div>

                <div class="d-flex flex-row-reverse">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" style="background: #cd5c5c">
                                <button type="button" class="btn btn-primary" id="btnColor_1" value="#cd5c5c">
                                    جگری
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #f08080">
                                <button type="button" class="btn btn-primary" id="btnColor_2" value="#f08080">
                                    بژ تیره
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #fa8072">
                                <button type="button" class="btn btn-primary" id="btnColor_3" value="#fa8072">
                                    حناییِ روشن
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ff0000">
                                <button type="button" class="btn btn-primary" id="btnColor_4" value="#ff0000">
                                    قرمز
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #dc143c">
                                <button type="button" class="btn btn-primary" id="btnColor_5" value="#dc143c">
                                    زرشکی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #b22222">
                                <button type="button" class="btn btn-primary" id="btnColor_6" value="#b22222">
                                    شرابی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #8b0000">
                                <button type="button" class="btn btn-primary" id="btnColor_7" value="#8b0000">
                                    عنابی تند
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ffc0cb">
                                <button type="button" class="btn btn-primary" id="btnColor_8" value="#ffc0cb">
                                    صورتی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ffb6c1">
                                <button type="button" class="btn btn-primary" id="btnColor_9" value="#ffb6c1">
                                    صورتی پررنگ
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ff69b4">
                                <button type="button" class="btn btn-primary" id="btnColor_10" value="#ff69b4">
                                    سرخابی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #c71085">
                                <button type="button" class="btn btn-primary" id="btnColor_11" value="#c71085">
                                    ارغوانی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ffa500">
                                <button type="button" class="btn btn-primary" id="btnColor_12" value="#ffa500">
                                    نارنجی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ff7f50">
                                <button type="button" class="btn btn-primary" id="btnColor_13" value="#ff7f50">
                                    نارنجی پررنگ
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ff6347">
                                <button type="button" class="btn btn-primary" id="btnColor_14" value="#ff6347">
                                    قرمز گوجه‌ای
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ff4500">
                                <button type="button" class="btn btn-primary" id="btnColor_15" value="#ff4500">
                                    قرمز نارنجی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ffffe0">
                                <button type="button" class="btn btn-primary" id="btnColor_16" value="#ffffe0">
                                    شیری
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #fafad2">
                                <button type="button" class="btn btn-primary" id="btnColor_17" value="#fafad2">
                                    لیمویی روشن
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ffe4d5">
                                <button type="button" class="btn btn-primary" id="btnColor_18" value="#ffe4d5">
                                    هلویی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #eee8aa">
                                <button type="button" class="btn btn-primary" id="btnColor_19" value="#eee8aa">
                                    نخودی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #f0e683">
                                <button type="button" class="btn btn-primary" id="btnColor_20" value="#f0e683">
                                    خاکی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ffff00">
                                <button type="button" class="btn btn-primary" id="btnColor_20" value="#ffff00">
                                    زرد
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #adff2f">
                                <button type="button" class="btn btn-primary" id="btnColor_21" value="#adff2f">
                                    مغزپسته‌ای
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #7fff00">
                                <button type="button" class="btn btn-primary" id="btnColor_22" value="#7fff00">
                                    سبز روشن
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #98fb98">
                                <button type="button" class="btn btn-primary" id="btnColor_23" value="#98fb98">
                                    سبز کمرنگ
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #00fa9a">
                                <button type="button" class="btn btn-primary" id="btnColor_24" value="#00fa9a">
                                    یشمی سیر
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #00ff7f">
                                <button type="button" class="btn btn-primary" id="btnColor_25" value="#00ff7f">
                                    یشمی کمرنگ
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #9acd32">
                                <button type="button" class="btn btn-primary" id="btnColor_26" value="#9acd32">
                                    سبز لجنی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #32cd32">
                                <button type="button" class="btn btn-primary" id="btnColor_27" value="#32cd32">
                                    سبز چمنی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #3cb371">
                                <button type="button" class="btn btn-primary" id="btnColor_28" value="#3cb371">
                                    خزه ای
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #2e8b57">
                                <button type="button" class="btn btn-primary" id="btnColor_29" value="#2e8b57">
                                    خزه‌ای پررنگ
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #228b22">
                                <button type="button" class="btn btn-primary" id="btnColor_30" value="#228b22">
                                    شویدی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #008000">
                                <button type="button" class="btn btn-primary" id="btnColor_31" value="#008000">
                                    سبز
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #6b8e23">
                                <button type="button" class="btn btn-primary" id="btnColor_32" value="#6b8e23">
                                    سبز ارتشی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #808000">
                                <button type="button" class="btn btn-primary" id="btnColor_33" value="#808000">
                                    زیتونی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #556b2f">
                                <button type="button" class="btn btn-primary" id="btnColor_34" value="#556b2f">
                                    زیتونی سیر
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #006400">
                                <button type="button" class="btn btn-primary" id="btnColor_35" value="#006400">
                                    سبز آووکادو
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #66cdaa">
                                <button type="button" class="btn btn-primary" id="btnColor_36" value="#66cdaa">
                                    سبز دریایی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #8fbc8f">
                                <button type="button" class="btn btn-primary" id="btnColor_37" value="#8fbc8f">
                                    سبز دریایی تیره
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #20b2aa">
                                <button type="button" class="btn btn-primary" id="btnColor_38" value="#20b2aa">
                                    سبز کبریتی روشن
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #008080">
                                <button type="button" class="btn btn-primary" id="btnColor_39" value="#008080">
                                    سبز دودی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #00ffff">
                                <button type="button" class="btn btn-primary" id="btnColor_40" value="#00ffff">
                                    فیروزه‌ای
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #e0ffff">
                                <button type="button" class="btn btn-primary" id="btnColor_41" value="#e0ffff">
                                    آبی آسمانی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #7fffd4">
                                <button type="button" class="btn btn-primary" id="btnColor_42" value="#7fffd4">
                                    یشمی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #87cefa">
                                <button type="button" class="btn btn-primary" id="btnColor_43" value="#87cefa">
                                    آبی روشن
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #1e90ff">
                                <button type="button" class="btn btn-primary" id="btnColor_44" value="#1e90ff">
                                    نیلی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #0000ff">
                                <button type="button" class="btn btn-primary" id="btnColor_45" value="#0000ff">
                                    آبی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #0000cd">
                                <button type="button" class="btn btn-primary" id="btnColor_46" value="#0000cd">
                                    آبی سیر
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #00008b">
                                <button type="button" class="btn btn-primary" id="btnColor_47" value="#00008b">
                                    سرمه‌ای
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #000080">
                                <button type="button" class="btn btn-primary" id="btnColor_48" value="#000080">
                                    لاجوردی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #191970">
                                <button type="button" class="btn btn-primary" id="btnColor_49" value="#191970">
                                    آبی نفتی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #d8bfd8">
                                <button type="button" class="btn btn-primary" id="btnColor_50" value="#d8bfd8">
                                    بادمجانی روشن
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #da70d6">
                                <button type="button" class="btn btn-primary" id="btnColor_51" value="#da70d6">
                                    ارکیده
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #8b008b">
                                <button type="button" class="btn btn-primary" id="btnColor_52" value="#8b008b">
                                    مخملی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #800080">
                                <button type="button" class="btn btn-primary" id="btnColor_53" value="#800080">
                                    بنفش
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #483d8b">
                                <button type="button" class="btn btn-primary" id="btnColor_54" value="#483d8b">
                                    آبی دودی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ffe4c4">
                                <button type="button" class="btn btn-primary" id="btnColor_55" value="#ffe4c4">
                                    کرم
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #f5debc">
                                <button type="button" class="btn btn-primary" id="btnColor_56" value="#f5debc">
                                    گندمی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #bc8f8f">
                                <button type="button" class="btn btn-primary" id="btnColor_57" value="#bc8f8f">
                                    بادمجانی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #8b4513">
                                <button type="button" class="btn btn-primary" id="btnColor_58" value="#8b4513">
                                    کاکائویی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #a52a2a">
                                <button type="button" class="btn btn-primary" id="btnColor_59" value="#8b4513">
                                    قهوه‌ای
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ffffff">
                                <button type="button" class="btn btn-primary" id="btnColor_60" value="#ffffff">
                                    سفید
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #ffe4e1">
                                <button type="button" class="btn btn-primary" id="btnColor_61" value="#ffe4e1">
                                    بژ
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #d3d3d3">
                                <button type="button" class="btn btn-primary" id="btnColor_62" value="#d3d3d3">
                                    نقره‌ای
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #c0c0c0">
                                <button type="button" class="btn btn-primary" id="btnColor_63" value="#c0c0c0">
                                    توسی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #808080">
                                <button type="button" class="btn btn-primary" id="btnColor_64" value="#808080">
                                    خاکستری
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #696969">
                                <button type="button" class="btn btn-primary" id="btnColor_65" value="#696969">
                                    دودی
                                </button>
                            </div>
                            <div class="swiper-slide" style="background: #000000">
                                <button type="button" class="btn btn-primary" id="btnColor_66" value="#000000">
                                    سیاه
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group py-2">
                        <label for="hex" class="pb-3"> کد رنگی </label>
                        <input id="hex" name="hex" type="color" class="form-control form-control-color">
                    </div>
                </div>
                <input type="submit" class="btn btn-success my-3 w-100 fw-bold" value="ثبت">
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "cards",
            grabCursor: true,
        });
    </script>
    <script>
        for (let i = 1; i <= 100; i++) {
            document.getElementById("btnColor_" + i).addEventListener("click", function() {
                printButtonValue(document.getElementById("btnColor_" + i));
            });

            function printButtonValue(buttonElement) {
                let hex = document.getElementById('hex');
                hex.value = buttonElement.value;
                let title = document.getElementById('title');
                title.value = buttonElement.innerHTML.trim();
            }
        }
    </script>
@endsection

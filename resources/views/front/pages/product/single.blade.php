@extends('front.master')
@section('style')
    <link rel="stylesheet" href="front/assets/css/plugins/nouislider/nouislider.css">
    <style>
        .btn-wishlist:hover{
            color:#4ca6ff;
        }
        .product-action:hover{
            background-color:#4ca6ff;
            color:#ffffff;
        }
        .btn-cart:hover{
            color:#ffffff;
        }

    </style>
@endsection
@section('main')
    <main class="main">
        <br>
        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-separated">
                                @foreach ($product->images as $image)
                                    <figure class="product-separated-item">
                                        <img src="{{ asset($image) }}" alt="تصویر محصول">
                                        @if ($loop->first)
                                            <a href="#" id="btn-separated-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        @endif
                                    </figure>
                                @endforeach
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="product-details sticky-content">
                                <h1 class="product-title"> {{ $product->title }} </h1>
                                #{{ $product->code }}

                                <!-- End .product-title -->


                                <div id="product-price" class="product-price">  </div><!-- End .product-price -->

                                <div class="product-content">
                                    <p> {{ Str::limit($product->description, 140, ' . . . ') }} </p>
                                </div><!-- End .product-content -->
                                @if($product->status_off!= 'none')
                                    <div class="deal-bottom">
                                        <div class="deal-countdown offer-countdown" data-until="+{{$final_date_off['years']}}y +{{$final_date_off['months']}}m +{{$final_date_off['days']}}d +{{$final_date_off['hours']}}h +{{$final_date_off['minutes']}}i +{{$final_date_off['seconds']}}s"></div>
                                        <!-- End .deal-countdown -->
                                    </div><!-- End .deal-bottom -->
                                @endif
                                <br>
                                <div class="text-right">
                                    <h6> رنگ </h6>
                                    <div>
                                    <form action="{{ route('carts.store') }}" method="post">
                                        @csrf
                                        @foreach ($product->colors()->where('inventory','>=',1)->get() as $color)
                                            <button name="color" type="button" class="rounded-pill border border-dark ml-1"
                                                style="width: 25px;height: 25px;background:{{ $color->hex }}" value="{{ $color->hex }}" id="color_{{ last(explode('#',$color->hex )) }}"></button>
                                        @endforeach
                                    </div>
                                </div>
                                <br>
                                <div class="details-filter-row details-row-size">
                                    <label for="qty">تعداد : </label>
                                    <div class="product-details-quantity">
                                        <input name="count" type="number" id="qty" class="form-control" value="1"
                                            min="1" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->
                                </div><!-- End .details-filter-row -->

                                <div class="d-flex mb-3" style="align-items: center !important;">
                                    <div class="product-details-action d-block m-0">
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                               <input type="hidden" value="" name="color" id="color_input">
                                                <button type="submit" class="btn btn-product btn-cart"
                                                    title="افزودن به سبد خرید"> افزودن به سبد خرید </button>
                                    </div>
                                </form>
                                        <form class="details-action-wrapper" action="{{ route('wishlists.store') }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                                            <button type="submit" class="mb-sm-3 btn btn-product btn-wishlist"
                                                title="افزودن به لیست علاقه مندی"> افزودن به لیست علاقه مندی </button>
                                        </form>
                                </div><!-- End .product-details-action -->

                                <div class="product-details-footer">
                                    <div class="product-cat text-center">
                                        <span>دسته بندی : </span>
                                        <a href="#"> {{$product->category()->first()->title}} </a>
                                    </div><!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">اشتراک گذاری : </span>
                                        <a href="#" class="social-icon" title="فیسبوک" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="توییتر" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="اینستاگرام" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="پینترست" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div><!-- End .product-details-footer -->

                                <div class="accordion accordion-plus product-details-accordion" id="product-accordion">
                                    <div class="card card-box card-sm">
                                        <div class="card-header" id="product-desc-heading">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#product-accordion-desc" aria-expanded="false"
                                                    aria-controls="product-accordion-desc">
                                                    توضیحات
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="product-accordion-desc" class="collapse"
                                            aria-labelledby="product-desc-heading" data-parent="#product-accordion">
                                            <div class="card-body">
                                                <div class="product-desc-content">
                                                    {{$product->description}}
                                                </div><!-- End .product-desc-content -->
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card card-box card-sm">
                                        <div class="card-header" id="product-info-heading">
                                            <h2 class="card-title">
                                                <a role="button" data-toggle="collapse" href="#product-accordion-info"
                                                    aria-expanded="true" aria-controls="product-accordion-info">
                                                   مشخصات
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="product-accordion-info" class="collapse show"
                                            aria-labelledby="product-info-heading" data-parent="#product-accordion">
                                            <div class="card-body">
                                                <div class="product-desc-content">
                                                    <table class="w-100">
                                                        @foreach($product->properties()->get() as $property)
                                                        <tr class="w-100 border border-top-0 border-left-0 border-right-0 ">
                                                            <td class="pt-1 pb-1"> {{ $property->title }} </td>
                                                            <td class="pt-1 pb-1"> {{ $property->type_input['type_input'] == 'radio' ? $property->pivot->value == 1 ? 'دارد' : 'ندارد' : str_replace('_',' ',$property->pivot->value) }} </td>
                                                            <td class="pt-1 pb-1"> {{ $property->pivot->unit == 'null' ? '' : str_replace('_',' ',$property->pivot->unit) }} </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div><!-- End .product-desc-content -->
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card card-box card-sm">
                                        <div class="card-header" id="product-shipping-heading">
                                            <h2 class="card-title">
                                                <a class="collapsed" role="button" data-toggle="collapse"
                                                    href="#product-accordion-shipping" aria-expanded="false"
                                                    aria-controls="product-accordion-shipping">
                                                    ارسال و بازگشت
                                                </a>
                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="product-accordion-shipping" class="collapse"
                                            aria-labelledby="product-shipping-heading" data-parent="#product-accordion">
                                            <div class="card-body">
                                                <div class="product-desc-content">

                                                </div><!-- End .product-desc-content -->
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->
                                </div><!-- End .card -->
                            </div><!-- End .accordion -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <hr class="mt-3 mb-5">

            <h2 class="title text-center mb-4"> محصولات مشابه </h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow m-lg-5" data-toggle="owl"
                data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "rtl": true,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                        @foreach($products->where('category_id' , $product->category()->first()->id)->where('id' , '!=' ,$product->id) as $product_cat)
                                    <div class="product product-2 rounded">
                                        <figure class="product-media">
                                            @if ($product_cat->status_off != 'none')
                                                <span class="product-label label-circle label-sale">فروش ویژه</span>
                                            @endif
                                            <a href="product.html">
                                                <img src="{{ asset($product_cat->image) }}" alt="{{ $product_cat->title }}"
                                                    class="product-image">
                                            </a>
                                            <form class="product-action-vertical" action="{{ route('wishlists.store') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $product_cat->id }}" name="product_id">
                                                <button type="submit" class="btn-product-icon btn-wishlist btn-expandable"
                                                    title="افزودن به لیست علاقه مندی"><span>افزودن به
                                        لیست علاقه مندی</span></button>
                                            </form>
                                            <div class="product-action">
                                        <a href="#" class="btn-product btn-cart"> افزودن به سبد خرید </a>
                                                 </div><!-- End .product-action -->
                                        </figure>
                                        <div class="product-body text-center">
                                            <br>
                                            <div class="product-cat text-center">
                                                <a href="#"> {{ $product->category()->first()->title }} </a>
                                            </div>
                                            <h3 class="product-title text-center">
                                                <a
                                                    href="{{ route('single-product', ['product' => $product_cat->slag_url]) }}">{{ $product_cat->title }}</a>
                                            </h3>
                                            <br>
                                            <div class="product-price text-center m-auto">
                                                @if ($product_cat->status_off != 'none')
                                                    <span
                                                        class="new-price text-center">{{ number_format($color->pivot->final_price) }}
                                                        تومان</span>
                                                    <span class="old-price text-center">{{ number_format($color->pivot->price) }}
                                                        تومان</span>
                                                @else
                                                   <span class="product-price text-center"> {{ number_format($color->pivot->price) }} تومان </span>
                                                @endif
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    @endforeach

            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </main><!-- End .main -->
@endsection
@section('script')
    <script src="front/assets/js/jquery.elevateZoom.min.js"></script>
    <script src="front/assets/js/jquery.sticky-kit.min.js"></script>
   <script>
    $(document).ready(function(){
        var colors = @json($product->colors()->where('inventory', '>=', 1)->get());
        var firstColorButton = $('button[id^="color_"]').first();

        // Set the first button as selected
        firstColorButton.removeClass('border-dark').addClass('border-success');

        // Get the first color object
        var selectedColor = colors.find(color => color.hex === firstColorButton.val());
         $("#color_input").val(selectedColor.id);

        // Update the price display
        updatePrice(selectedColor);

        // Set max quantity
        $('#qty').attr('max', selectedColor.pivot.inventory);

        // Handle button click event
        $('button[id^="color_"]').click(function() {
            $('button[id^="color_"]').removeClass('border-success').addClass('border-dark');
            $(this).removeClass('border-dark').addClass('border-success');

            var selectedColorHex = $(this).val();
            var selectedColor = colors.find(color => color.hex === selectedColorHex);
            $("#color_input").val(selectedColor.id);
            updatePrice(selectedColor);
            $('#qty').attr('max', selectedColor.pivot.inventory);
        });

        // Function to update price display
        function updatePrice(selectedColor) {
            $('#product-price').empty();
            var finalPrice = parseInt(selectedColor.pivot.final_price).toLocaleString();
            var oldPrice = parseInt(selectedColor.pivot.price).toLocaleString();

            if (@json($product->status_off != 'none')) {
                $('#product-price').append('<span class="new-price">' + finalPrice + ' تومان </span>');
                $('#product-price').append('<span class="old-price">' + oldPrice + ' تومان </span>');
            } else {
                $('#product-price').append('<span class="product-price">' + finalPrice + ' تومان </span>');
            }
        }
    });
</script>
@endsection

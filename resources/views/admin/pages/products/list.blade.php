@extends('admin.master')
@section('title', 'محصولات')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            محصولات
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4 mx-2">
                    <a href="{{ route('products.create') }}" class="text-light text-decoration-none fw-bold"> افزودن </a>
                </div>
                <div class="btn btn-warning px-4 mx-2">
                    <a href="{{ route('main-property.index') }}" class="text-light text-decoration-none fw-bold"> ویژگی اصلی
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> عنوان </td>
                        <td> لینک </td>
                        <td> تصویر </td>
                        <td> وضعیت </td>
                        <td> تنظیمات </td>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $product->title }} </td>
                                <td> <a href="{{ $product->url }}" target="_blank" class="btn btn-info fw-bold"> بزن روی
                                        لینک </a>
                                </td>
                                <td>
                                    <a href="{{ $product->image }}" target="_blank" class="btn btn-primary fw-bold">
                                        عکس ببین
                                    </a>
                                </td>
                                <td>
                                    @if ($product->status == 1)
                                        <div class="btn btn-success"> فعال </div>
                                    @elseif ($product->status == 0)
                                        <div class="btn btn-danger"> غیر فعال </div>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group dir-ltr p-1">
                                            <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                                class="btn btn-warning text-light px-2">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger px-2"> <i
                                                    class="bi bi-trash3-fill"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        @foreach ($products as $product)
            <div class="col-4 my-2">
                <div class="card">
                    <div class="card-body dir-rtl">
                        <img class="w-100 border shadow rounded-4" src="{{ asset($product->image) }}">
                        <br><br>
                        <h3 class="dir-rtl"> {{ $product->title }} </h3>
                        <small class="text-muted"> {{ $product->category()->first()->title }} </small>
                        <hr>
                        <h6> توضیحات : </h6>
                        <p> {{ $product->description }} </p>
                        <hr>
                        <span> قیمت : </span>
                        @if ($product->colors()->count() == 0)
                            <span> توافقی </span>
                        @elseif($product->colors()->count() == 1)
                            <span> {{ $product->colors()->first()->pivot->price }} </span>
                        @elseif($product->colors()->count() > 1)
                            <span> از </span>
                            <span> {{ $product->colors()->orderBy('price', 'asc')->first()->pivot->price }} </span>
                            <span> تا </span>
                            <span> {{ $product->colors()->orderBy('price', 'desc')->first()->pivot->price }} </span>
                        @endif
                    </div>
                    <div class="card-footer">
                    {{ $product->final_date_off }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

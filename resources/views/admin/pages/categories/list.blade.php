@extends('admin.master')
@section('title', 'دسته بندی ها')
@section('style')
    <style>
        .point_red {
            border-bottom: #ff0000 3px solid;
            animation-name: example;
            animation-duration: 0.5s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        @keyframes example {
            0% {
                border-bottom: #ff0000 3px solid;
            }

            75% {
                border-bottom: #8B0000 3px solid;
            }

            100% {
                border-bottom: #ff0000 3px solid;

            }
        }
    </style>
@endsection
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            دسته بندی ها
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4">
                    <a href="{{ route('categories.create') }}" class="text-light text-decoration-none fw-bold"> افزودن </a>
                </div>
                <div class="btn btn-warning px-4 me-2">
                    <a href="{{ route('properties.index') }}" class="text-light text-decoration-none fw-bold"> ویژگی ها </a>
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
                        @foreach ($categories as $key => $category)
                            <tr class="text-center">
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    <span
                                        @if (count($category->properties()->get()) == 0) class="point_red pb-1 px-2" title="ویژگی ندارد" @endif>
                                        {{ $category->title }}
                                    </span>
                                </td>
                                <td> <a href="{{ $category->url }}" target="_blank" class="btn btn-info fw-bold"> بزن روی
                                        لینک </a>
                                </td>
                                <td>
                                    <a href="{{ $category->image }}" target="_blank" class="btn btn-primary fw-bold">
                                        عکس ببین
                                    </a>
                                </td>
                                <td>
                                    @if ($category->status == 1)
                                        <div class="btn btn-success"> فعال </div>
                                    @elseif ($category->status == 0)
                                        <div class="btn btn-danger"> غیر فعال </div>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group dir-ltr p-1">
                                            <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
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
@endsection

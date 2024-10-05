@extends('admin.master')
@section('title', 'اسلایدر ها')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            اسلایدر ها
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4">
                    <a href="{{ route('sliders.create') }}" class="text-light text-decoration-none fw-bold"> افزودن </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> عنوان </td>
                        <td> توضیحات </td>
                        <td> لینک </td>
                        <td> تصویر </td>
                        <td> وضعیت </td>
                        <td> تنظیمات </td>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $key => $slider)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $slider->title }} </td>
                                <td> {{ $slider->caption }} </td>
                                <td> <a href="{{ $slider->url }}" target="_blank" class="btn btn-info fw-bold"> بزن روی
                                        لینک </a>
                                </td>
                                <td>
                                    <a href="{{ $slider->image }}" target="_blank" class="btn btn-primary fw-bold">
                                        عکس ببین
                                    </a>
                                </td>
                                <td>
                                    @if ($slider->status == 1)
                                        <div class="btn btn-success"> فعال </div>
                                    @elseif ($slider->status == 0)
                                        <div class="btn btn-danger"> غیر فعال </div>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('sliders.destroy', ['slider' => $slider->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group dir-ltr p-1">
                                            <a href="{{ route('sliders.edit', ['slider' => $slider->id]) }}"
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

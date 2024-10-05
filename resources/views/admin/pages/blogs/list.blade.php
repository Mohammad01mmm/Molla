@extends('admin.master')
@section('title', 'بلاگ ها')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            بلاگ ها
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4">
                    <a href="{{ route('blogs.create') }}" class="text-light text-decoration-none fw-bold"> افزودن </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> عنوان </td>
                        <td> تصویر </td>
                        <td> وضعیت </td>
                        <td> تنظیمات </td>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $key => $blog)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $blog->title }} </td>
                                <td>
                                    <a href="{{ $blog->image }}" target="_blank" class="btn btn-primary fw-bold">
                                        عکس ببین
                                    </a>
                                </td>
                                <td>
                                    @if ($blog->status == 1)
                                        <div class="btn btn-success"> فعال </div>
                                    @elseif ($blog->status == 0)
                                        <div class="btn btn-danger"> غیر فعال </div>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('blogs.destroy', ['blog' => $blog->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group dir-ltr p-1">
                                            <a href="{{ route('blogs.edit', ['blog' => $blog->id]) }}"
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

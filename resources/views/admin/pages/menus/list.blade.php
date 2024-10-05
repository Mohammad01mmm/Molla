@extends('admin.master')
@section('title', 'منو ها')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            منو ها
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4">
                    <a href="{{ route('menus.create') }}" class="text-light text-decoration-none fw-bold"> افزودن </a>
                </div>
            </div>
            @if ($menus->count() == 0 || $menus->where('status', 1)->count() == 0)
                <div class="alert alert-danger my-2">
                    <span class="fw-bold fs-6"> <i class="bi bi-exclamation-circle"></i> </span>
                    <span class="fw-bold">
                        هیچ منویی وجود ندارد و این موضوع رو ظاهر سایت شما تاثیر میگذارد
                    </span>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> عنوان </td>
                        <td> لینک </td>
                        <td> زیر مجموعه </td>
                        <td> وضعیت </td>
                        <td> تنظیمات </td>
                    </thead>
                    <tbody>
                        @foreach ($menus as $key => $menu)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $menu->title }} </td>
                                <td> <a href="{{ $menu->url }}" target="_blank" class="btn btn-info fw-bold"> بزن روی
                                        لینک </a>
                                </td>
                                <td>
                                    @php
                                        $chid = DB::table('menus')
                                            ->where('id', $menu->sub_menu)
                                            ->first();
                                    @endphp
                                    @if ($menu->sub_menu == 0)
                                        سرگروه
                                    @else
                                        زیر مجموعه {{ $chid->title }}
                                    @endif
                                </td>
                                <td>
                                    @if ($menu->status == 1)
                                        <div class="btn btn-success"> فعال </div>
                                    @elseif ($menu->status == 0)
                                        <div class="btn btn-danger"> غیر فعال </div>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('menus.destroy', ['menu' => $menu->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group dir-ltr p-1">
                                            <a href="{{ route('menus.edit', ['menu' => $menu->id]) }}"
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

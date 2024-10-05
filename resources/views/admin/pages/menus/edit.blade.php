@extends('admin.master')
@section('title', 'ویرایش منو ' . $menu->title)
@section('main')
    <div class="row flex-lg-row-reverse">
        <div class="col-lg-9 my-2">
            <div class="card dir-rtl shadow">
                <div class="card-header fw-bold">
                    ویرایش منو {{ $menu->title }}
                </div>
                <div class="card-body">
                    <form action="{{ route('menus.update', ['menu' => $menu->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        @if ($errors->all())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li class="m-1 mx-4">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group py-2">
                            <label for="title" class="pb-3"> عنوان </label>
                            <input id="title" name="title" type="text" class="form-control"
                                placeholder="عنوان . . ." value="{{ $menu->title }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="url" class="pb-3"> لینک </label>
                            <input id="url" name="url" type="text" class="form-control dir-ltr"
                                placeholder="لینک . . ." value="{{ $menu->url }}">
                        </div>
                        <div class="form-group py-2">
                            <label for="زیر مجموعه" class="pb-3"> زیر مجموعه </label>
                            <select name="sub_menu" class="form-control">
                                <option value="0"> سرگروه </option>
                                @foreach ($sub_menus_leader as $sub_menu_leader)
                                    <option value="{{ $sub_menu_leader->id }}"
                                        @if ($menu->sub_menu == $sub_menu_leader->id) selected @endif>
                                        {{ $sub_menu_leader->title }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group py-2">
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="active" value="1"
                                    {{ $menu->status == 1 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="active"> فعال </label>
                            </div>
                            <div class="form-check form-check-inline m-2">
                                <input class="form-check-input" type="radio" name="status" id="passive" value="0"
                                    {{ $menu->status == 0 ? 'checked' : '' }}>
                                <label class="form-check-label mx-1" for="passive"> غیر فعال </label>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-warning text-light fw-bold my-3 w-100 " value="ویرایش">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-3 my-2">
            <div class="card dir-rtl mb-3 shadow">
                <div class="card-header text-center fw-bold">
                    @if ($menu->sub_menu == 0)
                        زیر مجموعه های منو {{ $menu->title }}
                    @else
                        سر گروه منو {{ $menu->title }}
                    @endif
                </div>
                <div class="card-body">
                    <ul>
                        @if ($sub_menus->count() > 0)
                            @foreach ($sub_menus as $sub_menu)
                                <li
                                    @if ($sub_menu->status == 1) class="bg-success p-2 text-light fw-bold my-2 rounded " @else class="bg-danger p-2 text-light fw-bold my-2 rounded" @endif>
                                    {{ $sub_menu->title }}
                                </li>
                            @endforeach
                        @elseif($menu->sub_menu == 0 && $sub_menus->count() == 0)
                            <div class="bg-warning p-2 w-100 rounded border border-warning border-3 text-center">
                                <span class="text-light fw-bold">
                                    <i class="bi bi-emoji-frown-fill"></i>
                                    هیچ زیر مجموعه ای ندارد
                                </span>
                            </div>
                        @elseif($menu->sub_menu != 0)
                            سرگروه منو {{ $menu->title . ' ' . $leaders_for_sub_menu->title }}
                        @endif

                    </ul>
                </div>
            </div>
            <div class="card dir-rtl mb-5 shadow">
                <div class="card-body">
                    <div class="form-group py-2">
                        <label for="created_at" class="pb-3"> تاریخ ساخت </label>
                        <input type="text" disabled class="form-control dir-ltr" value="{{ $menu->created_at }}">
                    </div>
                    <div class="form-group py-2">
                        <label for="updated_at" class="pb-3"> تاریخ آخرین ویرایش </label>
                        <input type="text" disabled class="form-control dir-ltr" value="{{ $menu->updated_at }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

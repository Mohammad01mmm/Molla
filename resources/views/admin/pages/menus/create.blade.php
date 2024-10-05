@extends('admin.master')
@section('title', 'افزودن منو')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            افزودن منو
        </div>
        <div class="card-body">
            <form action="{{ route('menus.store') }}" method="post">
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
                <div class="form-group py-2">
                    <label for="url" class="pb-3"> لینک </label>
                    <input id="url" name="url" type="text" class="form-control dir-ltr">
                </div>
                <div class="form-group py-2">
                    <label for="زیر مجموعه" class="pb-3"> زیر مجموعه </label>
                    <select name="sub_menu" class="form-control">
                        <option value="0" selected> سرگروه </option>
                        @foreach ($sub_menus as $sub_menu)
                            <option value="{{ $sub_menu->id }}"> {{ $sub_menu->title }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group py-2">
                    <div class="form-check form-check-inline m-2">
                        <input class="form-check-input" type="radio" name="status" id="active" value="1" checked>
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

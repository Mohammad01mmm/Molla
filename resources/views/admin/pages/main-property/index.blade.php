@extends('admin.master')
@section('title', 'ویژگی های اصلی')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            ویژگی های اصلی
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4 mx-2">
                    <a href="{{ route('colors.index') }}" class="text-light text-decoration-none fw-bold"> رنگ </a>
                </div>
            </div>
        </div>
    </div>
@endsection

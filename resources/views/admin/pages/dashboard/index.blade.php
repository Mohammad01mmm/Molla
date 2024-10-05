@extends('admin.master')
@section('title', 'داشبورد')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            <span> داشبورد </span>
            @foreach ($admin->roles()->whereStatus('1')->get() as $role)
                <small class="badge bg-warning rounded-pill py-2 px-3 mb-1 border border-dark"> {{ $role->title }} </small>
            @endforeach
        </div>
        <div class="card-body">
            به پنل ادمین خوش آمدید {{ $admin->name }} عزیز !
        </div>
    </div>
@endsection

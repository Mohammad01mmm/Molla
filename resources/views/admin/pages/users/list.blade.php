@extends('admin.master')
@section('title', 'کاربران')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            کاربران
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4 mx-2">
                    <a href="{{ route('managers.create') }}" class="text-light text-decoration-none fw-bold"> افزودن مدیر </a>
                </div>
                <div class="btn btn-primary px-4 mx-2">
                    <a href="{{ route('roles.index') }}" class="text-light text-decoration-none fw-bold"> نقش ها </a>
                </div>
                <div class="btn btn-warning px-4 mx-2">
                    <a href="{{ route('permissions.index') }}" class="text-light text-decoration-none fw-bold"> دسترسی ها </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> نام </td>
                        <td> تصویر </td>
                        <td> وضعیت </td>
                        <td> تنظیمات </td>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $user->name }} </td>
                                <td>
                                    <a href="{{ $user->image }}" target="_blank" class="btn btn-primary fw-bold">
                                        عکس ببین
                                    </a>
                                </td>
                                <td>
                                    @if ($user->status == 1)
                                        <div class="btn btn-success"> فعال </div>
                                    @elseif ($user->status == 0)
                                        <div class="btn btn-danger"> غیر فعال </div>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group dir-ltr p-1">
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"
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

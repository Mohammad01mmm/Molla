@extends('admin.master')
@section('title', 'نقش ها')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            نقش ها
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4 mx-2">
                    <a href="{{ route('roles.create') }}" class="text-light text-decoration-none fw-bold"> افزودن </a>
                </div>
                <div class="btn btn-warning px-4 mx-2">
                    <a href="{{ route('permissions.index') }}" class="text-light text-decoration-none fw-bold"> دسترسی ها
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> عنوان </td>
                        <td> توضیحات </td>
                        <td> وضعیت </td>
                        <td> تنظیمات </td>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $role->title }} </td>
                                <td>
                                    <textarea class="shadow form-control disabled" readonly>{{ $role->description }}</textarea>
                                </td>
                                <td>
                                    @if ($role->status == 1)
                                        <div class="btn btn-success"> فعال </div>
                                    @elseif ($role->status == 0)
                                        <div class="btn btn-danger"> غیر فعال </div>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('roles.destroy', ['role' => $role->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group dir-ltr p-1">
                                            <a href="{{ route('roles.edit', ['role' => $role->id]) }}"
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

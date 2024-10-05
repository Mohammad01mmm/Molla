@extends('admin.master')
@section('title', 'دسترسی ها')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            دسترسی ها
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> عنوان </td>
                        <td> وضعیت </td>
                        <td> تنظیمات </td>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $permission->title }} </td>
                                <td>
                                    @if ($permission->status == 1)
                                        <div class="btn btn-success"> فعال </div>
                                    @elseif ($permission->status == 0)
                                        <div class="btn btn-danger"> غیر فعال </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group dir-ltr p-1">
                                        <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}"
                                            class="btn btn-warning text-light px-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

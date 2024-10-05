@extends('admin.master')
@section('title', 'ویژگی ها')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            ویژگی ها
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4">
                    <a href="{{ route('properties.create') }}" class="text-light text-decoration-none fw-bold"> افزودن </a>
                </div>
            </div>
            @if (Session::has('message'))
                <p class="alert alert-warning mt-1">{{ Session::get('message') }}</p>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> عنوان </td>
                        <td> تعداد دسته بندی ها </td>
                        <td> نام ویژگی </td>
                        <td> نوع ورودی ویژگی </td>
                        <td> مقادیر ورودی ویژگی </td>
                        <td> واحد داره </td>
                        <td> مقادیر واحد </td>
                        <td> وضعیت </td>
                        <td> تنظیمات </td>
                    </thead>
                    <tbody>
                        @foreach ($properties as $key => $property)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $property->title }}</td>
                                <td> {{ count($property->categories()->get()) }} </td>
                                <td> {{ $property->name_property }} </td>
                                <td> {{ $property->type_input['type_input'] }} </td>
                                <td>
                                    @if ($property->type_input['type_input'] != 'select')
                                        <div class="btn btn-danger"> <i class="bi bi-x-circle-fill"></i> </div>
                                    @else
                                        <textarea class="text-center shadow" readonly>
@foreach ($property->type_input as $key => $item)
@if (!$loop->first)
{{ $item }}
@endif
@endforeach
</textarea>
                                    @endif
                                <td>
                                    @if ($property->have_unit['have_unit'] == true)
                                        <div class="btn btn-success"> دارد </div>
                                    @elseif ($property->have_unit['have_unit'] == false)
                                        <div class="btn btn-danger"> ندارد </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($property->have_unit['have_unit'] == false)
                                        <div class="btn btn-danger"> <i class="bi bi-x-circle-fill"></i> </div>
                                    @else
                                        <textarea class="text-center shadow" readonly>
@foreach ($property->have_unit as $item)
@if (!$loop->first)
{{ $item }}
@endif
@endforeach
</textarea>
                                    @endif
                                <td>
                                    @if ($property->status == 1)
                                        <div class="btn btn-success"> فعال </div>
                                    @elseif ($property->status == 0)
                                        <div class="btn btn-danger"> غیر فعال </div>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('properties.destroy', ['property' => $property->id]) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group dir-ltr p-1">
                                            <a href="{{ route('properties.edit', ['property' => $property->id]) }}"
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

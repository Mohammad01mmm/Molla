@extends('admin.master')
@section('title', 'افزودن نقش')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            افزودن نقش
        </div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
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
                    <label for="description" class="pb-3"> توضیحات </label>
                    <textarea id="description" name="description" class="form-control" placeholder="توضیحات . . ."></textarea>
                </div>
                <div class="form-group py-2">
                    @foreach ($permissions as $key => $permission)
                        <input id="{{ $permission->id }}" name="permissions[{{ $permission->id }}]" type="checkbox"
                            class="form-check-input mx-1" value="{{ $permission->id }}">

                        <label for="{{ $permission->id }}" class="pb-3"> {{ $permission->title }}
                        </label>

                        <!-- Button trigger modal -->
                        <span data-bs-toggle="modal" data-bs-target="#exampleModal{{ $key }}">
                            <i class="bi bi-info-circle-fill text-primary" style="cursor: pointer"></i>
                        </span>

                        <!-- Modal -->
                        <div class="modal fade shadow" id="exampleModal{{ $key }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel{{ $key }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <h5 class="modal-title dir-ltr text-left"
                                            id="exampleModalLabel{{ $key }}">
                                            {{ $permission->title }} | {{ $permission->unique_name }}
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <h5> {{ $permission->title }} </h5>
                                        <hr>
                                        <p class="text-justify"> {{ $permission->description }} </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                            بستن
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
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

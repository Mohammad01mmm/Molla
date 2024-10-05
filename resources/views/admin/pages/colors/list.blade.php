@extends('admin.master')
@section('title', 'رنگ')
@section('main')
    <div class="card dir-rtl shadow">
        <div class="card-header fw-bold">
            رنگ
        </div>
        <div class="card-body">
            <div class="d-flex">
                <div class="btn btn-success px-4 mx-2">
                    <a href="{{ route('colors.create') }}" class="text-light text-decoration-none fw-bold"> افزودن </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <td> # </td>
                        <td> عنوان </td>
                        <td> کد رنگی </td>
                        <td> رنگ </td>
                        <td> تنظیمات </td>
                    </thead>
                    <tbody>
                        @foreach ($colors as $key => $color)
                            <tr class="text-center">
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $color->title }} </td>
                                <td class="dir-ltr">
                                    <button class="btn btn-sm btn-light btnCopy" data-value="{{ $color->hex }}">
                                        <i class="bi bi-copy"></i>
                                    </button>
                                    <span> {{ $color->hex }} </span>
                                </td>
                                <td>
                                    <div class="m-auto rounded-pill border border-dark shadow"
                                        style="width: 30px; height: 30px;background: {{ $color->hex }}"> </div>
                                </td>
                                <td>
                                    <form action="{{ route('colors.destroy', ['color' => $color->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group dir-ltr p-1">
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
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast align-items-center border-0 bg-success text-light dir-rtl" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex align-items-center justify-content-between">
                <div class="toast-body fw-bold">
                    <span> کپی شد </span>
                    <span id="textHexPrint" style="border-bottom: #fff 1px solid"> </span>
                </div>
                <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const buttons = document.querySelectorAll('.btnCopy');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                const value = button.dataset.value;
                navigator.clipboard.writeText(value);
                const toastLiveExample = document.getElementById('liveToast');
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);

                toastBootstrap.show();
                document.getElementById('textHexPrint').innerHTML = value.replace("#",
                    "");
            });
        });
    </script>
@endsection

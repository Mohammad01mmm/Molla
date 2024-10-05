<header class="container-fluid bg-primary pt-4 fixed-top dir-rtl shadow">
    <div class="row px-4">
        <div class="col-6 text-right"> <a href="{{ route('admin.dashboard') }}"
                class="text-light fw-bold text-decoration-none"> پنل ادمین </a> </div>
        <div class="col-6 text-left dir-ltr">
            <div class="d-flex align-items-center">
                <a href="{{ route('logout-admin') }}" class="text-light text-decoration-none px-3 py-1 " title="خروج">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </a>
                <a href="/" class="text-light text-decoration-none px-3 py-1 " title="سایت">
                    <i class="bi bi-house-door-fill"></i>
                </a>
                <div class="position-relative d-inline-block">
                    <span class="text-light px-3 py-1 " style="cursor: pointer" title="پروفایل"
                        id="btnMenuClickUserIcon">
                        <i class="bi bi-person-circle"></i>
                    </span>
                    <div class="position-absolute mt-1" style="transform: translate(-33% , 0%);width: 150px">
                        <div class="card w-100 shadow border-0 d-none" id="boxMenuClickUserIcon">
                            <div style="height: 80px;" class="position-relative">
                                <img src="{{ asset($admin->image) }}"
                                    class="card-img-top w-100 h-100" style="object-fit: cover;">
                                <div class="bg-dark position-absolute top-0 start-0 w-100 h-100 card-img-top"
                                    style="opacity: 20%"> </div>
                            </div>

                            <div class="mt-2" style="text-align: center !important">
                                <span class="px-2">{{ $admin->name }}</span>
                                <hr>
                            </div>
                            <div class="card-body pt-0">
                                <a class="btn btn-primary w-100 fw-bold text-light" href=""> پروفایل </a>
                            </div>

                            <div class="card-footer">
                                <a class="btn btn-danger w-100 fw-bold text-light" href="{{ route('logout-admin') }}">
                                    خروج </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout.bottom-header')
</header>

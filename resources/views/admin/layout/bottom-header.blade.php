<div class="border-top-2 border-black w-100">
    <div class="dir-rtl d-flex" id="bottom-sidebar">
        @php
            $adminLinks = [
                'ShowdashboardPermission' => [
                    'route' => 'admin.dashboard',
                    'label' => 'داشبورد',
                ],
                'ShowmenuPermission' => [
                    'route' => 'menus.index',
                    'label' => 'منو',
                ],
                'ShowsliderPermission' => [
                    'route' => 'sliders.index',
                    'label' => 'اسلایدر',
                ],
                'ShowcategoryPermission' => [
                    'route' => 'categories.index',
                    'label' => 'دسته بندی',
                ],
                'ShowproductPermission' => [
                    'route' => 'products.index',
                    'label' => 'محصولات',
                ],
                'ShowfactorPermission' => [
                    'route' => 'checkouts.index',
                    'label' => 'فاکتور ها',
                ],
                'ShowblogPermission' => [
                    'route' => 'blogs.index',
                    'label' => 'بلاگ',
                ],
                'ShowuserPermission' => [
                    'route' => 'users.index',
                    'label' => 'کاربران',
                ],
            ];
        @endphp

        @foreach ($adminLinks as $permission => $link)
            @if ($currentAdmin->hasPermission($permission))
                <div class="btn btn-warning m-3 shadow">
                    <a class="text-dark text-decoration-none fw-bold" href="{{ route($link['route']) }}">
                        {{ $link['label'] }}
                    </a>
                </div>
            @endif
        @endforeach
        {{-- <div class="btn btn-warning m-3 shadow">
            <a class="text-dark text-decoration-none fw-bold" href="{{ route('blogs.index') }}"> نظرات </a>
        </div> --}}
        {{-- <div class="btn btn-warning m-3 shadow">
            <a class="text-dark text-decoration-none fw-bold" href="{{ route('blogs.index') }}"> تنظیمات عمومی سایت </a>
        </div> --}}
    </div>
</div>

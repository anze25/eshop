<div class="center">
    <div class="center-item">
        <div class="center-heading">@lang('Main Home')</div>
        <ul class="menu-list">
            <li class="menu-item">
                <a
                    href="{{ route('admin.index') }}"
                    class=""
                >
                    <div class="icon"><i class="icon-grid"></i></div>
                    <div class="text">@lang('Dashboard')</div>
                </a>
            </li>
        </ul>
    </div>
    <div class="center-item">
        <ul class="menu-list">
            <x-nav-item
                icon="icon-shopping-cart"
                text="Products"
                :subMenu="[
                    ['text' => 'Add New', 'route' => route('admin.product.add')],
                    ['text' => 'All Products', 'route' => route('admin.products')],
                ]"
            />
            <x-nav-item
                icon="icon-file-text"
                text="Brands"
                :subMenu="[
                    ['text' => 'Add New', 'route' => route('admin.brand.add')],
                    ['text' => 'All Brands', 'route' => route('admin.brands')],
                ]"
            />

            <x-nav-item
                icon="icon-layers"
                text="Categories"
                :subMenu="[
                    ['text' => 'Add New', 'route' => route('admin.category.add')],
                    ['text' => 'All Categories', 'route' => route('admin.categories')],
                ]"
            />

            <x-nav-item
                icon="icon-file-plus"
                text="Orders"
                :subMenu="[
                    ['text' => 'All Orders', 'route' => route('admin.orders')],
                    ['text' => 'Order Tracking', 'route' => route('admin.orders')],
                ]"
            />


            <x-nav-item
                icon="icon-image"
                text="Slides"
                :route="route('admin.slides')"
            />

            <x-nav-item
                icon="icon-grid"
                text="Coupons"
                :route="route('admin.coupons')"
            />

            <x-nav-item
                icon="icon-mail"
                text="Messages"
                :route="route('admin.contacts')"
            />

            <x-nav-item
                icon="icon-users"
                text="Users"
                :route="route('admin.users')"
            />

            <x-nav-item
                icon="icon-settings"
                text="Settings"
                :route="route('admin.settings')"
            />




            <li class="menu-item">
                <form
                    id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                >
                    @csrf
                    <a
                        href="{{ route('logout') }}"
                        class=""
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    >
                        <div class="icon"><i class="icon-log-out"></i></div>
                        <div class="text">@lang('Log Out')</div>
                    </a>
                </form>
            </li>
        </ul>
    </div>
</div>

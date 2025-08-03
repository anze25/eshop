<ul class="account-nav">
    <li><a
            href="{{ route('user.index') }}"
            class="menu-link menu-link_us-s"
        >@lang('Dashboard')</a></li>
    <li><a
            href="{{ route('user.orders') }}"
            class="menu-link menu-link_us-s"
        >@lang('Orders')</a></li>
    <li><a
            href="{{ route('user.addresses') }}"
            class="menu-link menu-link_us-s"
        >@lang('Addresses')</a></li>
    <li><a
            href="{{ route('user.account.details') }}"
            class="menu-link menu-link_us-s"
        >@lang('Account Details')</a></li>
    @if (Cart::instance('wishlist')->content()->count() > 0)
        <li><a
                href="{{ route('user.wishlist') }}"
                class="menu-link menu-link_us-s"
            >@lang('Wishlist')</a></li>
    @endif
    <form
        id="logout-form"
        action="{{ route('logout') }}"
        method="POST"
    >
        @csrf
        <li><a
                href="{{ route('logout') }}"
                class="menu-link menu-link_us-s"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
            >@lang('Log Out')</a></li>
    </form>
</ul>

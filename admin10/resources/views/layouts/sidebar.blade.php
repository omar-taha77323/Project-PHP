<a href="{{ url('/dashboard') }}" class="text-white text-decoration-none fw-bold fs-5 d-block mb-3">
    🛒 ElectroStore
</a>

<hr class="text-secondary">

<ul class="nav nav-pills flex-column gap-1">

    {{-- Dashboard --}}
    <li class="nav-item">
        <a href="{{ url('/dashboard') }}"
            class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 ms-2"></i>
            لوحة التحكم
        </a>
    </li>

    {{-- Products --}}
    <li class="nav-item">
        <a href="{{ url('/products') }}"
            class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam ms-2"></i>
            المنتجات
        </a>
    </li>

    {{-- Categories --}}
    <li class="nav-item">
        <a href="{{ url('/categories') }}"
            class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
            <i class="bi bi-tags ms-2"></i>
            الأقسام
        </a>
    </li>

    {{-- Orders --}}
    <li class="nav-item">
        <a href="{{ url('/orders') }}"
            class="nav-link {{ request()->is('orders*') ? 'active' : '' }}">
            <i class="bi bi-receipt ms-2"></i>
            الطلبات
        </a>
    </li>

    {{-- Customers --}}
    <li class="nav-item">
        <a href="{{ url('/customers') }}"
            class="nav-link {{ request()->is('customers*') ? 'active' : '' }}">
            <i class="bi bi-people ms-2"></i>
            العملاء
        </a>
    </li>

    {{-- Super Admin Only --}}
    @auth
    @if((int) auth()->user()->role_id === 1)
    <hr class="text-secondary">

    <li class="nav-item">
        <a href="{{ url('/super-admins') }}"
            class="nav-link {{ request()->is('super-admins*') ? 'active' : '' }}">
            <i class="bi bi-shield-lock ms-2"></i>
            إدارة الأدمنز
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/sub-admins') }}"
            class="nav-link {{ request()->is('sub-admins*') ? 'active' : '' }}">
            <i class="bi bi-person-badge ms-2"></i>
            إدارة السَب أدمنز
        </a>
    </li>
    @endif
    @endauth

</ul>

<hr class="text-secondary">

@auth
<div class="dropdown">
    <a class="text-white dropdown-toggle text-decoration-none"
        href="#"
        data-bs-toggle="dropdown">
        {{ auth()->user()->name }}
    </a>

    <ul class="dropdown-menu dropdown-menu-dark">
        <li>
            <a class="dropdown-item" href="#">
                Profile
            </a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a class="dropdown-item text-danger"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </li>
    </ul>

    <form id="logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
    </form>
</div>
@endauth
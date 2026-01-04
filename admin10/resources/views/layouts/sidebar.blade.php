<a href="{{ url('/home') }}" class="text-white text-decoration-none fw-bold fs-5 d-block mb-3">
    🛒 ElectroStore
</a>

<hr class="text-secondary">

<ul class="nav nav-pills flex-column gap-1">

    <li class="nav-item">
        <a href="{{ url('/home') }}"
           class="nav-link {{ request()->is('home') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 ms-2"></i>
            لوحة التحكم
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/dsadmin/products') }}"
           class="nav-link {{ request()->is('dsadmin/products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam ms-2"></i>
            المنتجات
            <span class="badge bg-light text-dark ms-2">3</span>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/dsadmin/categories') }}" class="nav-link">
            <i class="bi bi-tags ms-2"></i>
            الأقسام
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/dsadmin/orders') }}" class="nav-link">
            <i class="bi bi-receipt ms-2"></i>
            الطلبات
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/dsadmin/customers') }}" class="nav-link">
            <i class="bi bi-people ms-2"></i>
            العملاء
        </a>
    </li>

</ul>

<hr class="text-secondary">

@auth
<div class="dropdown">
    <a class="text-white dropdown-toggle text-decoration-none" href="#" data-bs-toggle="dropdown">
        {{ Auth::user()->name }}
    </a>
    <ul class="dropdown-menu dropdown-menu-dark">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
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

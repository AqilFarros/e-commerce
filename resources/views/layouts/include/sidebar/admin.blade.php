<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.user.*' || 'admin.product.*') ? '' : 'collapsed' }}"
                data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav"
                class="nav-content collapse {{ request()->routeIs('admin.user.*' || 'admin.product.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.user.index') }}"
                        class="{{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>User</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.category.*' || 'admin.product.*') ? '' : 'collapsed' }}"
                data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav"
                class="nav-content collapse {{ request()->routeIs('admin.category.*' || 'admin.product.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.category.index') }}"
                        class="{{ request()->routeIs('admin.category.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.product.index') }}" class="{{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Product</span>
                    </a>
                </li>
            </ul>
        </li>

    </ul>

</aside>

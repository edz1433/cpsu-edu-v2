<!-- Sidebar Menu -->
<nav style="margin-right: -30px; !important">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin-dashboard') }}" class="nav-link text-success1 {{ request()->is('syntax-error/dashboard*') ? 'active' : '' }}">
                <i class="pt-1 nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin-user') }}" class="nav-link text-success1 {{ request()->is('syntax-error/user*') ? 'active' : '' }}">
                <i class="pt-1 nav-icon fas fa-users"></i>
                <p>User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin-file') }}" class="nav-link text-success1 {{ request()->is('syntax-error/file*') ? 'active' : '' }}">
                <i class="pt-1 nav-icon fas fa-file-upload"></i>
                <p>Upload File</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin-articles') }}" class="nav-link text-success1 {{ request()->is('syntax-error/articles*') ? 'active' : '' }}">
                <i class="pt-1 nav-icon fas fa-newspaper"></i>
                <p>Articles</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin-subMenu') }}" class="nav-link text-success1 {{ request()->is('syntax-error/submenu*') ? 'active' : '' }}">
                <i class="pt-1 nav-icon fas fa-list"></i>
                <p>Sub Menu</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin-subLink') }}" class="nav-link text-success1 {{ request()->is('syntax-error/sublink*') ? 'active' : '' }}">
                <i class="pt-1 nav-icon fas fa-link"></i>
                <p>Sub Link</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar -->
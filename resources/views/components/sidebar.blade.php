<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">POS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"
                    ><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            {{-- <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"
                    ><i class="fas fa-fire"></i><span>Users</span></a>
            </li> --}}
            <li class="nav-item dropdown {{ request()->routeIs('vehicles.*') ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Vehicles</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ request()->routeIs('vehicles.*') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('vehicles.index') }}">Vehicle List</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class=''>
                        <a class="nav-link"
                            href="">Vehicle Service</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>

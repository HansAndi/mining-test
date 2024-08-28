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
                <a href="{{ route('dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            @if(request()->user()->role_id == \App\Enums\Role::Admin->value)

            <li
                class="nav-item dropdown {{ request()->routeIs('vehicles.*') || request()->routeIs('vehicle-service.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Vehicles</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ request()->routeIs('vehicles.*') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('vehicles.index') }}">Vehicle List</a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class='{{ request()->routeIs('vehicle-service.*') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('vehicle-service.index') }}">Vehicle Service</a>
                    </li>
                </ul>
            </li>
            <li
                class="nav-item dropdown {{ request()->routeIs('locations.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Location</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ request()->routeIs('locations.*') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('locations.index') }}">Location</a>
                    </li>
                </ul>
            </li>

            @endif
            <li
                class="nav-item dropdown {{ request()->routeIs('reservations.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Reservation</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ request()->routeIs('reservations.*') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('reservations.index') }}">Reservation</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>

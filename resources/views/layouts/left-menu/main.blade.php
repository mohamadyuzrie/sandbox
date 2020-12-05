@if (Auth::check())
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    @include('layouts.left-menu.menu-1')
</ul>

@else
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <ul class="nav nav-treeview" style="display: block;">
        <li class="nav-item">
            <a href="{{ route('logout') }}" data-method="post" class="nav-link">
                <i class="fas fa-power-off nav-icon"></i>
                <p>LOGIN</p>
            </a>
        </li>
    </ul>
</ul>
@endif
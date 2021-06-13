<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
        @foreach ($menus as $menu)
        @php
            $oke = [];
        @endphp
        @foreach ($menu->children as $item)
            @php $oke[] = $item->url; @endphp
        @endforeach
        <li class="nav-item has-treeview {{ set_active_open($oke) }}">
            <a href="{{ Route::has($menu->url) ? route($menu->url) : $menu->url }}" class="nav-link {{ set_active($oke) }}">
            <i class="nav-icon {{ $menu->icon_class }}"></i>
            <p>
                {{ $menu->title }}
                @if ($menu->children->first() != null)
                    <i class="right fas fa-angle-left"></i>
                @endif
            </p>
            </a>
            @if ($menu->children->first() != null)
            <ul class="nav nav-treeview">
            @foreach ($menu->children as $item)
                <li class="nav-item ">
                    <a href="{{ Route::has($item->url) ? route($item->url) : $item->url }}" class="nav-link {{ set_active($item->url) }}">
                    <i class="{{ $item->icon_class }} nav-icon"></i>
                    <p>{{ $item->title }}</p>
                    </a>
                </li>
            @endforeach
            </ul>
            @endif
        </li>
        @endforeach
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
    {{-- <x-admin.sidebar.profile /> --}}

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @if (isset($side_menu))
                 {{ $side_menu }}
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

@inject('request', 'Illuminate\Http\Request')
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">

    <ul class="nav navbar-nav">

        <li>
            <a href="{{ route('home') }}" style="{{ ( $request->segment(1) == null ) ? 'background-color: transparent; color: rgb(255, 109, 16);' : '' }}">
                {{ trans('app.dashboard') }}&nbsp;
            </a>
        </li>

        {{-- INVOICES MENU --}}
        @can('invoices-menu')
        <li>
            <a href="{{ url('invoices') }}" style="{{ ($request->is('invoices*')) ? 'background-color: transparent; color: rgb(255, 109, 16);' : '' }}">
                {{ trans('inv.title') }}&nbsp;
            </a>
        </li>
        @endcan

        {{-- USERS MENU --}}
        @can('users-menu')
        <li>
            <a href="{{ url('users') }}"
               style="{{ ($request->is('users*')) ? 'background-color: transparent; color: rgb(255, 109, 16);' : '' }}">
                {{ trans('users.title') }}&nbsp;
            </a>
        </li>
        @endcan

        @can('settings-menu')
        <li>
            <a href="{{ url('settings') }}"
               style="{{ ($request->is('settings*')) ? 'background-color: transparent; color: rgb(255, 109, 16);' : '' }}">
                {{ trans('settings.title') }}
            </a>
        </li>
        @endcan

{{--
        <li>
            <a href="#">{{ trans('users.title') }}</a>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Dropdown <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
            </ul>
        </li>
        --}}
    </ul>

    <!-- Navbar Search -->
    {{--@includeIf('yusen_design.navbar.navbar-search')--}}
    <!-- End Navbar Search -->

</div>

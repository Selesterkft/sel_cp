<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{{trans('app.sort_title')}}</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{trans('app.title')}}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                {{--@includeIf('adminlte.headers.dropdown_messages_menu')--}}
                <!-- Notifications: style can be found in dropdown.less -->
                {{--@includeIf('adminlte.headers.dropdown_notifications_menu')--}}
                <!-- Tasks: style can be found in dropdown.less -->
                {{--@includeIf('adminlte.headers.dropdown_tasks_menu')--}}
                <!-- User Account: style can be found in dropdown.less -->
                @includeIf('adminlte.headers.dropdown_user_menu')
                <!-- Control Sidebar Toggle Button -->
                {{--<li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>--}}
            </ul>
        </div>
    </nav>
</header>

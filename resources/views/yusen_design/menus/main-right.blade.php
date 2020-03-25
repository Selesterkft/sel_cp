<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        {{--@includeIf('yusen_design.navbar.dropdown-messages-menu')--}}
        <!-- /.messages-menu -->

        <!-- Notifications Menu -->
        {{--@includeIf('yusen_design.navbar.dropdown-notifications-menu')--}}
        <!-- Tasks Menu -->
        {{--@includeIf('yusen_design.navbar.dropdown-tasks-menu')--}}
        <!-- User Account Menu -->
        @includeIf('yusen_design.navbar.dropdown-user-menu')
    </ul>
</div>

<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">

            <!-- Navbar Header -->
            <div class="navbar-header">
                {{--<a href="{{ url('/') }}">
                    <img src="{{ asset('yusen_design/dist/img/logo.png') }}"
                         alt="logo" height="100" width="100">
                </a>--}}
                {{--<a href="../../index2.html" class="navbar-brand"><b>Admin</b>LTE</a>--}}
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- End Navbar Header -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            @includeIf('yusen_design.menus.main-left')
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            @includeIf('yusen_design.menus.main-right')
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>

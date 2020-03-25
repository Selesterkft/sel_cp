<div class="main-header">
    <div class="navbar navbar-static-top" style="background-color: white;">
        <div class="container" style="padding-top: 5px;padding-bottom: 5px;">

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="pull-left">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('yusen_design/dist/img/logo.png') }}"
                         alt="logo" height="50"
                         style="background-color: white;padding-left: 15px;">
                </a>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            @includeIf('yusen_design.navbar.top-dropdown-language-menu')

            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>

@inject('request', 'Illuminate\Http\Request')
<aside class="main-sidebar">
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ \App\Classes\Helper::getLogo() }}"
                     class="img-circle"
                     style="background-color:white;"
                     alt="User Image">
            </div>

            <div class="pull-left info" style="top: 20px;">
                <p>
                    @php
                    $user = Auth::user();

                    if( $user->Supervisor_ID == 0 )
                    {
                        //dd('as', Auth::user());
                        $companyName = $user->company->Nev1;
                        //$companyName = Auth::user()->company->Nev1;

                        if( strlen($companyName) < 20 )
                        {
                            echo $companyName;
                        }
                        else
                        {
                            echo substr( $companyName, 0, 20) . "...";
                        }

                    }
                    else
                    {
                        $supervisorName = $user->Supervisor_Name;
                        if( strlen($supervisorName) < 20 )
                        {
                            echo $supervisorName;
                        }
                        else
                        {
                            echo substr( $supervisorName, 0, 20) . "...";
                        }
                    }
                    @endphp
                </p>
            </div>

            <!--
            <div class="pull-left info">
                <p>{{-- Auth::user()->Name --}}</p>
                <a href="#">
                    {{--
                        <i class="fa fa-circle text-success"></i>&nbsp;
                        Auth::user()->company->Nev1
                    --}}

                    @php
                    $user = Auth::user();

                    if( $user->Supervisor_ID == 0 )
                    {
                        echo $user->company->Nev1;
                    }
                    else
                    {
                        if( strlen($user->Supervisor_Name) < 20 )
                        {
                            echo $user->Supervisor_Name;
                        }
                        else
                        {
                            echo substr( $user->Supervisor_Name, 0, 20);
                            echo substr($user->Supervisor_Name , 20, strlen($user->Supervisor_Name));
                        }

                    }

                    @endphp

                </a>
            </div>
            -->
        </div>

        <!-- search form -->
        @yield('search')
        <!-- /.search form -->

        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">
                {{ __('global.app_main_navigation') }}
            </li>

            <li class="{{ $request->segment(1) == null ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    <span>
                        {{ __('global.app_dashboard') }}
                    </span>
                </a>
            </li>

            @can('invoices-menu')
            <li class="{{ $request->segment(1) == 'invoices' || $request->segment(1) == 'invoices.show' ? 'active' : '' }}">
                <a href="{{ url('invoices') }}">
                    <i class="ion ion-ios-list-outline"></i>&nbsp;
                    <span>
                        {{ __('global.invoices.title') }}
                    </span>
                </a>
            </li>
            @endcan

            @can('stocks-menu')
             <!--<li class="{{ $request->segment(1) == 'stocks' ? 'active' : '' }}">
                <a href="{{ url('stocks') }}">
                    <i class="ion ion-clipboard"></i>&nbsp;
                    <span>
                        {{ __('global.stocks.title') }}
                    </span>
                </a>
            </li>-->
            @endcan

            @can('transports-menu')
            <!--<li class="{{ $request->segment(1) == 'transports' ? 'active' : '' }}">
                <a href="{{ url('transports') }}">
                    <i class="fa fa-shopping-cart"></i>&nbsp;
                    <span>
                        {{ __('global.transports.title') }}
                    </span>
                </a>
            </li>-->
            @endcan
            @can('users-menu')
            <li class="{{ ($request->segment(1) == 'users' ||
                        $request->segment(1) == 'users.show' ||
                        $request->segment(1) == 'users.create' ||
                        $request->segment(1) == 'users.edit') ? 'active' : '' }}">
                <a href="{{ url('users') }}">
                    <i class="ion ion-android-contacts"></i>&nbsp;
                    <span>
                        {{ __('global.users.title') }}
                    </span>
                </a>
            </li>
<!--
                <li class="{{-- ($request->segment(1) == 'users2' ||
                        $request->segment(1) == 'users.show' ||
                        $request->segment(1) == 'users.create' ||
                        $request->segment(1) == 'users.edit') ? 'active' : '' --}}">
                    <a href="{{-- url('users2') --}}">
                        <i class="ion ion-android-contacts"></i>&nbsp;
                        <span>
                        {{-- __('USERS2') --}}
                    </span>
                    </a>
                </li>
-->
            @endcan

            @if( Auth::user()->CompanyID == 71 )
            @can('roles-menu')
            <li class="{{ $request->segment(1) == 'roles' ? 'active' : '' }}">
                <a href="{{ url('roles') }}">
                    <i class="fa  fa-users"></i>&nbsp;
                    <span>
                        {{ __('global.roles.title') }}
                    </span>
                </a>
            </li>
            @endcan
            @endif

            @can('settings-menu')
            @if(Auth::user()->Supervisor_ID == 0)
            <li class="{{ $request->segment(1) == 'settings' ? 'active' : '' }}">
                <a href="{{ url('settings') }}">
                    <i class="fa fa-wrench"></i>
                    <span>
                        {{ __('global.settings.title') }}
                    </span>
                </a>
            </li>
            @endif
            @endcan

            @if(Auth::user()->hasRole('Admin') && Auth::user()->CompanyID == 71)
            <li class="{{ $request->segment(1) == 'companysubdomain' ||
                        $request->segment(1) == 'companysubdomain.show' ||
                        $request->segment(1) == 'companysubdomain.create' ||
                        $request->segment(1) == 'companysubdomain.edit' ? 'active' : '' }}">
                <a href="{{ url('companysubdomain') }}">
                    <i class="fa fa-paw"></i>&nbsp;
                    <span>{{ __('global.company_subdomain.menu_title') }}</span>
                </a>
            </li>
            @endif

            @if(Auth::user()->hasRole('Admin') && Auth::user()->CompanyID == 71)
            <li class="{{ $request->segment(1) == 'versions' ||
                        $request->segment(1) == 'versions.show' ||
                        $request->segment(1) == 'versions.create' ||
                        $request->segment(1) == 'versions.edit' ||
                        $request->segment(1) == 'version_company.show' ||
                        $request->segment(1) == 'version_company.create' ||
                        $request->segment(1) == 'version_company.edit' ? 'active' : '' }}">
                <a href="{{ url('versions') }}">
                    <i class="fa fa-clone"></i>&nbsp;
                    <span>
                        {{ __('global.versions.title') }}
                    </span>
                </a>
            </li>
            @endif

            @if(Auth::user()->hasRole('Admin') && Auth::user()->CompanyID == 71)
            <!--
            <li class="{{-- $request->segment(1) == 'sd_helper' ? 'active' : '' --}}">
                <a href="{{-- url('sd_helper') --}}">
                    <i class="fa fa-book"></i>&nbsp;
                    <span>
                        {{-- __('global.sd_helper.title') --}}
                    </span>
                </a>
            </li>
                -->
            @endif

        </ul>

    </section>

</aside>

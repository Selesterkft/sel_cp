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
                {{ trans('app.main_navigation') }}
            </li>

            <li class="{{ $request->segment(1) == null ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fa fa-dashboard"></i>&nbsp;
                    <span>
                        {{ trans('app.dashboard') }}
                    </span>
                </a>
            </li>

            @can('invoices-menu')
                {{--
                <li class="{{ $request->segment(1) == 'invoices' || $request->segment(1) == 'invoices.show' ? 'active' : '' }}">
                    <a href="{{ url('invoices') }}">
                        <i class="ion ion-ios-list-outline"></i>&nbsp;
                        <span>
                            {{ trans('inv.title') }}
                        </span>
                    </a>
                </li>
    --}}
                <li class="{{ ($request->is('invoices*')) ? 'active' : '' }}">
                    <a href="{{ url('invoices') }}">
                        <i class="ion ion-ios-list-outline"></i>&nbsp;
                        <span>
                    {{ trans('inv.title') }}
                </span>
                    </a>
                </li>

                {{--
                            <li class="{{ $request->segment(1) == 'inv_new*' ? 'active' : '' }}">
                                <a href="{{ url('inv_new') }}">
                                    <i class="ion ion-ios-list-outline"></i>&nbsp;
                                    <span>
                                    {{ 'inv_new' }}
                                </span>
                                </a>
                            </li>
                --}}
                {{--
                            <li class="{{ $request->segment(1) == 'szamlak*' ? 'active' : '' }}">
                                <a href="{{ url('szamlak') }}">
                                    <i class="ion ion-ios-list-outline"></i>&nbsp;
                                    <span>
                                        {{ 'Számlák' }}
                                    </span>
                                </a>
                            </li>
                --}}
            @endcan

            @can('stocks-menu')
            <!--<li class="{{ ($request->is('stocks*')) ? 'active' : '' }}">
                <a href="{{ url('stocks') }}">
                    <i class="ion ion-clipboard"></i>&nbsp;
                    <span>
                        {{ trans('stocks.title') }}
                </span>
            </a>
        </li>-->
            @endcan

            @can('transports-menu')
            <!--<li class="{{ ($request->is('transports*')) ? 'active' : '' }}">
                <a href="{{ url('transports') }}">
                    <i class="fa fa-shopping-cart"></i>&nbsp;
                    <span>
                        {{ trans('transports.title') }}
                </span>
            </a>
        </li>-->
            @endcan
            @can('users-menu')
                <li class="{{ ($request->is('users*')) ? 'active' : '' }}">
                    <a href="{{ url('users') }}">
                        <i class="ion ion-android-contacts"></i>&nbsp;
                        <span>
                        {{ trans('users.title') }}
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
                    <li class="{{ ($request->is('roles*')) ? 'active' : '' }}">
                        <a href="{{ url('roles') }}">
                            <i class="fa  fa-users"></i>&nbsp;
                            <span>
                        {{ trans('roles.title') }}
                    </span>
                        </a>
                    </li>
                @endcan

                <li class="{{ ($request->is('languages*')) ? 'active' : '' }}">
                    <a href="{{ url('languages') }}">
                        <i class="fa  fa-language"></i>&nbsp;
                        <span>
                            {{ trans('languages.title') }}
                        </span>
                    </a>
                </li>

                <li class="{{ ($request->is('translations*')) ? 'active' : '' }}">
                    <a href="{{ url('translations', app()->getLocale()) }}">
                        <i class="fa  fa-language"></i>&nbsp;
                        <span>
                            {{ trans('translations.title') }}
                        </span>
                    </a>
                </li>
            @endif

            @can('settings-menu')
                @if(Auth::user()->Supervisor_ID == 0)
                    <li class="{{ ($request->is('settings')) ? 'active' : '' }}">
                        <a href="{{ url('settings') }}">
                            <i class="fa fa-wrench"></i>
                            <span>
                        {{ trans('settings.title') }}
                    </span>
                        </a>
                    </li>

                    <li class="treeview {{ $request->is('company_settings*') || $request->is('page_settings*') ? 'active menu-open' : '' }}">
                        <a href="#">
                            <i class="fa fa-wrench"></i>&nbsp;
                            <span>{{ trans('settings.title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ ($request->is('company_settings*')) ? 'active' : '' }}">
                                <a href="{{ url('company_settings') }}">
                                    <i class="fa fa-circle-o"></i>&nbsp;{{ trans('COMPANY SETTINGS') }}
                                </a>
                            </li>
                            <li class="{{ ($request->is('page_settings*')) ? 'active' : '' }}">
                                <a href="{{ url('page_settings') }}"><i
                                        class="fa fa-circle-o"></i>&nbsp;{{ trans('PAGE SETTINGS') }}</a>
                            </li>
                            {{--
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-circle-o"></i> Level One
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            --}}
                        </ul>
                    </li>

                @endif
            @endcan

            @if(Auth::user()->hasRole('Admin') && Auth::user()->CompanyID == 71)
                <li class="{{ ($request->is('companysubdomain*')) ? 'active' : '' }}">
                    <a href="{{ url('companysubdomain') }}">
                        <i class="fa fa-paw"></i>&nbsp;
                        <span>{{ trans('company_subdomain.menu_title') }}</span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->hasRole('Admin') && Auth::user()->CompanyID == 71)
                <li class="{{ ($request->is('versions*') ||
                            $request->is('version_company*')) ? 'active' : '' }}">
                    <a href="{{ url('versions') }}">
                        <i class="fa fa-clone"></i>&nbsp;
                        <span>
                        {{ trans('versions.title') }}
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

@inject('request', 'Illuminate\Http\Request')
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">{{ trans('app.main_navigation') }}</li>

    <li class="{{ $request->segment(1) == null ? 'active' : '' }}">
        <a href="{{ route('home') }}">
            <i class="fa fa-dashboard"></i>
            <span>{{ trans('app.dashboard') }}</span>
        </a>
    </li>

    {{-- SZÁMLÁIM MENU --}}
    @can('invoices-menu')
    <li class="{{ ($request->is('invoices*')) ? 'active' : '' }}">
        <i class="ion ion-ios-list-outline"></i>
        <span>
            {{ trans('inv.title') }}
        </span>
    </li>
    @endcan

    {{-- KÉSZLETEK MENÜ --}}
    {{--@can('stocks-menu')
        <li class="{{ ($request->is('stocks*')) ? 'active' : '' }}">
            <a href="{{ url('stocks') }}">
                <i class="ion ion-clipboard"></i>&nbsp;
                <span>{{ trans('stocks.title') }}</span>
            </a>
        </li>
    @endcan--}}

    {{--@can('transports-menu')
        <li class="{{ ($request->is('transports*')) ? 'active' : '' }}">
            <a href="{{ url('transports') }}">
                <i class="fa fa-shopping-cart"></i>&nbsp;
                <span>
                    {{ trans('transports.title') }}
                </span>
            </a>
        </li>
    @endcan--}}

    {{-- USERS MENU --}}
    @can('users-menu')
        <li class="{{ ($request->is('users*')) ? 'active' : '' }}">
            <a href="{{ url('users') }}">
                <i class="ion ion-android-contacts"></i>&nbsp;
                <span>{{ trans('users.title') }}</span>
            </a>
        </li>
    @endcan

    @if( Auth::user()->CompanyID == 71 )
        {{-- ROLES MENU --}}
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

        {{-- LANGUAGES MENU --}}
        <li class="{{ ($request->is('languages*')) ? 'active' : '' }}">
            <a href="{{ url('languages') }}">
                <i class="fa  fa-language"></i>&nbsp;
                <span>{{ trans('languages.title') }}</span>
            </a>
        </li>

        {{-- TRANSLATIONS MENU --}}
        <li class="{{ ($request->is('translations*')) ? 'active' : '' }}">
            <a href="{{ url('translations', app()->getLocale()) }}">
                <i class="fa  fa-language"></i>&nbsp;
                <span>{{ trans('translations.title') }}</span>
            </a>
        </li>

    @endif

    {{-- SETTINGS MENU --}}
    @can('settings-menu')
        @if( Auth::user()->Supervisor_ID == 0 )
            <li class="{{ ($request->is('settings*')) ? 'active' : '' }}">
                <a href="{{ url('settings') }}">
                    <i class="fa fa-wrench"></i>
                    <span>{{ trans('settings.title') }}</span>
                </a>
            </li>
        @endif
    @endcan

    @if( Auth::user()->hasRole('Admin') && Auth::user()->Company_ID == 71 )
        {{-- COMPANY SUBDOMAIN MENU --}}
        <li class="{{ ($request->is('companysubdomain*')) ? 'active' : '' }}">
            <a href="{{ url('companysubdomain') }}">
                <i class="fa fa-paw"></i>&nbsp;
                <span>{{ trans('company_subdomain.menu_title') }}</span>
            </a>
        </li>
        {{-- VERSIONS MENU --}}
        <li class="{{ ($request->is('versions*') || $request->is('version_company*')) ? 'active' : '' }}">
            <a href="{{ url('versions') }}">
                <i class="fa fa-clone"></i>&nbsp;
                <span>{{ trans('versions.title') }}</span>
            </a>
        </li>
    @endif

</ul>
{{--<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed
                    Sidebar</a></li>
        </ul>
    </li>
    <li>
        <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a>
            </li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
        </ul>
    </li>
    <li>
        <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
        </a>
    </li>
    <li>
        <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
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
        </ul>
    </li>
    <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
    <li class="header">LABELS</li>
    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
</ul>--}}

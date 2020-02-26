<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle"
       data-toggle="dropdown">
        <img src="{{ \App\Classes\Helper::getProfile() }}"
             class="user-image"
             style="background-color:white;"
             alt="User Image">
        <!--<span class="hidden-xs">Alexander Pierce</span>-->
        <span class="hidden-xs">{{ Auth::user()->Name }}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="{{ \App\Classes\Helper::getProfile() }}"
                 class="img-circle"
                 style="background-color:white;"
                 alt="User Image">
            <p>
                {{ trans('app.hello') }}&nbsp;{{ Auth::user()->Name }}
                <small>{{ trans('app.member_since') }}:&nbsp;{{ \Carbon::parse(Auth::user()->created_at)->format((config('appConfig.dateFormats'))[config('app.locale')]['carbon']) }}</small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <a href="{{ url('profile', ['id' => Auth::user()->ID]) }}">
                        {{ trans('users.profile') }}
                    </a>
                </div>
                <!--
                <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                </div>
                -->
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            @guest
                <div class="pull-left">
                    <!--<a href="{{-- route('login') --}}" class="btn btn-default btn-flat">Belépés</a>-->
                    <li>
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ trans('users.login') }}
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('register') }}">
                            {{ trans('users.register') }}
                        </a>
                    </li>
                </div>
            @else
                <div class="pull-left">
                    <!--
                    <a href="#" class="btn btn-default btn-flat">
                        {{-- __('global.lock.title') --}}
                    </a>
                    -->
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-in"></i>&nbsp;{{ trans('users.logout') }}
                    </a>
                </div>
            @endguest
        </li>
    </ul>
</li>

<form id="logout-form" name="logout-form" action="{{ route('logout') }}"
      method="POST"
      style="display: none;">
    {{ csrf_field() }}
</form>

<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{ \App\Classes\Helper::getProfile() }}"
             class="user-image"
             alt="User Image">
        <span class="hidden-xs">{{ Auth::user()->Name }}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="{{ \App\Classes\Helper::getProfile() }}"
                 class="img-circle" alt="User Image">

            <p>
                {{ trans('app.hello') }}&nbsp;{{ Auth::user()->Name }}
                <small>{{ trans('app.member_since') }}:&nbsp;{{ \Carbon::parse(Auth::user()->created_at)->format((config('appConfig.dateFormats'))[config('app.locale')]['carbon']) }}</small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
                {{--<div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                </div>--}}
                {{--<div class="col-xs-4 text-center">
                    <a href="{{ url('profile', ['id' => Auth::user()->ID]) }}">
                        {{ trans('users.profile') }}
                    </a>
                </div>--}}
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            {{--<div class="pull-left">
                <a href="#" class="btn btn-warning btn-flat">Profile</a>
            </div>
            <div class="pull-right">
                <a href="#" class="btn btn-warning btn-flat">Sign out</a>
            </div>--}}
            <div class="pull-right">
                <a class="btn btn-warning btn-flat" href="#"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-in"></i>&nbsp;{{ trans('users.logout') }}
                </a>
            </div>
        </li>
    </ul>
</li>
<form id="logout-form" name="logout-form" action="{{ route('logout') }}"
      method="POST"
      style="display: none;">
    {{ csrf_field() }}
</form>

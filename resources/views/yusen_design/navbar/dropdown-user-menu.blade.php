@php
use App\Classes\Helper as Helper;
$profile = Helper::getProfile();
@endphp
<li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <!-- The user image in the navbar-->
        <img src="{{ $profile }}"
             class="user-image" id="usr_image" name="usr_image"
             alt="User Image" style="background-color: white;">
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">{{ Auth::user()->Name }}</span>
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
            <img src="{{ $profile }}"
                 class="img-circle"
                 alt="User Image">

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
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                </div>--}}
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            {{--<div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>--}}
            <div class="pull-right">
                <a href="#"
                   class="btn btn-warning btn-flat"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ trans('users.logout') }}
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
<script>
{{--
    var img = $('#usr_image');
    var color = '';

    $(document).ready(function()
    {
        var x = img.css('backgroundColor');
        hexc(x);
    });

    function hexc(colorval) {

        if( colorval == 'rgb(0, 0, 0)'  || colorval == 'rgba(0, 0, 0, 0)')
        {
            color = '#000000';
        }
        else
        {
            var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            delete(parts[0]);
            for (var i = 1; i <= 3; ++i) {
                parts[i] = parseInt(parts[i]).toString(16);
                if (parts[i].length == 1) parts[i] = '0' + parts[i];
            }
            color = '#' + parts.join('');
        }
    }
--}}
</script>

<li class="dropdown messages-menu">

    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php
        if( session()->has('locale') )
        {
            $locale = session()->get('locale');
        }
        else
        {
            $locale = config('app.locale');
        }
        ?>
        <i class="fa fa-language"></i>
            @switch($locale)
                @case('hu')
                HU
                @break
                @case('en')
                EN
                @break
                @default
                AA
                @break
            @endswitch
    </a>
    <ul class="dropdown-menu" id="xxx" name="xxx">
        <li class="header">Választható nyelvek </li>
        <li>
            <ul class="menu">
                <li>
                    <a href="{{ url('lang/hu') }}" data-local="hu">
                        <div class="pull-left">
                            <img src="{{ asset('assets/dist/img/flags/115-hungary.png') }}"
                                 class="img-circle"
                                 alt="flag image">
                        </div>
                        <h4 style="margin-top: 10px;">
                            Magyar
                        </h4>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <ul class="menu">
                <li>
                    <a href="{{ url('lang/en') }}" data-local="en">
                        <div class="pull-left">
                            <img src="{{ asset('assets/dist/img/flags/260-united-kingdom.png') }}"
                                 class="img-circle"
                                 alt="flag image">
                        </div>
                        <h4 style="margin-top: 10px;">
                            United Kingdom
                        </h4>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
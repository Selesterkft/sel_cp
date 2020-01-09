@foreach($items as $item)

    <li @lm_attrs($item) @if($item->hasChildren()) class="treeview" @endif @lm_endattrs>

        @if($item->link)
            <a @lm_attrs($item->link) @lm_endattrs href="{!! $item->url() !!}">

                @if($item->hasChildren())
                    <span>{!! $item->title !!}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                @else
                    <span>{!! $item->title !!}</span>
                @endif
            </a>
        @else
            <a href="#"></a>
        @endif

        @if($item->hasChildren())
            <ul class="treeview-menu">
                @include(config('laravel-menu.views.admin-lte-items'), array('items' => $item->children()))
            </ul>
        @endif

    </li>

    @if($item->divider)
        <li {!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
    @endif

@endforeach
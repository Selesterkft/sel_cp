<button id="clear_search" name="clear_search"
        type="button" title="{{ trans('app.delete_search') }}"
        class="btn btn-bitbucket"
        onclick="window.location.href='{{ $url }}';">
    <i class="fa fa-search-minus"></i>&nbsp;
    {{ trans('app.delete_search') }}
</button>

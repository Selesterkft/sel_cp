<div class="col-lg-3 col-xs-6 configBox">
    <!-- small box -->
    <div class="small-box bg-yellow configBox">
        <div class="inner configBox">
            <h3 class="configBox">{{ trans('settings.title') }}</h3>

            <p class="configBox" style="color: #f39c12;">__</p>
        </div>

        <div class="icon configBox">
            <i class="fa fa-cog configBox"></i>
        </div>
        <a href="{{ url('settings') }}" class="small-box-footer configBox">
            {{ trans('app.more_info') }}&nbsp;
            <i class="fa fa-arrow-circle-right configBox"></i>
        </a>
    </div>
</div>

<script>
    let $confBox = $('.configBox');

    $confBox.on('mouseleave', function()
    {
        //console.log('lelépett');
        $confBox.find('*').css('cursor', 'pointer');
    });

    $confBox.mouseover(function()
    {
        //console.log('felette');
        $confBox.find('*').css('cursor', 'hand');
    });

    $confBox.click(function()
    {
        window.location = '{{ url('settings') }}';
    });
</script>

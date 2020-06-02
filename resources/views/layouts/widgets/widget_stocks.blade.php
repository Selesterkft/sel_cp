<?php
$url = 'keszletek';
?>
<div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green stocksBox">
        <div class="inner stocksBox">
            <!--<h3>53<sup style="font-size: 20px">%</sup></h3>-->
            <h3 class="stocksBox">{{ trans('stocks.title') }}</h3>
            <p class="stocksBox">&nbsp;</p>
        </div>
        <div class="icon stocksBox">
            <i class="ion ion-clipboard stocksBox"></i>
        </div>
        <a href="{{ url($url) }}" class="small-box-footer">
            {{ trans('app.more_info') }}&nbsp;&nbsp;<i class="fa fa-arrow-circle-right stocksBox"></i>
        </a>
    </div>
</div>
<script>
    let $stocksBox = $('.stocksBox');

    $stocksBox.on('mouseleave', function()
    {
        $stocksBox.find('*').css('cursor', 'pointer');
    });

    $stocksBox.mouseover(function()
    {
        $stocksBox.find('*').css('cursor', 'hand');
    });

    $stocksBox.click(function()
    {
        window.location = '{{ url($url) }}';
    });


</script>

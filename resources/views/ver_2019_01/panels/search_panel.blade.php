<div class="box box-default">

    <div class="box-header with-border">
        <h3 class="box-title">
            {{ trans('app.search') }}
        </h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool"
                    data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button>
        </div>

    </div>

    <div class="box-body">

        <div id="toolbar">

            <div class="btn-group">
                <button id="search" name="search"
                        type="button" title="{{ trans('app.search') }}"
                        class="btn btn-success"
                        data-toggle="modal"
                        data-target="#searchRekord"
                        data-title="{{ trans('app.search') }}"
                        data-message="{{ trans('app.search_title') }}">
                    <i class="fa fa-search"></i>&nbsp;
                    {{ trans('app.search') }}
                </button>

                <button id="clear_search" name="clear_search"
                        type="button" title="{{ trans('app.search') }}"
                        class="btn btn-bitbucket"
                        onclick="window.location.href='{{ url('invoices') }}'">
                    <i class="fa fa-search-minus"></i>&nbsp;
                    {{ trans('app.delete_search') }}
                </button>
            </div>

            <div class="btn-group">
                <label id="lblSearch" name="lblSearch"
                       class="form-control col-sm-5"
                       style="margin-top: 5px;border: 0px;">
                </label>
            </div>

        </div>

    </div>

    <div class="box-footer"></div>

</div>

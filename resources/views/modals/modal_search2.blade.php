<div class="modal fade" id="searchRekord" name="searchRekord"
     role="dialog" aria-label="modal_search" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button aria-hidden="true" class="close"
                        data-dismiss="modal"
                        type="button">&times;
                </button>
                <h4 class="modal-title" id="searchRekord">
                    {{ __('global.app_search') }}
                </h4>
            </div>

            <div class="modal-body">
                <p></p>
                {{ Form::open([
                    'url' => $url,
                    'id' => 'frmSearch',
                    'name' => 'frmSearch',
                    'class' => 'form-horizontal',
                    'method' => 'get'
                ]) }}

                @includeIf($fields)

                {{ Form::close() }}

            </div>

            <div class="modal-footer">

                <!-- Keresés törlése -->
                <button type="button"
                        class="btn btn-warning pull-right deleteSearch"
                        id="frm_searcdelete" name="frm_searcdelete" style="margin-left: 5px;"
                        onclick="event.preventDefault();document.getElementById('search-clear').submit();">
                    <i class='fa fa-trash-o'></i>&nbsp;
                    {{ __('global.app_delete_search') }}
                </button>
                <!-- ./Keresés törlése -->

                <!-- Mégsem -->
                <button type="button" data-dismiss="modal"
                        class="btn btn-info pull-right"
                        id="frm_cancel" name="frm_cancel">
                    <i class='fa fa-trash-o'></i>&nbsp;
                    {{ __('global.app_cancel') }}
                </button>
                <!-- ./Mégsem -->

                <!-- Keresés -->
                <button id="kereses" name="kereses"
                        class="btn btn-primary"
                        type="submit"
                        onclick="event.preventDefault();document.getElementById('frmSearch').submit();">
                    <i class="fa fa-search" aria-hidden="true"></i>&nbsp;
                    {{ __('global.app_search') }}
                </button>
                <!-- ./Keresés -->

            </div>
        </div>
    </div>
</div>

<form id="search-clear" name="search-clear"
      action="{{ url('invoices') }}"
      method="get">
</form>

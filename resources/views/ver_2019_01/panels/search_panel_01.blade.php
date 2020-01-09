<div class="box box-default">
    
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ __('global.app_search') }}
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
            
            {{--
            <div class="btn-group">
                <button id="search" name="search" 
                        type="button" title="{{ __('global.app_search') }}" 
                        class="btn btn-default"
                        data-toggle="modal"
                        data-target="#searchRekord"
                        data-title="{{ __('global.app_search') }}"
                        data-message="{{ __('global.app_search_title') }}">
                    <i class="fa fa-search"></i>
                </button>
                
                <button type="button" title="{{ __('global.app_delete_search') }}" 
                        class="btn btn-default" 
                        onclick="event.preventDefault();document.getElementById('search-clear1').submit();">
                    <i class="fa fa-search-minus"></i>
                </button>
            </div>

            <div class="btn-group">
                
                <button type="button" 
                        class="btn btn-default" 
                        title="{{ __('global.app_days_older', ['num' => 60]) }}" 
                        onclick="event.preventDefault();document.getElementById('frm60').submit();">
                    > 60
                </button>
                <button type="button" 
                        class="btn btn-default" 
                        title="{{ __('global.app_days_older', ['num' => 30]) }}"  
                        onclick="event.preventDefault();document.getElementById('frm30').submit();">
                    > 30
                </button>
            </div>

            <div class="btn-group">
                <button type="button" 
                        class="btn btn-default" 
                        title="Bejövő" 
                        onclick="event.preventDefault();document.getElementById('frmType201').submit();">
                    <i class="fa fa-arrow-down"></i>
                </button>
                <button type="button" 
                        class="btn btn-default" 
                        title="Kimenő"
                        onclick="event.preventDefault();document.getElementById('frmType202').submit();">
                    <i class="fa fa-arrow-up"></i>
                </button>
            </div>
            
            <div class="btn-group">
                
                <button type="button" class="btn btn-danger" title="Fizetetlen" 
                        onclick="event.preventDefault();document.getElementById('frmPaid').submit();">
                    <i class="fa fa-money"></i>
                </button>
                
                <button type="button" class="btn btn-primary" title="Fizetett" 
                        onclick="event.preventDefault();document.getElementById('frmUnPaid').submit();">
                    <i class="fa fa-money"></i>
                </button>
                
            </div>

            <form id="frmSzlaSzam" name="frmSzlaSzam" action="{{ url('invoices') }}" 
                  class="form-horizontal">
                <div class="input-group margin col-sm-3">
                    <input type="text" class="form-control" 
                           id="txtInvNum" name="txtInvNum">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-success">
                          {{ __('global.invoices.fields.inv_num') }}
                      </button>
                    </span>
                </div>
            </form>
            --}}
        </div>

    </div>
    
    <div class="box-footer"></div>
    
</div>
{{--
<form id="search-clear1" name="search-clear1" 
      action="{{ url('invoices') }}" 
      method="get">
</form>

<form id="frm60" name="frm60" 
      action="{{ url('invoices') }}" 
      method="get">
    <input type="hidden" id="days" name="days" value="60"/>
</form>

<form id="frm30" name="frm30" 
      action="{{ url('invoices') }}" 
      method="get">
    <input type="hidden" id="days" name="days" value="30"/>
</form>

<form id="frmType201" name="frmType201" method="get" 
      action="{{ url('invoices') }}">
    <input type="hidden" id="s_type_id" name="s_type_id" value="201"/>
</form>

<form id="frmType202" name="frmType202" method="get" 
      action="{{ url('invoices') }}">
    <input type="hidden" id="s_type_id" name="s_type_id" value="202"/>
</form>
<form id="frmPaid" name="frmPaid" method="get" 
      action="{{ url('invoices') }}">
    <input type="hidden" id="s_paid_rel" name="s_paid_rel" value="=">
    <input type="hidden" id="s_paid" name="s_paid" value="1">
</form>
<form id="frmUnPaid" name="frmUnPaid" method="get" 
      action="{{ url('invoices') }}">
    <input type="hidden" id="s_paid_rel" name="s_paid_rel" value="<>">
    <input type="hidden" id="s_paid" name="s_paid" value="1">
</form>--}}
<div class="form-group">
    <label for="s_type_id" class="col-sm-3 control-label">
        {{ __('global.invoices.search.type') }}:
    </label>
    <div class="col-sm-2"></div>
    @php
    //$helperModel = '\App\Classes\\' . session()->get('version') . '\Helper';
    $bizonylatTipusok = \App\Classes\Helper::getBizonylatTipusok();
    @endphp
    <div class="col-sm-7">
        {{ Form::select(
            's_type_id',
            $bizonylatTipusok,
            (request()->has('s_type_id')) ? request()->get('s_type_id') : null,
            [
                'id' => 's_type_id',
                'class' => 'form-control tooltip-enabled',
                'data-toggle' => '',
                'title' => 'TÍPUS'
            ]) }}
    </div>
</div>

<div class="form-group">
    <label for="s_vendor" class="col-sm-3 control-label">
        {{ __('global.invoices.search.vendor') }}:
    </label>
    <div class="col-sm-2"></div>
    <div class="col-sm-7">
        {{ Form::select(
            's_vendor',
            $vendors,
            null, [
                'id' => 's_vendor',
                'class' => 'form-control tooltip-enabled',
                'data-toggle' => 'tooltip',
                'title' => __('global.invoices.search.vendor')
            ]) }}
    </div>
</div>

<div class="form-group">
    <label for="s_customer" class="col-sm-3 control-label">{{ __('global.invoices.search.customer') }}:</label>
    <div class="col-sm-2">
        {{--
        @include('layouts.rel_select', [
            'id' => 's_customer_rel',
            'title' => 'reláció',
            'like' => true,
            'selected' => (Request::get('s_customer_rel') ? Request::get('s_customer_rel') : '')
        ])
        --}}
    </div>
    <div class="col-sm-7">
        {{ Form::select(
            's_customer',
            $customers,
            null,
            [
                'id' => 's_customer',
                'class' => 'form-control tooltip-enabled',
                'data-toggle' => 'tooltip',
                'title' => __('global.invoices.search.customer')
            ]) }}
    </div>
</div>

<div class="form-group">
    <label for="s_inv_date" class="col-sm-3 control-label">{{ __('global.invoices.fields.inv_date') }}:</label>
    <div class="col-sm-2">
        @includeIf('layouts.rel_select', [
        'id' => 's_inv_date_rel',
        'title' => __('global.app_relation'),
        'like' => false,
        'selected' => (Request::has('s_inv_date_rel')) ? Request::get('s_inv_date_rel') : '',
        ])
    </div>
    <div class="col-sm-7">
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control tooltip-enabled"
                   id="s_inv_date" name="s_inv_date"
                   data-toggle="tooltip" title="{{ __('global.inv_date') }}"
                   value="{{ (Request::has('s_inv_date')) ? Request::get('s_inv_date') : '' }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="s_delivery_date" class="col-sm-3 control-label">{{ __('global.invoices.fields.delivery_date') }}:</label>
    <div class="col-sm-2">
        @includeIf('layouts.rel_select', [
        'id' => 's_delivery_date_rel',
        'title' => __('global.app_relation'),
        'like' => false,
        'selected' => (Request::has('s_delivery_date_rel')) ? Request::get('s_delivery_date_rel') : '',
        ])
    </div>
    <div class="col-sm-7">
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control tooltip-enabled"
                   id="s_delivery_date" name="s_delivery_date"
                   data-toggle="tooltip" 
                   title="{{ __('global.delivery_date') }}"
                   value="{{ (Request::has('s_delivery_date')) ? Request::get('s_delivery_date') : '' }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label for="s_due_date" class="col-sm-3 control-label">{{ __('global.invoices.fields.due_date') }}:</label>
    <div class="col-sm-2">
        @includeIf('layouts.rel_select', [
        'id' => 's_due_date_rel',
        'title' => __('global.app_relation'),
        'like' => false,
        'selected' => (Request::has('s_due_date_rel')) ? Request::get('s_due_date_rel') : '',
        ])
    </div>
    <div class="col-sm-7">
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control tooltip-enabled"
                   id="s_due_date" name="s_due_date"
                   data-toggle="tooltip" 
                   title="{{ __('global.due_date') }}"
                   value="{{ (Request::has('s_due_date')) ? Request::get('s_due_date') : '' }}">
        </div>
    </div>
</div>

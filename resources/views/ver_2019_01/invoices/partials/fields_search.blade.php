{{-- Számla típusok --}}
<div class="form-group col-sm-12">
    <label for="s_customer" class="control-label">{{ trans('app.type') }}:</label>
    <div class="">
        <select id="s_type" name="s_type"
                class="form-control tooltip-enabled"
                data-toggle="tooltip"
                title="{{ trans('app.type') }}">
            <option value="">{{ trans('app.type_all') }}</option>
            <option value="201" @if(request()->get('s_type') == '201') selected @endif >{{ trans('app.type_outgoing') }}</option>
            <option value="202" @if(request()->get('s_type') == '202') selected @endif >{{ trans('app.type_incoming') }}</option>
        </select>
    </div>
</div>
{{-- /.Számla típusok --}}

{{-- Számlaszám --}}
<div class="form-group col-sm-12">
    <label for="s_invNum" class="control-label">{{ trans('inv.inv_num') }}:</label>
    <div class="">
        <input id="s_invNum" name="s_invNum" class="form-control" value="{{ request()->get('s_invNum') }}">
    </div>
</div>
{{-- /.Számlaszám --}}
@if( \Auth::user()->Supervisor_ID == 0 )
    <div class="form-group col-sm-12">
        <label for="s_customer" class="control-label">
            {{ trans('inv.customer') }}:
        </label>
        <div class="">
            <select id="s_customer" name="s_customer" class="form-control tooltip-enabled"
                    data-toggle="tooltip"
                    title="{{ trans('inv.customer') }}">
                <option value="0">{{ trans('app.select_first_element') }}</option>
                <?php
                /** @var TYPE_NAME $customers */
                foreach($customers as $customer)
                {
                $selected = '';
                if( $customer->Cust_ID == request()->get('s_customer') )
                {
                    $selected = 'selected';
                }
                ?>
                <option value="{{ $customer->Cust_ID }}" {{ $selected }}>{{ $customer->Cust_Name1 }}</option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group col-sm-12">
        <label for="s_vendor" class="control-label">
            {{ trans('inv.vendor') }}:
        </label>
        <div class="">
            <select id="s_vendor" name="s_vendor" class="form-control tooltip-enabled"
                    data-toggle="tooltip"
                    title="{{ trans('invoices.vendor') }}">
                <option value="0">{{ trans('app.select_first_element') }}</option>

                <?php
                /** @var TYPE_NAME $vendors */
                foreach($vendors as $vendor)
                {
                $selected = '';
                if( $vendor->Vendor_ID == request()->get('s_vendor') )
                {
                    $selected = 'selected';
                }
                ?>
                <option value="{{ $vendor->Vendor_ID }}" {{ $selected }}>{{ $vendor->Vendor_Name1 }}</option>
                <?php
                }
                ?>

            </select>
        </div>
    </div>
@endif

<div class="form-group col-sm-12">
    <label for="s_delivery_date" class="control-label">{{ trans('inv.delivery_date') }}:</label>

    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input id="s_delivery_date" name="s_delivery_date"
               class="form-control pull-right" value="" autocomplete="off">
    </div>
</div>

<div class="form-group col-sm-12">
    <label for="s_due_date" class="control-label">
        {{ trans('inv.due_date') }}:
    </label>

    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input id="s_due_date" name="s_due_date"
               class="form-control pull-right" value="" autocomplete="off">
    </div>
</div>

{{-- Számlaszám --}}
<div class="form-group col-sm-12">
    <label for="s_invNum" class="control-label">
        {{ __('global.invoice.account_number') }}:
    </label>
    
    <div class="">
        <input id="s_invNum" name="s_invNum" class="form-control" 
               value="{{ request()->get('s_invNum') }}">
    </div>
    
</div>
{{-- /.Számlaszám --}}

@if( \Auth::user()->Supervisor_ID == 0 )
<div class="form-group col-sm-12">
    <label for="s_customer" class="control-label">
        {{ __('global.invoices.search.customer') }}:
    </label>
    <div class="">
        <select id="s_customer" name="s_customer" class="form-control tooltip-enabled" 
                data-toggle="tooltip" 
                title="{{ __('global.invoices.search.customer') }}">
            <option value="0">{{ __('global.app_select_first_element') }}</option>
            <?php
            foreach($customers as $customer)
            {
                $selected = '';
                if( $customer['Cust_ID'] == request()->get('s_customer') )
                {
                    $selected = 'selected';
                }
            ?>
            <option value="{{ $customer['Cust_ID'] }}" {{ $selected }}>{{ $customer['Cust_Name1'] }}</option>
            <?php
            }
            ?>
        </select>
    </div>
</div>

<div class="form-group col-sm-12">
    <label for="s_vendor" class="control-label">
        {{ __('global.invoices.search.vendor') }}:
    </label>
    <div class="">
        <select id="s_vendor" name="s_vendor" class="form-control tooltip-enabled" 
                data-toggle="tooltip" 
                title="__('global.invoices.search.vendor')">
            <option value="0">{{ __('global.app_select_first_element') }}</option>
            
            @php
            foreach($vendors as $vendor)
            {
                $selected = '';
                if( $vendor['Vendor_ID'] == request()->get('s_vendor') )
                {
                    $selected = 'selected';
                }
            @endphp
            <option value="{{ $vendor['Vendor_ID'] }}" {{ $selected }}>{{ $vendor['Vendor_Name1'] }}</option>
            @php
            }
            @endphp
            
        </select>
    </div>
</div>
@endif

<div class="form-group col-sm-12">
    <label for="s_delivery_date" class="control-label">
        {{ __('global.invoices.fields.delivery_date') }}:
    </label>
    
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
        {{ __('global.invoices.fields.due_date') }}:
    </label>
    
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input id="s_due_date" name="s_due_date" 
               class="form-control pull-right" value="" autocomplete="off">
    </div>
</div>
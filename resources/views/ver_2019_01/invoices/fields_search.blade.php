{{-- Számla típusok --}}
@includeIf('layouts.fields.input_select', [
    'select_id' => 's_customer',
    'title' => trans('app.type'),
    'get_option_all' => trans('app.type_all'),
    'elements' => ['201' => trans('app.type_outgoing'), '202' => trans('app.type_incoming')],
    'selected_value' => request()->get('s_type'),
])
{{-- /.Számla típusok --}}

{{-- Számlaszám --}}
@includeIf('layouts.fields.input_textbox', [
    'title' => trans('inv.inv_num'),
    'textbox_id' => 's_invNum',
    'textbox_value' => request()->get('s_invNum')
])
{{-- /.Számlaszám --}}

{{-- Partnerek --}}
@if( \Auth::user()->Supervisor_ID == 0 )
    <div class="form-group col-sm-12">
        <label for="s_customer" class="control-label">
            {{ trans('app.partners') }}:
        </label>
        <div class="">
            <select id="s_partner" name="s_partner" class="form-control tooltip-enabled"
                    data-toggle="tooltip"
                    title="{{ trans('app.partners') }}">
                <option value="0">{{ trans('app.select_first_element') }}</option>
                <?php
                /** @var Collection $partners */
                foreach($partners as $partner)
                {
                $selected = '';
                if( $partner->ID == request()->get('s_partner') )
                {
                    $selected = 'selected';
                }
                ?>
                <option value="{{ $partner->ID }}" {{ $selected }}>{{ $partner->Name }}</option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
@endif
{{-- End Partnerek --}}

{{-- Teljesítés dátuma --}}
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
{{-- /.Teljesítés dátuma --}}

{{-- Szállítás dátuma --}}
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
{{-- /.Szállítás dátuma --}}

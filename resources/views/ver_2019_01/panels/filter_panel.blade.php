<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">
            {{ trans('app.filter') }}
        </h3>

        <div class="box-tools">
            <button type="button" class="btn btn-box-tool"
                    data-widget="collapse">
                    <i class="fa fa-minus"></i>
            </button>
        </div>

    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-md-12">

                <div class="form-group col-md-4">
                    <label>{{ trans('app.dates') }}</label>
                    <select class="form-control"
                            id="date_cell" name="date_cell">
                        <option value="booking_date">
                            {{ trans('cp_wrhs_trans.booking_date') }}
                        </option>
                        <option value="deliverydate">
                            {{ trans('cp_wrhs_trans.deliverydate') }}
                        </option>
                        <option value="deadline">
                            {{ trans('cp_wrhs_trans.deadline') }}
                        </option>
                        <option value="customs_clearance_date">
                            {{ trans('cp_wrhs_trans.customs_clearance_date') }}
                        </option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label>{{ trans('app.from') }}</label>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker2'>
                            <input type='text' class="form-control"
                                id="startDate" name="startDate"
                                value=""/>
                            <span class="input-group-addon">
                                <span class="add-on"><i class="icon-remove"></i></span>
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label>{{ trans('app.to') }}</label>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker3'>
                            <input type='text' class="form-control"
                                id="endDate" name="endDate"
                                value=""/>
                            <span class="input-group-addon">
                                <span class="add-on"><i class="icon-remove"></i></span>
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    {{--
      <div class="box-footer"></div>
    --}}
</div>

<div class="box box-info">
    <div class="box-header">
        <i class="fa fa-envelope"></i>

        <h3 class="box-title">@lang('widget.quick_email.title')</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-info btn-sm" data-widget="remove"
                    data-toggle="tooltip"
                    title="Remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <!-- /. tools -->
    </div>
    <div class="box-body">
        <form action="#" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="emailto" placeholder="@lang('widget.quick_email.email_to'):">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="subject" placeholder="@lang('widget.quick_email.subject')">
            </div>
            <div>
                  <textarea class="textarea" placeholder="@lang('widget.quick_email.message')"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
        </form>
    </div>
    <div class="box-footer clearfix">
        <button type="button" class="pull-right btn btn-warning" id="sendEmail">@lang('widget.quick_email.send')
            <i class="fa fa-arrow-circle-right"></i>
        </button>
    </div>
</div>

<div class="modal fade"
     id="{{ $modal_name }}" name="{{ $modal_name }}"
     tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <div class="modal-body">
                <form>

                    @includeIf($fields)

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left"
                        data-dismiss="modal">
                    {{ trans('app.cancel') }}
                </button>
                <button id="modal_save" name="modal_save" type="button"
                        class="btn btn-success">{{ trans('app.save') }}</button>
            </div>
        </div>
    </div>
</div>

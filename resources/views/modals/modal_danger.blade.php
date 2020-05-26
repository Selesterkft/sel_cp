<div class="modal modal-danger fade" id="{{ $modal_name }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Danger Modal</h4>
            </div>
            <div class="modal-body">
                <p>Biztos, hogy törlöd az adatot?</p>
                <input type="hidden" id="record_id" name="record_id" value="0">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">
                    {{ trans('app.cancel') }}
                </button>
                <button id="modal_delete" name="modal_delete" type="button" class="btn btn-outline">
                    {{ trans('app.delete') }}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

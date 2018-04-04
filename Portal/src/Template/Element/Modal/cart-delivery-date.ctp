<div class="modal fade" id="deliveryDate" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= __('Edit delivery date') ?></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="form_nrint" />
                <input class="form-control" type="date" id="minDateModal" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= __('Cancel') ?></button>
                <button type="submit" id="saveModal" class="btn btn-hodi"><?= __('Save') ?></button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#deliveryDate').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var minDate = button.data('mindate');
        var articleNrint = button.data('nrint');
        var curDate = $('#del_date_'+articleNrint).data('date');
        $('#form_nrint').val(articleNrint);
        $('#minDateModal').val(curDate).prop('min', minDate);
    });

    $('#saveModal').on('click', function (event) {
        var articleNrint = $('#form_nrint').val();
        var curDate = $('#minDateModal').val();
        $('#del_date_'+articleNrint).html(curDate).data('date', curDate);
        $('#del_date_'+articleNrint+'_hid').val(curDate);
        $('#deliveryDate').modal('hide');
    });

    $('#requestModal').on('shown.bs.modal', function (e) {
        // Focus on textarea
        $('#requestTextarea').focus();
    });

    $('#requestModal').on('hidden.bs.modal', function (e) {
        // Focus on textarea
        $('#requestForm')[0].reset();
    });
</script>
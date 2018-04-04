<div class="modal fade" id="requestModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="requestForm" method="post" action="/Quotation/sendNewRequest/">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= __('New request') ?></h4>
                </div>
                <div class="modal-body">
                    <textarea id="requestTextarea" name="request" class="form-control" rows="6" placeholder="<?= __('You can make a new order request here') ?>."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= __('Cancel') ?></button>
                    <button type="submit" class="btn btn-hodi"><?= __('Send request') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#requestModal').on('shown.bs.modal', function (e) {
        // Focus on textarea
        $('#requestTextarea').focus();
    });

    $('#requestModal').on('hidden.bs.modal', function (e) {
        // Focus on textarea
        $('#requestForm')[0].reset();
    });
</script>
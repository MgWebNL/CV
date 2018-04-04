<div class="modal fade" id="editQuote" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="requestForm" method="post" action="/Quotation/answerQuotation/">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= __('Reject quote') ?></h4>
                </div>
                <div class="modal-body">
                    <p><?= __('Are you sure you want to reject and cancel this quote?') ?></p>
                    <textarea id="requestTextarea" name="changes" class="form-control" rows="6" placeholder="<?= __('Please enter a reason for cancellation here') ?>."></textarea>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="quotation_nrint" value="<?= $aQuotation->ORDOFNRINT ?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= __('Cancel') ?></button>
                    <button type="submit" class="btn btn-hodi" name="answer" value="-1"><?= __('Reject and cancel quote') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="approveQuote" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="requestForm" method="post" action="/Quotation/answerQuotation/">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?= __('Approve quote') ?></h4>
                </div>
                <div class="modal-body">
                    <p><?= __('Are you sure you want to approve this quote?') ?></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="quotation_nrint" value="<?= $aQuotation->ORDOFNRINT ?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= __('No') ?></button>
                    <button type="submit" class="btn btn-hodi" name="answer" value="1"><?= __('Yes, approve quote') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
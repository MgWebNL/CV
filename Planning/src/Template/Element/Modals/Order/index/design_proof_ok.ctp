<!-- Modal DESIGN OK -->
<div class="modal fade" id="designAndProofOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form method="post" action="/Order/customerDesignAnswer/<?= $aOrder->orderrule_id ?>/2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-check"></i>Design en drukproof akkoord</h4>
                </div>
                <div class="modal-body">
                    <p>Weet u zeker dat zowel <strong>design</strong>, als <strong>drukproef</strong> akkoord zijn bij de klant?</p>
                    <label>
                        <input type="checkbox" required="required" name="sales_msg" value="Ja, ik weet zeker dat klant akkoord is met design en drukproef" />
                        Ja, ik weet zeker dat klant akkoord is met design en drukproef
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">
                        <i class="fa fa-times"></i> Sluiten
                    </button>

                    <button type="submit" name="submit" value="new_artwork" class="btn bg-purple btn-sm pull-right">
                        <i class="fa fa-check"></i> Upload aanvragen bij Studio
                    </button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </form>
</div>
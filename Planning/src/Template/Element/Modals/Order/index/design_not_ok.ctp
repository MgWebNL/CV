<!-- Modal DESIGN NOT OK -->
<div class="modal fade" id="designNotOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form method="post" action="/Order/customerDesignAnswer/<?= $aOrder->orderrule_id ?>/0">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i>Design voorstel niet akkoord</h4>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" name="sales_msg" placeholder="Typ hier uw opmerking"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">
                        <i class="fa fa-times"></i> Sluiten
                    </button>

                    <button type="submit" name="submit" value="new_artwork" class="btn bg-purple btn-sm pull-right">
                        <i class="fa fa-check"></i> Nieuwe opzet aanvragen bij studio
                    </button>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </form>
</div>
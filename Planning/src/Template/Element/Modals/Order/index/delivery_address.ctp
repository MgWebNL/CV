<!-- Modal ARTICLE DETAILS -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-truck"></i>Afleveradres wijzigen</h4>
            </div>
            <form method="post" action="/Order/saveDeliveryAddress/<?= $aOrder->orderrule_id ?>/<?= $aOrder->HdIntPrplGeneral->id ?>">
                <div class="modal-body no-padding">
                <ul class="list-group">

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-1">
                                <input type="radio" id="deliverCust" required="required" name="deliveryHodi" value="0" />
                            </div>
                            <div class="col-xs-5">
                                <label for="deliverCust">Afleveren bij klant</label>
                            </div>
                            <div class="col-xs-6">
                                <?= $aOrder->afleveradres_name ?><br />
                                <?= $aOrder->afleveradres_address ?><br />
                                <?= $aOrder->afleveradres_postalcode ?> <?= $aOrder->afleveradres_town ?><br />
                                <?= $aOrder->afleveradres_countryname ?>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-1">
                                <input type="radio" id="deliverHodi" required="required" name="deliveryHodi" value="1" />
                            </div>
                            <div class="col-xs-5">
                                <label for="deliverHodi">Afleveren bij Hodi</label>
                            </div>
                            <div class="col-xs-6">
                                Hodi International BV<br />
                                Kernreactorstraat 1<br />
                                3903 LG Veenendaal<br />
                                The Netherlands
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item text-right">
                        <button type="submit" name="saveDelAddr" class="btn btn-sm bg-purple">Opslaan</button>
                    </li>
                </ul>

            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal REPRINT -->
<div class="modal fade" id="confirmReprint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <script>
        function toggleData(){
            $('#addDataReprint').show();
            $('#showBtn').hide();
            $('#saveBtn').show();
        }
    </script>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-repeat"></i>Ongewijzigde herdruk</h4>
            </div>

            <form method="post" action="/Order/setReprint/<?= $aOrder->orderrule_id ?>">
                <div class="modal-body">
                    <p>Weet u zeker dat u deze order wil markeren als <b>Ongewijzigde herdruk</b>?</p>
                    <small>De order zal direct naar de status <em>Bestand uploaden</em> verplaatst worden.</small>

                    <div id="addDataReprint" style="display: none;">
                        <br />
                        <input type="hidden" name="id" value="<?= isset($aPrepress["HdIntPrplPrepressInstructions"]["id"]) ? @$aPrepress["HdIntPrplPrepressInstructions"]["id"] : 0 ?>" />
                        <input type="hidden" name="prepress_id" value="<?= isset($aPrepress["id"]) ? @$aPrepress["id"] : 0 ?>" />
                        <input type="hidden" name="order_nrint" value="<?= $aOrder->orderrule_id ?>" />
                        <input type="hidden" name="general_id" value="<?= $aOrder->HdIntPrplGeneral->id ?>" />

                        <!-- AANVULLENDE OPTIES -->
                        <ul class="list-group">
                            <li class="list-group-item list-head-purple text-left">
                                <strong><i class="fa fa-check-square"></i> Aanvullende opties</strong>
                            </li>

                            <li class="list-group-item text-right">
                                <span class="pull-left"><strong>FSC-order</strong></span>
                                <input id="switch-fsc" name="fsc_order" value="1" class="form-toggle" <?= ($aOrder->HdIntPrplGeneral->fsc_order == 1) ? 'checked' : '' ?> type="checkbox" data-toggle="toggle" data-size="micro" data-on-text="Ja" data-off-text="Nee" data-on-color="success" data-off-color="danger">
                            </li>

                            <li class="list-group-item text-right">
                                <span class="pull-left"><strong>Spoedorder</strong></span>
                                <input id="switch-priority" name="priority" value="1"  class="form-toggle" <?= ($aOrder->HdIntPrplGeneral->priority == 1) ? 'checked' : '' ?> type="checkbox" data-toggle="toggle" data-size="micro" data-on-text="Ja" data-off-text="Nee" data-on-color="success" data-off-color="danger">
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Servet</strong>
                                        <small class="text-danger">VERPLICHT</small>
                                    </div>
                                    <div class="col-xs-6">
                                        <select name="napkin_nrint" class="form-control input-xs no-space selectpicker" required>
                                            <option value="">Selecteer servet</option>
                                            <option value="NONENONE">-- Geen servet --</option>
                                            <?php foreach($aNapkin as $aNap){ ?>
                                                <option <?= $aNap["napkin_article_nrint"] == $aOrder->HdIntPrplGeneral->napkin_nrint ? "selected" : "" ?> value="<?= $aNap["napkin_article_nrint"] ?>"><?= $aNap["napkin_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Omdoos</strong>
                                        <small class="text-danger">VERPLICHT</small>
                                    </div>
                                    <div class="col-xs-6">
                                        <select name="box_nrint" class="form-control input-xs no-space selectpicker" required>
                                            <option value="">Selecteer omdoos</option>
                                            <option value="NONENONE">-- Geen omdoos --</option>
                                            <?php foreach($aBox as $aB){ ?>
                                                <option <?= $aB["box_article_nrint"] == $aOrder->HdIntPrplGeneral->box_nrint ? "selected" : "" ?> value="<?= $aB["box_article_nrint"] ?>"><?= $aB["box_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Art. variant</strong>
                                    </div>
                                    <div class="col-xs-6">

                                        <select name="article_editions[]" multiple class="form-control input-xs no-space selectpicker">
                                            <?php $aOptions = explode(",",$aOrder->HdIntPrplGeneral->article_editions); ?>
                                            <?php foreach($aEdition as $aEdit){ ?>
                                                <option value="<?= $aEdit["id"] ?>" <?php if(in_array($aEdit["id"], $aOptions)){ echo "selected"; } ?>><?= $aEdit["edition_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Aantal per omdoos</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <input name="article_box_quantity" type="number" class="form-control input-xs"
                                               value="<?php if($aOrder->HdIntPrplGeneral->article_box_quantity == 0){
                                                   echo $aOrder->HdIntPrplGrootboekActief["box_quantity"];
                                               }else{
                                                   echo $aOrder->HdIntPrplGeneral->article_box_quantity;
                                               } ?>" min="1" />
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item no-padding no-border">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <textarea name="order_remarks" class="form-control" style="resize: none; height: 52px;" placeholder="Typ hier uw opmerking voor deze order..."><?= $aOrder["order_remarks"] ?></textarea>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">
                        <i class="fa fa-times"></i> Nee
                    </button>

                    <button type="submit" id="saveBtn" style="display: none;" name="submitReprint" value="<?= $aOrder->orderrule_id ?>" class="btn bg-purple btn-sm pull-right">
                        <i class="fa fa-check"></i> Gegevens opslaan
                    </button>

                    <button type="button" id="showBtn" onclick="toggleData();" class="btn bg-purple btn-sm pull-right">
                        <i class="fa fa-check"></i> Ja
                    </button>

                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </div>
</div>
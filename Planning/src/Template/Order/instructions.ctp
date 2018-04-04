<!-- Modal ART -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cubes"></i> Artikelinfo</h4>
            </div>
            <div class="modal-body no-padding">
                <ul class="list-group">

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>Artikelcode</strong>
                            </div>
                            <div class="col-xs-6">
                                <?= $aOrder["product_code"] ?>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>Artikelomschrijving</strong>
                            </div>
                            <div class="col-xs-6">
                                <?= nl2br($aOrder["product_name"]) ?>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item oc">
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>Soort artikel</strong>
                            </div>
                            <div class="col-xs-6">
                                <?= $aOrder["ledger_name"] ?>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item oc">
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>Aantal per omdoos</strong>
                            </div>
                            <div class="col-xs-6">
                                <?= $aOrder->HdIntPrplGrootboekActief->box_quantity ?> stuks
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item no-border">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <button type="button" class="btn bg-purple btn-sm btn-block" data-dismiss="modal">
                                    <i class="fa fa-times"></i> Sluiten
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>

<!-- Modal CUST -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Klantgegevens</h4>
            </div>
            <div class="modal-body no-padding">
                <ul class="list-group">

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>Debiteurencode</strong>
                            </div>
                            <div class="col-xs-6">
                                <?= $aOrder["adres_code"] ?>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6">
                                <strong>Naam</strong>
                            </div>
                            <div class="col-xs-6">
                                <?= $aOrder["adres_name"] ?>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item no-border">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <button type="button" class="btn bg-purple btn-sm btn-block" data-dismiss="modal">
                                    <i class="fa fa-times"></i> Sluiten
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>

<!-- Modal CUST -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-comment-o"></i> Opmerkingen</h4>
            </div>
            <div class="modal-body no-padding">
                <ul class="list-group">
                    <li class="list-group-item no-padding" style="height: 247px; overflow-y: auto;">
                        <table class="table table-condensed">
                            <tbody>
                            <?php if(count($aLog) == 0){ ?>
                                <tr>
                                    <td class="text-center text-muted">
                                        <br />Geen logboek beschikbaar
                                    </td>
                                </tr>

                            <?php }else{ ?>
                                <?php foreach($aLog as $log){ ?>
                                    <tr class="">
                                        <td style="padding: 10px 15px;">
                                            <div class="label bg-purple pull-right"><?= $log["medewerker"] ?></div>
                                            <?php $a = strtotime($log["timestamp"]->format('Y/m/d H:i:s')) ?>
                                            <!--                                                    <strong>--><?//= strftime('%A %e %B', $log["timestamp"]) ?><!--</strong><br />-->
                                            <strong><?= ucfirst(strftime("%A %#d %B %Y om %H:%M:%S", $a)) ?></strong><br />
                                            <?= $log["log_title"] ?><br>
                                            <em><?= $log["log_remark"] ?></em>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>


                            </tbody>
                        </table>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>


<?php
    if($aOrder["general_status"] > 101 || $aOrder["reprint"] == 1){
        $disabled = 'disabled';
    }else{
        $disabled = '';
    }
?>
<!-- ORDER -->
<div class="row">
    <div class="col-xs-12 col-lg-12">
        <div class="box box-default">

            <div class="box-body">
                <div class="row">
                    <!-- GENERAL ORDER INFO -->
                    <div class="col-sm-6 col-lg-6">
                        <form method="post" id="prepress_form" action="/Order/savePrepressForm/<?= $aOrder["orderrule_id"] ?>">
                            <input type="hidden" name="id" value="<?= isset($aPrepress["HdIntPrplPrepressInstructions"]["id"]) ? @$aPrepress["HdIntPrplPrepressInstructions"]["id"] : 0 ?>" />
                            <input type="hidden" name="prepress_id" value="<?= isset($aPrepress["id"]) ? @$aPrepress["id"] : 0 ?>" />
                            <input type="hidden" name="order_nrint" value="<?= $aOrder["orderrule_id"] ?>" />
                            <input type="hidden" name="general_id" value="<?= $aOrder->HdIntPrplGeneral["id"] ?>" />
                            <input type="hidden" name="order_type" value="<?= $aOrder->HdIntPrplGeneral["order_type"] ?>" />

                            <!-- AANVULLENDE OPTIES -->
                            <ul class="list-group">
                                <li class="list-group-item list-head-purple text-left">
                                    <strong><i class="fa fa-check-square"></i> Aanvullende opties</strong>
                                </li>

                                <li class="list-group-item text-right">
                                    <span class="pull-left"><strong>FSC-order</strong></span>
                                    <input id="switch-fsc" name="fsc_order" value="1" class="form-toggle" <?= ($aOrder->HdIntPrplGeneral["fsc_order"] == 1) ? 'checked' : '' ?> type="checkbox" data-toggle="toggle" data-size="micro" data-on-text="Ja" data-off-text="Nee" data-on-color="success" data-off-color="danger">
                                </li>

                                <li class="list-group-item text-right">
                                    <span class="pull-left"><strong>Spoedorder</strong></span>
                                    <input id="switch-priority" name="priority" value="1"  class="form-toggle" <?= ($aOrder->HdIntPrplGeneral["priority"] == 1) ? 'checked' : '' ?> type="checkbox" data-toggle="toggle" data-size="micro" data-on-text="Ja" data-off-text="Nee" data-on-color="success" data-off-color="danger">
                                </li>

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Servet</strong>
                                        </div>
                                        <div class="col-xs-6">
                                            <select name="napkin_nrint" class="form-control input-xs no-space selectpicker">
                                                <option value="">Selecteer servet</option>
                                                <option value="NONENONE">-- Geen servet --</option>
                                                <?php foreach($aNapkin as $aNap){ ?>
                                                    <option <?= $aNap["napkin_article_nrint"] == $aOrder->HdIntPrplGeneral["napkin_nrint"] ? "selected" : "" ?> value="<?= $aNap["napkin_article_nrint"] ?>"><?= $aNap["napkin_name"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Omdoos</strong>
                                        </div>
                                        <div class="col-xs-6">
                                            <select name="box_nrint" class="form-control input-xs no-space selectpicker">
                                                <option value="">Selecteer omdoos</option>
                                                <option value="NONENONE">-- Geen omdoos --</option>
                                                <?php foreach($aBox as $aB){ ?>
                                                    <option <?= $aB["box_article_nrint"] == $aOrder->HdIntPrplGeneral["box_nrint"] ? "selected" : "" ?> value="<?= $aB["box_article_nrint"] ?>"><?= $aB["box_name"] ?></option>
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
                                                <?php $aOptions = explode(",",$aOrder->HdIntPrplGeneral["article_editions"]); ?>
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
                                                   value="<?php if($aOrder->HdIntPrplGeneral["article_box_quantity"] == 0){
                                                       echo $aOrder->HdIntPrplGrootboekActief["box_quantity"];
                                                   }else{
                                                       echo $aOrder->HdIntPrplGeneral["article_box_quantity"];
                                                   } ?>" min="1" />
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item no-padding no-border">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <textarea name="order_remarks" class="form-control" style="resize: none; height: 52px;" placeholder="Typ hier uw opmerking voor deze order..."><?= $aOrder->HdIntPrplGeneral["order_remarks"] ?></textarea>
                                        </div>
                                    </div>
                                </li>

                            </ul>

                            <!-- DISTRIBUTEURSLOGO -->
                            <ul class="list-group <?= $disabled ?>">
                                <li class="list-group-item list-head-purple text-left">
                                    <strong><i class="fa fa-copyright"></i> Distributeurslogo</strong>
                                </li>

                                <li class="list-group-item text-left">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Distributeurslogo</strong>
                                        </div>
                                        <div class="col-xs-6">

                                            <select name="prepress_distributer_logo" class="form-control input-xs">
                                                <option value="">- Selecteer antwoord -</option>
                                                <option value="1" <?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_distributer_logo"] == "1" ? "selected" : "" ?>>Ja</option>
                                                <option value="0" <?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_distributer_logo"] == "0" ? "selected" : "" ?>>Nee</option>
                                            </select>
                                        </div>
                                    </div>



                                </li>

                                <li class="list-group-item hidden">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Tekst distributeurslogo</strong>
                                        </div>
                                        <div class="col-xs-6">
                                            <input name="prepress_distributer_text" value="<?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_social_other"] ?>" type="text" class="form-control input-xs" />
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item text-left">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Merklogo</strong>
                                        </div>
                                        <div class="col-xs-6">

                                            <select name="prepress_product_logo" class="form-control input-xs">
                                                <option value="">- Selecteer antwoord -</option>
                                                <option value="1" <?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_product_logo"] == "1" ? "selected" : "" ?>>Ja</option>
                                                <option value="0" <?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_product_logo"] == "0" ? "selected" : "" ?>>Nee</option>
                                            </select>
                                        </div>
                                    </div>

                                </li>

                            </ul>



                            <!-- OPMAAKINSTRUCTIES -->
                            <ul class="list-group <?= $disabled ?>">
                                <li class="list-group-item list-head-purple text-left">
                                    <strong><i class="fa fa-pencil"></i> Opmaakinstructies</strong>
                                </li>

                                <li class="list-group-item no-padding no-border">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <textarea name="prepress_instructions" class="form-control" style="resize: none; height: 200px;" placeholder="Typ hier de opmaakinstructies voor deze order..."><?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_instructions"] ?></textarea>
                                        </div>
                                    </div>
                                </li>



                            </ul>

                            <!-- VOORZIJDE -->
                            <ul class="list-group <?= $disabled ?>">
                                <li class="list-group-item list-head-purple text-left">
                                    <strong><i class="fa fa-image"></i> Voorzijde</strong>
                                </li>

                                <input type="hidden" name="prepress_logo_front" value="1" />
                                <input type="hidden" name="prepress_photo_front" value="1" />
                                <input type="hidden" name="prepress_logo_back" value="1" />
                                <input type="hidden" name="prepress_photo_back" value="1" />

                                <input type="hidden" name="prepress_social_facebook" value="" />
                                <input type="hidden" name="prepress_social_twitter" value="" />
                                <input type="hidden" name="prepress_social_qr" value="" />
                                <input type="hidden" name="prepress_social_other" value="" />

                                <!--                        <li class="list-group-item text-right">-->
                                <!--                            <span class="pull-left"><strong>Logo op voorzijde</strong></span>-->
                                <!--                            <input name="prepress_logo_front" value="1" --><?//= (@$aPrepress["Instructions"]["prepress_logo_front"] == 1) ? 'checked' : '' ?><!-- id="switch-fsc" class="form-toggle" type="checkbox" data-toggle="toggle" data-size="micro" data-on-text="Ja" data-off-text="Nee" data-on-color="success" data-off-color="danger">-->
                                <!---->
                                <!--                        </li>-->
                                <!---->
                                <!--                        <li class="list-group-item text-right">-->
                                <!--                            <span class="pull-left"><strong>Foto's op voorzijde</strong></span>-->
                                <!--                            <input name="prepress_photo_front" value="1" --><?//= (@$aPrepress["Instructions"]["prepress_photo_front"] == 1) ? 'checked' : '' ?><!-- id="switch-fsc" class="form-toggle" type="checkbox" data-toggle="toggle" data-size="micro" data-on-text="Ja" data-off-text="Nee" data-on-color="success" data-off-color="danger">-->
                                <!--                        </li>-->

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Kleur voorzijde</strong>
                                        </div>
                                        <div class="col-xs-6">
                                            <input name="prepress_color_front" value="<?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_color_front"] ?>" type="text" class="form-control input-xs" />
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Tekstkleur voorzijde</strong>
                                        </div>
                                        <div class="col-xs-6">
                                            <input name="prepress_textcolor_front" value="<?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_textcolor_front"] ?>" type="text" class="form-control input-xs" />
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <strong>Tekst op voorzijde</strong>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item no-border no-padding">
                                    <textarea name="prepress_text_front" style="resize: none; height: 200px;" class="form-control" rows="4"><?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_text_front"] ?></textarea>
                                </li>

                            </ul>

                            <!-- ACHTERZIJDE -->
                            <ul class="list-group <?= $disabled ?>">
                                <li class="list-group-item list-head-purple text-left">
                                    <strong><i class="fa fa-image"></i> Achterzijde</strong>
                                </li>

                                <!--                        <li class="list-group-item text-right">-->
                                <!--                            <span class="pull-left"><strong>Logo op achterzijde</strong></span>-->
                                <!--                            <input name="prepress_logo_back" value="1" --><?//= (@$aPrepress["HdIntPrplPrepressInstructions"]["prepress_logo_back"] == 1) ? 'checked' : '' ?><!-- id="switch-fsc" class="form-toggle" type="checkbox" data-toggle="toggle" data-size="micro" data-on-text="Ja" data-off-text="Nee" data-on-color="success" data-off-color="danger">-->
                                <!--                        </li>-->
                                <!---->
                                <!--                        <li class="list-group-item text-right">-->
                                <!--                            <span class="pull-left"><strong>Foto's op achterzijde</strong></span>-->
                                <!--                            <input name="prepress_photo_back" value="1" --><?//= (@$aPrepress["HdIntPrplPrepressInstructions"]["prepress_photo_back"] == 1) ? 'checked' : '' ?><!-- id="switch-fsc" class="form-toggle" type="checkbox" data-toggle="toggle" data-size="micro" data-on-text="Ja" data-off-text="Nee" data-on-color="success" data-off-color="danger">-->
                                <!--                        </li>-->

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Kleur achterzijde</strong>
                                        </div>
                                        <div class="col-xs-6">
                                            <input name="prepress_color_back" value="<?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_color_back"] ?>" type="text" class="form-control input-xs" />
                                        </div>
                                    </div>
                                </li>



                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <strong>Tekstkleur achterzijde</strong>
                                        </div>
                                        <div class="col-xs-6">
                                            <input name="prepress_textcolor_back" value="<?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_textcolor_back"] ?>" type="text" class="form-control input-xs" />
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <strong>Tekst op achterzijde</strong>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item no-border no-padding">
                                    <textarea name="prepress_text_back" style="resize: none; height: 200px;" class="form-control"><?= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_text_back"] ?></textarea>
                                </li>

                            </ul>

                            <!-- SOCIAL MEDIA -->
                            <!--                    <ul class="list-group">-->
                            <!--                        <li class="list-group-item list-head-purple text-left">-->
                            <!--                            <strong><i class="fa fa-globe"></i> Social media</strong>-->
                            <!--                        </li>-->
                            <!---->
                            <!--                        <li class="list-group-item">-->
                            <!--                            <div class="row">-->
                            <!--                                <div class="col-xs-6">-->
                            <!--                                    <i class="fa fa-facebook-square"></i>-->
                            <!--                                    <strong>Facebook</strong>-->
                            <!--                                </div>-->
                            <!--                                <div class="col-xs-6">-->
                            <!--                                    <input name="prepress_social_facebook" value="--><?//= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_social_facebook"] ?><!--" type="text" class="form-control input-xs" placeholder="Typ hier de link..." />-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                        </li>-->
                            <!---->
                            <!--                        <li class="list-group-item">-->
                            <!--                            <div class="row">-->
                            <!--                                <div class="col-xs-6">-->
                            <!--                                    <i class="fa fa-twitter"></i>-->
                            <!--                                    <strong>Twitter</strong>-->
                            <!--                                </div>-->
                            <!--                                <div class="col-xs-6">-->
                            <!--                                    <input name="prepress_social_twitter" value="--><?//= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_social_twitter"] ?><!--" type="text" class="form-control input-xs" placeholder="Typ hier de link..." />-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                        </li>-->
                            <!---->
                            <!--                        <li class="list-group-item">-->
                            <!--                            <div class="row">-->
                            <!--                                <div class="col-xs-6">-->
                            <!--                                    <i class="fa fa-qrcode"></i>-->
                            <!--                                    <strong>&nbsp;QR-code</strong>-->
                            <!--                                </div>-->
                            <!--                                <div class="col-xs-6">-->
                            <!--                                    <input name="prepress_social_qr" value="--><?//= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_social_qr"] ?><!--" type="text" class="form-control input-xs" placeholder="Typ hier de link..." />-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                        </li>-->
                            <!---->
                            <!--                        <li class="list-group-item">-->
                            <!--                            <div class="row">-->
                            <!--                                <div class="col-xs-6">-->
                            <!--                                    <i class="fa fa-globe"></i>-->
                            <!--                                    <strong>&nbsp;Overige</strong>-->
                            <!--                                </div>-->
                            <!--                                <div class="col-xs-6">-->
                            <!--                                    <input name="prepress_social_other" value="--><?//= @$aPrepress["HdIntPrplPrepressInstructions"]["prepress_social_other"] ?><!--" type="text" class="form-control input-xs" placeholder="Typ hier de link..." />-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                        </li>-->
                            <!---->
                            <!--                    </ul>-->

                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="/Order/<?= $aOrder["orderrule_id"] ?>" class="btn btn-sm btn-default btn-block"><i class="fa fa-share fa-flip-horizontal"></i> Terug</a>
                                </div>
                                <div class="col-xs-6">
                                    <button type="submit" name="submit" class="btn btn-sm bg-purple btn-block"><i class="fa fa-save"></i> Opslaan</button>
                                </div>
                            </div>

                        </form>


                    </div>

                    <!-- ADDITIONAL ORDER INFO -->
                    <div class="col-sm-6 col-lg-6">
                        <ul class="list-group">
                            <li class="list-group-item list-head-purple text-left">
                                <strong><i class="fa fa-file-o"></i> Ordergegevens</strong>
                                <div class="pull-right">
                                    <a href="/Order/<?= $aOrder["orderrule_id"] ?>/" class="btn bg-purple btn-xs">
                                        Bekijk order
                                    </a>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Medewerker</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?= $aOrder["employee_name"] ?>
                                        <i class="fa fa-phone hidden fa-margin-left" data-toggle="tooltip" data-placement="bottom" title="Tel. 111"></i>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Klantcode</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?= $aOrder["adres_code"] ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Klant</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?= $aOrder["adres_name"] ?>
                                        <a href="#" onclick="$('#myModal2').modal()" class="fa-margin-left">
                                            <i class="fa fa-info-circle fa-no-padding text-purple"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Ordernummer</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?= $aOrder["order_nr"] ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Artikelcode</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?= $aOrder["product_code"] ?>
                                        <a href="#" onclick="$('#myModal').modal()" class="fa-margin-left">
                                            <i class="fa fa-info-circle fa-no-padding text-purple"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Status</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <strong><?= $aStatus[$aOrder->HdIntPrplGeneral["general_status"]]["naam"] ?></strong>
                                        <i class="fa fa-pencil hidden fa-margin-left" data-toggle="tooltip" data-placement="bottom" title="xe wijziging"></i>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-12"><!-- btn-blink -->
                                        <button class="btn btn-sm btn-block bg-purple" onclick="$('#myModal3').modal()">Bekijk opmerkingen ( <?= number_format(count($aLog),0,",",".") ?> )</button>
                                    </div>
                                </div>
                            </li>


                        </ul>

                    </div>

                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
</div>



<style>
    .list-group.disabled, .list-group.disabled:hover{
        opacity: 0.5;
        pointer-events: none;
        cursor: not-allowed !important;
    }
</style>

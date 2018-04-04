<!-- LOAD MODALS -->
    <?= $this->element('Modals/Order/index/box_sticker'); ?>
    <?= $this->element('Modals/Order/index/delivery_address'); ?>
    <?= $this->element('Modals/Order/index/order_reprint'); ?>
    <?= $this->element('Modals/Order/index/new_artwork'); ?>
    <?= $this->element('Modals/Order/index/design_not_ok'); ?>
    <?= $this->element('Modals/Order/index/design_ok'); ?>
    <?= $this->element('Modals/Order/index/design_proof_ok'); ?>
    <?= $this->element('Modals/Order/index/proof_not_ok'); ?>
<!-- END MODALS -->

<!-- ORDER -->
<div class="box box-default">
    <div class="box-body">
        <div class="row">
                <!-- GENERAL ORDER INFO -->
                <div class="col-sm-6 col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item list-head-purple text-left">
                            <strong>
                                <i class="fa fa-file-o"></i> Order <?= $aOrder->order_nr ?>
                            </strong>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Orderdatum</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= date_format($aOrder->order_date, 'd-m-Y') ?>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Projectmanager</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= $aOrder->employee_name ?>
                                </div>
                            </div>
                        </li>


                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Klant</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= $aOrder->adres_name ?>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Orderomschr.</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= $aOrder->order_description ?>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Afleveradres</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?php if($aOrder->HdIntPrplGeneral->deliver_hodi == 1){ ?>
                                        <strong>Afleveren bij Hodi</strong>
                                    <?php }else{ ?>
                                        Afleveren bij klant
                                    <?php } ?>
                                    <a href="#" onclick="$('#myModal').modal()"  class="pull-right">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Aantal</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= number_format($aOrder->HdIntPrplGeneral->order_quantity_new,0,",",".") ?> / <?= number_format($aOrder->HdIntPrplGeneral->order_start_quantity,0,",",".") ?>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Soort artikel</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= $aOrder->ledger_name ?>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Artikelcode</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= $aOrder->FRbkhARTIKEL->BKHARCODE ?>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>

                <!-- ADDITIONAL ORDER INFO -->
                <div class="col-sm-6 col-lg-4">
                    <form method="post" action="/Order/saveRemarks/<?= $aOrder->orderrule_id ?>">
                        <ul class="list-group">
                            <li class="list-group-item list-head-purple text-left">
                                <strong><i class="fa fa-check-square"></i> Aanvullende opties</strong>
                                <span class="pull-right">
                                    <button type="submit" class="btn btn-xs bg-purple">Opslaan</button>
                                </span>
                            </li>

                            <li class="list-group-item text-left">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>FSC-order</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php if($aOrder->HdIntPrplGeneral->fsc_order == 1){ echo "Ja"; }else{ echo "Nee"; } ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item text-left">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Spoedorder</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php if($aOrder->HdIntPrplGeneral->priority == 1){ echo "Ja"; }else{ echo "Nee"; } ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Servet</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php
                                        foreach($aNapkin as $aNap){
                                            if($aNap["napkin_article_nrint"] == $aOrder->HdIntPrplGeneral->napkin_nrint) { $napkin = $aNap["napkin_name"]; }
                                        }
                                        echo isset($napkin) ? $napkin : "Geen servet geselecteerd";
                                        ?>

                                        <?php if($aOrder->HdIntPrplGeneral->general_status >= 100 || $aOrder->HdIntPrplGeneral->reprint == 1){ ?>
                                        <a href="/Order/Instructions/<?= $aOrder["orderrule_id"] ?>" class="pull-right">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Omdoos</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php
                                        foreach($aBox as $aNap){
                                            if($aNap["box_article_nrint"] == $aOrder->HdIntPrplGeneral->box_nrint) { $box = $aNap["box_name"]; }
                                        }
                                        echo isset($box) ? $box : "Geen omdoos geselecteerd";
                                        ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Art.variant</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php
                                        $aOptions = explode(",",$aOrder->HdIntPrplGeneral->article_editions);
                                        foreach($aEdition as $aEdit){
                                            if(in_array($aEdit["id"], $aOptions)){ $editions[] = $aEdit["edition_name"]; }
                                        }
                                        echo isset($editions) ? implode(", ", $editions) : "Geen varianten geselecteerd";
                                        ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Aantal per omdoos</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php if($aOrder->HdIntPrplGeneral->article_box_quantity == 0){
                                                   echo $aOrder->HdIntPrplGrootboekActief->box_quantity;
                                               }else{
                                                   echo $aOrder->HdIntPrplGeneral->article_box_quantity;
                                               } ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item no-padding no-border">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="hidden" name="id" value="<?= $aOrder->HdIntPrplGeneral->id ?>" />
                                        <textarea name="order_remarks" class="form-control" style=" height: 83px;" placeholder="Typ hier uw opmerking voor deze order..."><?php echo $aOrder->HdIntPrplGeneral["order_remarks"] != "" ? $aOrder->HdIntPrplGeneral["order_remarks"] : ""; ?></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>


                <!-- ORDER HISTORY -->
                <div class="visible-lg col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item list-head-purple text-left">
                            <strong><i class="fa fa-history"></i> Orderstatus</strong>
                            <div class="pull-right btn btn-xs bg-orange">
                                <strong>Verwachtte verzenddatum:</strong> <?= $aDeliveryDate->leverdatum <= "0000-00-00" ? "Niet bekend" : date('d-m-Y', strtotime($aDeliveryDate->leverdatum)) ?>
                            </div>
                        </li>
                        <li class="list-group-item text-left">
                            <strong><?= ucfirst($aStatus[$aOrder->HdIntPrplGeneral->general_status]["status_type"]) ?>:</strong> <?= $aStatus[$aOrder->HdIntPrplGeneral->general_status]["naam"] ?>
                            <em class="pull-right"><?= $aOrder["general_status_date"] ?></em>
                        </li>
                        <li class="list-group-item no-padding" style="height: 290px; overflow-y: auto;">
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
                                                    <?php $a = strtotime($log["timestamp"]->format('Y/m/d H:i:s')) ?>
<!--                                                    <strong>--><?//= strftime('%A %e %B', $log["timestamp"]) ?><!--</strong><br />-->
                                                    <strong><?= ucfirst(strftime("%A %#d %B %Y om %H:%M:%S", $a)) ?></strong><br />
                                                    <?= $log["log_title"] ?><br>
                                                    <em><?= stripslashes(nl2br($log["log_remark"])) ?></em>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>


                                </tbody>
                            </table>
                        </li>
                    </ul>
                </div>

                <!-- ALERT MEMO -->
                <?php if(isset($aPrepress["prepress_artwork_ok"]) && $aPrepress["prepress_artwork_ok"] == -1){ ?>
                    <div class="col-xs-12">
                        <a href="#" onclick="$('#newArtworkModel').modal()" class="btn btn-block btn-lg bg-purple btn-blink"><i class="fa fa-warning"></i> Lever nieuw artwork aan !!</a>
                        <br />
                    </div>

                <?php } ?>

                <!-- TEMP ORDER ALERT -->
                <?php if($aPrepress["HdIntPrplPrepressInstructions"]["direct_proof"] == 1){ ?>
                    <div class="col-xs-12">
                        <div class="callout callout-danger">
                            <h4 class="no-margin"><strong>LET OP:</strong> Studio heeft het design direct op drukproef gezet !!<br />Wanneer deze akkoord wordt gegeven, wordt de order direct verplaatst naar <em>Bestand uploaden</em></h4>
                        </div>
                    </div>
                <?php } ?>


                <div class="col-xs-12">
                    <div class="text-right">
                        <?= $this->element('order_button_prepress'); ?>
                        <?= $this->element('order_button_design_to_customer'); ?>
                        <?= $this->element('order_button_customer_design_answer'); ?>
                        <?= $this->element('order_button_proof_to_customer'); ?>
                        <?= $this->element('order_button_customer_proof_answer'); ?>


                        <br />&nbsp;
                    </div>

                    <?php foreach($aNotes as $note){ ?>
                    <div class="callout callout-warning">
                        <i class="fa fa-warning"></i> <?= $note["rule"] ?>
                    </div>
                    <?php } ?>

                    <!-- SHORTCUT BUTTONS -->
                    <div class="pull-right">

                        <button class="btn btn-sm bg-purple disabled"><i class="fa fa-file-o"></i> Bekijk design</button>
                        <button onclick="$('#myModalSticker').modal()" class="btn btn-sm bg-purple"><i class="fa fa-sticky-note-o"></i> Bekijk doossticker</button>

                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn bg-purple btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-file-pdf-o"></i> Pakbon downloaden&nbsp;&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <?php foreach($aPackingLists as $k => $aList){ ?>
                                    <li><a target="_pakbon" href="/pdf/packaging_list_cust/<?= $aList->pdf_title ?>.pdf">Pakbon zending <?= ($k + 1) ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>

                        <?php $dis1 = $aOrder->HdIntPrplGeneral->general_status < 102 ? "" : "disabled"; ?>
                        <a href="/Order/updateOrderQuantity/<?= $aOrder->orderrule_id ?>/" class="btn btn-sm bg-purple <?= $dis1 ?>">
                            <i class="fa fa-refresh"></i> Aantallen bijwerken
                        </a>
                    </div>

                    <div class="">

                        <ul class="nav nav-tabs">
                            <li class="active"><a href="##Overzicht" data-toggle="tab">Overzicht (999)</a></li>

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="Overzicht">

                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="400">Omschrijving</th>
                                        <th>Aanvullingen</th>
                                        <th width="80" class="text-right">Aantal</th>

                                        <th width="125" class="text-right">Begindatum</th>
                                        <th width="125" class="text-right">Einddatum</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>Orderinvoer Ohmega</td>
                                        <td></td>
                                        <td class="text-right"><?= number_format($aOrder->HdIntPrplGeneral->order_start_quantity,0,",",".") ?></td>
                                        <td class="text-right"><?= $aOrder["BKHORDATUM"] ?></td>
                                        <td class="text-right"></td>
                                    </tr>
                                    <?php $aLogRev = array_reverse($aLog->toArray()); ?>
                                    <?php foreach($aLogRev as $log){ if($log["log_order_table"] == 1){ ?>
                                    <tr>
                                        <td><?= $log["log_title"] ?></td>
                                        <td><?= $log["log_remark"] ?></td>
                                        <td class="text-right"><?= number_format($aOrder->HdIntPrplGeneral->order_start_quantity,0,",",".") ?></td>
                                        <td class="text-right"><?= $log["timestamp"]->format('d-m-Y') ?></td>
                                        <td class="text-right"><?= $log["log_enddate"] != null ? $log["log_enddate"]->format('d-m-Y') : "" ?></td>
                                    </tr>
                                    <?php }} ?>
                                    </tbody>
                                </table>

                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-pane -->

                    </div>

                </div>

            </div>

        </div>
    </div><!-- /.box-body -->

</div>
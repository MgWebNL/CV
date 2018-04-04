<script>
    function selectElementContents(el) {
        var body = document.body, range, sel;
        if (document.createRange && window.getSelection) {
            range = document.createRange();
            sel = window.getSelection();
            sel.removeAllRanges();
            try {
                range.selectNodeContents(el);
                sel.addRange(range);
            } catch (e) {
                range.selectNode(el);
                sel.addRange(range);
            }
        } else if (body.createTextRange) {
            range = body.createTextRange();
            range.moveToElementText(el);
            range.select();
        }
        document.execCommand('copy');
    }
</script>

<!-- Modal BoxSticker -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sticky-note-o"></i>Doossticker</h4>
            </div>
            <div class="modal-body no-padding">
                <ul class="list-group">

                    <li class="list-group-item">
                        <table class="table" id="sticker" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                                <th width="50%">Ordernumber:</th>
                                <td><?= $aOrder["order_nr"] ?></td>
                            </tr>
                            <tr>
                                <th align="right">Customer:</th>
                                <td><?= $aOrder["adres_name"] ?></td>
                            </tr>
                            <tr>
                                <th align="right">Design:</th>
                                <td><?= $aOrder["order_description"] ?></td>
                            </tr>
                            <tr>
                                <th align="right">Quantity:</th>
                                <td><?= $aOrder["HdIntPrplGeneral"]["article_box_quantity"] ?></td>
                            </tr>
                            <tr>
                                <th align="right">Reference:</th>
                                <td><?= $aOrder["order_reference"] ?></td>
                            </tr>
                            <?php if($bStickerWebsite == 1){ ?>
                            <tr>
                                <th align="right">Website:</th>
                                <td><strong><?= strtolower($aOrder["adres_website"]) ?></strong></td>
                            </tr>
                            <?php } ?>
                            </tbody></table>
                    </li>

                    <li class="list-group-item no-border">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <button type="button" onclick="selectElementContents( document.getElementById('sticker'))" class="btn btn-default bg-purple btn-sm btn-block">
                                    <i class="fa fa-copy"></i> Copy table
                                </button>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item no-border">
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <button type="button" class="btn btn-default bg-purple btn-sm btn-block" data-dismiss="modal">
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

<!-- ORDER -->
<div class="box box-default">

    <div class="box-body">
        <div class="row">
                <!-- GENERAL ORDER INFO -->
                <div class="col-sm-6 col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item list-head-purple text-left">
                            <strong>
                                <i class="fa fa-file-o"></i> Order <?= $aOrder["order_nr"] ?>
                            </strong>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Orderdatum</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= date_format($aOrder["order_date"], 'd-m-Y') ?>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Projectmanager</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= $aOrder["employee_name"] ?>
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
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Orderomschr.</strong>
                                </div>
                                <div class="col-xs-6">
                                    <?= $aOrder["order_description"] ?>
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
                                    <?= $aOrder["ledger_name"] ?>
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
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>

                <!-- ADDITIONAL ORDER INFO -->
                <div class="col-sm-6 col-lg-4">
                    <form method="post" action="/Order/saveRemarks/<?= $aOrder["orderrule_id"] ?>">
                        <ul class="list-group">
                            <li class="list-group-item list-head-purple text-left">
                                <strong><i class="fa fa-check-square"></i> Aanvullende opties</strong>
                            </li>

                            <li class="list-group-item text-left">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>FSC-order</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php if($aOrder["HdIntPrplGeneral"]["fsc_order"] == 1){ echo "Ja"; }else{ echo "Nee"; } ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item text-left">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <strong>Spoedorder</strong>
                                    </div>
                                    <div class="col-xs-6">
                                        <?php if($aOrder["HdIntPrplGeneral"]["priority"] == 1){ echo "Ja"; }else{ echo "Nee"; } ?>
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
                                            if($aNap["napkin_article_nrint"] == $aOrder["HdIntPrplGeneral"]["napkin_nrint"]) { $napkin = $aNap["napkin_name"]; }
                                        }
                                        echo isset($napkin) ? $napkin : "Geen servet geselecteerd";
                                        ?>
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
                                            if($aNap["box_article_nrint"] == $aOrder["HdIntPrplGeneral"]["box_nrint"]) { $box = $aNap["box_name"]; }
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
                                        $aOptions = explode(",",$aOrder["HdIntPrplGeneral"]["article_editions"]);
                                        foreach($aEdition as $aEdit){
                                            if(in_array($aEdit["id"], $aOptions)){ $editions[] = $aEdit["edition_name"]; }
                                        }
                                        echo isset($editions) ? implode(",", $editions) : "Geen varianten geselecteerd";
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
                                        <?php echo $aOrder["HdIntPrplGeneral"]["article_box_quantity"]; ?>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item no-padding no-border">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="hidden" name="id" value="<?= $aOrder["orderrule_id"] ?>" />
                                        <textarea name="order_remarks" class="form-control" style="resize: none; height: 42px;"></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>


                <!-- ORDER HISTORY -->
                <div class="visible-lg col-lg-4">
                    <?php if($aOrder["HdIntPrplGeneral"]["order_remarks"] != ""){ ?>
                        <div class="callout callout-danger">
                            <i class="fa fa-warning"></i> <?= $aOrder["HdIntPrplGeneral"]["order_remarks"] ?>
                        </div>
                    <?php } ?>
                    <?php foreach($aNotes as $note){ ?>
                        <div class="callout callout-warning">
                            <i class="fa fa-warning"></i> <?= $note["rule"] ?>
                        </div>
                    <?php } ?>

                    <button class="btn btn-block bg-purple disabled"><i class="fa fa-file-o"></i> Bekijk design</button>
                    <button onclick="$('#myModal').modal()" class="btn btn-block bg-purple"><i class="fa fa-sticky-note-o"></i> Bekijk doossticker</button>

                    <div class="btn-group btn-block">
                        <button type="button" class="btn bg-purple btn-block dropdown-toggle disabled" data-toggle="dropdown">
                            <i class="fa fa-file-pdf-o"></i> Pakbon downloaden&nbsp;&nbsp;<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu btn-block" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>

                    <br />
                    <br />
                    <a href="/Dashboard/" class="btn btn-block bg-purple"><i class="fa fa-share fa-flip-horizontal"></i> Terug</a>
                </div>

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
                            <th width="125" class="text-right">Datum</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>Orderinvoer Ohmega</td>
                            <td></td>
                            <td class="text-right"><?= $aOrder["order_date"]->format("d-m-Y") ?></td>
                            <td class="text-right"></td>
                        </tr>
                        <?php $aLogRev = array_reverse($aLog->toArray()); ?>
                        <?php foreach($aLogRev as $log){ if($log["log_order_table"] == 1){ ?>
                            <tr>
                                <td><?= $log["log_title"] ?></td>
                                <td><?= $log["log_remark"] ?></td>
                                <td class="text-right"><?= $log["timestamp"]->format('d-m-Y') ?></td>
                            </tr>
                        <?php }} ?>
                        </tbody>
                    </table>

                </div><!-- /.tab-pane -->
            </div><!-- /.tab-pane -->

        </div>

        </div>
    </div><!-- /.box-body -->

</div>
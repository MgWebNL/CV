<?php
use Cake\I18n\Time;
$aPrio = [1 => "priority", 0 => "plain"];
?>

<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-cog"></i> <?= __('Wacht op ontvangst') ?></h3>
        <div class="pull-right">
            <?php if($adminlogin["rights"] === true || $adminlogin["rights"] != '2'){ ?>
                <a href="#" id="export" onClick="fnExcelReport('table2excel', 'Wacht op ontvangst');" class="btn btn-xs bg-purple">
                    <i class="fa fa-file-excel-o"></i> <?= __('Maak export') ?>
                </a>
            <?php } ?>
        </div>
    </div>

    <div class="box-body">


            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab"><?= __('Overzicht') ?> (<?= $aOrders->count() ?>)</a></li>
                <?php foreach($aCompanies as $aItem){ ?>
                    <li><a href="#tab_<?= $aItem["BKHADNRINT"] ?>" data-toggle="tab"><?= $aItem["HdIntPrplCompanies"]["adres_alias"] ?> (<?= @count($aGrouped[$aItem["BKHADNRINT"]]) ?>)</a></li>
                <?php } ?>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">

                    <?php if($aOrders->count() == 0){ ?>
                        <br/><p class="alert alert-warning"><?= __('Geen orders in de hoofdstatus') ?> <b><?= __('Wacht op ontvangst') ?></b></p>
                    <?php }else{ ?>
                        <?php $total = 0; ?>
                        <table class="table table-condensed table-hover" id="table2excel">
                            <thead>
                            <tr>
                                <th width="20"></th>
                                <th width="80"><?= __('Ordernr.') ?></th>
                                <th width="100"><?= __('Datum') ?></th>
                                <th width="250"><?= __('Klant') ?></th>
                                <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                <th width="100"><?= __('Artikelnr.') ?></th>
                                <th><?= __('Omschrijving') ?></th>
                                <th width="200"><?= __('Drukkerij') ?></th>
                                <th width="25"></th>
                            </tr>
                            </thead>

                            <?php foreach($aPrio as $prio => $class){ ?>
                                <tbody class="<?= $class ?>">
                                <?php foreach($aOrders as $aOrder){ ?>
                                    <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>
                                        <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                                            <td><?= ($prio == 1) ? '<i class="fa fa-bolt text-warning fa-no-margin"></i>' : '' ?></td>
                                            <td><?= $aOrder->order_nr ?></td>
                                            <td><?= $aOrder->order_date->format('d-m-Y') ?></td>
                                            <td><?= $aOrder->adres_name ?></td>
                                            <td class="text-right">
                                                <?php
                                                    if($aOrder->HdIntPrplGeneral->order_start_quantity != $aOrder->HdIntPrplGeneral->order_quantity_new && $aOrder->HdIntPrplGeneral->order_quantity_new != 0){
                                                        $startQty = $aOrder->HdIntPrplGeneral->order_start_quantity;
                                                        $newQty =  $aOrder->HdIntPrplGeneral->order_quantity_new;
                                                    }else{
                                                        $startQty = null;
                                                        $newQty =  $aOrder->HdIntPrplGeneral->order_start_quantity;
                                                    }
                                                ?>
                                                <?= !is_null($startQty) ? "<abbr title='Beginhoeveelheid: ".number_format($startQty,0,",",".")."'>".number_format($newQty,0,",",".")."</abbr>" : number_format($newQty,0,",","."); ?>
                                            </td>
                                            <td><?= $aOrder->product_code ?></td>
                                            <td>
                                                <?= $aOrder->order_description ?>
                                                <?php if($aOrder->HdIntPrplGeneral->fsc_order == 1){ echo "<i class='fa fa-leaf text-success'></i>"; } ?>
                                                <?php if($aOrder->HdIntPrplGeneral->order_remarks != ""){ echo "<br><small class='text-danger'>".$aOrder->HdIntPrplGeneral->order_remarks."</small>"; } ?>
                                                <?php if(isset($aExceptions[$aOrder->adres_code])){
                                                    foreach($aExceptions[$aOrder->adres_code] as $note){
                                                        echo "<br><small class='text-danger'>".$note["rule"]."</small>";
                                                    }
                                                } ?>
                                                <?php
                                                $a = explode(",",$aOrder->HdIntPrplGeneral->article_editions);
                                                if(strlen(implode('', $a)) != 0){
                                                    echo "<br />";
                                                    foreach($a as $option){
                                                        if(isset($aEditie[$option])){
                                                            echo "<div class='label label-success'>".$aEditie[$option]["edition_name"]."</div>&nbsp;";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?= $aCompanies[$aOrder->HdIntPrplPrinting->adres_nrint]->HdIntPrplCompanies->adres_alias ?></td>
                                            <td><a href="/Order/<?= $aOrder->orderrule_id ?>" class="btn btn-xs bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                                        </tr>
                                        <?php $total += $newQty ?>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                            <?php } ?>
                            <tfoot>
                            <th></th>
                            <th colspan="3">Totaal</th>
                            <th class="text-right"><?= \Cake\I18n\Number::precision($total,0); ?></th>
                            <th colspan="4"></th>
                            </tfoot>

                        </table>

                    <?php } ?>

                </div><!-- /.tab-pane -->

                <?php foreach($aCompanies as $aItem){ ?>
                    <div class="tab-pane" id="tab_<?= $aItem["BKHADNRINT"] ?>">

                        <form action="/Prepackaging/ConfirmPackagingOrder/" method="post">
                            <input type="hidden" name="company_nrint" value="<?= $aItem["BKHADNRINT"] ?>" />
                            <?php if(@count($aGrouped[$aItem["BKHADNRINT"]]) == 0){ ?>
                                <br/><p class="alert alert-warning"><?= __('Geen verwachte zendingen van') ?> <b><?= $aItem["HdIntPrplCompanies"]["adres_alias"] ?></b></p>
                            <?php }else{ ?>
                                <?php $total = 0; ?>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="20"><input type="checkbox" data-find="<?= $aItem["BKHADNRINT"] ?>" id="checkAll" /></th>
                                        <th width="80"><?= __('Ordernr.') ?></th>
                                        <th width="100"><?= __('Datum') ?></th>
                                        <th width="250"><?= __('Klant') ?></th>
                                        <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                        <th width="100"><?= __('Artikelnr.') ?></th>
                                        <th><?= __('Omschrijving') ?></th>
                                        <th width="200"><?= __('Verzenddatum') ?></th>
                                        <th width="200"><?= __('Napkin') ?></th>
                                    </tr>
                                    </thead>

                                    <?php foreach($aPrio as $prio => $class){ ?>
                                        <tbody class="<?= $class ?>">
                                        <?php foreach($aOrders as $aOrder){ ?>
                                            <?php if($aOrder->HdIntPrplPrinting->adres_nrint == $aItem["BKHADNRINT"]){ ?>
                                                <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>
                                                    <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                                                        <td><input data-checkbox-group="<?= $aItem["BKHADNRINT"] ?>" type="checkbox" name="order_nrint[]" value="<?= $aOrder->orderrule_id ?>" /></td>
                                                        <td><?= $aOrder->order_nr ?></td>
                                                        <td><?= $aOrder->order_date->format('d-m-Y') ?></td>
                                                        <td><?= $aOrder->adres_name ?></td>
                                                        <td class="text-right">
                                                            <?php
                                                            if($aOrder->HdIntPrplGeneral->order_start_quantity != $aOrder->HdIntPrplGeneral->order_quantity_new && $aOrder->HdIntPrplGeneral->order_quantity_new != 0){
                                                                $startQty = $aOrder->HdIntPrplGeneral->order_start_quantity;
                                                                $newQty =  $aOrder->HdIntPrplGeneral->order_quantity_new;
                                                            }else{
                                                                $startQty = null;
                                                                $newQty =  $aOrder->HdIntPrplGeneral->order_start_quantity;
                                                            }
                                                            ?>
                                                            <?= !is_null($startQty) ? "<abbr title='Beginhoeveelheid: ".number_format($startQty,0,",",".")."'>".number_format($newQty,0,",",".")."</abbr>" : number_format($newQty,0,",","."); ?>
                                                        </td>
                                                        <td><?= $aOrder->product_code ?></td>
                                                        <td>
                                                            <?= $aOrder->order_description ?>
                                                            <?php if($aOrder->HdIntPrplGeneral->fsc_order == 1){ echo "<i class='fa fa-leaf text-success'></i>"; } ?>
                                                            <?php if($aOrder->HdIntPrplGeneral->order_remarks != ""){ echo "<br><small class='text-danger'>".$aOrder->HdIntPrplGeneral->order_remarks."</small>"; } ?>
                                                            <?php if(isset($aExceptions[$aOrder->adres_code])){
                                                                foreach($aExceptions[$aOrder->adres_code] as $note){
                                                                    echo "<br><small class='text-danger'>".$note["rule"]."</small>";
                                                                }
                                                            } ?>
                                                            <?php
                                                            $a = explode(",",$aOrder->HdIntPrplGeneral->article_editions);
                                                            if(strlen(implode('', $a)) != 0){
                                                                echo "<br />";
                                                                foreach($a as $option){
                                                                    if(isset($aEditie[$option])){
                                                                        echo "<div class='label label-success'>".$aEditie[$option]["edition_name"]."</div>&nbsp;";
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $aOrder->HdIntPrplPrinting->done_date ?></td>
                                                        <td><?= $aOrder->HdIntPrplGeneral->HdIntPrplNapkins->napkin_name ?></td>
                                                    </tr>
                                                    <?php $total += $newQty ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        </tbody>
                                    <?php } ?>

                                    <tfoot>
                                    <th></th>
                                    <th colspan="3">Totaal</th>
                                    <th class="text-right"><?= \Cake\I18n\Number::precision($total,0); ?></th>
                                    <th colspan="4"></th>
                                    </tfoot>





















                                </table>

                                <div class="pull-right form-inline">
                                    <button type="submit" name="submit" value="submitProformaBottom" class="btn bg-purple btn-sm">
                                        <i class="fa fa-file-pdf-o"></i> <?= __('Maak ontvangstlijst') ?> <?= $aItem["HdIntPrplCompanies"]["adres_alias"] ?>
                                    </button>
                                </div>
                                <div class="clearfix"></div>

                            <?php } ?>

                        </form>
                    </div><!-- /.tab-pane -->

                <?php } ?>
            </div><!-- /.tab-pane -->

            <div class="clearfix"></div>
        </div><!-- /.tab-content -->



    </form>

</div><!-- /.box-body -->
</div>

<script>
    $("[data-find").change(function () {
        $("[data-checkbox-group='"+$(this).data('find')+"']").prop('checked', $(this).prop("checked"));
    });
</script>
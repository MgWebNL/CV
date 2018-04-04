<?php
$session = $this->request->session()->read("adminlogin")["supplier_nrint"] == "" || $this->request->session()->read("adminlogin")["supplier_nrint"] == "C86OEET2" ? $this->request->session()->read("intake") : $this->request->session()->read("adminlogin")["supplier_nrint"];
?>

<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-cog"></i> <?= __('Orders onderweg naar Nederland') ?></h3>
        <div class="pull-right">
            <?php if($adminlogin["rights"] === true || $adminlogin["rights"] != '2'){ ?>
                <a href="#" id="export" onClick="fnExcelReport('table2excel', 'Ontvangst verpakker');" class="btn btn-xs bg-purple">
                    <i class="fa fa-file-excel-o"></i> <?= __('Maak export') ?>
                </a>
            <?php } ?>
        </div>
    </div>

    <div class="box-body">

            <ul class="nav nav-tabs">
                <?php if($session == ""){ ?>
                <li class="active"><a href="#tab_1-1" data-toggle="tab"><?= __('Overzicht') ?> (<?= $this->Subcount->makeSubCount($aOrders, "in_nl", "0", "0") ?>)</a></li>
                <?php } foreach($aCompany as $company){
                    if($session == $company["BKHADNRINT"]){ ?>
                    <li class="active">
                        <a href="#<?= $company["BKHADNRINT"] ?>" data-toggle="tab">
                            <?= __('Overzicht') ?> (<?= $this->Subcount->makeSubCount($aOrders, "adres_nrint", $company["BKHADNRINT"], 0, "HdPackaging") ?>)
                        </a>
                    </li>
                <?php }} ?>
                <!-- SHORTCUT BUTTONS -->
                <?php if($this->request->session()->read("adminlogin")["supplier_nrint"] == ""){ ?>
                    <div class="pull-right">
                        <form method="post" action="/Transport/setSession/intake/">
                            <select name="transport_nrint" onchange="this.form.submit()" required="required">
                                <option value=""><?= __('Selecteer verpakker') ?></option>
                                <?php foreach($aCompany as $company){ ?>
                                    <option value="<?= $company["BKHADNRINT"] ?>" <?= $session == $company["BKHADNRINT"] ? "selected" : "" ?>>
                                        <?php
                                        if($company["company"]["adres_alias"] != "") {
                                            echo $company["company"]["adres_alias"];
                                        }else{
                                            echo $company["BKHADNAAM"];
                                        } ?>
                                        (<?= $this->Subcount->makeSubCount($aOrders, "adres_nrint", $company["BKHADNRINT"], 0, "HdPackaging") ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </form>
                    </div>
                <?php } ?>
            </ul>

            <div class="tab-content">
                <?php if($session == ""){ ?>
                    <div class="tab-pane active" id="tab_1-1">

                        <?php if($this->Subcount->makeSubCount($aOrders, "in_nl", "0", "0") == 0){ ?>
                            <br/><p class="alert alert-warning"><?= __('Geen orders in de hoofdstatus') ?> <b><?= __('Transport') ?></b></p>
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
                                    <th width="200" class="text-right"><?= __('Onderweg') ?></th>
                                </tr>
                                </thead>

                                <tbody class="priority">
                                <?php
                                $total = 0;
                                foreach($aOrders as $aOrder){
                                    $total += $aOrder->HdIntPrplPartialDelivery->quantity_send;
                                    ?>
                                        <tr data-touch-href="/Order/<?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->orderrule_id ?>" <?php if($aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->fsc_order == 1){ echo "class='success'"; } ?>>
                                            <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                                            <td><?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->order_nr ?></td>
                                            <td><?= $aOrder->wait_nl_date->format('d-m-Y') ?></td>
                                            <td><?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->adres_name ?></td>
                                            <td class="text-right">
                                                <?php
                                                if($aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity != $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new && $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new != 0){
                                                    $startQty = $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity;
                                                    $newQty =  $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new;
                                                }else{
                                                    $startQty = null;
                                                    $newQty =  $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity;
                                                }
                                                ?>
                                                <?= !is_null($startQty) ? "<abbr title='Beginhoeveelheid: ".number_format($startQty,0,",",".")."'>".number_format($newQty,0,",",".")."</abbr>" : number_format($newQty,0,",","."); ?>
                                            </td>
                                            <td><?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->product_code ?></td>
                                            <td>
                                                <?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->order_description ?>
                                                <?php if($aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->fsc_order == 1){ echo "<i class='fa fa-leaf text-success'></i>"; } ?>
                                                <?php if($aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_remarks != ""){ echo "<br><small class='text-danger'>".$aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_remarks."</small>"; } ?>
                                                <?php if(isset($aExceptions[$aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->adres_code])){
                                                    foreach($aExceptions[$aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->adres_code] as $note){
                                                        echo "<br><small class='text-danger'>".$note["rule"]."</small>";
                                                    }
                                                } ?>
                                                <?php
                                                $a = explode(",",$aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->article_editions);
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
                                            <td class="text-right">
                                                <?= $aOrder->daysToInvoice ?> <?= __('dagen') ?>
                                            </td>
                                        </tr>
                                        <?php $total += $newQty; ?>
                                    <?php } ?>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th colspan="3"><?= __('Totaal') ?></th>
                                    <th class="text-right"><?= number_format($total,0,",",".") ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>

                            </table>
                        <?php } ?>

                    </div><!-- /.tab-pane -->
                <?php } ?>

                <?php foreach($aCompany as $company){ ?>
                    <?php if($session == $company["BKHADNRINT"]){ ?>
                    <div class="tab-pane active" id="<?= $company["BKHADNRINT"] ?>">
                        <form method="post" action="/Transport/setReceiveDate/">
                        <?php if(@count($aGrouped[$company["BKHADNRINT"]]) == 0){ ?>
                            <br/>
                            <p class="alert alert-warning">
                                <?= __('Geen orders bij') ?>
                                <b>
                                    <?php
                                    if($company["company"]["adres_alias"] != "") {
                                        echo $company["company"]["adres_alias"];
                                    }else{
                                        echo $company["BKHADNAAM"];
                                    } ?>
                                </b>
                            </p>
                        <?php }else{ ?>
                            <?php $total = 0; ?>
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th width="80"><?= __('Ordernr.') ?></th>
                                    <th width="100"><?= __('Datum') ?></th>
                                    <th width="250"><?= __('Klant') ?></th>
                                    <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                    <th width="100"><?= __('Artikelnr.') ?></th>
                                    <th><?= __('Omschrijving') ?></th>
                                    <th width="200" class="text-right"><?= __('Onderweg') ?></th>
                                    <th width="100" class="text-right"><?= __('Eindbestemming') ?></th>
                                </tr>
                                </thead>

                                <tbody class="priority">
                            <?php
                            $total = 0;
                            foreach($aGrouped[$company["BKHADNRINT"]] as $aOrder){
                                    if($aOrder->HdIntPrplPackaging->adres_nrint == $session){
                                        $total += $aOrder->HdIntPrplPartialDelivery->quantity_send;
                                        ?>
                                        <tr data-touch-href="/Order/<?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->orderrule_id ?>" <?php if($aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->fsc_order == 1){ echo "class='success'"; } ?>>
                                            <td><?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->order_nr ?></td>
                                            <td><?= $aOrder->wait_nl_date->format('d-m-Y') ?></td>
                                            <td><?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->adres_name ?></td>
                                            <td class="text-right">
                                                <?php
                                                if($aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity != $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new && $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new != 0){
                                                    $startQty = $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity;
                                                    $newQty =  $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new;
                                                }else{
                                                    $startQty = null;
                                                    $newQty =  $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity;
                                                }
                                                ?>
                                                <?= !is_null($startQty) ? "<abbr title='Beginhoeveelheid: ".number_format($startQty,0,",",".")."'>".number_format($newQty,0,",",".")."</abbr>" : number_format($newQty,0,",","."); ?>
                                            </td>
                                            <td><?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->product_code ?></td>
                                            <td>
                                                <?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->order_description ?>
                                                <?php if($aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->fsc_order == 1){ echo "<i class='fa fa-leaf text-success'></i>"; } ?>
                                                <?php if($aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_remarks != ""){ echo "<br><small class='text-danger'>".$aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_remarks."</small>"; } ?>
                                                <?php if(isset($aExceptions[$aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->adres_code])){
                                                    foreach($aExceptions[$aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->adres_code] as $note){
                                                        echo "<br><small class='text-danger'>".$note["rule"]."</small>";
                                                    }
                                                } ?>
                                                <?php
                                                $a = explode(",",$aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->article_editions);
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
                                            <td class="text-right">
                                                <?= $aOrder->daysToInvoice ?> <?= __('dagen') ?>
                                            </td>
                                            <td class="text-right">
                                                <input type="hidden" name="id[<?= $aOrder->id ?>]" value="<?= $aOrder->order_nrint ?>" />
                                                <select name="destination[<?= $aOrder->id ?>]">
                                                    <option value="">- Maak keuze -</option>
                                                    <option value="1" <?= $aOrder->loading_order == 1 ? "selected" : "" ?>>Klant</option>
                                                    <option value="-1" <?= $aOrder->loading_order == -1 ? "selected" : "" ?>>Hodi</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php $total += $newQty; ?>
                                    <?php }} ?>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th colspan="3"><?= __('Totaal') ?></th>
                                    <th class="text-right"><?= number_format($total,0,",",".") ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>

                            <div class="pull-right">
                                <button type="submit" name="submit" value="saveAndShowBatch" class="btn btn-sm bg-purple"><i class="fa fa-file-o"></i> <?= __('Bevestig ontvangsten') ?></button>
                            </div>

                        <?php } ?>
                        <div class="clearfix"></div>
                    </div><!-- /.tab-pane -->
                    </form>
                <?php }} ?>
            </div><!-- /.tab-pane -->


    </div><!-- /.tab-content -->

</div><!-- /.box-body -->
</div>


<script>
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>
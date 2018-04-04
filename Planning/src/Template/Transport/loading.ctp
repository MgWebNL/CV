<?php
$session = $this->request->session()->read("adminlogin")["supplier_nrint"] == "" || $this->request->session()->read("adminlogin")["supplier_nrint"] == "C86OEET2" ? $this->request->session()->read("intake") : $this->request->session()->read("adminlogin")["supplier_nrint"];
?>

<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-cog"></i> <?= __('Laadvolgorde Orders') ?></h3>
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
                <li class="active"><a href="#tab_1-1" data-toggle="tab"><?= __('Overzicht') ?> (<?= $this->Subcount->makeSubCount($aOrders, "in_nl", "0", "0") ?>)</a></li>
            </ul>

            <div class="tab-content">

                    <div class="tab-pane active" id="tab1_1">
                        <form method="post" action="/Transport/setLoadingOrder/">
                        <?php if(count($aOrders) == 0){ ?>
                            <br/>
                            <p class="alert alert-warning">
                                <?= __('Geen orders bij wachtende op indeling') ?>
                            </p>
                        <?php }else{ ?>

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
                                    <th width="100" class="text-right"><?= __('Laadvolgorde') ?></th>
                                </tr>
                                </thead>

                                <tbody class="priority">
                            <?php
                            $total = 0;
                            foreach($aOrders as $aOrder){
                                        $total += $aOrder->HdIntPrplPartialDelivery->quantity_send;
                                        ?>
                                        <tr data-touch-href="/Order/<?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->orderrule_id ?>">
                                            <td><?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->order_nr ?></td>
                                            <td><?= $aOrder->wait_nl_date->format('d-m-Y') ?></td>
                                            <td><?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->adres_name ?></td>
                                            <td class="text-right"><?= number_format($aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new,0,",",".") ?></td>
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

                                                    <option value="1">Laden</option>
                                                    <option value="-1">Als eerste laden</option>
                                                    <option value="">Niet laden</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <div class="pull-right">
                                <button type="submit" name="submit" value="saveAndShowBatch" class="btn btn-sm bg-purple">
                                    <i class="fa fa-file-o"></i> <?= __('Bevestig volgorde') ?>
                                </button>
                            </div>

                        <?php } ?>
                        <div class="clearfix"></div>
                    </div><!-- /.tab-pane -->
                </form>


    </div><!-- /.tab-content -->

</div><!-- /.box-body -->
</div>


<script>
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>
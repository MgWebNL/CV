<?php
$session = $this->request->session()->read("adminlogin")["supplier_nrint"] == "" || $this->request->session()->read("adminlogin")["supplier_nrint"] == "C86OEET2" ? $this->request->session()->read("intake") : $this->request->session()->read("adminlogin")["supplier_nrint"];
?>

<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-cog"></i> <?= __('Orders aanmelden voor transport') ?></h3>
    </div>

    <div class="box-body">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab"><?= __('Overzicht') ?> (<?= $this->Subcount->makeSubCount($aOrders, "in_nl", "1", "0") ?>)</a></li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane active" id="tab">
                    <form method="post" action="/Transport/setTransportAssignment/">
                    <?php if($this->Subcount->makeSubCount($aOrders, "in_nl", "1", "0") == 0){ ?>
                        <br/>
                        <p class="alert alert-warning">
                            <?= __('Geen orders bij') ?>
                            <b>aanmelden transport</b>
                        </p>
                    <?php }else{ ?>
                        <?php $total = 0; ?>
                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th width="20"><input type="checkbox" id="checkAll" /></th>
                                <th width="80"><?= __('Ordernr.') ?></th>
                                <th width="100"><?= __('Datum') ?></th>
                                <th width="250"><?= __('Klant') ?></th>
                                <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                <th width="100"><?= __('Artikelnr.') ?></th>
                                <th><?= __('Omschrijving') ?></th>
                                <th width="200" class="text-right"><?= __('Bij Hodi') ?></th>
                                <th width="100" class="text-right"><?= __('Pallets') ?></th>
                            </tr>
                            </thead>

                            <tbody class="priority">
                            <?php
                            $total = 0;
                            foreach($aOrders as $aOrder){
                                    $total += $aOrder->HdIntPrplPartialDelivery->quantity_send;
                                    ?>
                                    <tr data-touch-href="/Order/<?= $aOrder->HdIntPrplPartialDelivery->HdIntPrplViewItem->orderrule_id ?>">
                                        <td><input type="checkbox" name="id[<?= $aOrder->id ?>]" value="<?= $aOrder->order_nrint ?>" /></td>
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
                                            <?= $aOrder->total_colli ?> pallets
                                            <input style="width:100%;text-align:right;" value="<?= $aOrder->total_colli ?>" type="hidden" name="pallets[<?= $aOrder->id ?>]" />
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

                        <div class="pull-right">
                            <div class="form-inline form-group">
                                <select class="form-control" name="transporter_code" required>
                                    <option value="">- Selecteer een vervoerder -</option>
                                    <option value="ECK">Van Eck</option>

                                </select>
                                <button type="submit" name="submit" value="saveAndShowBatch" class="btn btn-sm bg-purple"><i class="fa fa-truck"></i> <?= __('Maak transportorder(s)') ?></button>
                            </div>
                        </div>

                        <?php } ?>

                        <div class="clearfix"></div>
                    </form>
                </div><!-- /.tab-pane -->

        </div><!-- /.tab-pane -->


    </div><!-- /.tab-content -->

</div><!-- /.box-body -->
</div>


<script>
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>
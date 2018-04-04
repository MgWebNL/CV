<?php
    use Cake\I18n\Time;
    $aPrio = [1 => "priority", 0 => "plain"];
?>

<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-print"></i> <?= __('Batch') ?> &apos;<?= __('Orders gereed') ?>&apos;</h3>
    </div>

    <div class="box-body">

        <form method="post" action="/Printing/saveBatchToPackaging/">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab"><?= __('Overzicht') ?> (<?= $this->Subcount->makeSubCount($aBatch, "general_status", "-1", "1", "order") ?>)</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">


                    <table class="table table-condensed table-hover">
                        <thead>
                        <tr>
                            <th width="20"></th>
                            <th width="80"><?= __('Ordernr.') ?></th>
                            <th width="100"><?= __('Datum') ?></th>
                            <th width="100"><?= __('Artikelnr.') ?></th>
                            <th><?= __('Omschrijving') ?></th>

                            <th width="80" class="text-right"><?= __('Aantal') ?></th>
                            <th width="80" class="text-right"><?= __('Geproduceerd') ?></th>
                            <th width="80" class="text-right"><?= __('Afwijking') ?></th>
                            <th width="80" class="text-right"><?= __('Pallet') ?></th>
                        </tr>
                        </thead>



                        <?php foreach($aPrio as $prio => $class){ ?>
                            <tbody class="<?= $class ?>">
                            <?php foreach($aBatch as $aOrder){ ?>
                                <?php if($aOrder->HdIntPrplViewItem->HdIntPrplGeneral->priority == $prio){ ?>
                                    <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                                        <td><?= ($prio == 1) ? '<i class="fa fa-bolt text-warning fa-no-margin"></i>' : '' ?></td>
                                        <td><?= $aOrder->HdIntPrplViewItem->order_nr ?></td>
                                        <td><?= $aOrder->HdIntPrplViewItem->order_date ?></td>
                                        <td><?= $aOrder->HdIntPrplViewItem->product_code ?></td>
                                        <td>
                                            <?= $aOrder->HdIntPrplViewItem->order_description ?>
                                            <?php if($aOrder->HdIntPrplViewItem->HdIntPrplGeneral->fsc_order == 1){ echo "<i class='fa fa-leaf text-success'></i>"; } ?>
                                            <?php if($aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_remarks != ""){ echo "<br><small class='text-danger'>".$aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_remarks."</small>"; } ?>
                                            <?php if(isset($aExceptions[$aOrder->HdIntPrplViewItem->adres_code])){
                                                foreach($aExceptions[$aOrder->HdIntPrplViewItem->adres_code] as $note){
                                                    echo "<br><small class='text-danger'>".$note["rule"]."</small>";
                                                }
                                            } ?>
                                            <?php
                                            $a = explode(",",$aOrder->HdIntPrplViewItem->HdIntPrplGeneral->article_editions);
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
                                        <td class="text-right"><?= number_format($aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity,0,",",".") ?></td>
                                        <td class="text-right"><?= number_format($aOrder->quantity,0,",",".") ?></td>
                                        <td class="text-right"><?= number_format(($aOrder->quantity - $aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity),0,",",".") ?></td>
                                        <td class="text-right">
                                            <input required pattern="([1-9\,]+)" type="text" class="form-control input-sm" name="pallets[<?= $aOrder->HdIntPrplViewItem->orderrule_id ?>]" value="" />
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        <?php } ?>
                    </table>

                </div><!-- /.tab-pane -->

            </div><!-- /.tab-pane -->

            <!-- SHORTCUT BUTTONS -->
            <br />
            <div class="row">
                <div class="col-xs-12">
                    <a href="/Printing/" class="btn btn-sm bg-gray"><i class="fa fa-share fa-flip-horizontal"></i> <?= __('Terug') ?></a>
                    <button type="submit" name="submit" value="saveBatch" class="btn btn-sm bg-purple pull-right"><i class="fa fa-send"></i> <?= __('Aanmelden bij verpakker') ?></button>
                </div>
            </div>

        </form>

    </div><!-- /.tab-content -->

</div><!-- /.box-body -->
</div>
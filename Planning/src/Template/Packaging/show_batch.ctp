<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-cog"></i> <?= __('Batch') ?> &apos;<?= __('Machine gereed') ?>&apos;</h3>
    </div>

    <div class="box-body">

        <form method="post" action="/Packaging/saveBatchToPack/">

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
                        </tr>
                        </thead>

                        <tbody class="priority">
                        <?php
                        foreach($aBatch as $aOrder){
                            if($aOrder["order"]["priority"] == 1){
                                ?>
                                <tr <?php if($aOrder->order->fsc_order == 1){ echo "class='success'"; } ?>>
                                    <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                                    <td><?= $aOrder->order->BKHORNR ?></td>
                                    <td><?= $aOrder->order->BKHORDATUM->format('d-m-Y') ?></td>
                                    <td><?= $aOrder->order->BKHARCODE ?></td>
                                    <td><?= $aOrder->order->BKHOROMS ?></td>

                                    <td class="text-right"><?= number_format($aOrder->order->order_quantity_new,0,",",".") ?></td>
                                    <td class="text-right"><?= number_format($aOrder->quantity,0,",",".") ?></td>
                                    <td class="text-right"><?= number_format(($aOrder->quantity - $aOrder->order->order_quantity_new),0,",",".") ?></td>
                                </tr>
                            <?php }} ?>
                        </tbody>

                        <tbody class="plain">
                        <?php
                        foreach($aBatch as $aOrder){
                            if($aOrder->order["priority"] != 1){
                                ?>
                                <tr <?php if($aOrder->order->fsc_order == 1){ echo "class='success'"; } ?>>
                                    <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                                    <td><?= $aOrder->order->BKHORNR ?></td>
                                    <td><?= $aOrder->order->BKHORDATUM->format('d-m-Y') ?></td>
                                    <td><?= $aOrder->order->BKHARCODE ?></td>
                                    <td><?= $aOrder->order->BKHOROMS ?></td>

                                    <td class="text-right"><?= number_format($aOrder->order->order_quantity_new,0,",",".") ?></td>
                                    <td class="text-right"><?= number_format($aOrder->quantity,0,",",".") ?></td>
                                    <td class="text-right"><?= number_format(($aOrder->quantity - $aOrder->order->order_quantity_new),0,",",".") ?></td>
                                </tr>
                            <?php }} ?>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th></th>
                            <th colspan="4"><?= __('Totaal') ?></th>
                            <?php
                                $iBasis = $this->Subcount->makeSubSum($aBatch, "order_quantity_new", "-1", "order_quantity_new", 1, "order", "order");
                                $iNew = $this->Subcount->makeSubSum($aBatch, "quantity", "-1", "quantity", 1, "");
                            ?>

                            <th class="text-right"><?= number_format($iBasis,0,",",".") ?></th>
                            <th class="text-right"><?= number_format($iNew,0,",",".") ?></th>
                            <th class="text-right"><?= number_format(($iNew-$iBasis),0,",",".") ?></th>
                        </tr>
                        </tfoot>
                    </table>

                </div><!-- /.tab-pane -->

            </div><!-- /.tab-pane -->

            <!-- SHORTCUT BUTTONS -->
            <br />
            <div class="row">
                <div class="col-xs-12">
                    <a href="/Packaging/OnMachine/" class="btn btn-sm bg-gray"><i class="fa fa-share fa-flip-horizontal"></i> <?= __('Terug') ?></a>
                    <button type="submit" name="submit" value="saveBatch" class="btn btn-sm bg-purple pull-right"><i class="fa fa-send"></i> <?= __('Aantallen verwerken') ?></button>
                </div>
            </div>

        </form>

    </div><!-- /.tab-content -->

</div><!-- /.box-body -->
</div>
<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-cog"></i> <?= __('Op machine') ?></h3>
    </div>

    <div class="box-body">

        <?php if($this->Subcount->makeSubCount($aOrders, "general_status", "-1", "1") == 0){ ?>
            <br/><p class="alert alert-warning"><?= __('Geen orders in de hoofdstatus') ?> <b>Op machine</b></p>
        <?php }else{ ?>

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab"><?= __('Overzicht') ?> (<?= $this->Subcount->makeSubCount($aOrders, "general_status", "-1", "1") ?>)</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <form method="post" action="/Packaging/saveBatch/">

                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th width="20"></th>
                                    <th width="80"><?= __('Ordernr.') ?></th>
                                    <th width="100"><?= __('Datum') ?></th>
                                    <th width="250"><?= __('Klant') ?></th>
                                    <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                    <th width="100" class="text-right"><?= __('Geproduceerd') ?></th>
                                    <th width="100"><?= __('Artikelnr.') ?></th>
                                    <th><?= __('Omschrijving') ?></th>
                                </tr>
                                </thead>

                                <tbody class="priority">
                                <?php
                                foreach($this->Subcount->makeSubSet($aOrders, "general_status", 103, 1) as $aOrder){
                                    if($aOrder->priority == 1){
                                        ?>
                                        <input type="hidden" name="order_nrint[]" value="<?= $aOrder["ORDERREGELNRINT"] ?>" />
                                        <tr data-touch-href="/Order/<?= $aOrder->ORDERREGELNRINT ?>" <?php if($aOrder->fsc_order == 1){ echo "class='success'"; } ?>>
                                            <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                                            <td><?= $aOrder->BKHORNR ?></td>
                                            <td><?= $aOrder->BKHORDATUM->format('d-m-Y') ?></td>
                                            <td><?= $aOrder->BKHADNAAM ?></td>
                                            <td class="text-right"><?= number_format($aOrder->order_quantity_new,0,",",".") ?></td>
                                            <td class="text-right">
                                                <input type="number" class="form-control input-xs text-right" name="machine_quantity[]"
                                                       value="<?php if(isset($aBatch[$aOrder->ORDERREGELNRINT])){ echo $aBatch[$aOrder->ORDERREGELNRINT]["quantity"];} ?>"
                                                />
                                            </td>
                                            <td><?= $aOrder->BKHARCODE ?></td>
                                            <td><?= $aOrder->BKHOROMS ?></td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>

                                <tbody class="plain">
                                <?php
                                foreach($this->Subcount->makeSubSet($aOrders, "general_status", 103, 1) as $aOrder){
                                    if($aOrder->priority != 1){
                                        ?>
                                        <input type="hidden" name="order_nrint[]" value="<?= $aOrder["ORDERREGELNRINT"] ?>" />
                                        <tr data-touch-href="/Order/<?= $aOrder->ORDERREGELNRINT ?>" <?php if($aOrder->fsc_order == 1){ echo "class='success'"; } ?>>
                                            <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                                            <td><?= $aOrder->BKHORNR ?></td>
                                            <td><?= $aOrder->BKHORDATUM->format('d-m-Y') ?></td>
                                            <td><?= $aOrder->BKHADNAAM ?></td>
                                            <td class="text-right"><?= number_format($aOrder->order_quantity_new,0,",",".") ?></td>
                                            <td class="text-right">
                                                <input type="number" class="form-control input-xs text-right" name="machine_quantity[]"
                                                       value="<?php if(isset($aBatch[$aOrder->ORDERREGELNRINT])){ echo $aBatch[$aOrder->ORDERREGELNRINT]["quantity"];} ?>"
                                                />
                                            </td>
                                            <td><?= $aOrder->BKHARCODE ?></td>
                                            <td><?= $aOrder->BKHOROMS ?></td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th colspan="3"><?= __('Totaal') ?></th>
                                    <th class="text-right"><?= number_format($this->Subcount->makeSubSum($aOrders, "general_status", 103, "order_quantity_new", 0),0,",",".") ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                
                                </tr>
                                </tfoot>
                            </table>

                            <div class="pull-right">
                                <button type="submit" name="submit" value="saveBatch" class="btn btn-sm btn-warning"><i class="fa fa-save"></i> <?= __('Opslaan') ?></button>
                                <button type="submit" name="submit" value="saveAndShowBatch" class="btn btn-sm bg-purple"><i class="fa fa-files-o"></i> <?= __('Bekijk batch') ?></button>
                            </div>

                        <div class="clearfix"></div>
                    </form>
                </div><!-- /.tab-pane -->
            </div><!-- /.tab-pane -->

        <?php } ?>
    </div><!-- /.tab-content -->


</div><!-- /.box-body -->
</div>
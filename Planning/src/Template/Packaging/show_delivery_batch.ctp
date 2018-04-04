<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-cog"></i> <?= __('Batch') ?> &apos;<?= __('Verstuur naar klant') ?>&apos;</h3>
    </div>

    <div class="box-body">

        <form method="post" action="/Packaging/saveBatchToDeliver/">

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
                            <th width="80" class="text-right"><?= __('Geleverd') ?></th>
                            <th width="80" class="text-right"><?= __('Geproduceerd') ?></th>
                            <th width="80" class="text-right"><?= __('Afwijking') ?></th>
                            <th width="150" class="text-right"><?= __('Compleet') ?></th>
                        </tr>
                        </thead>



                        <tbody>
                        <?php foreach($aBatch as $aOrder){ ?>
                            <tr <?php if($aOrder->HdIntPrplViewItem->HdIntPrplGeneral->fsc_order == 1){ echo "class='success'"; } ?>>
                                <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                                <td><?= $aOrder->HdIntPrplViewItem->order_nr ?></td>
                                <td><?= $aOrder->HdIntPrplViewItem->order_date->format('d-m-Y') ?></td>
                                <td><?= $aOrder->HdIntPrplViewItem->product_code ?></td>
                                <td><?= $aOrder->HdIntPrplViewItem->order_description ?></td>

                                <?php @$iTotal = $aOrder->quantity + $aOrder->quantity_delivered ?>

                                <td class="text-right">
                                    <?php
                                    if($aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity != $aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new && $aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new != 0){
                                        $startQty = $aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity;
                                        $newQty =  $aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new;
                                    }else{
                                        $startQty = null;
                                        $newQty =  $aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_start_quantity;
                                    }
                                    ?>
                                    <?= !is_null($startQty) ? "<abbr title='Beginhoeveelheid: ".number_format($startQty,0,",",".")."'>".number_format($newQty,0,",",".")."</abbr>" : number_format($newQty,0,",","."); ?>
                                </td>
                                <td class="text-right"><?= @number_format($aOrder->quantity_delivered,0,",",".") ?></td>
                                <td class="text-right"><?= number_format($aOrder->quantity,0,",",".") ?></td>
                                <td class="text-right"><?= @number_format($iTotal - $aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new,0,",",".") ?></td>
                                <td class="text-right">
                                    <?php
                                    if(($aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new*0.9 <= $iTotal && $iTotal < $aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new) || $this->request->session()->read("adminlogin")["supplier_nrint"] == ""){
                                        ?>
                                            <select class="form-control input-xs" name="order_complete[]" required="required">
                                                <option value="">- <?= __('Selecteer optie') ?> -</option>
                                                <option value="1"><?= __('Ja') ?></option>
                                                <option value="0"><?= __('Nee') ?></option>
                                            </select>
                                        <?php
                                    }elseif($iTotal >= $aOrder->HdIntPrplViewItem->HdIntPrplGeneral->order_quantity_new){
                                        echo __('Ja');
                                        ?>
                                            <input type="hidden" name="order_complete[]" value="1" />
                                        <?php
                                    }else{
                                        echo __('Nee');
                                        ?>
                                            <input type="hidden" name="order_complete[]" value="0" />
                                        <?php
                                    }
                                    ?>
                                    <input type="hidden" name="packaging_id[]" value="<?= $aOrder["packaging_id"] ?>" />
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>


                    </table>

                </div><!-- /.tab-pane -->

            </div><!-- /.tab-pane -->

            <!-- SHORTCUT BUTTONS -->
            <br />
            <div class="row">
                <div class="col-xs-12">
                    <a href="/Packaging/" class="btn btn-sm bg-gray"><i class="fa fa-share fa-flip-horizontal"></i> <?= __('Terug') ?></a>
                    <button type="submit" name="submit" value="saveBatch" class="btn btn-sm bg-purple pull-right"><i class="fa fa-send"></i> <?= __('Batch verzenden') ?></button>
                </div>
            </div>

        </form>

    </div><!-- /.tab-content -->

</div><!-- /.box-body -->
</div>
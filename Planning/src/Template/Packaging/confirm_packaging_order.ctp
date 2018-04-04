<?php $aPrio = [1 => "priority", 0 => "plain"] ?>
<?php $aTableTitle = [1 => "Spoedorders", 0 => "Reguliere orders"] ?>
<?php $aCount = [1 => 0, 0 => 0] ?>

<?php
foreach($aProforma["Orders"] as $aOrder){
    $aCount[$aOrder->HdIntPrplGeneral->priority]++;
}
?>

<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-body">

            <!-- Main content -->
            <section class="invoice">
                <form method="post" action="/Packaging/sendOrdersToPackaging/">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <?= __('Proforma') ?>  <?= $aProforma["Packaging"]["HdIntPrplCompanies"]["adres_alias"] ?>
                                <small class="pull-right"><?= __('Datum') ?>: <?= date('d-m-Y') ?></small>
                            </h2>
                            <input type="hidden" name="packaging_nrint" value="<?= $aProforma["Packaging"]["BKHADNRINT"] ?>" />
                            <input type="hidden" name="packaging_name" value="<?= $aProforma["Packaging"]["BKHADNAAM"] ?>" />
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->


                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">

                            <?php foreach($aPrio as $prio => $class){ ?>
                                <?php if($aCount[$prio] > 0){ ?>
                                    <h3><?= $aTableTitle[$prio] ?></h3>
                                    <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="20"></th>
                                        <th width="80"><?= __('Ordernr.') ?></th>
                                        <th><?= __('Omschrijving') ?></th>
                                        <th width="200"><?= __('Soort') ?></th>
                                        <th width="100"><?= __('Artikelnr.') ?></th>
                                        <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                    </tr>
                                    </thead>

                                    <tbody class="<?= $class ?>">
                                    <?php foreach($aProforma["Orders"] as $aOrder){ ?>
                                        <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>
                                            <input type='hidden' name='order_nrint[]' value='<?= $aOrder["orderrule_id"] ?>' />
                                            <input type='hidden' name='end_date[]' value='<?= $aOrder->newdate->format('Y-m-d') ?>' />
                                            <tr <?php if($aOrder["HdIntPrplGeneral"]["fsc_order"] == 1){ echo "class='success'"; } ?>>
                                                <td><?php if($aOrder["HdIntPrplGeneral"]["fsc_order"] == 1){ echo "<span class='text-success'><i class='fa fa-leaf fa-no-margin'></i></span>"; } ?></td>
                                                <td><?= $aOrder["order_nr"] ?></td>
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
                                                <td><?= $aOrder->ledger_name ?></td>
                                                <td><?= $aOrder->product_code ?></td>
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
                                                <input type='hidden' name='start_quantity[]' value='<?= $newQty ?>' />
                                            </tr>

                                        <?php } ?>
                                    <?php } ?>
                                    </tbody>
                                <?php } ?>
                                </table>
                            <?php } ?>



















                            <?php
                                $iSpoed = $this->Subcount->makeSubSum($aProforma["Orders"], "priority", "1", "leading_quantity", 0);
                                if($iSpoed > 0){
                            ?>
                                <h3><?= __('Spoedorders') ?></h3>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="20"></th>
                                        <th width="80"><?= __('Ordernr.') ?></th>
                                        <th><?= __('Omschrijving') ?></th>
                                        <th width="200"><?= __('Soort') ?></th>
                                        <th width="100"><?= __('Artikelnr.') ?></th>
                                        <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                        <th width="125" class="text-right"><?= __('Leverdatum') ?></th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                    foreach($aProforma["Orders"] as $aOrder){
                                        if($aOrder["priority"] == 1){
                                            echo "<input type='hidden' name='order_nrint[]' value='".$aOrder["ORDERREGELNRINT"]."' />";
                                            echo "<input type='hidden' name='end_date[]' value='".$aOrder["newdate"]->format('Y-m-d')."' />";
                                            echo "<input type='hidden' name='start_quantity[]' value='".$aOrder["leading_quantity"]."' />";
                                            ?>
                                            <tr <?php if($aOrder["fsc_order"] == 1){ echo "class='success'"; } ?>>
                                                <td><?php if($aOrder["fsc_order"] == 1){ echo "<span class='text-success'><i class='fa fa-leaf fa-no-margin'></i></span>"; } ?></td>
                                                <td><?= $aOrder["BKHORNR"] ?></td>
                                                <td><?= $aOrder["BKHOROMS"] ?></td>
                                                <td><?= $aOrder["article_type"] ?></td>
                                                <td><?= $aOrder["BKHARCODE"] ?></td>
                                                <td class="text-right"><?= number_format($aOrder["leading_quantity"],0,",",".") ?></td>
                                                <td class="text-right"><?= $aOrder["newdate"]->format('d-m-Y') ?></td>
                                            </tr>
                                        <?php }} ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th colspan="4"><?= __('Totaal') ?></th>
                                        <th class="text-right"><?= number_format($iSpoed,0,",",".") ?></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            <?php } ?>

                            <?php
                            $iRegular = $this->Subcount->makeSubSum($aProforma["Orders"], "priority", "0", "leading_quantity", 0);
                            if($iRegular > 0){
                                ?>
                                <h3><?= __('Reguliere orders') ?></h3>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="20"></th>
                                        <th width="80"><?= __('Ordernr.') ?></th>
                                        <th><?= __('Omschrijving') ?></th>
                                        <th width="200"><?= __('Soort') ?></th>
                                        <th width="100"><?= __('Artikelnr.') ?></th>
                                        <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                        <th width="125" class="text-right"><?= __('Leverdatum') ?></th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                    foreach($aProforma["Orders"] as $aOrder){
                                        if($aOrder["priority"] != 1){
                                            echo "<input type='hidden' name='order_nrint[]' value='".$aOrder["ORDERREGELNRINT"]."' />";
                                            echo "<input type='hidden' name='end_date[]' value='".$aOrder["newdate"]->format('Y-m-d')."' />";
                                            echo "<input type='hidden' name='start_quantity[]' value='".$aOrder["leading_quantity"]."' />";
                                            ?>
                                            <tr <?php if($aOrder["fsc_order"] == 1){ echo "class='success'"; } ?>>
                                                <td><?php if($aOrder["fsc_order"] == 1){ echo "<span class='text-success'><i class='fa fa-leaf fa-no-margin'></i></span>"; } ?></td>
                                                <td><?= $aOrder["BKHORNR"] ?></td>
                                                <td><?= $aOrder["BKHOROMS"] ?></td>
                                                <td><?= $aOrder["article_type"] ?></td>
                                                <td><?= $aOrder["BKHARCODE"] ?></td>
                                                <td class="text-right"><?= number_format($aOrder["leading_quantity"],0,",",".") ?></td>
                                                <td class="text-right"><?= $aOrder["newdate"]->format('d-m-Y') ?></td>
                                            </tr>
                                        <?php }} ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th colspan="4"><?= __('Totaal') ?></th>
                                        <th class="text-right"><?= number_format($iRegular,0,",",".") ?></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            <?php } ?>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button onclick="javascript:history.go(-1);" class="btn btn-default btn-sm"><i class="fa fa-share fa-flip-horizontal"></i> <?= __('Proforma aanpassen') ?></button>
                            <button type="submit" name="submit" value="ok_send" class="btn bg-purple btn-sm pull-right"><i class="fa fa-send"></i> <?= __('Bevestig en verstuur') ?></button>
                            <button type="submit" name="submit" value="ok_no_send" class="hidden btn bg-orange btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-check"></i> <?= __('Bevestigen') ?></button>
                        </div>
                    </div>
                </form>
            </section><!-- /.content -->
            <div class="clearfix"></div>

    </div><!-- /.box-body -->
</div>
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
                <form method="post" action="/Preprinting/sendOrdersToPrinter/">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                Proforma  <?= $aProforma["Printer"]["BKHADNAAM"] ?>
                                <small class="pull-right">Datum: <?= date('d-m-Y') ?></small>
                            </h2>
                            <input type="hidden" name="printer_nrint" value="<?= $aProforma["Printer"]["BKHADNRINT"] ?>" />
                            <input type="hidden" name="printer_name" value="<?= $aProforma["Printer"]["BKHADNAAM"] ?>" />
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->


                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12">

                            <?php foreach($aPrio as $prio => $class){ ?>
                                <?php if($aCount[$prio] > 0){ ?>
                                    <h3><?= $aTableTitle[$prio] ?></h3>
                                    <table class="table table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th width="20"></th>
                                            <th width="120">Ordernr.</th>
                                            <th>Omschrijving</th>
                                            <th width="200">Soort</th>
                                            <th width="100">Artikelnr.</th>
                                            <th width="80" class="text-right">Aantal</th>
                                            <th width="125" class="text-right">Leverdatum</th>
                                        </tr>
                                        </thead>

                                        <tbody class="<?= $class ?>">
                                        <?php foreach($aProforma["Orders"] as $aOrder){ ?>
                                            <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>

                                                <input type='hidden' name='order_nrint[]' value='<?= $aOrder["orderrule_id"] ?>' />
                                                <input type='hidden' name='end_date[]' value='<?= $aOrder["newdate"]->format('Y-m-d') ?>' />
                                                <input type='hidden' name='quantity[]' value='<?= $aOrder->HdIntPrplGeneral["order_start_quantity"] ?>' />
                                                <input type='hidden' name='general_id[]' value='<?= $aOrder->HdIntPrplGeneral["id"] ?>' />

                                                <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                                                    <td><?= ($prio == 1) ? '<i class="fa fa-bolt text-warning fa-no-margin"></i>' : '' ?></td>
                                                    <td><?= $aOrder->order_nr ?></td>
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
                                                    <td class="text-right"><?= number_format($aOrder->HdIntPrplGeneral->order_start_quantity,0,",",".") ?></td>
                                                    <td class="text-right"><?= $aOrder["newdate"]->format('d-m-Y') ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        </tbody>
                                    <?php } ?>
                                </table>
                            <?php } ?>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <hr />
                            <a onclick="javascript:history.go(-1);" class="btn btn-default btn-sm"><i class="fa fa-share fa-flip-horizontal"></i> Proforma aanpassen</a>
                            <button type="submit" name="submit" value="ok_send" class="btn bg-purple btn-sm pull-right"><i class="fa fa-send"></i> Bevestig en verstuur</button>
                            <button type="submit" name="submit" value="ok_no_send" class="btn bg-orange btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-check"></i> Bevestig</button>
                        </div>
                    </div>
                </form>
            </section><!-- /.content -->
            <div class="clearfix"></div>

    </div><!-- /.box-body -->
</div>
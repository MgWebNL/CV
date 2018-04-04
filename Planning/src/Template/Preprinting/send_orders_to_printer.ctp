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
                        <div class="col-xs-12 table-responsive">
                            <?php
                                $iSpoed = $this->Subcount->makeSubSum($aProforma["Orders"], "priority", "1", "order_start_quantity", 0);
                                if($iSpoed > 0){
                            ?>
                                <h3>Spoedorders</h3>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="20"></th>
                                        <th width="80">Ordernr.</th>
                                        <th>Omschrijving</th>
                                        <th width="200">Soort</th>
                                        <th width="100">Artikelnr.</th>
                                        <th width="80" class="text-right">Aantal</th>
                                        <th width="125" class="text-right">Leverdatum</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                    foreach($aProforma["Orders"] as $aOrder){
                                        if($aOrder["priority"] == 1){
                                            echo "<input type='hidden' name='order_nrint[]' value='".$aOrder["ORDERREGELNRINT"]."' />";
                                            echo "<input type='hidden' name='end_date[]' value='".$aOrder["newdate"]->format('Y-m-d')."' />";
                                            echo "<input type='hidden' name='quantity[]' value='".$aOrder["order_start_quantity"]."' />";
                                            echo "<input type='hidden' name='general_id[]' value='".$aOrder["id"]."' />";
                                            ?>
                                            <tr <?php if($aOrder["fsc_order"] == 1){ echo "class='success'"; } ?>>
                                                <td><?php if($aOrder["fsc_order"] == 1){ echo "<span class='text-success'><i class='fa fa-leaf fa-no-margin'></i></span>"; } ?></td>
                                                <td><?= $aOrder["BKHORNR"] ?></td>
                                                <td><?= $aOrder["BKHOROMS"] ?></td>
                                                <td><?= $aOrder["article_type"] ?></td>
                                                <td><?= $aOrder["BKHARCODE"] ?></td>
                                                <td class="text-right"><?= number_format($aOrder["order_start_quantity"],0,",",".") ?></td>
                                                <td class="text-right"><?= $aOrder["newdate"]->format('d-m-Y') ?></td>
                                            </tr>
                                        <?php }} ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th colspan="4">Totaal</th>
                                        <th class="text-right"><?= number_format($iSpoed,0,",",".") ?></th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            <?php } ?>

                            <?php
                            $iRegular = $this->Subcount->makeSubSum($aProforma["Orders"], "priority", "0", "order_start_quantity", 0);
                            if($iRegular > 0){
                                ?>
                                <h3>Reguliere orders</h3>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th width="20"></th>
                                        <th width="80">Ordernr.</th>
                                        <th>Omschrijving</th>
                                        <th width="200">Soort</th>
                                        <th width="100">Artikelnr.</th>
                                        <th width="80" class="text-right">Aantal</th>
                                        <th width="125" class="text-right">Leverdatum</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                    foreach($aProforma["Orders"] as $aOrder){
                                        if($aOrder["priority"] != 1){
                                            echo "<input type='hidden' name='order_nrint[]' value='".$aOrder["ORDERREGELNRINT"]."' />";
                                            echo "<input type='hidden' name='end_date[]' value='".$aOrder["newdate"]->format('Y-m-d')."' />";
                                            echo "<input type='hidden' name='quantity[]' value='".$aOrder["order_start_quantity"]."' />";
                                            echo "<input type='hidden' name='general_id[]' value='".$aOrder["id"]."' />";
                                            ?>
                                            <tr <?php if($aOrder["fsc_order"] == 1){ echo "class='success'"; } ?>>
                                                <td><?php if($aOrder["fsc_order"] == 1){ echo "<span class='text-success'><i class='fa fa-leaf fa-no-margin'></i></span>"; } ?></td>
                                                <td><?= $aOrder["BKHORNR"] ?></td>
                                                <td><?= $aOrder["BKHOROMS"] ?></td>
                                                <td><?= $aOrder["article_type"] ?></td>
                                                <td><?= $aOrder["BKHARCODE"] ?></td>
                                                <td class="text-right"><?= number_format($aOrder["order_start_quantity"],0,",",".") ?></td>
                                                <td class="text-right"><?= $aOrder["newdate"]->format('d-m-Y') ?></td>
                                            </tr>
                                        <?php }} ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th colspan="4">Totaal</th>
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
                            <a onclick="javascript:history.go(-1);" class="btn btn-default btn-sm"><i class="fa fa-share fa-flip-horizontal"></i> Proforma aanpassen</a>
                            <button type="submit" name="submit" value="ok_send" class="btn bg-purple btn-sm pull-right"><i class="fa fa-send"></i> Bevestig en verstuur</button>
                            <button type="submit" name="submit" value="ok_no_send" class="hidden btn bg-orange btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-check"></i> Bevestig</button>
                        </div>
                    </div>
                </form>
            </section><!-- /.content -->
            <div class="clearfix"></div>

    </div><!-- /.box-body -->
</div>
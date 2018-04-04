<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-print"></i> Bestellen bij drukkerij</h3>
    </div>

    <div class="box-body">

        <form action="/Preprinting/ConfirmPrintingOrder/" method="post">

            <div class="pull-right form-inline">
                <select class="form-control input-sm" required="required" name="company_nrint">
                    <option value="">- Selecteer drukkerij -</option>
                    <?php foreach($aCompany as $aItem){ ?>
                        <option value="<?= $aItem["BKHADNRINT"] ?>"><?= $aItem["BKHADNAAM"] ?></option>
                    <?php } ?>
                </select>
                <button type="submit" name="submit" value="submitProformaTop" class="btn bg-purple btn-sm">
                    <i class="fa fa-file-pdf-o"></i> Maak proforma
                </button>
            </div>

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Overzicht (<?= $this->Subcount->makeSubCount($aOrders, "general_status", "-1", "1") ?>)</a></li>
            </ul>



            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">

                    <?php if($this->Subcount->makeSubCount($aOrders, "general_status", -1, 1) == 0){ ?>
                        <br/><p class="alert alert-warning">Geen orders in de hoofdstatus <b>Bestellen bij drukkerij</b></p>
                    <?php }else{ ?>

                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th width="20"><input type="checkbox" id="checkAll" /></th>
                                <th width="80">Ordernr.</th>
                                <th width="100">Datum</th>
                                <th width="250">Klant</th>
                                <th width="80" class="text-right">Aantal</th>
                                <th width="100">Artikelnr.</th>
                                <th>Omschrijving</th>
                                <th width="200">Status</th>
                                <th width="25"></th>
                            </tr>
                            </thead>

                            <tbody class="priority">
                            <?php
                            foreach($this->Subcount->makeSubSet($aOrders, "general_status", "-1", "1") as $aOrder){
                                if($aOrder["priority"] == 1){
                                    ?>

                                    <?php
                                    $error = 0;
                                    $text = "";
                                    if($aOrder->napkin_nrint == '' || $aOrder->box_nrint == ''){
                                        $text .= "<i class=\"fa fa-exclamation\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Geen servet/omdoos opgegeven\" />";
                                        $error = 1;
                                    }
                                    if($error == 0){
                                        $text .= "<input type=\"checkbox\" name=\"order_nrint[]\" value=\"".$aOrder->ORDERREGELNRINT."\" />";
                                    }
                                    ?>


                                    <tr data-touch-href="/Order/<?= $aOrder->ORDERREGELNRINT ?>" <?php if($error == 1){ echo "class='danger'"; }else{ echo "class='success'"; } ?>>
                                        <td>
                                            <?= $text ?>
                                        </td>
                                        <td><?= $aOrder->BKHORNR ?></td>
                                        <td><?= $aOrder->BKHORDATUM->format('d-m-Y') ?></td>
                                        <td><?= $aOrder->BKHADNAAM ?></td>
                                        <td class="text-right"><?= number_format($aOrder->order_start_quantity,0,",",".") ?></td>
                                        <td><?= $aOrder->BKHARCODE ?></td>
                                        <td>
                                            <?= $aOrder->BKHOROMS ?>
                                            <?php if($aOrder->fsc_order == 1){ echo "<i class='fa fa-leaf text-success'></i>"; } ?>
                                            <?php if($aOrder->order_remarks != ""){ echo "<br><small class='text-danger'>".$aOrder->order_remarks."</small>"; } ?>
                                            <?php if(isset($aNotes[$aOrder["BKHADCODE"]])){
                                                foreach($aNotes[$aOrder["BKHADCODE"]] as $note){
                                                    echo "<br><small class='text-danger'>".$note["rule"]."</small>";
                                                }
                                            } ?>


                                            <?php
                                            $a = explode(",",$aOrder->article_editions);
                                            if(strlen(implode('', $a)) != 0){
                                                echo "<br />";
                                                foreach($a as $option){
                                                    if(isset($aEditie[$option])){
                                                        echo "<div class='label label-success'>".$aEditie[$option]["edition_name"]."</div>&nbsp;";
                                                    }
                                                }} ?>
                                        </td>
                                        <td><?= $aStatus[$aOrder->general_status]->naam ?></td>
                                        <td><a href="/Order/Instructions/<?= $aOrder->ORDERREGELNRINT ?>/#Prepress" class="btn btn-xs bg-purple"> <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                                    </tr>
                                <?php }} ?>
                            </tbody>

                            <tbody class="plain">
                            <?php
                            foreach($aOrders as $aOrder){
                                if($aOrder["priority"] != 1){
                                    ?>


                                    <?php
                                    $error = 0;
                                    $text = "";
                                    if($aOrder->napkin_nrint == '' || $aOrder->box_nrint == ''){
                                        $text .= "<i class=\"fa fa-exclamation\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Geen servet/omdoos opgegeven\" />";
                                        $error = 1;
                                    }
                                    if($error == 0){
                                        $text .= "<input type=\"checkbox\" name=\"order_nrint[]\" value=\"".$aOrder->ORDERREGELNRINT."\" />";
                                    }
                                    ?>


                                    <tr data-touch-href="/Order/<?= $aOrder->ORDERREGELNRINT ?>" <?php if($error == 1){ echo "class='danger'"; }elseif($aOrder->fsc_order == 1){ echo "class='success'"; } ?>>
                                        <td>
                                            <?= $text ?>
                                        </td>
                                        <td><?= $aOrder->BKHORNR ?></td>
                                        <td><?= $aOrder->BKHORDATUM->format('d-m-Y') ?></td>
                                        <td><?= $aOrder->BKHADNAAM ?></td>
                                        <td class="text-right"><?= number_format($aOrder->order_start_quantity,0,",",".") ?></td>
                                        <td><?= $aOrder->BKHARCODE ?></td>
                                        <td>
                                            <?= $aOrder->BKHOROMS ?>
                                            <?php if($aOrder->fsc_order == 1){ echo "<i class='fa fa-leaf text-success'></i>"; } ?>
                                            <?php if($aOrder->order_remarks != ""){ echo "<br><small class='text-danger'>".$aOrder->order_remarks."</small>"; } ?>
                                            <?php if(isset($aNotes[$aOrder["BKHADCODE"]])){
                                                foreach($aNotes[$aOrder["BKHADCODE"]] as $note){
                                                    echo "<br><small class='text-danger'>".$note["rule"]."</small>";
                                                }
                                            } ?>


                                            <?php
                                            $a = explode(",",$aOrder->article_editions);
                                            if(strlen(implode('', $a)) != 0){
                                                echo "<br />";
                                                foreach($a as $option){
                                                    if(isset($aEditie[$option])){
                                                        echo "<div class='label label-success'>".$aEditie[$option]["edition_name"]."</div>&nbsp;";
                                                    }
                                                }} ?>
                                        </td>
                                        <td><?= $aStatus[$aOrder->general_status]->naam ?></td>
                                        <td><a href="/Order/Instructions/<?= $aOrder->ORDERREGELNRINT ?>/#Prepress" class="btn btn-xs bg-purple"> <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                                    </tr>
                                <?php }} ?>
                            </tbody>

                            <tfoot>
                            <tr>
                                <th></th>
                                <th colspan="3">Totaal</th>
                                <th class="text-right"><?= number_format($this->Subcount->makeSubSum($aOrders, "general_status", "-1", "order_start_quantity", 1),0,",",".") ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>

                    <?php } ?>

                </div><!-- /.tab-pane -->
            </div><!-- /.tab-pane -->

            <br />

            <div class="pull-right form-inline">
                <button type="submit" name="submit" value="submitProformaBottom" class="btn bg-purple btn-sm">
                    <i class="fa fa-file-pdf-o"></i> Maak proforma
                </button>
            </div>

            <div class="clearfix"></div>
        </div><!-- /.tab-content -->



    </form>

</div><!-- /.box-body -->
</div>


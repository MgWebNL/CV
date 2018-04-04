<?php
$session = $this->request->session()->read("adminlogin")["supplier_nrint"] == "" || $this->request->session()->read("adminlogin")["supplier_nrint"] == "C86OEET2" ? $this->request->session()->read("intake") : $this->request->session()->read("adminlogin")["supplier_nrint"];
use Cake\I18n\Time;
$aPrio = [1 => "priority", 0 => "plain"];
?>

<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <?php if($adminlogin["rights"] === true || $adminlogin["rights"] != '2'){ ?>
            <a href="#" id="export" onClick="fnExcelReport('table2excel', 'Bij drukkerij');" class="btn btn-xs bg-purple pull-right">
                <i class="fa fa-file-excel-o"></i> <?= __('Maak export') ?>
            </a>
        <?php } ?>

        <h3 class="box-title"><i class="fa fa-cog"></i> <?= __('Ontvangst verpakker') ?></h3>
    </div>

    <div class="box-body">

        <ul class="nav nav-tabs">
            <?php if($session == ""){ ?>
                <li class="active"><a href="#PRINTING" data-toggle="tab"><?= __('Overzicht') ?> (<?= $aOrders->count() ?>)</a></li>
            <?php } ?>
            <?php foreach($aCompanies as $company){
                if($session == $company["BKHADNRINT"]){ ?>
                    <li class="active">
                        <a href="#<?= $company["BKHADNRINT"] ?>" data-toggle="tab">
                            <?= $session == '' ? $company->HdIntPrplCompanies["adres_alias"] : __('Overzicht') ?> (<?= @count($aGrouped[$company["BKHADNRINT"]]) ?>)
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
            <!-- SHORTCUT BUTTONS -->
            <?php if($this->request->session()->read("adminlogin")["supplier_nrint"] == "" || $this->request->session()->read("adminlogin")["supplier_nrint"] == "C86OEET2"){ ?>
                <div class="pull-right">
                    <form method="post" action="/Packaging/setSession/intake">
                        <select name="packaging_nrint" onchange="this.form.submit()" required="required">
                            <option value="">Selecteer drukkerij</option>
                            <?php foreach($aCompanies as $company){ ?>
                                <option value="<?= $company["BKHADNRINT"] ?>" <?= $session == $company["BKHADNRINT"] ? "selected" : "" ?>>
                                    <?php
                                    if($company["HdIntPrplCompanies"]["adres_alias"] != "") {
                                        echo $company["HdIntPrplCompanies"]["adres_alias"];
                                    }else{
                                        echo $company["BKHADNAAM"];
                                    } ?>
                                </option>
                            <?php } ?>
                        </select>
                    </form>
                </div>
            <?php } ?>
        </ul>

        <div class="tab-content">
            <?php if($session == ""){ ?>
                <div class="tab-pane active" id="tab_1-1">

                    <?php if($aOrders->count() == 0){ ?>
                        <br/><p class="alert alert-warning"><?= __('Geen orders in de hoofdstatus') ?> <b><?= __('Naar verpakker') ?></b></p>
                    <?php }else{ ?>
                        <?php $total = 0; ?>
                        <table class="table table-condensed table-hover" id="table2excel">
                            <thead>
                            <tr>
                                <th width="20"></th>
                                <th width="80"><?= __('Ordernr.') ?></th>
                                <th width="100"><?= __('Datum') ?></th>
                                <th width="250"><?= __('Klant') ?></th>
                                <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                <th width="100"><?= __('Artikelnr.') ?></th>
                                <th><?= __('Omschrijving') ?></th>
                                <th width="200"><?= __('Verpakker') ?></th>
                                <th width="25"></th>
                            </tr>
                            </thead>

                            <?php foreach($aPrio as $prio => $class){ ?>
                                <tbody class="<?= $class ?>">
                                <?php foreach($aOrders as $aOrder){ ?>

                                    <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>
                                        <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                                            <td></td>
                                            <td><?= $aOrder->order_nr ?></td>
                                            <td><?= $aOrder->order_date->format('d-m-Y') ?></td>
                                            <td><?= $aOrder->adres_name ?></td>
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
                                            <td><?= $aOrder->product_code ?></td>
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
                                            <td><?= $aCompany[$aOrder->HdIntPrplPackaging->adres_nrint]->HdIntPrplCompanies->adres_alias ?></td>
                                            <td><a href="/Order/<?= $aOrder->orderrule_id ?>" class="btn btn-xs bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                                        </tr>
                                        <?php $total += $newQty ?>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                            <?php } ?>

                            <tfoot>
                            <th></th>
                            <th colspan="3">Totaal</th>
                            <th class="text-right"><?= \Cake\I18n\Number::precision($total,0); ?></th>
                            <th colspan="4"></th>
                            </tfoot>

                        </table>

                    <?php } ?>

                </div><!-- /.tab-pane -->
            <?php } ?>

            <?php foreach($aCompany as $company){ ?>
                <?php if($session == $company["BKHADNRINT"]){ ?>
                    <form method="post" action="/Packaging/showIntakeList/">
                        <input type="hidden" name="company_nrint" value="<?= $company["BKHADNRINT"] ?>">
                        <div class="tab-pane active" id="tab_1-1">

                        <?php if(@count($aGrouped[$company["BKHADNRINT"]]) == 0){ ?>
                            <br/><p class="alert alert-warning"><?= __('Geen orders in de hoofdstatus') ?> <b><?= __('Ontvangst verpakker') ?></b></p>
                        <?php }else{ ?>

                            <table class="table table-condensed table-hover" id="table2excel">
                                <thead>
                                <tr>
                                    <th width="20"><input type="checkbox" id="checkAll" /></th>
                                    <th width="80"><?= __('Ordernr.') ?></th>
                                    <th width="100"><?= __('Datum') ?></th>
                                    <th width="250"><?= __('Klant') ?></th>
                                    <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                    <th width="100"><?= __('Artikelnr.') ?></th>
                                    <th><?= __('Omschrijving') ?></th>
                                </tr>
                                </thead>

                                <?php foreach($aPrio as $prio => $class){ ?>
                                    <tbody class="<?= $class ?>">
                                    <?php foreach(@$aGrouped[$company["BKHADNRINT"]] as $aOrder){ ?>

                                        <?php
                                        $error = 0;
                                        $text = "";
                                        if($aOrder->HdIntPrplGeneral->napkin_nrint == '' || $aOrder->HdIntPrplGeneral->box_nrint == ''){
                                            $text .= "<i class=\"fa fa-exclamation\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Geen servet/omdoos opgegeven\" />";
                                            $error = 1;
                                        }
                                        if($error == 0){
                                            $text .= "<input type=\"checkbox\" name=\"order_nrint[]\" value=\"".$aOrder->orderrule_id."\" />";
                                        }
                                        ?>


                                        <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>
                                            <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                                                <td><?= $text ?></td>
                                                <td><?= $aOrder->order_nr ?></td>
                                                <td><?= $aOrder->order_date->format('d-m-Y') ?></td>
                                                <td><?= $aOrder->adres_name ?></td>
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
                                                <td><?= $aOrder->product_code ?></td>
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
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    </tbody>
                                <?php } ?>

                            </table>
                            <div class="pull-right">
                                <button type="submit" name="submit" value="saveAndShowBatch" class="btn btn-sm bg-purple"><i class="fa fa-file-o"></i><?= __('Maak ontvangstlijst') ?></button>
                            </div>
                            <div class="clearfix"></div>
                        <?php } ?>

                    </div><!-- /.tab-pane -->
                    </form>
                <?php } ?>
            <?php } ?>
        </div><!-- /.tab-pane -->


    </div><!-- /.tab-content -->

</div><!-- /.box-body -->


<script>
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>
<?php
$session = $this->request->session()->read("adminlogin")["supplier_nrint"] == "" || $this->request->session()->read("adminlogin")["supplier_nrint"] == "C86OEET2" ? $this->request->session()->read("packaging") : $this->request->session()->read("adminlogin")["supplier_nrint"];
use Cake\I18n\Time;
$aPrio = [1 => "priority", 0 => "plain"];
?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">
                    Nieuwe datum voor order <span id="mdl_ordernumber"></span>
                </h4>
            </div>
            <form method="post" action="/Packaging/setDate/" id="updateDateForm">
                <div class="modal-body">
                    <input type="hidden" name="order_nrint" id="mdl_ordernrint" />
                    <div class="form-group">
                        <label class="control-label">Huidige datum:</label>
                        <span type="text" id="mdl_old_date" class="form-control form-control-static">0000-00-00</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nieuwe datum:</label>
                        <input type="text" name="end_date_late" class="form-control datepicker2" id="mdl_new_date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
                    <button type="sumbit" class="btn btn-primary">Update datum</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- PANEL CONTACT -->
<div class="box box-default">

    <div class="box-header">
        <?php if($adminlogin["rights"] === true || $adminlogin["rights"] != '2'){ ?>
            <a href="#" id="export" onClick="fnExcelReport('table2excel', 'Bij drukkerij');" class="btn btn-xs bg-purple pull-right">
                <i class="fa fa-file-excel-o"></i> <?= __('Maak export') ?>
            </a>
        <?php } ?>

        <h3 class="box-title"><i class="fa fa-cog"></i> <?= __('Bij verpakker') ?></h3>
    </div>

    <div class="box-body">

        <ul class="nav nav-tabs">
            <?php if($session == ""){ ?>
                <li class="active"><a href="#PACKAGING" data-toggle="tab"><?= __('Overzicht') ?> (<?= $aOrders->count() ?>)</a></li>
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
                    <form method="post" action="/Packaging/setSession/">
                        <select name="packaging_nrint" onchange="this.form.submit()" required="required">
                            <option value="">Selecteer verpakker</option>
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
                <div class="tab-pane active" id="PACKAGING">

                    <?php if($aOrders->count() == 0){ ?>
                        <br/><p class="alert alert-warning"><?= __('Geen orders in de hoofdstatus') ?> <b><?= __('Bij verpakker') ?></b></p>
                    <?php }else{ ?>
                        <?php $total = 0; ?>
                        <table class="table table-condensed table-hover" id="table2excel">
                            <thead>
                            <tr>
                                <th width="20"></th>
                                <th width="80">Ordernr.</th>
                                <th width="100">Deadline</th>
                                <th width="250">Klant</th>
                                <th width="80" class="text-right">Aantal</th>
                                <th width="100">Artikelnr.</th>
                                <th>Omschrijving</th>
                                <th width="200">Verpakker</th>
                                <th width="25"></th>
                            </tr>
                            </thead>

                            <?php foreach($aPrio as $prio => $class){ ?>
                                <tbody class="<?= $class ?>">
                                <?php foreach($aOrders as $aOrder){ ?>
                                    <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>

                                        <?php
                                        $country = strtolower($aOrder->afleveradres_countrycode == "" ? $aOrder->adres_countrycode : $aOrder->afleveradres_countrycode);
                                        if($aOrder->HdIntPrplPackaging->adres_nrint == "BGR2F2Z2" && ($country == 'nl' || $country == 'be' || strpos(strtolower($aOrder->afleveradres_name), "hodi") !== false)) {
                                            $truck = "<i class='fa fa-truck pull-right fa-2x'></i>";
                                        }else{
                                            $truck = '';
                                        }
                                        ?>

                                        <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                                            <td><?= ($prio == 1) ? '<i class="fa fa-bolt text-warning fa-no-margin"></i>' : '' ?></td>
                                            <td><?= $aOrder->order_nr ?></td>
                                            <td><?= $aOrder->order_date->format('d-m-Y') ?></td>
                                            <td>
                                                <?= $aOrder->adres_name.$truck ?>
                                            </td>
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

            <?php foreach($aCompanies as $company){ ?>
                <?php if($session == $company["BKHADNRINT"]){ ?>
                    <div class="tab-pane active" id="<?= $company["BKHADNRINT"] ?>">
                        <form method="post" action="/Packaging/saveDeliveryBatch/">
                            <input type="hidden" name="packaging_nrint" value="<?= $company["BKHADNRINT"] ?>" />
                            <?php if(@count($aGrouped[$company["BKHADNRINT"]]) == 0){ ?>
                                <br/>
                                <p class="alert alert-warning">
                                    <?= __('Geen orders bij') ?>
                                    <b>
                                        <?php
                                        if($company["HdIntPrplCompanies"]["adres_alias"] != "") {
                                            echo $company["HdIntPrplCompanies"]["adres_alias"];
                                        }else{
                                            echo $company["BKHADNAAM"];
                                        } ?>
                                    </b>
                                </p>
                            <?php }else{ ?>
                                <?php $total = 0; ?>
                                <table class="table table-condensed table-hover" id="table2excel">
                                    <thead>
                                    <tr>
                                        <th width="20"></th>
                                        <th width="80"><?= __('Ordernr.') ?></th>
                                        <th width="120"><?= __('Deadline') ?></th>
                                        <th width="100">&nbsp;</th>
                                        <th width="250"><?= __('Klant') ?></th>
                                        <th width="80" class="text-right"><?= __('Aantal') ?></th>
                                        <th width="80" class="text-right"><?= __('Geleverd') ?></th>
                                        <th width="80" class="text-right"><?= __('Open') ?></th>
                                        <th width="100" class="text-right"><?= __('Geproduceerd') ?></th>
                                        <th width="100"><?= __('Artikelnr.') ?></th>
                                        <th><?= __('Omschrijving') ?></th>

                                    </tr>
                                    </thead>

                                    <?php foreach($aPrio as $prio => $class){ ?>
                                        <tbody class="<?= $class ?>">
                                        <?php foreach($aGrouped[$company["BKHADNRINT"]] as $aOrder){ ?>
                                            <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>

                                                <?php
                                                $country = strtolower($aOrder->afleveradres_countrycode == "" ? $aOrder->adres_countrycode : $aOrder->afleveradres_countrycode);
                                                if($aOrder->HdIntPrplPackaging->adres_nrint == "BGR2F2Z2" && ($country == 'nl' || $country == 'be' || strpos(strtolower($aOrder->afleveradres_name), "hodi") !== false)) {
                                                    $truck = "<i class='fa fa-truck pull-right fa-2x'></i>";
                                                }else{
                                                    $truck = '';
                                                }
                                                ?>

                                                <input type="hidden" name="order_nrint[]" value="<?= $aOrder["orderrule_id"] ?>" />
                                                <input type="hidden" name="packaging_id[]" value="<?= $aOrder["HdIntPrplPackaging"]["id"] ?>" />
                                                <input type="hidden" name="general_id[]" value="<?= $aOrder["HdIntPrplGeneral"]["id"] ?>" />
                                                <input type="hidden" name="adres_nrint[]" value="<?= $aOrder["HdIntPrplPackaging"]["adres_nrint"] ?>" />
                                                <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                                                    <td><?= ($prio == 1) ? '<i class="fa fa-bolt text-warning fa-no-margin"></i>' : '' ?></td>
                                                    <td><?= $aOrder->order_nr ?></td>
                                                    <?php
                                                    $enddate = !is_null($aOrder->HdIntPrplPackaging->end_date_late) ? $aOrder->HdIntPrplPackaging->end_date_late :  $aOrder->HdIntPrplPackaging->end_date;
                                                    if($enddate != $aOrder->HdIntPrplPackaging->end_date){
                                                        $enddate_base =  $aOrder->HdIntPrplPackaging->end_date->format('d-m-Y');
                                                    }else{
                                                        unset($enddate_base);
                                                    }
                                                    $class = $enddate->format('Ymd') < date('Ymd') ? 'text-danger text-bold' : '';
                                                    ?>
                                                    <td>
                                                <span class="<?= $class ?>">
                                                    <abbr title="Wijzig datum" data-toggle="modal" data-target="#exampleModal"
                                                          data-order_number="<?= $aOrder->order_nr ?>"
                                                          data-order_nrint="<?= $aOrder->orderrule_id ?>"
                                                          data-date_now="<?= $enddate->format('d-m-Y') ?>">
                                                        <?= $enddate->format('d-m-Y') ?>
                                                    </abbr>
                                                </span>
                                                        <?= isset($enddate_base) ? "<br /><s>".$enddate_base."</s>" : "" ?>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <?= $aOrder->adres_name.$truck ?>
                                                    </td>
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
                                                    <td class="text-right"><?= number_format($aOrder->quantity_delivered,0,",","."); ?></td>
                                                    <td class="text-right"><?= number_format($newQty - $aOrder->quantity_delivered,0,",","."); ?></td>
                                                    <td class="text-right">
                                                        <input type="number" class="form-control input-xs text-right" name="delivery_quantity[]"
                                                               value="<?php if(isset($aBatch[$aOrder->orderrule_id])){ echo $aBatch[$aOrder->orderrule_id]["quantity"];} ?>"
                                                        />
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
                                                <?php $total += $newQty; ?>
                                            <?php } ?>
                                        <?php } ?>
                                        </tbody>
                                    <?php } ?>

                                    <tfoot>
                                    <th></th>
                                    <th colspan="4">Totaal</th>
                                    <th class="text-right"><?= \Cake\I18n\Number::precision($total,0); ?></th>
                                    <th colspan="5"></th>
                                    </tfoot>

                                </table>

                                <div class="pull-right">
                                    <button type="submit" name="submit" value="saveBatch" class="btn btn-sm btn-warning"><i class="fa fa-save"></i> <?= __('Opslaan') ?></button>
                                    <button type="submit" name="submit" value="saveAndShowBatch" class="btn btn-sm bg-purple"><i class="fa fa-files-o"></i> <?= __('Bekijk batch') ?></button>
                                </div>

                            <?php } ?>
                            <div class="clearfix"></div>
                    </div><!-- /.tab-pane -->
                    </form>
                <?php } ?>
            <?php } ?>
        </div><!-- /.tab-pane -->


    </div><!-- /.tab-content -->

</div><!-- /.box-body -->

<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
        $('.datepicker2').datepicker("remove");

        var button = $(event.relatedTarget); // Button that triggered the modal

        var ordernumber = button.data('order_number'); // Extract info from data-* attributes
        var date_now = button.data('date_now'); // Extract info from data-* attributes
        var ordernrint = button.data('order_nrint'); // Extract info from data-* attributes

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#mdl_ordernumber').html(ordernumber);
        modal.find('#mdl_old_date').html(date_now);
        modal.find('#mdl_ordernrint').val(ordernrint);
        modal.find('#mdl_new_date').attr('data-date-start-date', '01-09-2016');
        $('.datepicker2').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            maxViewMode: 0,
            clearBtn: true,
            language: "nl",
            forceParse: false,
            keyboardNavigation: false,
            startDate: date_now,
            daysOfWeekDisabled: "0,6"
        });
    })

    $('#exampleModal').on('hidden.bs.modal', function (event) {
        $('#updateDateForm').trigger("reset");
    })
</script>
<style>
    .datepicker{z-index:1151 !important;}
    .datepicker .disabled.day{ color: #CCC !important; }
</style>

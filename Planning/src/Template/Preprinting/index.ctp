<?php $aPrio = [1 => "priority", 0 => "plain"] ?>

<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title"><i class="fa fa-phone"></i> Contact</h3>
  </div>

  <div class="box-body">

    <form action="/Preprinting/ConfirmPrintingOrder/" method="post">

      <div class="pull-right form-inline">
        <select class="form-control input-sm" required="required" name="company_nrint">
          <option value="">- Selecteer drukkerij -</option>
          <?php foreach($aCompanies as $aItem){ ?>
            <option value="<?= $aItem["BKHADNRINT"] ?>"><?= $aItem->HdIntPrplCompanies["adres_alias"] ?></option>
          <?php } ?>
        </select>
        <button type="submit" name="submit" value="submitProformaTop" class="btn bg-purple btn-sm">
          <i class="fa fa-file-pdf-o"></i> Maak proforma
        </button>
      </div>

      <ul class="nav nav-tabs">
        <li class="active"><a href="#PREPRINT" data-toggle="tab">Overzicht (<?= $aOrders->count() ?>)</a></li>
      </ul>

      <div class="tab-content">

        <div class="tab-pane active" id="PREPRINT">

          <?php if($aOrders->count() == 0){ ?>
            <br/><p class="alert alert-warning">Geen orders in de hoofdstatus <b>Contact</b></p>
          <?php }else{ ?>
          <?php $total = 0; ?>
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
                <th width="80"></th>
              </tr>
            </thead>

            <?php foreach($aPrio as $prio => $class){ ?>
              <tbody class="<?= $class ?>">
                <?php foreach($aOrders as $aOrder){ ?>

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
                    <?php $total += $aOrder->HdIntPrplGeneral->order_start_quantity; ?>
                    <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                      <td><?= $text ?></td>
                      <td><?= $aOrder->order_nr ?></td>
                      <td><?= $aOrder->order_date->format('d-m-Y') ?></td>
                      <td><?= $aOrder->adres_name ?></td>
                      <td class="text-right"><?= number_format($aOrder->HdIntPrplGeneral->order_start_quantity,0,",",".") ?></td>
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
                      <td><?= $aStatusList[$aOrder->HdIntPrplGeneral->general_status]->naam ?></td>
                      <td><a href="/Order/<?= $aOrder->orderrule_id ?>" class="btn btn-xs bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                    </tr>
                  <?php } ?>
                <?php } ?>
              </tbody>
            <?php } ?>

              <tfoot>
              <th></th>
              <th colspan="3">Totaal</th>
              <th class="text-right"><?= \Cake\I18n\Number::precision($total, 0); ?></th>
              <th colspan="4"></th>
              </tfoot>

          </table>
          <?php } ?>



        </div><!-- /.tab-pane -->

      </div><!-- /.tab-content -->
    </form>
  </div><!-- /.box-body -->
</div>


<script>
  $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
  });
</script>
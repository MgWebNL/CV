<?php $aPrio = [1 => "priority", 0 => "plain"] ?>

<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title"><i class="fa fa-phone"></i> Contact</h3>
  </div>

  <div class="box-body">

    <ul class="nav nav-tabs">
      <li class="active"><a href="#PREPRESS" data-toggle="tab">Overzicht (<?= $aOrders->count() ?>)</a></li>
      <?php foreach($aStatusList as $status){ ?>
        <li><a href="#<?= $status->code ?>" data-toggle="tab"><?= $status->naam ?> (<?= \Cake\I18n\Number::precision(@count($aGrouped[$status->id]),0) ?>)</a></li>
      <?php } ?>
    </ul>

    <div class="tab-content">

      <div class="tab-pane active" id="PREPRESS">

        <?php if($this->Subcount->makeSubCount($aOrders, "general_status", $status->id, 1) == 0){ ?>
          <br/><p class="alert alert-warning">Geen orders in de hoofdstatus <b>Contact</b></p>
        <?php }else{ ?>
        <table class="table table-condensed table-hover">
          <thead>
            <tr>
              <th width="20"></th>
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
          <?php $total = 0; ?>
          <?php foreach($aPrio as $prio => $class){ ?>
            <tbody class="<?= $class ?>">
              <?php foreach($aOrders as $aOrder){ ?>
                <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>
                  <?php @$total += $aOrder->HdIntPrplGeneral->order_start_quantity; ?>
                  <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                    <td><?= ($prio == 1) ? '<i class="fa fa-bolt text-warning fa-no-margin"></i>' : '' ?></td>
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

      <?php foreach($aStatusList as $status){ ?>
        <div class="tab-pane" id="<?= $status->code ?>">

          <?php if($this->Subcount->makeSubCount($aOrders, "general_status", $status->id, 1) == 0){ ?>
            <br/><p class="alert alert-warning">Geen orders in de status <b><?= $status->naam ?></b></p>
          <?php }else{ ?>
            <table class="table table-condensed table-hover">
              <thead>
              <tr>
                <th width="20"></th>
                <th width="80">Ordernr.</th>
                <th width="100">Datum</th>
                <th width="250">Klant</th>
                <th width="80" class="text-right">Aantal</th>
                <th width="100">Artikelnr.</th>
                <th>Omschrijving</th>
                <th width="200">Medewerker</th>
                <th width="80"></th>
              </tr>
              </thead>

                <?php $total = 0; ?>
              <?php foreach($aPrio as $prio => $class){ ?>
                <tbody class="<?= $class ?>">
                <?php foreach($aOrders as $aOrder){ ?>
                  <?php if($aOrder->HdIntPrplGeneral->general_status == $status->id){ ?>
                    <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>
                      <?php @$total += $aOrder->HdIntPrplGeneral->order_start_quantity; ?>
                      <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                        <td><?= ($prio == 1) ? '<i class="fa fa-bolt text-warning fa-no-margin"></i>' : '' ?></td>
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
                        <td><?= $aOrder->employee_name ?></td>
                        <td><a href="/Order/<?= $aOrder->orderrule_id ?>" class="btn btn-xs bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                      </tr>
                    <?php } ?>
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
      <?php } ?>

    </div><!-- /.tab-content -->

  </div><!-- /.box-body -->
</div>
<?php $aPrio = [1 => "priority", 0 => "plain"] ?>

<meta http-equiv="refresh" content="300">

<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title"><i class="fa fa-paint-brush"></i> Studio</h3>
  </div>

  <div class="box-body">

    <ul class="nav nav-tabs" id="saveStateTab">
      <li class="active"><a href="#STUDIO" data-toggle="tab">Overzicht (<?= $aOrders->count() ?>)</a></li>
      <?php foreach($aStatusList as $status){ ?>
        <li><a href="#<?= $status->code ?>" data-toggle="tab"><?= $status->naam ?> (<?= \Cake\I18n\Number::precision(count(@$aGrouped[$status->id]),0) ?>)</a></li>
      <?php } ?>
    </ul>

    <div class="tab-content">

      <div class="tab-pane active" id="STUDIO">

        <?php if($this->Subcount->makeSubCount($aOrders, "general_status", $status->id, 1) == 0){ ?>
          <br/><p class="alert alert-warning">Geen orders in de hoofdstatus <b>Studio</b></p>
        <?php }else{ ?>
        <table class="table table-condensed table-hover">
          <thead>
            <tr>
              <th width="20"></th>
              <th width="80">Ordernr.</th>
              <th width="100">Datum</th>
              <th width="100">Klantcode</th>
              <th width="250">Klant</th>
              <th width="100">Artikelcode</th>
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
                  <?php $total += $aOrder->HdIntPrplGeneral->order_quantity_new ?>
                  <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                    <td><?= ($prio == 1) ? '<i class="fa fa-bolt text-warning fa-no-margin"></i>' : '' ?></td>
                    <td><?= $aOrder->order_nr ?></td>
                    <td><?= $aOrder->order_date->format('d-m-Y') ?></td>
                    <td><?= $aOrder->adres_code ?></td>
                    <td><?= $aOrder->adres_name ?></td>
                    <td><?= $aOrder->product_code ?></td>
                    <td>
                      <?= $aOrder->order_description ?>
                      <?php if($aOrder->HdIntPrplGeneral->fsc_order == 1){ echo "<i class='fa fa-leaf text-success'></i>"; } ?>
                      <br />
                      <?= ($aOrder->HdIntPrplGeneral->reprint == 1) ? "<div class='label label-success'>Ongewijzigde herdruk</div>&nbsp;" : "" ?>
                    </td>
                    <td><?= $aStatusList[$aOrder->HdIntPrplGeneral->general_status]->naam ?></td>
                    <td><a href="/Studio/Instructions/<?= $aOrder->orderrule_id ?>" class="btn btn-xs bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                  </tr>
                <?php } ?>
              <?php } ?>
            </tbody>
          <?php } ?>

            <tfoot>
            <th></th>
            <th colspan="4">Totaal</th>
            <th class="text-left"><?= \Cake\I18n\Number::precision($total, 0); ?></th>
            <th colspan="3"></th>
            </tfoot>

        </table>
        <?php } ?>

      </div><!-- /.tab-pane -->

      <?php foreach($aStatusList as $status){ ?>
        <div class="tab-pane" id="<?= $status->code ?>">
          <?php $total = 0; ?>
          <?php if($this->Subcount->makeSubCount($aOrders, "general_status", $status->id, 1) == 0){ ?>
            <br/><p class="alert alert-warning">Geen orders in de status <b><?= $status->naam ?></b></p>
          <?php }else{ ?>
            <table class="table table-condensed table-hover">
              <thead>
              <tr>
                <th width="20"></th>
                <th width="80">Ordernr.</th>
                <th width="100">Datum</th>
                <th width="100">Klantcode</th>
                <th width="250">Klant</th>
                <th width="100">Artikelcode</th>
                <th>Omschrijving</th>
                <th width="200">Medewerker</th>
                <th width="80"></th>
              </tr>
              </thead>

              <?php foreach($aPrio as $prio => $class){ ?>
                <tbody class="<?= $class ?>">
                <?php foreach($aOrders as $aOrder){ ?>
                  <?php if($aOrder->HdIntPrplGeneral->general_status == $status->id){ ?>
                    <?php if($aOrder->HdIntPrplGeneral->priority == $prio){ ?>
                      <?php $total += $aOrder->HdIntPrplGeneral->order_quantity_new ?>
                      <tr class="<?= ($prio == 1) ? 'warning' : '' ?>" data-touch-href="/Order/<?= $aOrder->orderrule_id ?>">
                        <td><?= ($prio == 1) ? '<i class="fa fa-bolt text-warning fa-no-margin"></i>' : '' ?></td>
                        <td><?= $aOrder->order_nr ?></td>
                        <td><?= $aOrder->order_date->format('d-m-Y') ?></td>
                        <td><?= $aOrder->adres_code ?></td>
                        <td><?= $aOrder->adres_name ?></td>
                          <td><?= $aOrder->product_code ?></td>
                        <td>
                          <?= $aOrder->order_description ?>
                          <?php if($aOrder->HdIntPrplGeneral->fsc_order == 1){ echo "<i class='fa fa-leaf text-success'></i>"; } ?>
                          <br />
                          <?= ($aOrder->HdIntPrplGeneral->reprint == 1) ? "<div class='label label-success'>Ongewijzigde herdruk</div>&nbsp;" : "" ?>
                        </td>
                        <td><?= $aOrder->employee_name ?></td>
                        <td>
                            <a href="/Studio/Instructions/<?= $aOrder->orderrule_id ?>" class="btn btn-xs btn-block bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a>
                            <?php if($status->naam == "Bestand uploaden"){ ?>
                                <form id="upload_<?= $aOrder->orderrule_id ?>" method="post" action="/Order/saveStudioAnswer/<?= $aOrder->orderrule_id ?>">
                                    <input type="hidden" name="studio_msg" value="" />
                                    <button type="submit" name="submit" value="done_8" class="btn btn-xs btn-success btn-block" style="margin-top: 5px;">
                                        Done <i class="fa fa-check fa-no-margin"></i>
                                    </button>
                                </form>
                            <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
                </tbody>
              <?php } ?>

                <tfoot>
                <th></th>
                <th colspan="4">Totaal</th>
                <th class="text-left"><?= \Cake\I18n\Number::precision($total, 0); ?></th>
                <th colspan="3"></th>
                </tfoot>

            </table>
          <?php } ?>

        </div><!-- /.tab-pane -->
      <?php } ?>

    </div><!-- /.tab-content -->

  </div><!-- /.box-body -->
</div>
<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title"><i class="fa fa-eur"></i> Orders factureren</h3>
    <div class="pull-right">
      <?php if($adminlogin["rights"] === true || $adminlogin["rights"] != '2'){ ?>
        <a href="#" id="export" onClick="fnExcelReport('table2excel', 'Factureren');" class="btn btn-xs bg-purple">
          <i class="fa fa-file-excel-o"></i> <?= __('Maak export') ?>
        </a>
      <?php } ?>
    </div>
  </div>

  <div class="box-body">

    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab_1-1" data-toggle="tab">Overzicht (<?= $this->Subcount->makeSubCount($aOrders, "general_status", "-1", "1") ?>)</a></li>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active" id="tab_1-1">

        <?php if($this->Subcount->makeSubCount($aOrders, "general_status", 2, 1) == 0){ ?>
          <br/><p class="alert alert-warning">Geen orders om te factureren</p>
        <?php }else{ ?>
        <table class="table table-condensed table-hover" id="table2excel">
          <thead>
            <tr>
              <th width="20"></th>
              <th width="80">Ordernr.</th>
              <th width="100">Datum</th>
              <th width="250">Klant</th>
              <th width="80" class="text-right">Aantal</th>
              <th width="80" class="text-right">Factureren</th>
              <th width="100">Artikelnr.</th>
              <th>Omschrijving</th>
              <th width="125" class="text-right">Wachten</th>
              <th width="100"></th>
              <th width="100"></th>
            </tr>
          </thead>

          <tbody>
          <?php
          $total = 0;
          foreach($this->Subcount->makeSubSet($aOrders, "general_status", "-1", "1") as $aOrder){
            $total += $aOrder->quantity_send;
            ?>

                  <tr <?php if($aOrder->HdIntPrplViewItem->HdIntPrplGeneral->fsc_order == 1){ echo "class='success'"; } ?> data-touch-href="/Order/<?= $aOrder->order_nrint ?>">
                    <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                    <td><?= $aOrder->HdIntPrplViewItem->order_nr ?></td>
                    <td><?= $aOrder->HdIntPrplViewItem->order_date ?></td>
                    <td>
                      <?= $aOrder->HdIntPrplViewItem->adres_name ?>
                      <?php if($aOrder->truck == 1){
                        echo '<i class="fa fa-truck pull-right fa-2x"></i>';
                      }
                      ?>
                    </td>
                    <td class="text-right"><?= number_format($aOrder->HdIntPrplViewItem->orderrule_quantity,0,",",".") ?></td>
                    <td class="text-right"><?= number_format($aOrder->quantity_send,0,",",".") ?></td>
                    <td><?= $aOrder->HdIntPrplViewItem->product_code ?></td>
                    <td><?= $aOrder->HdIntPrplViewItem->order_description ?></td>
                    <td class="text-right">
                      <?php
                      $iDays = $aOrder->daysToInvoice;
                      if($iDays == 0){
                        echo "<strong>Vandaag</strong>";
                      }elseif($iDays == -1){
                        echo "<strong>".abs($iDays)." dag geleden</strong>";
                      }elseif($iDays < 0) {
                        echo "<strong>".abs($iDays)." dagen geleden</strong>";
                      }elseif($iDays == 1){
                        echo "Nog ".$iDays." dag";
                      }else{
                        echo "Nog ".$iDays." dagen";
                      }
                      ?>
                    </td>
                    <td><a href="/Order/<?= $aOrder->HdIntPrplViewItem->orderrule_id ?>" class="btn btn-xs btn-block bg-gray">Bekijk order</a></td>
                    <td>
   

                      <div class="btn-group btn-group-xs text-right">
                        <!--                          <button type="submit" class="btn btn-danger">Inslaan</button>-->
                        <button type="button" class="btn btn-xs btn-block bg-purple dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Factureren&nbsp;&nbsp;<span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li></li>
                          <li><?= $this->Form->postLink('Factureren', ['action' => 'setInvoice', 0, $aOrder->id]); ?></li>
                          <li><?= $this->Form->postLink('Gehele order factureren', ['action' => 'setInvoice', 1, $aOrder->id]); ?></li>
                        </ul>
                      </div>
                    </td>
                  </tr>
            <?php } ?>
          </tbody>

          <tfoot>
            <tr>
                <th><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></th>
                <th colspan="4">Totaal</th>
                <th class="text-right"><?= number_format($iTotal,0,",",".") ?></th>
                <th colspan="5"></th>
            </tr>
          </tfoot>
        </table>
        <?php } ?>

      </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->

  </div><!-- /.box-body -->
</div>
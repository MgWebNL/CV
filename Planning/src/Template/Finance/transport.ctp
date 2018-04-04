<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title"><i class="fa fa-eur"></i> Invoer transportkosten</h3>
  </div>

  <div class="box-body">
    <form method="post" action="/Finance/setTransport/">
      <!-- SHORTCUT BUTTONS -->
      <div class="pull-right">
        <div class="form-inline">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-eur fa-no-margin"></i></span>
            <input type="number" step="0.01" class="form-control input-sm" name="merge_transport_cost" />
          </div>
          <button type="submit" name="merge_transport" class="btn btn-sm bg-purple"><i class="fa fa-eur"></i> Combineer transport</button>
        </div>

      </div>

      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1-1" data-toggle="tab">Overzicht (<?= $this->Subcount->makeSubCount($aOrders, "general_status", "-1", "1") ?>)</a></li>

      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="tab_1-1">

          <?php if($this->Subcount->makeSubCount($aOrders, "general_status", 2, 1) == 0){ ?>
            <br/><p class="alert alert-warning">Geen orders om transportkosten op te voeren</p>
          <?php }else{ ?>




          <table class="table table-condensed table-hover">
            <thead>
              <tr>
                <th width="20"><input type="checkbox" id="checkAll" /></th>
                <th width="80">Ordernr.</th>
                <th width="100">Datum</th>
                <th width="250">Klant</th>
                <th width="80" class="text-right">Aantal</th>
                <th width="80" class="text-right">Verstuurd</th>
                <th width="100">Artikelnr.</th>
                <th>Omschrijving</th>
                <th width="125">Transportkosten</th>
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
                    <tr data-touch-href="/Order/<?= $aOrder->order_nrint ?>" <?php if($aOrder->HdIntPrplViewItem->HdIntPrplGeneral->fsc_order == 1){ echo "class='success'"; } ?>>
                      <td><input type="checkbox" name="order_nrint[<?= $aOrder->id ?>]" value="<?= $aOrder->order_nrint ?>" /></td>
                      <td><?= $aOrder->HdIntPrplViewItem->order_nr ?></td>
                      <td><?= $aOrder->HdIntPrplViewItem->order_date ?></td>
                      <td><?= $aOrder->HdIntPrplViewItem->adres_name ?></td>
                      <td class="text-right"><?= number_format($aOrder->HdIntPrplViewItem->orderrule_quantity,0,",",".") ?></td>
                      <td class="text-right"><?= number_format($aOrder->quantity_send,0,",",".") ?></td>
                      <td><?= $aOrder->HdIntPrplViewItem->product_code ?></td>
                      <td><?= $aOrder->HdIntPrplViewItem->order_description ?></td>
                      <td>
                          <input type="number" step="0.01" class="form-control input-xs" name="transport_cost[<?= $aOrder->id ?>]" />
                          <input type="hidden" value="<?= $aOrder->quantity_send ?>" name="quantity[<?= $aOrder->id ?>]" />
                      </td>
                      <td><a href="/Order/<?= $aOrder->order_nrint ?>" class="btn btn-xs btn-block bg-gray">Bekijk order</a></td>
                      <td>
                          <button type="submit" name="saveSingleLine" value="<?= $aOrder->id ?>" class="btn btn-xs btn-block bg-purple">Opslaan</button>
                      </td>
                    </tr>
              <?php } ?>
            </tbody>
          <?php } ?>
        </table>

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
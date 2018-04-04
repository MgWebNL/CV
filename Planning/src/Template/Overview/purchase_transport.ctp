<?php
use Cake\I18n\Number;
?>
<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title">
      <i class="fa fa-eur"></i> <?= __('Inkooporder transport') ?>

    </h3>
    <div class="pull-right">
        <form method="post" class="form-inline" action="/overview/purchaseTransportPost/">

          <div class="input-daterange input-group" id="datepicker">
            <input type="text" required class="input-sm form-control" name="startDate" value="<?= @$sStartDate ?>" />
            <span class="input-group-addon">t/m</span>
            <input type="text" required class="input-sm form-control" name="endDate" value="<?= @$sEndDate ?>" />
          </div>

          <select name="reinvoice" class="input-sm form-control">
            <option value="0">Factureren</option>
            <option value="1" <?= @$iReinvoice == 1 ? "selected" : "" ?>>Bekijken</option>
          </select>
          <button class="btn btn-sm btn-success" type="submit">Maak overzicht</button>

        </form>
    </div>
  </div>

  <?php if(isset($sStartDate) && $aInvoiceRules->count() > 0){ ?>

    <form method="post" action="/Overview/sendPurchaseTransport/">
      <div class="box-body">

        <table class="table table-condensed table-bordered table-sortable table-striped table-hover">
          <thead>
          <tr class="orderListHomeHeader" id="headerTable">
            <th width="100" align="left">Ordernummer</th>
            <th align="left">Klant</th>
            <th class="text-left" width="80">Land</th>
            <th class="text-right" width="80">Verz. Dtm</th>
            <th class="text-right" width="80">Aantal</th>
            <th class="text-right" width="80">Colli</th>

          </tr>
          </thead>

          <tbody>
          <?php $total = []; ?>
          <?php foreach(@$aInvoiceRules as $lijst){ ?>
            <?php @$total[$lijst->HdIntPrplViewItem->afleveradres_countryname] += $lijst->total_colli; ?>
            <tr <?= ($lijst->invoiced == 1) ? "class='success'" : "" ?> >
              <input type="hidden" name="id[]" value="<?= $lijst->id ?>" />
              <td><?= $lijst->HdIntPrplViewItem->order_nr ?></td>
              <td><?= $lijst->HdIntPrplViewItem->adres_name ?></td>
              <td><?= $lijst->HdIntPrplViewItem->afleveradres_countrycode ?></td>
              <td><?= $lijst->to_transport_date->format('d-m-Y') ?></td>
              <td align="right"><?= Number::precision($lijst->HdIntPrplPartialDelivery->quantity_send,0) ?></td>
              <td align="right"><?= Number::precision($lijst->total_colli,0) ?></td>
            </tr>
          <?php } ?>

          </tbody>

          <tfoot>
          <tr>
            <td colspan="6">
              <hr />
            </td>
          </tr>
          <?php foreach($total as $land => $aantal){ ?>
          <tr>
            <td><strong><?= $land ?>:</strong></td>
            <td colspan="5" align="right"><strong><?= Number::precision($aantal, 0) ?></strong></td>
          </tr>
          <?php } ?>
          </tfoot>

        </table><br />
        <?php if(@$iReinvoice != 1 && $aInvoiceRules->count() > 0){ ?>
          <button type="submit" class="btn btn-success pull-right">Maak inkooporder</button>
          <div class="clearfix"></div>
        <?php } ?>
      </div>
    </form>

  <?php }elseif(isset($sStartDate)){ ?>
  <div class="box-body">
      <div class="alert alert-warning">
        Geen gegevens beschikbaar voor deze periode
      </div>
  </div>
  <?php }else{ ?>
  <div class="box-body">
    <div class="alert alert-warning">
        Selecteer een periode
    </div>
  </div>
  <?php } ?>
</div>



<script>
  $(function(){
    $('#datepicker').datepicker({
      format: "dd-mm-yyyy",
      endDate: "today",
      maxViewMode: 2,
      todayBtn: "linked",
      language: "nl",
      keyboardNavigation: false,
      autoclose: true
    });
  });
</script>
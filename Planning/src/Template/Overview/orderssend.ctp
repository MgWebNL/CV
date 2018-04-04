<?php
use Cake\I18n\Number;
?>
<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title">
      <i class="fa fa-line-chart"></i> <?= __('Verzonden aantallen') ?>

    </h3><div class="pull-right">Aantal orders: <?= Number::precision(count($aList),0) ?></div>
  </div>

  <div class="box-body">
    <form method="post" action="/overview/orderssend/">
      Filters:

      <select name="product" required="required">
        <option value="0">Alle producten</option>
        <?php foreach($aGBs as $prod){ ?>
          <option value="<?= $prod->BKHGBNR ?>" <?= isset($this->request->data()["product"]) && ($this->request->data()["product"] == $prod->BKHGBNR) ? "selected" : "" ?>>
            <?= $prod->BKHGBOMS ?>
          </option>
        <?php } ?>
      </select>

      <select name="company" required="required">
        <option value="0">Alle werkplaatsen</option>
        <?php foreach($aCustomers as $comp){ ?>
          <option value="<?= $comp->adres_nrint ?>" <?= isset($this->request->data()["company"]) && ($this->request->data()["company"] == $comp->adres_nrint) ? "selected" : "" ?>>
            <?= $comp->adres_alias ?>
          </option>
        <?php } ?>
      </select>

      <br /><br />


      <input type="submit" name="today" value="Vandaag" />
      <input type="submit" name="yesterday" value="Gisteren" />
      <input type="submit" name="week" value="Deze week" />
      <input type="submit" name="month" value="Deze maand" />
      <input type="submit" name="thisyear" value="Dit jaar" />
      - of -
      <input type="text" id="datepicker1" name="from" placeholder="Vanaf" value="<?= isset($this->request->data()["from"]) ? $this->request->data()["from"] : "" ?>" />
      <input type="text" id="datepicker2" name="to" placeholder="t/m datum" value="<?= isset($this->request->data()["to"]) ? $this->request->data()["to"] : "" ?>" />
      <input type="submit" name="dates" value="Bekijk" />
    </form>

    <table class="table table-condensed table-bordered table-sortable table-striped table-hover">
      <thead>
      <tr class="orderListHomeHeader" id="headerTable">
        <th width="100" align="left">Ordernummer</th>
        <th align="left">Klant</th>
        <th>Verpakker</th>
        <th>GB</th>
        <th class="text-right" width="80">Aantal</th>
        <th class="text-right"width="100">Verstuurd</th>
        <td class="text-right" width="80"></td>

      </tr>
      </thead>

      <tbody>
      <?php $total = 0 ?>
      <?php foreach($aList as $lijst){ ?>
        <tr>
          <td><?= $lijst->BKHORNR ?></td>
          <td><?= $lijst->BKHADNAAM ?></td>
          <td><?= $lijst->BKHADCODE ?></td>
          <td><?= $lijst->BKHGBOMS ?></td>
          <td data-order="<?= Number::precision($lijst->quantity_send,0) ?>" align="right"><?= Number::precision($lijst->quantity_send,0) ?></td>
          <td data-order="<?= $lijst->send_date->format('Ymd') ?>" align="right"><?= $lijst->send_date->format('d-m-Y') ?></td>
          <td class="adminListEditDealer">
            <a href="/Order/<?= $lijst->order_nrint ?>" class="btn btn-danger btn-xs btn-block">
              Naar order&nbsp;&nbsp;<i class="glyphicon glyphicon-chevron-right"></i>
            </a>
          </td>
        </tr>
      <?php $total += $lijst->quantity_send; ?>
      <?php } ?>

      </tbody>

      <tfoot>
      <tr>
        <td><strong>Totaal:</strong></td>
        <td colspan="4" align="right"><?= Number::precision($total, 0) ?></td>
        <td colspan="2"></td>
      </tr>
      </tfoot>

    </table>
  </div>
</div>
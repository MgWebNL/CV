<meta http-equiv="refresh" content="300">

<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title"><i class="fa fa-line-chart"></i> Voorraadoverzicht</h3>
  </div>

  <div class="box-body">

    <table class="table table-condensed table-fixed-header table-striped">
      <thead class="header">
      <tr>
        <th style="width: 879px;">Art.Code</th>
        <th class="text-right" align="right" width="80" style="width: 80px;">Verwacht</th>
        <th class="text-right" width="80" style="width: 80px;">Voorraad</th>
        <th class="text-right" width="80" style="width: 80px;">Besteld</th>
        <th class="text-right" width="80" style="width: 80px;">Nodig</th>
        <th class="text-right" width="80" style="width: 95px;">Beschikbaar</th>
        <th class="text-right" width="80" style="width: 80px;">Bestellen</th>
      </tr>
      </thead>

      <tbody>
      <?php foreach($aNapkins as $item){ ?>
        <tr>
          <td><?= $item->BKHARCODE ?></td>
          <td class="text-right"><?= number_format($item->verwacht, 0, ",", ".") ?></td>
          <td class="text-right"><?= number_format($item->stock, 0, ",", ".") ?></td>
          <td class="text-right"><?= number_format($item->besteld, 0, ",", ".") ?></td>
          <td class="text-right"><?= number_format($item->nodig, 0, ",", ".") ?></td>
          <td class="text-right"><?= number_format($item->stock - $item->nodig + $item->besteld, 0, ",", ".") ?></td>
          <td class="text-right"><?= $item->stock - $item->nodig + $item->besteld < 0 ? "<strong>".number_format(abs($item->stock - $item->nodig + $item->besteld), 0, ",", ".")."</strong>" : 0 ?></td>
        </tr>
      <?php } ?>
      </tbody>

    </table>

  </div><!-- /.tab-content -->

</div><!-- /.box-body -->
</div>
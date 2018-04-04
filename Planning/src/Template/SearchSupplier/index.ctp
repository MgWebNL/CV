<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title"><i class="fa fa-search"></i> <?= number_format(count($aOrders),0, ",", ".") ?> resultat(en) voor <em><?= $this->request->data["searchKey"] ?></em></h3>
  </div>

  <div class="box-body">


        <?php if($aOrders){ ?>
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

          <tbody class="priority">
            <?php
                foreach($this->Subcount->makeSubSet($aOrders, "general_status", "-1", "1") as $aOrder){
              ?>



                    <tr <?php if($aOrder->HdIntPrplGeneral->fsc_order == 1){ echo "class='success'"; } ?>>
                        <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                        <td><?= $aOrder->order_nr ?></td>
                        <td><?= $aOrder->order_date->format('d-m-Y') ?></td>
                        <td><?= $aOrder->adres_name ?></td>
                        <td class="text-right"><?= number_format($aOrder->HdIntPrplGeneral->order_start_quantity,0,",",".") ?></td>
                        <td><?= $aOrder->product_code ?></td>
                        <td><?= $aOrder->order_description ?></td>
                        <td><?= $aStatus[$aOrder->HdIntPrplGeneral->general_status]->naam ?></td>
                        <td><a href="/Packaging/Order/<?= $aOrder->orderrule_id ?>" class="btn btn-xs bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                    </tr>
            <?php } ?>
          </tbody>


        </table>
        <?php } ?>

  </div><!-- /.box-body -->
</div>
<meta http-equiv="refresh" content="300">

<!-- PANEL CONTACT -->
<div class="box box-default">

  <div class="box-header">
    <h3 class="box-title"><i class="fa fa-paint-brush"></i> Studio</h3>
  </div>

  <div class="box-body">

    <ul class="nav nav-tabs" id="saveStateTab">
      <li class="active"><a href="#tab_1-1" data-toggle="tab">Overzicht (<?= $this->Subcount->makeSubCount($aOrders, "general_status", "-1", "1") ?>)</a></li>
      <?php foreach($aStatus as $status){ ?>
        <li><a href="#<?= $status["status_type"] ?>-<?= $status["volgorde"] ?>" data-toggle="tab"><?= $status["naam"] ?> (<?= $this->Subcount->makeSubCount($aOrders, "general_status", $status["id"]) ?>)</a></li>
      <?php } ?>
    </ul>

    <div class="tab-content">
      <div class="tab-pane active" id="tab_1-1">

        <?php if($this->Subcount->makeSubCount($aOrders, "general_status", $status->id, 1) == 0){ ?>
          <br/><p class="alert alert-warning">Geen orders in de hoofdstatus <b>Studio</b></p>
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

            <tbody class="priority">
            <?php
            foreach($this->Subcount->makeSubSet($aOrders, "general_status", "-1", "1") as $aOrder){
              if($aOrder["priority"] == 1){
                ?>
                <tr data-touch-href="/Order/<?= $aOrder->ORDERREGELNRINT ?>" class='warning'>
                  <td><i class="fa fa-bolt text-warning fa-no-margin"></i></td>
                  <td><?= $aOrder->BKHORNR ?></td>
                  <td><?= $aOrder->BKHORDATUM->format('d-m-Y') ?></td>
                  <td><?= $aOrder->BKHADNAAM ?></td>
                  <td class="text-right"><?= number_format($aOrder->order_start_quantity,0,",",".") ?></td>
                  <td><?= $aOrder->BKHARCODE ?></td>
                  <td>
                    <?= $aOrder->BKHOROMS ?>

                    <?php
                    $a = explode(",",$aOrder->article_editions);
                    if(strlen(implode('', $a)) != 0){
                      echo "<br />";
                      foreach($a as $option){
                        if(isset($aEditie[$option])){
                          echo "<div class='label label-success'>".$aEditie[$option]["edition_name"]."</div>&nbsp;";
                        }
                      }} ?>
                  </td>
                  <td><?= $aStatus[$aOrder->general_status]->naam ?></td>
                  <td><a href="/Studio/Instructions/<?= $aOrder->ORDERREGELNRINT ?>/#Prepress" class="btn btn-xs bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                </tr>
              <?php }} ?>
            </tbody>

            <tbody class="plain">
            <?php
            foreach($aOrders as $aOrder){
              if($aOrder["priority"] != 1){
                ?>
                <tr data-touch-href="/Order/<?= $aOrder->ORDERREGELNRINT ?>" <?php if($aOrder->fsc_order == 1){ echo "class='success'"; } ?>>
                  <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                  <td><?= $aOrder->BKHORNR ?></td>
                  <td><?= $aOrder->BKHORDATUM->format('d-m-Y') ?></td>
                  <td><?= $aOrder->BKHADNAAM ?></td>
                  <td class="text-right"><?= number_format($aOrder->order_start_quantity,0,",",".") ?></td>
                  <td><?= $aOrder->BKHARCODE ?></td>
                  <td>
                    <?= $aOrder->BKHOROMS ?>

                    <?php
                    $a = explode(",",$aOrder->article_editions);
                    if(strlen(implode('', $a)) != 0){
                      echo "<br />";
                      foreach($a as $option){
                        if(isset($aEditie[$option])){
                          echo "<div class='label label-success'>".$aEditie[$option]["edition_name"]."</div>&nbsp;";
                        }
                      }} ?>
                  </td>
                  <td><?= $aStatus[$aOrder->general_status]->naam ?></td>
                  <td><a href="/Studio/Instructions/<?= $aOrder->ORDERREGELNRINT ?>/#Prepress" class="btn btn-xs bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a></td>
                </tr>
              <?php }} ?>
            </tbody>

            <tfoot>
            <tr>
              <th></th>
              <th colspan="3">Totaal</th>
              <th class="text-right"><?= number_format($this->Subcount->makeSubSum($aOrders, "general_status", "-1", "order_start_quantity", 1),0,",",".") ?></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            </tfoot>
          </table>
        <?php } ?>

      </div><!-- /.tab-pane -->

      <?php foreach($aStatus as $status){ ?>
        <div class="tab-pane" id="<?= $status["status_type"] ?>-<?= $status["volgorde"] ?>">

          <?php if($this->Subcount->makeSubCount($aOrders, "general_status", $status->id) == 0){ ?>
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

              <tbody class="priority">
              <?php
              foreach($this->Subcount->makeSubSet($aOrders, "general_status", $status["id"]) as $aOrder){
                if($aOrder->priority == 1){
                  ?>
                  <tr class='warning'>
                    <td><i class="fa fa-bolt text-warning fa-no-margin"></i></td>
                    <td><?= $aOrder->BKHORNR ?></td>
                    <td><?= $aOrder->BKHORDATUM->format('d-m-Y') ?></td>
                    <td><?= $aOrder->BKHADNAAM ?></td>
                    <td class="text-right"><?= number_format($aOrder->order_start_quantity,0,",",".") ?></td>
                    <td><?= $aOrder->BKHARCODE ?></td>
                    <td>
                      <?= $aOrder->BKHOROMS ?>

                      <?php
                      $a = explode(",",$aOrder->article_editions);
                      if(strlen(implode('', $a)) != 0){
                        echo "<br />";
                        foreach($a as $option){
                          if(isset($aEditie[$option])){
                            echo "<div class='label label-success'>".$aEditie[$option]["edition_name"]."</div>&nbsp;";
                          }
                        }} ?>
                    </td>
                    <td><?= $aOrder->ADVMWNAAM ?></td>
                    <td>
                      <a href="/Studio/Instructions/<?= $aOrder->ORDERREGELNRINT ?>/#Prepress" class="btn btn-xs bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a>
                      <?php if($status->naam == "Bestand uploaden"){ ?>
                        <form id="upload_<?= $aOrder->ORDERREGELNRINT ?>" method="post" action="/Order/saveStudioAnswer/<?= $aOrder->ORDERREGELNRINT ?>">
                          <input type="hidden" name="studio_msg" value="" />
                          <button type="submit" name="submit" value="done_8" class="btn btn-xs btn-success btn-block" style="margin-top: 5px;">
                            Done <i class="fa fa-check fa-no-margin"></i>
                          </button>
                        </form>
                      <?php } ?>
                    </td>
                  </tr>
                <?php }} ?>
              </tbody>

              <tbody class="plain">
              <?php
              foreach($this->Subcount->makeSubSet($aOrders, "general_status", $status["id"]) as $aOrder){
                if($aOrder->priority != 1){
                  ?>
                  <tr <?php if($aOrder->fsc_order == 1){ echo "class='success'"; } ?>>
                    <td><!-- <i class="fa fa-warning text-danger fa-no-margin"></i> --></td>
                    <td><?= $aOrder->BKHORNR ?></td>
                    <td><?= $aOrder->BKHORDATUM->format('d-m-Y') ?></td>
                    <td><?= $aOrder->BKHADNAAM ?></td>
                    <td class="text-right"><?= number_format($aOrder->order_start_quantity,0,",",".") ?></td>
                    <td><?= $aOrder->BKHARCODE ?></td>
                    <td>
                      <?= $aOrder->BKHOROMS ?>

                      <?php
                      $a = explode(",",$aOrder->article_editions);
                      if(strlen(implode('', $a)) != 0){
                        echo "<br />";
                        foreach($a as $option){
                          if(isset($aEditie[$option])){
                            echo "<div class='label label-success'>".$aEditie[$option]["edition_name"]."</div>&nbsp;";
                          }
                        }} ?>
                    </td>
                    <td><?= $aOrder->ADVMWNAAM ?></td>
                    <td>
                      <a href="/Studio/Instructions/<?= $aOrder->ORDERREGELNRINT ?>/#Prepress" class="btn btn-xs btn-block bg-purple">Bekijk <i class="fa fa-chevron-right fa-no-margin"></i></a>
                      <?php if($status->naam == "Bestand uploaden"){ ?>
                          <form id="upload_<?= $aOrder->ORDERREGELNRINT ?>" method="post" action="/Order/saveStudioAnswer/<?= $aOrder->ORDERREGELNRINT ?>">
                            <input type="hidden" name="studio_msg" value="" />
                            <button type="submit" name="submit" value="done_8" class="btn btn-xs btn-success btn-block" style="margin-top: 5px;">
                              Done <i class="fa fa-check fa-no-margin"></i>
                            </button>
                          </form>
                      <?php } ?>
                    </td>
                  </tr>
                <?php }} ?>
              </tbody>

              <tfoot>
              <tr>
                <th></th>
                <th colspan="3">Totaal</th>
                <th class="text-right"><?= number_format($this->Subcount->makeSubSum($aOrders, "general_status", $status["id"], "order_start_quantity"),0,",",".") ?></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
              </tfoot>
            </table>
          <?php } ?>

        </div><!-- /.tab-pane -->
      <?php } ?>
    </div><!-- /.tab-pane -->


  </div><!-- /.tab-content -->

</div><!-- /.box-body -->
</div>
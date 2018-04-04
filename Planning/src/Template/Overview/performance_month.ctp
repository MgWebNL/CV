<div class="box box-default">

    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-line-chart"></i> <?= __('Doorlooptijd orders') ?></h3>
    </div>

    <div class="box-body">
        <!-- TABEL VOOR ORDERS -->
        <table class="table table-condensed table-bordered table-sortable table-striped table-hover">
            <thead>
            <tr class="orderListHomeHeader" id="headerTable">
                <th width="100" align="left">Ordernummer</th>
                <th>Klant</th>
                <th class="text-right" width="80">Aantal</th>

                <th class="text-right" width="110">Uit prepress</th>
                <th class="text-right" width="110">Uit productie</th>
                <th class="text-right" width="100">Doorlooptijd</th>
                <th class="text-right" width="80"></th>
            </tr>
            </thead>

            <?php foreach($aList as $k=>$lijst){ ?>
                <?php
                if($lijst["avg"] > 49) {
                    $class = "danger";
                }elseif($lijst["avg"] < 42) {
                    $class = "success";
                }else{
                    $class="warning";
                }
                ?>
                <tr>
                    <td><?= $lijst["ordernumber"] ?></td>
                    <td><?= $lijst["customer"] ?></td>
                    <td align="right"><?= $lijst["quantity"] ?></td>
                    <td align="right"><?= $lijst["certification_date"]->format('d-m-Y') ?></td>
                    <td align="right"><?= $lijst["orderreturn_date"]->format('d-m-Y') ?></td>
                    <td align="right" class="<?= $class ?>"><?= $lijst["avg"] ?> dagen</td>
                    <td class="adminListEditDealer">
                        <a class="btn btn-danger btn-xs btn-block" href="/Order/<?= $lijst["id"] ?>/">
                            Naar order&nbsp;&nbsp;<i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>


        </table>
    </div>
</div>




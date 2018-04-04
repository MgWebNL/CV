<!-- Modal -->
<?= $this->element('Modal/request'); ?>

<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Searchresults') ?> - <?= \Cake\I18n\Number::format($aResults['count']) ?> <?= __('results for') ?> <em><?= __($aResults['basics']["keywords"]) ?></em>
                </h2>
            </div>

            <?php if($aResults['count'] == 0){ ?>
                <div class="card-body card-padding">
                    <div class="alert alert-warning m-b-0">
                        <?= __('No items available'); ?>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="card-body card-padding">
                    <?php if(count($res = $aResults["results"]["quote"]) > 0){ ?>
                        <h4><?= __('Quotations') ?></h4>
                        <table class="table table-hover table-condensed no-padding">
                            <thead>
                            <tr>
                                <th width="125">#</th>
                                <th class="visible-xs"></th>
                                <th class="hidden-xs">Omschrijving</th>
                                <th class="text-right" width="125">Datum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($res as $r){ ?>
                                <tr data-href="/Search/gotoResult/Quotation/<?= $r->ORDOFNRINT ?>/<?= $sToken ?>">
                                    <td><?= $r->ORDOFNR ?></td>
                                    <td class="visible-xs">&nbsp;</td>
                                    <td class="hidden-xs"><?= $r->ORDOFOMS ?></td>
                                    <td class="text-right"><?= $r->ORDOFDATUM->format('d-m-Y') ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                        <hr />
                    <?php } ?>

                    <?php if(count($res = $aResults["results"]["order"]) > 0){ ?>
                        <h4><?= __('Orders') ?></h4>
                        <table class="table table-hover table-condensed no-padding">
                            <thead>
                            <tr>
                                <th width="125">#</th>
                                <th class="visible-xs"></th>
                                <th class="hidden-xs">Omschrijving</th>
                                <th class="text-right" width="125">Datum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($res as $r){ ?>
                                <tr data-href="/Search/gotoResult/Order/<?= $r->ORDORNRINT ?>/<?= $sToken ?>">
                                    <td><?= $r->ORDORNR ?></td>
                                    <td class="visible-xs">&nbsp;</td>
                                    <td class="hidden-xs"><?= $r->ORDOROMS ?></td>
                                    <td class="text-right"><?= $r->ORDORDATUM->format('d-m-Y') ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                        <hr />
                    <?php } ?>

                    <?php if(count($res = $aResults["results"]["invoice"]) > 0){ ?>
                        <h4><?= __('Invoices') ?></h4>
                        <table class="table table-hover table-condensed no-padding">
                            <thead>
                            <tr>
                                <th width="125">#</th>
                                <th class="visible-xs"></th>
                                <th class="hidden-xs">Omschrijving</th>
                                <th class="text-right" width="125">Datum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($res as $r){ ?>
                                <tr data-href="/Search/gotoResult/Invoice/<?= $r->BKHVFNRINT ?>/<?= $sToken ?>">
                                    <td><?= $r->BKHVFNR ?></td>
                                    <td class="visible-xs">&nbsp;</td>
                                    <td class="hidden-xs"><?= $r->BKHVFOMS ?></td>
                                    <td class="text-right"><?= $r->BKHVFDATUM->format('d-m-Y') ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                        <hr />
                    <?php } ?>

                    <?php if(count($res = $aResults["results"]["article"]) > 0){ ?>
                        <h4><?= __('Articles') ?></h4>
                        <table class="table table-hover table-condensed no-padding">
                            <thead>
                            <tr>
                                <th width="125">#</th>
                                <th class="visible-xs"></th>
                                <th class="hidden-xs">Omschrijving</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($res as $r){ ?>
                                <tr data-href="/Search/gotoResult/Article/<?= $r->BKHARNRINT ?>/<?= $sToken ?>">
                                    <td><?= $r->BKHARCODE ?></td>
                                    <td class="visible-xs">&nbsp;</td>
                                    <td class="hidden-xs"><?= $r->BKHAROMS ?></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                        <hr />
                    <?php } ?>
                </div>
            <?php } ?>

        </div>
    </div>


</div>
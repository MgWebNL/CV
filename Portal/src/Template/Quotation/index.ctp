<!-- Modal -->
<?= $this->element('Modal/request'); ?>

<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Quotations') ?> - <?= __($sStatus) ?>
                    <div class="pull-right">
                        <a href="#" class="btn btn-xs btn-secondair btn-no-shadow" data-toggle="modal" data-target="#requestModal" title="<?= __('New request') ?>">
                            <i class="fa fa-plus"></i> <?= __('New request') ?>
                        </a>
                    </div>
                </h2>
            </div>

            <?php if(count($aList) == 0){ ?>
                <div class="card-body card-padding">
                    <div class="alert alert-warning bgm-secondair m-b-0">
                        <?= __('No items available'); ?>
                    </div>
                </div>
            <?php }else{ ?>
            <div class="card-body card-padding">
                <table class="table table-sortable table-hover table-condensed no-padding">
                    <thead>
                    <tr>
                        <th width="125">Ref.</th>
                        <th width="125"><?= __('No.') ?></th>
                        <th class="visible-xs"></th>
                        <th class="hidden-xs" width="125"><?= __('Date') ?></th>
                        <th class="hidden-xs"><?= __('Description') ?></th>
                        <th class="text-right" width="80"><?= __('Status') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($aList as $row){ ?>
                            <tr data-href="/Quotation/view/<?= $row->ORDOFNRINT ?>">
                                <td><?= ($row->ORDOFREFERENTIE == "") ? "<em>" . __("N/A") . "</em>" : $row->ORDOFREFERENTIE ?></td>
                                <td><?= $row->ORDOFNR ?></td>
                                <td class="visible-xs"></td>
                                <td data-sort="<?= $row->ORDOFDATUM->format('Ymd') ?>" class="hidden-xs"><?= $row->ORDOFDATUM->format('d-m-Y') ?></td>
                                <td class="hidden-xs"><?= $row->ORDOFOMS ?></td>
                                <td class="text-right">
                                    <?= __($row->ORDOFSTATUSTEXT["text"]) ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } ?>
        </div>
    </div>


</div>
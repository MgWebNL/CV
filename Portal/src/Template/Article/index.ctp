<?php use Cake\I18n\Number; ?>
<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Articles') ?> - <?= __($sStatus) ?>
                </h2>
            </div>

            <?php if(count($aList) == 0){ ?>
                <div class="card-body card-padding">
                    <div class="alert alert-warning m-b-0">
                        <?= __('No items available'); ?>
                    </div>
                </div>
            <?php }else{ ?>

                <div class="card-body card-padding">
                    <?php foreach($aList as $k => $aGB){ ?>
                        <h4><?= $aLedger->$k->BKHGBOMS ?></h4>
                        <table class="table table-hover table-condensed no-padding">
                            <thead>
                            <tr>
                                <th width="125"><?= __('My code') ?></th>
                                <th width="125"><?= __('Article no.') ?></th>
                                <th class="visible-xs"></th>
                                <th class="hidden-xs"><?= __('Description') ?></th>

<!--                                <th class="text-right" width="125">Besteldatum</th>-->
<!--                                <th class="text-right hidden-xs" width="125">Aantal</th>-->
                                <th class="text-right hidden-xs" width="80"><?= __('Type') ?></th>
                                <th class="text-right hidden-xs" width="125"><?= __('Last order') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($aGB as $rule){ ?>
                                <?php $oDate = new DateTime($rule->ArticleUsage["besteldatum"]); ?>
                                <tr data-href="/Article/view/<?= $rule->BKHARNRINT ?>">
                                    <td><?= $rule->customer_artNumber ?></td>
                                    <td><?= $rule->BKHARCODE ?></td>
                                    <td class="visible-xs">&nbsp;</td>
                                    <td class="hidden-xs"><?= $rule->BKHAROMS ?></td>

                                    <td class="text-right hidden-xs">
                                        <?= __($rule->BKHARCUSTOMERSTATUSTEXT["text"]) ?>
                                    </td>
                                    <td class="text-right hidden-xs">
                                        <?= date('d-m-Y', strtotime($rule->latest_order)); ?>
                                    </td>
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
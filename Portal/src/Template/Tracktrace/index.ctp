<?php use Cake\I18n\Number; ?>
<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Track & Trace') ?>
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
                    <table class="table table-hover table-condensed no-padding">
                        <thead>
                        <tr>
                            <th width="125">#</th>
                            <th class="visible-xs"></th>
                            <th class="hidden-xs">Referentie</th>
                            <th class="hidden-xs">Omschrijving</th>
                            <th class="text-right" width="125">Besteldatum</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($aList as $rule){ ?>
                            <tr data-href="/Order/view/<?= $rule->Order->ORDORNRINT ?>">
                                <td><?= $rule->tt_trackingnumber.$rule->tt_follownumber ?></td>
                                <td class="visible-xs">&nbsp;</td>
                                <td class="hidden-xs"><?= $rule->Order->ORDORREFERENTIE ?></td>
                                <td class="hidden-xs"><?= $rule->Order->ORDOROMS ?></td>
                                <td class="text-right"><?= @$rule->Order->ORDORDATUM->format('d-m-Y') ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            <?php } ?>

        </div>
    </div>
</div>
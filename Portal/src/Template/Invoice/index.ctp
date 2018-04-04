<?php use Cake\I18n\Number; ?>

<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Invoices') ?> - <?= __($sStatus) ?>
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
                            <th width="150">Ref.</th>
                            <th><?= __('No.') ?></th>
                            <th class="text-right hidden-xs" width="125"><?= __('Date') ?></th>
                            <th class="text-right hidden-xs" width="125"><?= __('Amount') ?></th>
                            <th class="text-right hidden-xs" width="125"><?= __('Expiry date') ?></th>
                            <th class="text-right" width="125"><?= __('Open amount') ?></th>
                            <th class="text-right" width="100"><?= __('Status') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($aList as $rule){ ?>
                            <tr data-href="/Invoice/view/<?= $rule->BKHVFNRINT ?>" class="<?= $rule->BKHVFSTATUS == 1 ? "text-danger" : "" ?>">
                                <td><?= $rule->BKHVFTEKST1 == "" ? "<em>" . __("N/A") . "</em>" : $rule->BKHVFTEKST1 ?></td>
                                <td><?= $rule->BKHVFNR ?></td>
                                <td data-sort="<?= $rule->BKHVFDATUM->format('Ymd') ?>" class="text-right hidden-xs"><?= $rule->BKHVFDATUM->format('d-m-Y') ?></td>
                                <td class="text-right hidden-xs">&euro; <?=  Number::precision($rule->BKHVFBEDRAG_EUR,2) ?></td>
                                <td data-sort="<?= is_null($rule->BKHVFDATUM_VV) ? 0 : $rule->BKHVFDATUM_VV->format('Ymd') ?>" class="text-right hidden-xs"><?= is_null($rule->BKHVFDATUM_VV) ? __('Not available') : $rule->BKHVFDATUM_VV->format('d-m-Y') ?></td>
                                <td class="text-right">
                                    &euro; <?= Number::precision($rule->BKHVFOPEN_VAL,2) ?>
                                </td>
                                <td class="text-right">
<!--                                    <span class="label label-info bgm---><?//= $rule->BKHVFSTATUSTEXT["color"] ?><!--">-->
<!--                                        --><?//= __($rule->BKHVFSTATUSTEXT["text"]) ?>
<!--                                    </span>-->
                                    <?= __($rule->BKHVFSTATUSTEXT["text"]) ?>
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
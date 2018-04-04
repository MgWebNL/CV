<?php
use Cake\I18n\Time;
?>

<!-- Modal -->
<?= $this->element('Modal/request'); ?>

<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Applications') ?> - <?= __('Box search') ?>
                </h2>
            </div>

            <div class="card-body card-padding">
                <div class="row">
                    <div class="col-xs-12 col-md-3 col-lg-2">
                        <form method="post" action="/Application/boxsearchrequest">
                            <label style="min-width: 100%">
                                <strong><?= __('Length') ?> in mm.</strong><br />
                                <input name="length" type="number" value="<?= @$aPost["length"] ?>" style="min-width: 100%">
                            </label><br />

                            <label style="min-width: 100%">
                                <strong><?= __('Width') ?> in mm.</strong><br />
                                <input name="width" type="number" value="<?= @$aPost["width"] ?>" style="min-width: 100%">
                            </label><br />

                            <label style="min-width: 100%">
                                <strong><?= __('Height') ?> in mm.</strong><br />
                                <input name="height" type="number" value="<?= @$aPost["height"] ?>" style="min-width: 100%">
                            </label><br />

                            <button type="submit" class="btn btn-hodi btn-block"><?= __('Search') ?></button>
                        </form>
                    </div>

                    <div class="col-xs-12 col-md-9 col-lg-10">
                        <?php if(!empty($aBoxes)){ ?>
                            <table class="table table-hover table-condensed no-padding">
                                <thead>
                                <tr>
                                    <th width="125">#</th>
                                    <th class="visible-xs"></th>
                                    <th class="hidden-xs"><?= __('Description') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($aBoxes as $rule){ ?>
                                    <tr data-href="/Article/view/<?= $rule->BKHARNRINT ?>">
                                        <td><?= $rule->BKHARCODE ?></td>
                                        <td class="visible-xs">&nbsp;</td>
                                        <td class="hidden-xs"><?= $rule->BKHAROMS ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        <?php }else{ ?>
                            <div class="alert alert-warning">
                                <?= __('No boxes found') ?><br />
                                <?= __('You can order your personal boxes') ?> <?= __('here') ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
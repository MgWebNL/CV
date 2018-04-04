<?php
// LINK
$link = '/Article/view/';
?>
<?php if(count($count) != 0) { ?>
    <table class="table table-hover table-condensed no-padding">
        <thead>
        <tr>
            <th width="125"><?= __('My code') ?></th>
            <th width="125"><?= __('Art.Code') ?></th>
            <th class="visible-xs"></th>
            <th class="hidden-xs"><?= __('Description') ?></th>
            <th class="text-right" width="80"><?= __('Qty') ?></th>
            <th class="hidden-xs text-right" width="125"><?= __('Date') ?></th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($count as $art){ ?>
            <?php
                $dateView = date('d-m-Y', strtotime($art->besteldatum));
                $date = date('Ymd', strtotime($art->besteldatum));
                $now = date('Ymd');
            ?>
            <tr data-href="<?= $link.($art->BKHARNRINT) ?>" <?= ($date < $now) ? "class='text-danger'" : "" ?>>
                <td><?= $art->customer_artNumber ?></td>
                <td><?= $art->BKHARCODE ?></td>
                <td class="visible-xs"></td>
                <td class="hidden-xs"><?= $art->BKHAROMS ?></td>
                <td class="hidden-xs text-right"><?= \Cake\I18n\Number::precision($art["ArticleUsage"]["opt_bst"], 0) ?></td>
                <td class="text-right">
                    <?= $dateView ?>
                </td>
            </tr>
        <?php } ?>

        <tr>
            <td colspan="5" class="text-center">
                <a href="/Article/Order/" class="btn btn-link"><?= __('Show all articles in order advice') ?></a>
            </td>
        </tr>

        </tbody>
    </table>
<?php }else{ ?>
    <div class="alert alert-warning">
        <?= __('There are no products in your Product Order Advice right now') ?>
    </div>
<?php } ?>
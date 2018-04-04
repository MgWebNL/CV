<?php
// LINK
$link = '/Invoice/Overview';
?>

<div data-href="<?= $link ?>" class="col-xs-<?= $xs ?> col-sm-<?= $sm ?> col-md-<?= $md ?> col-lg-<?= $lg ?> ">
    <div class="mini-charts-item bgm-hodi">
        <div class="clearfix">
            <div class="chart">
                <i class="fa fa-eur"></i>
            </div>
            <div class="count">
                <small><?= __('Open invoices') ?></small>
                <h2>&euro; <?= \Cake\I18n\Number::precision($count->Total->amount, 2) ?></h2>
            </div>
        </div>
    </div>
</div>
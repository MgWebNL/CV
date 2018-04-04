<?php
// LINK
$link = '/Quotation/index/0';
?>

<div data-href="<?= $link ?>" class="col-xs-<?= $xs ?> col-sm-<?= $sm ?> col-md-<?= $md ?> col-lg-<?= $lg ?> ">
    <div class="mini-charts-item bgm-hodi">
        <div class="clearfix">
            <div class="chart">
                <i class="fa fa-pencil-square-o"></i>
            </div>
            <div class="count">
                <small><?= __('Pending quotations') ?></small>
                <h2><?= \Cake\I18n\Number::precision($count, 0) ?></h2>
            </div>
        </div>
    </div>
</div>
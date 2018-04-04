<?php
// LINK
$link = '/Recommendation/';
$class = $count == 0 ? 'hodi' : 'orange';
?>

<div data-href="<?= $link ?>" class="col-xs-<?= $xs ?> col-sm-<?= $sm ?> col-md-<?= $md ?> col-lg-<?= $lg ?> ">
    <div class="mini-charts-item bgm-<?= $class ?>">
        <div class="clearfix">
            <div class="chart">
                <i class="fa fa-check"></i>
            </div>
            <div class="count">
                <small><?= __('Recommendations') ?></small>
                <h2><?= \Cake\I18n\Number::precision($count, 0) ?></h2>
            </div>
        </div>
    </div>
</div>
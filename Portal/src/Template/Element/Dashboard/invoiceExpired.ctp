<?php
    // LINK
    $link = '/Invoice/Overview';

    // KLEUR BEPALEN
    if($count->Late->amount > 0){
        $amount = $count->Late->amount;
        $color = 'red';
    }else{
        $amount = 0;
        $color = 'hodi';
    }
?>

<div data-href="<?= $link ?>" class="col-xs-<?= $xs ?> col-sm-<?= $sm ?> col-md-<?= $md ?> col-lg-<?= $lg ?> ">
    <div class="mini-charts-item bgm-<?= $color ?>">
        <div class="clearfix">
            <div class="chart">
                <i class="fa fa-exclamation-circle"></i>
            </div>
            <div class="count">
                <small><?= __('Expired invoices') ?></small>
                <h2>&euro; <?= \Cake\I18n\Number::precision($amount, 2) ?></h2>
            </div>
        </div>
    </div>
</div>
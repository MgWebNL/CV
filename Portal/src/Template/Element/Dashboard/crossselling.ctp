<?php
// LINK
$link = '/Article/view/';
?>

<div class="col-xs-<?= $xs ?> col-sm-<?= $sm ?> col-md-<?= $md ?> col-lg-<?= $lg ?> ">
    <!-- LIST -->
    <div class="card">
        <div class="card-header">
            <h2>
                <span id="orders"><?= __('Also interesting') ?></span>
            </h2>
        </div>

        <?php if(count($count) == 0){ ?>
            <div class="card-body card-padding hidden">
                <div class="alert alert-warning bgm-secondair m-b-0">
                    <?= __('No items available'); ?>
                </div>
            </div>
        <?php }else{ ?>
            <div class="card-body card-padding m-t-0 p-t-0">
                <div class="row">
                    <?php foreach($count as $rule){ ?>
                        <?php $link = isset($aGBLink[$rule->BKHGBNR]) ? base64_encode('/Test/'.$aGBLink[$rule->BKHGBNR].'/') : ''; ?>
                        <div class="col-xs-5">
                            <div class="well-sm">
                                <img class="center-block img-responsive img-thumbnail" src="<?= $rule->image ?>" />
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <h4 class="text-left"><?= $rule->BKHGBOMS ?></h4>
                            <h2 class="text-left"><?= $rule->BKHARCODE ?></h2>
                            <p class="text-left"><?= nl2br($rule->BKHAROMS) ?></p>
                        </div>
                        <div class="col-xs-12">
                            <div class="well-sm">
                                <a href="/Webshop/index/<?= $link ?>" class="btn btn-hodi btn-block" target="_portal"><?= __('Show') ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
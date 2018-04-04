<?php use Cake\I18n\Number; ?>
<!-- CONTENT -->
<div class="row">
    <div class="col-xs-12">
        <!-- Recent Posts -->
        <div class="card">
            <div class="card-header">
                <h2>
                    <?= __('Recommendations') ?>
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
                    <div class="row">
                        <?php foreach($aList as $rule){ ?>
                            <?php
                            $link = isset($aGBLink[$rule->BKHGBNR]) ? base64_encode('/Test/'.$aGBLink[$rule->BKHGBNR].'/') : '';
                            if($link != ''){
                            ?>
                            <div class="col-xs-6 col-md-3 col-lg-2">
                                <div class="well-sm">
                                    <img class="center-block img-responsive img-thumbnail" src="<?= $rule->image ?>" />
                                    <p class="text-center"><?= $rule->BKHGBOMS ?></p>
<!--                                    <p class="text-center">--><?//= $rule->BKHGBNR ?><!--</p>-->
                                    <a href="/Webshop/index/<?= $link ?>" class="btn btn-hodi btn-block" target="_portal"><?= __('Show') ?></a>
                                </div>
                            </div>
                        <?php }} ?>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>
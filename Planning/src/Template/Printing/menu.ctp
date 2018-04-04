<?php use Cake\I18n\Number; ?>
<div class="row">

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Preprinting/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[100], 0) ?>
                </h3>
                <p>Bestellen bij drukkerij</p>
            </div>
            <div class="icon">
                <i class="fa fa-print"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[100], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Printing/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[101], 0) ?>
                </h3>
                <p>Orders bij drukkerij</p>
            </div>
            <div class="icon">
                <i class="fa fa-print"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[101], 0) ?></h4>
            </div>
        </div>
    </div>
</div>

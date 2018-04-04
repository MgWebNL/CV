<?php use Cake\I18n\Number; ?>
<div class="row">

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Transport/waitinglist/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[112], 0) ?>
                </h3>
                <p>Verzenden naar Hodi</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[112], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Transport/loading/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[113], 0) ?>
                </h3>
                <p>Laadvolgorde</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[113], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Transport/intake/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[114], 0) ?>
                </h3>
                <p>Aankomst Hodi</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[114], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Transport/assign/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[115], 0) ?>
                </h3>
                <p>Aanmelden transport</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[115], 0) ?></h4>
            </div>
        </div>
    </div>

</div>
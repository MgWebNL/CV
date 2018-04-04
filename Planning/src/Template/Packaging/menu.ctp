<?php use Cake\I18n\Number; ?>
<div class="row">

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Prepackaging/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[102], 0) ?>
                </h3>
                <p>Wachten op ontvangst</p>
            </div>
            <div class="icon">
                <i class="fa fa-cog"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[102], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Prepackaging/OnMachine/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[103], 0) ?>
                </h3>
                <p>Op machine</p>
            </div>
            <div class="icon">
                <i class="fa fa-cog"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[103], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Packaging/ToPack/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[104], 0) ?>
                </h3>
                <p>Naar verpakker</p>
            </div>
            <div class="icon">
                <i class="fa fa-cog"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[104], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Packaging/Intake/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[109], 0) ?>
                </h3>
                <p>Ontvangst verpakker</p>
            </div>
            <div class="icon">
                <i class="fa fa-cog"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[109], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Packaging/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[105], 0) ?>
                </h3>
                <p>Bij verpakker</p>
            </div>
            <div class="icon">
                <i class="fa fa-cog"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[105], 0) ?></h4>
            </div>
        </div>
    </div>

</div>
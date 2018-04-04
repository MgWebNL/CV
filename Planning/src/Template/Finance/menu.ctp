<?php use Cake\I18n\Number; ?>
<div class="row">

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Finance/Intake/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[106], 0) ?>
                </h3>
                <p>Inslaan</p>
            </div>
            <div class="icon">
                <i class="fa fa-euro"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[106], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Finance/Invoice/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[107], 0) ?>
                </h3>
                <p>Factureren</p>
            </div>
            <div class="icon">
                <i class="fa fa-euro"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[107], 0) ?></h4>
            </div>
        </div>
    </div>

    <!-- BLOCK POLEN -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Finance/Transport/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount[108], 0) ?>
                </h3>
                <p>Transportkosten</p>
            </div>
            <div class="icon">
                <i class="fa fa-euro"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity[108], 0) ?></h4>
            </div>
        </div>
    </div>

</div>
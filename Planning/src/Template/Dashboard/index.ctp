<?php use Cake\I18n\Number; ?>
<div class="row">

  <!-- BLOCK CONTACT -->
  <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Contact/">
    <div class="small-box bg-purple-gradient">
      <div class="inner">
        <h3>
          <?= @Number::precision($aCount["prepress"], 0) ?>
        </h3>
        <p>Contact</p>
      </div>
      <div class="icon">
        <i class="fa fa-phone"></i>
      </div>
      <div class="small-box-footer bg-purple-active">
        <h4><?= @Number::precision($aQuantity["prepress"], 0) ?></h4>
        </div>
    </div>
  </div>

  <!-- BLOCK STUDIO -->
  <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Studio/">
    <div class="small-box bg-purple-gradient">
      <div class="inner">
        <h3>
          <?= @Number::precision($aCount["studio"], 0) ?>
        </h3>
        <p>Studio</p>
      </div>
      <div class="icon">
        <i class="fa fa-paint-brush"></i>
      </div>
      <div class="small-box-footer bg-purple-active">
        <h4><?= @Number::precision($aQuantity["studio"], 0) ?></h4>
        </div>
    </div>
  </div>

  <!-- BLOCK DRUKKERIJ -->
  <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Printing/menu">
    <div class="small-box bg-purple-gradient">
      <div class="inner">
        <h3>
          <?= @Number::precision($aCount["printing"], 0) ?>
        </h3>
        <p>Drukkerij</p>
      </div>
      <div class="icon">
        <i class="fa fa-print"></i>
      </div>
      <div class="small-box-footer bg-purple-active">
        <h4><?= @Number::precision($aQuantity["printing"], 0) ?></h4>
        </div>
    </div>
  </div>

  <!-- BLOCK POLEN -->
  <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Packaging/menu">
    <div class="small-box bg-purple-gradient">
      <div class="inner">
        <h3>
          <?= @Number::precision($aCount["packaging"], 0) ?>
        </h3>
        <p>Verpakken</p>
      </div>
      <div class="icon">
        <i class="fa fa-cog"></i>
      </div>
      <div class="small-box-footer bg-purple-active">
        <h4><?= @Number::precision($aQuantity["packaging"], 0) ?></h4>
        </div>
    </div>
  </div>

    <!-- BLOCK Transport -->
    <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Transport/menu/">
        <div class="small-box bg-purple-gradient">
            <div class="inner">
                <h3>
                    <?= @Number::precision($aCount["transport"], 0) ?>
                </h3>
                <p>Transport</p>
            </div>
            <div class="icon">
                <i class="fa fa-truck"></i>
            </div>
            <div class="small-box-footer bg-purple-active">
                <h4><?= @Number::precision($aQuantity["transport"], 0) ?></h4>
            </div>
        </div>
    </div>

  <!-- BLOCK FINANCIEEL -->
  <div class="col-lg-2 col-xs-6 col-sm-4" data-href="/Finance/menu/">
    <div class="small-box bg-purple-gradient">
      <div class="inner">
        <h3>
          <?= @Number::precision($aCount["finance"], 0) ?>
        </h3>
        <p>Financieel</p>
      </div>
      <div class="icon">
        <i class="fa fa-euro"></i>
      </div>
      <div class="small-box-footer bg-purple-active">
        <h4><?= @Number::precision($aQuantity["finance"], 0) ?></h4>
      </div>
    </div>
  </div>

<?//= __('Dit is een test'); ?>

</div>